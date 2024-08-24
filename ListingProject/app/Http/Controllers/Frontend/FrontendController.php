<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\BlogComment;
use App\Models\Category;
use App\Models\Hero;
use App\Models\Listing;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Events\CreateOrder;
use App\Models\AboutUs;
use App\Models\Amenity;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Claim;
use App\Models\Contact;
use App\Models\Counter;
use App\Models\ListingSchedule;
use App\Models\Location;
use App\Models\OurFeature;
use App\Models\PrivacyPolicy;
use App\Models\Review;
use App\Models\SectionTitle;
use App\Models\TermsAndCondition;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Session;

class FrontendController extends Controller
{
    public function index(): View
    {
        $sectionTitles = SectionTitle::first();
        $hero = Hero::first();
        $ourFeatures = OurFeature::where('status', 1)->get();
        $counter = Counter::first();
        $testimonials = Testimonial::where('status', 1)->get();
        $blogs = Blog::with('author')->where('status', 1)->orderBy('id', 'Desc')->take(3)->get();
        $categories = Category::where('status', 1)->get();
        $locations = Location::where('status', 1)->get();
        $packages = Package::where('status', 1)->where('show_at_home', 1)->take(3)->get();
        $featuredCategories = Category::withCount([
            'listings' => function ($query) {
                $query->where('is_approved', 1);
            }
        ])->where(['status' => 1, 'show_at_home' => 1])->take(6)->get();

        //featured locations
        $featuredLocations = Location::where(['show_at_home' => 1, 'status' => 1])->get();

        $featuredLocations->each(function($location) {
            $location->listings = $location->listings()
            ->withAvg(['reviews' => function($query) {
                $query->where('is_approved', 1);
            }], 'rating')
            ->withCount(['reviews' => function($query) {
                $query->where('is_approved', 1);
            }])
            ->where(['status' => 1, 'is_approved' => 1])
            ->orderBy('id', 'desc')
            ->take(8)->get();
        });

        //featured litings
        $featuredListings = Listing::withAvg([
            'reviews' => function ($query) {
                $query->where('is_approved', 1);
            }
        ], 'rating')
            ->withCount([
                'reviews' => function ($query) {
                    $query->where('is_approved', 1);
                }
            ])
            ->where(['status' => 1, 'is_approved' => 1, 'is_featured' => 1])
            ->orderBy('id', 'desc')->limit(10)->get();

        return view(
            'frontend.home.index',
            compact(
                'hero',
                'categories',
                'packages',
                'featuredCategories',
                'featuredLocations',
                'featuredListings',
                'locations',
                'ourFeatures',
                'counter',
                'testimonials',
                'blogs',
                'sectionTitles'
            )
        );

    }

    public function listings(Request $request): View
    {
        $listings = Listing::withAvg([
            'reviews' => function ($query) {
                $query->where('is_approved', 1);
            }
        ], 'rating')
            ->withCount([
                'reviews' => function ($query) {
                    $query->where('is_approved', 1);
                }
            ])
            ->with('category', 'location')->where(['status' => 1, 'is_approved' => 1]);

        //Used for searching when the category slug is passed in the url
        $listings->when($request->has('category') && $request->filled('category'), function ($query) use ($request) {
            $query->whereHas('category', function ($subQuery) use ($request) {
                $subQuery->where('slug', $request->category);
            });
        });
        //Used for searching when a string is passed in the url
        $listings->when($request->has('search') && $request->filled('search'), function ($query) use ($request) {
            $query->where(function ($subquery) use ($request) {
                $subquery->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        });
        //Used for searching when a location slug is passed in the url
        $listings->when($request->has('location') && $request->filled('location'), function ($query) use ($request) {
            $query->whereHas('location', function ($subQuery) use ($request) {
                $subQuery->where('slug', $request->location);
            });
        });

        //Used for searching based in amenities
        $listings->when($request->has('amenity') && is_array($request->amenity), function ($query) use ($request) {
            $amenityIds = Amenity::whereIn('slug', $request->amenity)->pluck('id');

            $query->whereHas('amenities', function ($subQuery) use ($amenityIds) {
                $subQuery->whereIn('amenity_id', $amenityIds);
            });
        });

        $listings = $listings->paginate(12);

        $categories = Category::where('status', 1)->get();
        $locations = Location::where('status', 1)->get();
        $amenities = Amenity::where('status', 1)->get();

        return view('frontend.pages.listings', compact('listings', 'categories', 'locations', 'amenities'));
    }

    public function listingModal(string $id)
    {
        $listing = Listing::findOrFail($id);

        return view('frontend.layouts.ajax-listing-modal', compact('listing'))->render();
    }

    public function showListing(string $slug): View
    {
        $listing = Listing::withAvg([
            'reviews' => function ($query) {
                $query->where('is_approved', 1);
            }
        ], 'rating')
            ->where(['status' => 1, 'is_approved' => 1])->where(['slug' => $slug])->firstOrFail();
        if ($listing) {
            $listing->increment('views');
        } else {
            abort(404);
        }

        $openStatus = $this->listingScheduleStatus($listing);

        $reviews = Review::with('user')->where(['listing_id' => $listing->id, 'is_approved' => 1])->paginate(10);

        $similarListings = Listing::where('category_id', $listing->category_id)
            ->where('id', '!=', $listing->id)->orderBy('id', 'DESC')->take(4)->get();
        return view(
            'frontend.pages.listing-view',
            compact(
                'listing',
                'similarListings',
                'openStatus',
                'reviews'
            )
        );
    }

    public function listingScheduleStatus(Listing $listing): ?string
    {
        $openStatus = '';

        $day = ListingSchedule::where('listing_id', $listing->id)->where('day', \Str::lower(date('l')))->first();
        if ($day) {
            $startTime = strtotime($day->start_time);
            $endTime = strtotime($day->end_time);
            if (time() >= $startTime && time() <= $endTime) {
                $openStatus = 'open';
            } else {
                $openStatus = 'closed';
            }
        }
        return $openStatus;
    }

    public function showPackages(): View
    {
        $packages = Package::where('status', 1)->get();
        return view('frontend.pages.packages', compact('packages'));
    }

    public function checkout(string $id): View
    {
        $package = Package::findOrFail($id);

        /*  store package id in session */
        Session()->put('selected_package_id', $package->id);

        /* If package is free, then direct place order */
        if ($package->type === 'free' || $package->price === 0) {
            $paymentInfo = [
                'transaction_id' => uniqid(),
                'paid_amount' => 0,
                'paid_currency' => config('settings.site_default_currency'),
                'payment_method' => 'free',
                'payment_status' => 'completed',
            ];
            CreateOrder::dispatch($paymentInfo);

            toastr()->success('Package suscribed successfully');
            return view('frontend.dashboard.index');
        }

        return view('frontend.pages.checkout', compact('package'));
    }

    public function submitReview(Request $request): RedirectResponse
    {
        $request->validate([
            'rating' => ['required', 'in:1,2,3,4,5'],
            'review' => ['required', 'max:500'],
            'listing_id' => ['required', 'integer'],
        ]);

        $prevReview = Review::where(['listing_id' => $request->listing_id, 'user_id' => auth()->user()->id])->exists();

        if ($prevReview) {
            throw ValidationException::withMessages(['You already added a review for this listing!']);
        }

        $review = new Review();
        $review->listing_id = $request->listing_id;
        $review->user_id = auth()->user()->id;
        $review->rating = $request->rating;
        $review->review = $request->review;
        $review->save();

        toastr()->success('Review Added successfully!');

        return redirect()->back();
    }

    public function submitClaim(Request $request): RedirectResponse
    {
        request()->validate([
            'listing_id' => 'required|integer',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'claim' => 'required|max:300',
        ]);

        $claim = new Claim();
        $claim->listing_id = $request->listing_id;
        $claim->name = $request->name;
        $claim->email = $request->email;
        $claim->claim = $request->claim;
        $claim->save();

        toastr()->success('Claim submitted successfully!');

        return redirect()->back();
    }

    public function blog(Request $request): View
    {
        $blogs = Blog::with('author')->where('status', 1)
            ->when($request->has('search') && $request->filled('search'), function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            })
            ->when($request->has('category') && $request->filled('category'), function ($query) use ($request) {
                $category = BlogCategory::select('id')->where('slug', $request->category)->first();
                $query->where('blog_category_id', $category->id);
            })
            ->orderBy('id', 'Desc')
            ->paginate(9);
        return view('frontend.pages.blog', compact('blogs'));
    }

    public function blogShow(string $slug): View
    {
        $blog = Blog::with(['category', 'comments'])->where(['slug' => $slug, 'status' => 1])->firstOrFail();
        $popularBlogs = Blog::select(['id', 'title', 'slug', 'created_at', 'image'])->where('id', '!=', $blog->id)
            ->where('is_popular', 1)->orderBy('id', 'desc')->take(5)->get();
        $categories = BlogCategory::withCount([
            'blogs' => function ($query) {
                $query->where('status', 1);
            }
        ])
            ->where('status', 1)->get();

        return view('frontend.pages.blog-show', compact('blog', 'categories', 'popularBlogs'));
    }

    public function blogCommentStore(Request $request)
    {
        $request->validate([
            'blog_id' => 'required|integer',
            'comment' => 'required|string|max:500',
        ]);

        $comment = new BlogComment();
        $comment->blog_id = $request->blog_id;
        $comment->user_id = auth()->user()->id;
        $comment->comment = $request->comment;
        $comment->save();

        toastr()->success('Comment added successfully and waiting for approval!');

        return redirect()->back();
    }

    public function aboutIndex(): View
    {
        $sectionTitles = SectionTitle::first();
        $about = AboutUs::first();
        $counter = Counter::first();
        $ourFeatures = OurFeature::where('status', 1)->get();
        $featuredCategories = Category::withCount([
            'listings' => function ($query) {
                $query->where('is_approved', 1);
            }
        ])->where(['status' => 1, 'show_at_home' => 1])->take(6)->get();
        return view('frontend.pages.about', compact('about', 'counter', 'ourFeatures', 'featuredCategories','sectionTitles'));
    }

    public function contactIndex(): View
    {
        $contact = Contact::first();
        return view('frontend.pages.contact', compact('contact'));
    }

    public function contactMessage(Request $request) : redirectResponse
    {
        request()->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:50',
            'subject' => 'required|max:200',
            'message' => 'required|max:2000',
        ]);

        Mail::to(config('settings.site_email'))->send(new ContactMail($request->name, $request->subject, $request->message));

        toastr()->success('Message sent successfully!');

        return redirect()->back();
    }

    public function privacyPolicy(): View
    {
        $policy = PrivacyPolicy::first();
        return view('frontend.pages.privacy-policy', compact('policy'));
    }
    public function termsAndCondiitons(): View
    {
        $termsAndConditions = TermsAndCondition::first();
        return view('frontend.pages.terms-and-conditions', compact('termsAndConditions'));
    }

}
