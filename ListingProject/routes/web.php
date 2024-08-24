<?php

use App\Http\Controllers\Frontend\AgentListingController;
use App\Http\Controllers\Frontend\AgentListingScheduleController;
use App\Http\Controllers\Frontend\AgentListingsImageGalleryController;
use App\Http\Controllers\Frontend\AgentListingVideoGalleryController;
use App\Http\Controllers\Frontend\ChatController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\frontend\OrderController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\frontend\ReviewController;
use App\Http\Controllers\PaymentController;
use App\Models\Order;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/listings',[FrontendController::class, 'listings'])->name('listings');
Route::get('/listing-modal/{id}',[FrontendController::class, 'listingModal'])->name('listing-modal');
Route::get('/listing/{slug}',[FrontendController::class, 'showListing'])->name('listing.show');
Route::get('/packages',[FrontendController::class, 'showPackages'])->name('packages');
Route::get('/checkout/{id}',[FrontendController::class, 'checkout'])->name('checkout.index');
//review route
Route::post('listing-review', [FrontendController::class, 'submitReview'])->name('listing-review.store')->middleware('auth');
//claim Routes
Route::post('claim', [FrontendController::class, 'submitClaim'])->name('submit-claim');

/* Blog Routes */
Route::get('/blog', [FrontendController::class, 'blog'])->name('blog.index');
Route::get('/blog/{slug}', [FrontendController::class, 'blogShow'])->name('blog.show');
Route::post('/blog-comment', [FrontendController::class, 'blogCommentStore'])->name('blog-comment.store');

/* Contact Us Routes*/
Route::get('/contact', [FrontendController::class, 'contactIndex'])->name('contact.index');
Route::post('/contact', [FrontendController::class, 'contactMessage'])->name('contact.message');

/* About Routes*/
Route::get('/about-us', [FrontendController::class, 'aboutIndex'])->name('about.index');

/* Privacy POlicy  Routes*/
Route::get('/privacy-policy', [FrontendController::class, 'privacyPolicy'])->name('privacy-policy.index');

/* Privacy POlicy  Routes*/
Route::get('/terms-and-conditions', [FrontendController::class, 'termsAndCondiitons'])->name('terms-and-conditions.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => 'auth', 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile-password', [ProfileController::class, 'passwordUpdate'])->name('profile-password.update');
    Route::get('/messages', [ChatController::class, 'index'])->name('messages');

    /* Message Route */
    Route::post('/send-message', [ChatController::class, 'sendMessage'])->name('send-message');
    Route::get('/get-messages', [ChatController::class, 'getMessages'])->name('get-messages');


    /*  Agent Listing Routes */
    Route::resource('/listing', AgentListingController::class);

    /* Agent Listing Image Gallery Routes */

    Route::resource('/listing-image-gallery', AgentListingsImageGalleryController::class);

    /* Listing Video Gallery Routes */

    Route::resource('/listing-video-gallery', AgentListingVideoGalleryController::class);

     /* Listing Schedule Routes */

     Route::get('/listing-schedule/{listing_id}', [AgentListingScheduleController::class, 'index'])->name('listing-schedule.index');

     Route::get('/listing-schedule/{listing_id}/create', [AgentListingScheduleController::class, 'create'])->name('listing-schedule.create');

     Route::post('/listing-schedule/create/{listing_id}', [AgentListingScheduleController::class, 'store'])->name('listing-schedule.store');

     Route::get('/listing-schedule/create/{id}/edit', [AgentListingScheduleController::class, 'edit'])->name('listing-schedule.edit');

     Route::put('/listing-schedule/create/{id}/', [AgentListingScheduleController::class, 'update'])->name('listing-schedule.update');

     Route::delete('/listing-schedule/delete/{id}/', [AgentListingScheduleController::class, 'destroy'])->name('listing-schedule.destroy');

     /* Order Routes */
     Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
     Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');

     /* Review Routes */
     Route::resource('/reviews', ReviewController::class);

    });

    /* Payment Routes */
Route::group(['middleware' => 'auth'], function(){
    Route::get('payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('payment/cancel', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');

   /*  Paypal Routes */
    Route::get('paypal/payment', [PaymentController::class, 'payWithPaypal'])->name('paypal.payment');
    Route::get('paypal/success', [PaymentController::class, 'paypalSuccess'])->name('paypal.success');
    Route::get('paypal/cancel', [PaymentController::class, 'paypalCancel'])->name('paypal.cancel');

   /*  Stripe Routes */
    Route::get('stripe/payment', [PaymentController::class, 'payWithStripe'])->name('stripe.payment');
    Route::get('stripe/success', [PaymentController::class, 'stripeSuccess'])->name('stripe.success');
    Route::get('stripe/cancel', [PaymentController::class, 'stripeCancel'])->name('stripe.cancel');

   /*  Razorpay Routes */
    Route::get('razorpay/redirect', [PaymentController::class, 'razorpayRedirect'])->name('razorpay.redirect');
    Route::get('razorpay/payment', [PaymentController::class, 'payWithRazorpay'])->name('razorpay.payment');
});

require __DIR__ . '/auth.php';
