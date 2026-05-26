<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\WebPushController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;


// landing
Route::get('/', [LandingController::class, 'home_view'])->name('landing.accueil.accueil');
Route::get('/apropos', [LandingController::class, 'about_view'])->name('landing.about.accueil');
Route::get('/contact', [LandingController::class, 'contact_view'])->name('landing.contact.accueil');
Route::post('/contact', [ContactController::class, 'contact'])->name('landing.contact.post');
Route::get('/faq', [LandingController::class, 'faq_view'])->name('landing.faq.accueil');
Route::get('/politique-confidentialite', [LandingController::class, 'privacy_view'])->name('landing.privacy.accueil');
Route::get('/evenements', [LandingController::class, 'event_view_sort'])->name('landing.events.accueil');
Route::get('/evenement/detail/{id}', [LandingController::class, 'event_detail_view'])->name('landing.events.detail');
Route::get('/menus', [LandingController::class, 'menu_view_sort'])->name('landing.menu.accueil');
Route::get('/menu/detail/{id}', [LandingController::class, 'menu_detail_view'])->name('landing.menu.detail');
Route::get('/offres', [LandingController::class, 'offers_view_sort'])->name('landing.offers.accueil');
Route::get('/profils', [LandingController::class, 'restaurants_view'])->name('landing.profil.accueil');
Route::get('/offre/detail/{id}', [LandingController::class, 'offer_detail_view'])->name('landing.offers.detail');
Route::get('/profil/detail/{id}', [LandingController::class, 'restaurant_detail'])->name('landing.profil.detail');
Route::get('/avis/{slug}/{id}', [LandingController::class, 'review_view'])->name('review.view');
Route::POST('/avis/{slug}/{id}', [ReviewController::class, 'create'])->name('review.create');



// authentication
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login_view')->name('login.view');
    Route::get('/login/account/suspended', 'suspended_view')->name('suspended.view');
    Route::get('/deconnexion', 'logout')->name('logout');
    Route::post('/login', 'login')->name('login');
    Route::get('/register', 'register_view')->name('register.view');
    Route::get('/register/community', 'join_community_view')->name('join.community.view');
    Route::post('/register/community', 'join_community')->name('join.community');
    Route::post('/register', 'register')->name('register');
    Route::get('/confirmation-mail/{token}', 'confirmEmail')->name('confirm-email');
    Route::get('/suppression', 'delete_account_view')->name('delete-account.view')->middleware('auth');
    Route::post('/suppression', 'delete_account')->name('delete-account')->middleware('auth');
    //forget password
    Route::prefix('/password-forget')->group(function () {
        Route::get('/', 'password_reset_view')->name('password_reset.view');
        Route::post('/', 'password_reset')->name('password_reset');
        Route::get('/change-password/{token}', 'change_password_view')->name('change_password.view');
        Route::post('/change-password', 'change_password')->name('change_password');
    });
});



// dashboard
Route::prefix('/compte/dashboard')->name('dashboard.')->group(function () {


    Route::get('', [DashboardController::class, 'dashboard_view'])->name('index.view')->middleware('auth')->middleware('profile.required');
    Route::get('/calendrier', [DashboardController::class, 'calendar_view'])->name('calendar.view')->middleware('auth')->middleware('profile.required');
    Route::get('/evenements', [DashboardController::class, 'event_view'])->name('event.view')->middleware('auth')->middleware('profile.required');
    Route::get('/evenements/nouvel', [DashboardController::class, 'new_event_view'])->name('event.new.view')->middleware('auth')->middleware('profile.required');
    Route::post('/evenements/nouvel', [EventController::class, 'create'])->name('event.new.create')->middleware('auth')->middleware('profile.required');
    Route::get('/evenements/{id}/delete', [EventController::class, 'delete'])->name('event.delete')->middleware('auth')->middleware('profile.required');
    Route::get('/evenements/{id}/edit', [DashboardController::class, 'update_event_view'])->name('event.edit.view')->middleware('auth')->middleware('profile.required');
    Route::post('/evenements/{id}/edit', [EventController::class, 'update'])->name('event.edit')->middleware('auth');
    Route::post('/evenements/images/{id}/edit', [EventController::class, 'update_image'])->name('event.image.edit')->middleware('auth')->middleware('profile.required');
    Route::post('/evenements/images/{id}/add', [EventController::class, 'add_image'])->name('event.image.add')->middleware('auth')->middleware('profile.required');
    Route::delete('/evenements/images/{id}/delete', [EventController::class, 'delete_image'])->name('event.image.delete')->middleware('auth')->middleware('profile.required');
    Route::get('/offres', [DashboardController::class, 'offers_view'])->name('offers.view')->middleware('auth')->middleware('profile.required');
    Route::get('/offres/nouvel', [DashboardController::class, 'new_offers_view'])->name('new_offers.view')->middleware('auth')->middleware('profile.required');
    Route::post('/offres/nouvel', [OfferController::class, 'create'])->name('new_offers.create')->middleware('auth')->middleware('profile.required');
    Route::get('/offres/{id}/update', [DashboardController::class, 'update_offers_view'])->name('update_offers.view')->middleware('auth')->middleware('profile.required');
    Route::post('/offres/{id}/update', [OfferController::class, 'update'])->name('update_offers.update')->middleware('auth')->middleware('profile.required');
    Route::get('/offres/{id}/delete', [OfferController::class, 'delete'])->name('offers.delete')->middleware('auth')->middleware('profile.required');
    Route::post('/offres/images/{id}/edit', [OfferController::class, 'update_image'])->name('offer.image.edit')->middleware('auth')->middleware('profile.required');
    Route::post('/offres/images/{id}/add', [OfferController::class, 'add_image'])->name('offer.image.add')->middleware('auth')->middleware('profile.required');
    Route::delete('/offres/images/{id}/delete', [OfferController::class, 'delete_image'])->name('offer.image.delete')->middleware('auth')->middleware('profile.required');
    Route::get('/profil', [DashboardController::class, 'profil_view'])->name('profil.view')->middleware('auth');
    Route::post('/profil/create', [ProfilController::class, 'create'])->name('profil.create')->middleware('auth');
    Route::post('/profil/{id}/update', [ProfilController::class, 'update'])->name('profil.update')->middleware('auth');
    Route::post('/profil/images/{id}/edit', [ProfilController::class, 'update_image'])->name('profil.image.edit')->middleware('auth');
    Route::post('/profil/images/{id}/add', [ProfilController::class, 'add_image'])->name('profil.image.add')->middleware('auth');
    Route::delete('/profil/images/{id}/delete', [ProfilController::class, 'delete_image'])->name('profil.image.delete')->middleware('auth');

    Route::get('/menus', [DashboardController::class, 'menu_view'])->name('menu.view')->middleware('auth')->middleware('profile.required');
    Route::get('/menus/nouvel', [DashboardController::class, 'new_menu_view'])->name('menu.new.view')->middleware('auth')->middleware('profile.required');
    Route::post('/menus/nouvel', [MenuController::class, 'create'])->name('menu.new.create')->middleware('auth')->middleware('profile.required');
    Route::get('/menus/{id}/delete', [MenuController::class, 'delete'])->name('menu.delete')->middleware('auth')->middleware('profile.required');
    Route::get('/menus/{id}/edit', [DashboardController::class, 'update_menu_view'])->name('menu.edit.view')->middleware('auth')->middleware('profile.required');
    Route::post('/menus/{id}/edit', [MenuController::class, 'update'])->name('menu.edit')->middleware('auth')->middleware('profile.required');
    Route::post('/menus/images/{id}/edit', [MenuController::class, 'update_image'])->name('menu.image.edit')->middleware('auth')->middleware('profile.required');
    Route::post('/menus/images/{id}/add', [MenuController::class, 'add_image'])->name('menu.image.add')->middleware('auth')->middleware('profile.required');
    Route::delete('/menus/images/{id}/delete', [MenuController::class, 'delete_image'])->name('menu.image.delete')->middleware('auth')->middleware('profile.required');
    Route::get('/menus/{id}/plats', [MenuController::class, 'menu_dishes'])->name('menu.plats.list')->middleware('auth')->middleware('profile.required');
    Route::post('/menus/{id}/add-plat', [MenuController::class, 'add_dish'])->name('menu.plats.add')->middleware('auth')->middleware('profile.required');
    Route::delete('/menus/{menu_id}/delete-plat/{dish_id}', [MenuController::class, 'delete_menu_dish'])->name('menu.plats.delete')->middleware('auth')->middleware('profile.required');

    Route::get('/plats', [DishController::class, 'index'])->name('dish.view')->middleware('auth')->middleware('profile.required');
    Route::post('/plats/create', [DishController::class, 'create'])->name('dish.create')->middleware('auth')->middleware('profile.required');
    Route::put('/plats/{id}', [DishController::class, 'update'])->name('dish.update')->middleware('auth')->middleware('profile.required');
    Route::delete('/plats/{id}', [DishController::class, 'delete'])->name('dish.delete')->middleware('auth')->middleware('profile.required');
    Route::get('/parametres', [DashboardController::class, 'settings_view'])->name('settings.view')->middleware('auth')->middleware('profile.required');
    Route::post('/parametres/update/email', [AuthController::class, 'update_email'])->name('settings.update.email')->middleware('auth')->middleware('profile.required');



    // my
    Route::get('/evenements/me', [EventController::class, 'my_events'])->name('event.me')->middleware('auth');
    Route::get('/menus/me', [MenuController::class, 'my_menus'])->name('menu.me')->middleware('auth');
    Route::get('/offres/me', [OfferController::class, 'my_offers'])->name('offer.me')->middleware('auth');
    Route::put('/evenements/{id}', [EventController::class, 'updateDates'])->middleware('auth');
    Route::put('/menus/{id}', [MenuController::class, 'updateDates'])->middleware('auth');
    Route::put('/offres/{id}', [OfferController::class, 'updateDates'])->middleware('auth');
});


Route::prefix('/admin')->name('admin.')->group(function () {


    Route::get('', [AdminController::class, 'dashboard_view'])->name('dashboard.view')->middleware('auth')->middleware('admin.required');
    Route::get('/utilisateurs', [AdminController::class, 'users_view'])->name('users.view')->middleware('auth')->middleware('admin.required');
    Route::get('/communaute', [AdminController::class, 'community_view'])->name('community.view')->middleware('auth')->middleware('admin.required');
    Route::get('/parametres', [AdminController::class, 'settings_view'])->name('settings.view')->middleware('auth')->middleware('admin.required');
    Route::get('/calendrier', [AdminController::class, 'calendar_view'])->name('calendar.view')->middleware('auth')->middleware('admin.required');
    Route::post('/change/status/{id}', [AdminController::class, 'change_account_status'])->name('change.status')->middleware('auth')->middleware('admin.required');
});


// notification
Route::post('/save-subscription', [WebPushController::class, 'store'])->middleware('auth');
Route::get('/test_push', [WebPushController::class, 'push'])->middleware('auth');
Route::get('/test-notification', [WebPushController::class,'sendPushNotification']);
