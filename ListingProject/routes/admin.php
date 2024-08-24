<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AmenityController;
use App\Http\Controllers\admin\BlogCategoryController;
use App\Http\Controllers\admin\BlogCommentController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\admin\ChatController;
use App\Http\Controllers\admin\ClaimController;
use App\Http\Controllers\admin\ClearDatabaseController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\CounterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\admin\FooterInfoController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\ListingController;
use App\Http\Controllers\Admin\ListingScheduleController;
use App\Http\Controllers\Admin\ListingVideoGalleryController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\admin\MenuBuilderContoller;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\OurFeatureControlller;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PaymentSettingController;
use App\Http\Controllers\Admin\PendingListingController;
use App\Http\Controllers\admin\PrivacyPolicyController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\admin\ReviewController;
use App\Http\Controllers\admin\RolePermissionController;
use App\Http\Controllers\Admin\RoleUserController;
use App\Http\Controllers\admin\SectionTitleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SociaLinkController;
use App\Http\Controllers\admin\TermsAndConditionsController;
use App\Http\Controllers\admin\TestimonialController;
use App\Http\Controllers\ListingImageGalleryController;
use Illuminate\Support\Facades\Route;


Route::get('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login')->middleware('guest');
Route::get('/admin/forgot-password', [AdminAuthController::class, 'PasswordRequest'])->name('admin.password.request')->middleware('guest');

Route::group([
    'middleware' => ['auth', 'user.type:admin'],
    'prefix' => 'admin',
    'as' => 'admin.'
], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    /*  Profile Routes */

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile-password', [ProfileController::class, 'passwordUpdate'])->name('profile-password.update');

    /*  Hero routes */

    Route::get('/hero', [HeroController::class, 'index'])->name('hero.index');
    Route::put('/hero', [HeroController::class, 'update'])->name('hero.update');

    /* Section Title Routes */
    Route::get('/section-title', [SectionTitleController::class, 'index'])->name('section-title.index');
    Route::post('/section-titles', [SectionTitleController::class, 'update'])->name('section-title.update');


    /* Category routes */

    Route::resource('/category', CategoryController::class);

    /* Location Routes */

    Route::resource('/location', LocationController::class);

    /*  Amenity Routes */

    Route::resource('/amenity', AmenityController::class);

    /* Listing Routes */

    Route::resource('/listing', ListingController::class);

    /*Pending Listing Routes */

    Route::get('/pending-listing', [PendingListingController::class, 'index'])->name('pending-listing.index');
    Route::post('/pending-listing', [PendingListingController::class, 'update'])->name('pending-listing.update');

    /* Listing Image Gallery Routes */

    Route::resource('/listing-image-gallery', ListingImageGalleryController::class);

    /* Listing Video Gallery Routes */

    Route::resource('/listing-video-gallery', ListingVideoGalleryController::class);

    /* Listing Schedule Routes */

    Route::get('/listing-schedule/{listing_id}', [ListingScheduleController::class, 'index'])->name('listing-schedule.index');

    Route::get('/listing-schedule/{listing_id}/create', [ListingScheduleController::class, 'create'])->name('listing-schedule.create');

    Route::post('/listing-schedule/create/{listing_id}', [ListingScheduleController::class, 'store'])->name('listing-schedule.store');

    Route::get('/listing-schedule/create/{id}/edit', [ListingScheduleController::class, 'edit'])->name('listing-schedule.edit');

    Route::put('/listing-schedule/create/{id}/', [ListingScheduleController::class, 'update'])->name('listing-schedule.update');

    Route::delete('/listing-schedule/delete/{id}/', [ListingScheduleController::class, 'destroy'])->name('listing-schedule.destroy');

    /* Listing Review */
    Route::get('listing-reviews', [ReviewController::class, 'index'])->name('listing-reviews.index');
    Route::get('listing-reviews/{id}', [ReviewController::class, 'updateStatus'])->name('listing-reviews.update');
    Route::delete('listing-reviews/{id}', [ReviewController::class, 'destroy'])->name('listing-reviews.destroy');

    //Claim Routes
    Route::get('/listing-claims', [ClaimController::class, 'index'])->name('listing-claims');
    Route::delete('/listing-claims/{id}', [ClaimController::class, 'destroy'])->name('listing-claims.destroy');

    /* Package Routes */
    Route::resource('/package', PackageController::class);

    /* Order Routes */
    Route::resource('/order', OrderController::class);

    /* Message Routes */
    Route::get('messages', [ChatController::class, 'index'])->name('messages');
    Route::get('/get-messages', [ChatController::class, 'getMessages'])->name('get-messages');
    Route::post('/send-message', [ChatController::class, 'sendMessage'])->name('send-message');

    /* Our Feature Routes */
    Route::resource('our-features', OurFeatureControlller::class);

    /* Counter Routes */
    Route::resource('counter', CounterController::class);

    /* Testimonial Routes */
    Route::resource('testimonials', TestimonialController::class);

    /* Blog Routes */
    Route::resource('blog-category', BlogCategoryController::class);
    Route::resource('blog', BlogController::class);
    Route::get('blog-comment', [BlogCommentController::class, 'index'])->name('blog-comment.index');
    Route::delete('blog-comment/{id}', [BlogCommentController::class, 'destroy'])->name('blog-comment.destroy');

    /* About Routes */
    Route::get('about-us', [AboutController::class, 'index'])->name('about-us.index');
    Route::post('about-us', [AboutController::class, 'update'])->name('about-us.update');

    /* Contact Routes */
    Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('contact', [ContactController::class, 'update'])->name('contact.update');

   /*  Footer Info Routes */
   Route::get('footer-info', [FooterInfoController::class, 'index'])->name('footer-info.index');
   Route::post('footer-info', [FooterInfoController::class, 'update'])->name('footer-info.update');

   /* Privacy Policy  Routes */
   Route::get('privacy-policy', [PrivacyPolicyController::class, 'index'])->name('privacy-policy.index');
   Route::post('privacy-policy', [PrivacyPolicyController::class, 'update'])->name('privacy-policy.update');

   /* Menu Builder Routes */
   Route::get('menu-builder', [MenuBuilderContoller::class, 'index'])->name('menu-builder.index');

   /* Social Link Routes */
   Route::resource('social-link', SociaLinkController::class);

   /* Role Routes */
   Route::resource('role', RolePermissionController::class);

   /* Role user  Routes */
   Route::resource('role-user',RoleUserController::class);

   /*  Terms and Conditions Routes */
   Route::get('terms-and-conditions', [TermsAndConditionsController::class, 'index'])->name('terms-and-conditions.index');
   Route::post('terms-and-conditions', [TermsAndConditionsController::class, 'update'])->name('terms-and-conditions.update');


    Route::post('comment-status', [BlogCommentController::class, 'commentStatusUpdate'])->name('comment-status.update');

    /* Settings Routes */
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/general-settings', [SettingController::class, 'updateGeneralSettings'])->name('general-settings.update');
    Route::post('/logo-settings', [SettingController::class, 'updateLogoSettings'])->name('logo-settings.update');
    Route::post('/pusher-settings', [SettingController::class, 'updatePusherSettings'])->name('pusher-settings.update');
    Route::post('/appearance-settings', [SettingController::class, 'updateAppearanceSettings'])->name('appearance-settings.update');

     /*Payment Settings Routes */
    Route::get('/payment-settings', [PaymentSettingController::class, 'index'])->name('payment-settings.index');
    Route::post('/paypal-settings', [PaymentSettingController::class, 'payPalSetting'])->name('paypal-settings.update');

    Route::post('/stripe-settings', [PaymentSettingController::class, 'stripeSetting'])->name('stripe-settings.update');

    Route::post('/razorpay-settings', [PaymentSettingController::class, 'razorpaySetting'])->name('razorpay-settings.update');

    /* Database Clear Route */
    Route::get('/clear-database', [ClearDatabaseController::class, 'index'])->name('clear-database.index');
    Route::post('/clear-database', [ClearDatabaseController::class, 'createDB'])->name('clear-database');
});
