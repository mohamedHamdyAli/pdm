<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\API;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
normal api_token
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::get('category-list',[API\CategoryController::class,'getCategoryList']);
Route::get('subcategory-list',[API\SubCategoryController::class,'getSubCategoryList']);
Route::get('service-list',[API\ServiceController::class,'getServiceList']);
Route::get('type-list',[API\CommanController::class,'getTypeList']);


Route::post('country-list',[ API\CommanController::class, 'getCountryList' ]);
Route::post('state-list',[ API\CommanController::class, 'getStateList' ]);
Route::post('city-list',[ API\CommanController::class, 'getCityList' ]);
Route::get('search-list', [ API\CommanController::class, 'getSearchList' ] );
Route::get('slider-list',[ API\SliderController::class, 'getSliderList' ]);
Route::get('top-rated-service',[ API\ServiceController::class, 'getTopRatedService' ]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register',[API\User\UserController::class, 'register']);
Route::post('login',[API\User\UserController::class,'login']);
Route::post('forgot-password',[ API\User\UserController::class,'forgotPassword']);
Route::post('social-login',[ API\User\UserController::class, 'socialLogin' ]);
Route::post('contact-us', [ API\User\UserController::class, 'contactUs' ] );


Route::get('dashboard-detail',[ API\DashboardController::class, 'dashboardDetail' ]);
Route::get('service-rating-list',[API\ServiceController::class,'getServiceRating']);
Route::get('user-detail',[API\User\UserController::class, 'userDetail']);
Route::post('service-detail', [ API\ServiceController::class, 'getServiceDetail' ] );
Route::get('user-list',[API\User\UserController::class, 'userList']);
Route::get('booking-status', [ API\BookingController::class, 'bookingStatus' ] );
Route::post('handyman-reviews',[API\User\UserController::class, 'handymanReviewsList']);
Route::post('service-reviews', [ API\ServiceController::class, 'serviceReviewsList' ] );

Route::post('bookingservice-save', [ App\Http\Controllers\API\BookingserviceController::class, 'saveBookingService' ] );

Route::get('bookingservice-edit/{id}', [ App\Http\Controllers\API\BookingserviceController::class, 'getBookingService' ] );

Route::post('bookingservice-update/{id}', [ App\Http\Controllers\API\BookingserviceController::class, 'updateBookingService' ] );

Route::group(['middleware' => ['auth:sanctum']], function () {


    Route::post('service-save', [ App\Http\Controllers\ServiceController::class, 'store' ] );
    Route::post('service-delete/{id}', [ App\Http\Controllers\ServiceController::class, 'destroy' ] );
    Route::post('booking-save', [ App\Http\Controllers\BookingController::class, 'store' ] );
    Route::post('booking-update', [ API\BookingController::class, 'bookingUpdate' ] );
    Route::get('provider-dashboard',[ API\DashboardController::class, 'providerDashboard' ]);
    Route::get('booking-list', [ API\BookingController::class, 'getBookingList' ] );
    Route::post('booking-detail', [ API\BookingController::class, 'getBookingDetail' ] );
    Route::post('save-booking-rating', [ API\BookingController::class, 'saveBookingRating' ] );
    Route::post('delete-booking-rating', [ API\BookingController::class, 'deleteBookingRating' ] );

    Route::post('save-favourite',[ API\ServiceController::class, 'saveFavouriteService' ]);
    Route::post('delete-favourite',[ API\ServiceController::class, 'deleteFavouriteService' ]);
    Route::get('user-favourite-service',[ API\ServiceController::class, 'getUserFavouriteService' ]);

    Route::post('booking-action',[ API\BookingController::class, 'action' ] );

    Route::post('booking-assigned',[ App\Http\Controllers\BookingController::class,'bookingAssigned'] );

    Route::post('user-update-status',[API\User\UserController::class, 'userStatusUpdate']);
    Route::post('change-password',[API\User\UserController::class, 'changePassword']);
    Route::post('update-profile',[API\User\UserController::class,'updateProfile']);
    Route::post('notification-list',[API\NotificationController::class,'notificationList']);
    Route::post('remove-file', [ App\Http\Controllers\HomeController::class, 'removeFile' ] );
    Route::get('logout',[ API\User\UserController::class, 'logout' ]);

    Route::post('save-payment',[API\PaymentController::class, 'savePayment']);
    Route::get('payment-list',[API\PaymentController::class, 'paymentList']);


    Route::post('save-provideraddress', [ App\Http\Controllers\ProviderAddressMappingController::class, 'store' ]);
    Route::get('provideraddress-list', [ API\ProviderAddressMappingController::class, 'getProviderAddressList' ]);
    Route::post('provideraddress-delete/{id}', [ App\Http\Controllers\ProviderAddressMappingController::class, 'destroy' ]);
    Route::post('save-handyman-rating', [ API\BookingController::class, 'saveHandymanRating' ] );
    Route::post('delete-handyman-rating', [ API\BookingController::class, 'deleteHandymanRating' ] );

    Route::get('document-list', [ API\DocumentsController::class, 'getDocumentList' ] );
    Route::get('provider-document-list', [ API\ProviderDocumentController::class, 'getProviderDocumentList' ] );
    Route::post('provider-document-save', [ App\Http\Controllers\ProviderDocumentController::class, 'store' ] );
    Route::post('provider-document-delete/{id}', [ App\Http\Controllers\ProviderDocumentController::class, 'destroy' ] );

    Route::get('tax-list',[ API\CommanController::class, 'getProviderTax' ]);
    Route::get('handyman-dashboard',[ API\DashboardController::class, 'handymanDashboard' ]);

    Route::post('customer-booking-rating',[ API\BookingController::class, 'bookingRatingByCustomer' ]);
    Route::post('handyman-delete/{id}',[ App\Http\Controllers\HandymanController::class, 'destroy' ]);
    Route::post('handyman-action',[ App\Http\Controllers\HandymanController::class, 'action' ]);

    Route::get('provider-payout-list', [ API\PayoutController::class, 'providerPayoutList' ] );
    Route::get('handyman-payout-list', [ API\PayoutController::class, 'handymanPayoutList' ] );

    Route::get('plan-list', [ API\PlanController::class, 'planList' ] );
    Route::post('save-subscription', [ API\SubscriptionController::class, 'providerSubscribe' ] );
    Route::post('cancel-subscription', [ API\SubscriptionController::class, 'cancelSubscription' ] );
    Route::get('subscription-history', [ API\SubscriptionController::class, 'getHistory' ] );
    Route::get('wallet-history', [ API\WalletController::class, 'getHistory' ] );

    Route::post('save-service-proof', [ API\BookingController::class, 'uploadServiceProof' ] );
    Route::post('handyman-update-available-status',[API\User\UserController::class, 'handymanAvailable']);
    Route::post('delete-user-account',[API\User\UserController::class, 'deleteUserAccount']);
    Route::post('delete-account',[API\User\UserController::class, 'deleteAccount']);


});
