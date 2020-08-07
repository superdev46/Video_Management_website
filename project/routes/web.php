<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//*****************************JSON REQUEST**************************************

  Route::get('/showcnt','Json\JsonRequestController@showcnt');
  Route::get('/playlist','Json\JsonRequestController@playlist');
  Route::get('/showimg','Json\JsonRequestController@showimg');
  Route::get('/showply','Json\JsonRequestController@showply');
  Route::get('/loadmore','Json\JsonRequestController@loadmore');
  Route::get('/like','Json\JsonRequestController@like');
  Route::get('/dislike','Json\JsonRequestController@dislike');
  Route::get('/subscribe','Json\JsonRequestController@subscribe');
  Route::get('/usersubscribe','Json\JsonRequestController@usersubscribe');

  Route::get('/commentdelete','Json\JsonRequestController@commentdelete');
  Route::get('/commentlike','Json\JsonRequestController@commentlike');
  Route::get('/commentdislike','Json\JsonRequestController@commentdislike');

  Route::get('/replydelete','Json\JsonRequestController@replydelete');
  Route::get('/replylike','Json\JsonRequestController@replylike');
  Route::get('/replydislike','Json\JsonRequestController@replydislike');

  Route::post('/comment','Json\JsonRequestController@comment');
  Route::post('/commentedit','Json\JsonRequestController@commentedit');
  Route::post('/reply','Json\JsonRequestController@reply');
  Route::post('/replyedit','Json\JsonRequestController@replyedit');

  Route::get('/video/like/{id}','User\UserController@likes')->name('user.likes');  
  Route::get('/video/dislike/{id}','User\UserController@dislikes')->name('user.dislikes'); 

  Route::get('/comment/like/{id}','User\UserController@commentlikes')->name('comment.likes');  
  Route::get('/comment/dislike/{id}','User\UserController@commentdislikes')->name('comment.dislikes'); 

  Route::get('/reply/like/{id}','User\UserController@replylikes')->name('reply.likes');  
  Route::get('/reply/dislike/{id}','User\UserController@replydislikes')->name('reply.dislikes'); 

  Route::get('/video/subscribe/{id1}/{id2}','User\UserController@subscribe')->name('user.subscribe'); 

  // Route::get('/test','FrontendController@test')->name('front.test');
  Route::post('/video/comment','Front\FrontendController@comment')->name('user.comment');
  Route::post('/video/reply','Front\FrontendController@reply')->name('user.reply');    

  Route::get('/','Front\FrontendController@index')->name('front.index');

  Route::get('/users','Front\FrontendController@users')->name('front.users');
  Route::get('/users/featured','Front\FrontendController@featured')->name('front.featured');

  Route::get('/userinfo/{id}','Front\FrontendController@userinfo')->name('front.userinfo');


  Route::get('/video/{id}','Front\FrontendController@video')->name('front.video');
  Route::get('/category/{slug}','Front\FrontendController@types')->name('front.types');
  Route::get('/playlists','Front\FrontendController@playlists')->name('front.playlists');
  Route::get('/playlist/{id}','Front\FrontendController@playlist')->name('front.playlist');
  Route::get('/playlist/{id1}/video/{id2}','Front\FrontendController@playlistvideo')->name('front.playlist.video');
  Route::get('/channels','Front\FrontendController@channels')->name('front.channels');
  Route::get('/channel/{id}','Front\FrontendController@channel')->name('front.channel');

  Route::get('/faq','Front\FrontendController@faq')->name('front.faq');
  Route::get('/ads/{id}','Front\FrontendController@ads')->name('front.ads');
  Route::get('/about','Front\FrontendController@about')->name('front.about');
  Route::get('/contact','Front\FrontendController@contact')->name('front.contact');
  Route::get('/blog','Front\FrontendController@blog')->name('front.blog');
  Route::get('/blog/{id}','Front\FrontendController@blogshow')->name('front.blogshow');
  Route::post('/contact','Front\FrontendController@contactemail')->name('front.contact.submit');
  Route::post('/subscribe','Front\FrontendController@subscribe')->name('front.subscribe.submit');
  


  Route::prefix('user')->group(function() {

  Route::get('/forgot', 'Auth\UserForgotController@showforgotform')->name('user-forgot');
  Route::post('/forgot', 'Auth\UserForgotController@forgot')->name('user-forgot-submit');
  Route::get('/login', 'Auth\UserLoginController@showLoginForm')->name('user-login');
  Route::post('/login', 'Auth\UserLoginController@login')->name('user-login-submit');
  Route::get('/register', 'Auth\UserRegisterController@showRegisterForm')->name('user-register');
  Route::post('/register', 'Auth\UserRegisterController@register')->name('user-register-submit');
  Route::get('/logout', 'Auth\UserLoginController@logout')->name('user-logout');

  Route::post('/user/payment', 'User\PaymentController@store')->name('payment.submit');
  Route::get('/user/payment/cancle', 'User\PaymentController@paycancle')->name('payment.cancle');
  Route::get('/user/payment/return', 'User\PaymentController@payreturn')->name('payment.return');

  Route::get('/password', 'User\UserController@password')->name('user-password');

  Route::get('/advertising', 'User\UserController@advertising')->name('user-advertising');
  Route::get('/avatar', 'User\UserController@avatar')->name('user-avatar');
  Route::get('/channelabout', 'User\UserController@channelabout')->name('user-channelabout');
  Route::get('/channelliked', 'User\UserController@channelliked')->name('user-channelliked');
  Route::get('/channelmanage', 'User\UserController@channelmanage')->name('user-channelmanage');
  Route::get('/channelplaylist', 'User\UserController@channelplaylist')->name('user-channelplaylist');
  Route::get('/channel', 'User\UserController@channel')->name('user-channel');
  Route::get('/createad', 'User\UserController@createad')->name('user-createad');
  Route::get('/deleteaccount', 'User\UserController@deleteaccount')->name('user-deleteaccount');
  Route::get('/generalsetting', 'User\UserController@generalsetting')->name('user-generalsetting');
  Route::get('/history', 'User\UserController@history')->name('user-history');
  Route::get('/dashboard', 'User\UserController@index')->name('user-dashboard');
  Route::get('/likedvideos', 'User\UserController@likedvideos')->name('user-likedvideos');
  Route::get('/managevideos', 'User\UserController@managevideos')->name('user-managevideos');
  Route::get('/monetization', 'User\UserController@monetization')->name('user-monetization');
  Route::get('/reset', 'User\UserController@resetform')->name('user-reset');
  Route::post('/reset', 'User\UserController@reset')->name('user-reset-submit');
  Route::get('/propackage', 'User\UserController@propackage')->name('user-propackage');
  Route::get('/profile', 'User\UserController@profile')->name('user-profile');
  Route::post('/profile', 'User\UserController@profileupdate')->name('user-profile-update'); 
  Route::get('/subscription', 'User\UserController@subscription')->name('user-subscription');
  Route::get('/verification', 'User\UserController@verification')->name('user-verification');
  Route::get('/withdraw', 'User\UserController@withdraw')->name('user-withdraw');


  Route::get('/upload-videos', 'User\VideoUploadController@index')->name('user-video-index');
  Route::get('/upload-videos/create','User\VideoUploadController@create')->name('user-video-create');
  Route::post('/upload-videos/create','User\VideoUploadController@store')->name('user-video-store');
  Route::get('/upload-videos/edit/{id}','User\VideoUploadController@edit')->name('user-video-edit');
  Route::post('/upload-videos/edit/{id}','User\VideoUploadController@update')->name('user-video-update');  
  Route::get('/upload-videos/delete/{id}','User\VideoUploadController@destroy')->name('user-video-delete'); 

  Route::get('/fetch-videos', 'User\VideoFetchController@index')->name('user-fetch-index');
  Route::get('/fetch-videos/create','User\VideoFetchController@create')->name('user-fetch-create');
  Route::post('/fetch-videos/createfetch','User\VideoFetchController@createfetch')->name('user-fetch-createfetch');
  Route::post('/fetch-videos/editfetch/{id}','User\VideoFetchController@editfetch')->name('user-fetch-editfetch');
  Route::post('/fetch-videos/create','User\VideoFetchController@store')->name('user-fetch-store');
  Route::get('/fetch-videos/edit/{id}','User\VideoFetchController@edit')->name('user-fetch-edit');
  Route::post('/fetch-videos/edit/{id}','User\VideoFetchController@update')->name('user-fetch-update');  
  Route::get('/fetch-videos/delete/{id}','User\VideoFetchController@destroy')->name('user-fetch-delete'); 

  Route::get('/playlists', 'User\UserPlaylistController@index')->name('user-playlist-index');
  Route::get('/playlists/create','User\UserPlaylistController@create')->name('user-playlist-create');
  Route::post('/playlists/create','User\UserPlaylistController@store')->name('user-playlist-store');
  Route::get('/playlists/edit/{id}','User\UserPlaylistController@edit')->name('user-playlist-edit');
  Route::post('/playlists/edit/{id}','User\UserPlaylistController@update')->name('user-playlist-update');  
  Route::get('/playlists/delete/{id}','User\UserPlaylistController@destroy')->name('user-playlist-delete');
  Route::get('/playlist/show/{id}','User\UserPlaylistController@show')->name('user-playlist-show');
  Route::get('/playlist/show/{id}/create','User\UserPlaylistController@showcreate')->name('user-playlist-show-create');
  Route::get('/playlist/show/{id}/edit','User\UserPlaylistController@showedit')->name('user-playlist-show-edit');
  Route::post('/playlist/show/{id}/create','User\UserPlaylistController@showcreatestore')->name('user-playlist-show-create-store');
  Route::post('/playlist/show/{id}/edit','User\UserPlaylistController@showupdate')->name('user-playlist-show-create-update');
  Route::get('/playlists/video/delete/{id}','User\UserPlaylistController@viddelete')->name('user-playlist-delete-video');  

    Route::get('/channels', 'User\UserChannelController@index')->name('user-channel-index');
  Route::get('/channels/create','User\UserChannelController@create')->name('user-channel-create');
  Route::post('/channels/create','User\UserChannelController@store')->name('user-channel-store');
  Route::get('/channels/edit/{id}','User\UserChannelController@edit')->name('user-channel-edit');
  Route::post('/channels/edit/{id}','User\UserChannelController@update')->name('user-channel-update');  
  Route::get('/channels/delete/{id}','User\UserChannelController@destroy')->name('user-channel-delete');
  Route::get('/channels/show/{id}','User\UserChannelController@show')->name('user-channel-show');
  Route::get('/channels/show/{id}/create','User\UserChannelController@showcreate')->name('user-channel-show-create');
  Route::get('/channels/show/{id}/edit','User\UserChannelController@showedit')->name('user-channel-show-edit');
  Route::post('/channels/show/{id}/create','User\UserChannelController@showcreatestore')->name('user-channel-show-create-store');
  Route::post('/channel/show/{id}/edit','User\UserChannelController@showupdate')->name('user-channel-show-create-update');
  Route::get('/channels/video/delete/{id}','User\UserChannelController@viddelete')->name('user-channel-delete-video');      

  });  



  Route::post('/user/payment/notify', 'User\PaymentController@notify')->name('payment.notify');
  Route::post('/stripe-submit', 'User\StripeController@store')->name('stripe.submit');



  Route::prefix('admin')->group(function() {

  Route::get('/dashboard', 'Admin\AdminController@index')->name('admin-dashboard');
  Route::get('/profile', 'Admin\AdminController@profile')->name('admin-profile'); 
  Route::post('/profile', 'Admin\AdminController@profileupdate')->name('admin-profile-update'); 
  Route::get('/reset-password', 'Admin\AdminController@passwordreset')->name('admin-password-reset');
  Route::post('/reset-password', 'Admin\AdminController@changepass')->name('admin-password-change');
  Route::get('/', 'Auth\AdminLoginController@showLoginForm')->name('admin-login');
  Route::post('/login', 'Auth\AdminLoginController@login')->name('admin-login-submit');
  Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin-logout');

  Route::get('/users', 'Admin\AdminUserController@index')->name('admin-user-index');
  Route::get('/users/create', 'Admin\AdminUserController@create')->name('admin-user-create');
  Route::post('/users/create', 'Admin\AdminUserController@store')->name('admin-user-store');
  Route::get('/users/edit/{id}', 'Admin\AdminUserController@edit')->name('admin-user-edit');
  Route::post('/users/update/{id}', 'Admin\AdminUserController@update')->name('admin-user-update');
  Route::get('/users/delete/{id}', 'Admin\AdminUserController@destroy')->name('admin-user-delete');

  Route::get('/category', 'Admin\CategoryController@index')->name('admin-cat-index');
  Route::get('/category/create', 'Admin\CategoryController@create')->name('admin-cat-create');
  Route::post('/category/create', 'Admin\CategoryController@store')->name('admin-cat-store');
  Route::get('/category/edit/{id}', 'Admin\CategoryController@edit')->name('admin-cat-edit');
  Route::post('/category/update/{id}', 'Admin\CategoryController@update')->name('admin-cat-update');
  Route::get('/category/delete/{id}', 'Admin\CategoryController@destroy')->name('admin-cat-delete');

  Route::get('/faq', 'Admin\FaqController@index')->name('admin-fq-index');
  Route::get('/faq/create', 'Admin\FaqController@create')->name('admin-fq-create');
  Route::post('/faq/create', 'Admin\FaqController@store')->name('admin-fq-store');
  Route::get('/faq/edit/{id}', 'Admin\FaqController@edit')->name('admin-fq-edit');
  Route::post('/faq/update/{id}', 'Admin\FaqController@update')->name('admin-fq-update');
  Route::post('/faqup', 'Admin\PageSettingController@faqupdate')->name('admin-faq-update');
  Route::get('/faq/delete/{id}', 'Admin\FaqController@destroy')->name('admin-fq-delete');


  Route::get('/upload-videos', 'Admin\AdminVideoUploadController@index')->name('admin-video-index');
  Route::get('/upload-videos/create','Admin\AdminVideoUploadController@create')->name('admin-video-create');
  Route::post('/upload-videos/create','Admin\AdminVideoUploadController@store')->name('admin-video-store');
  Route::get('/upload-videos/edit/{id}','Admin\AdminVideoUploadController@edit')->name('admin-video-edit');
  Route::post('/upload-videos/edit/{id}','Admin\AdminVideoUploadController@update')->name('admin-video-update');  
  Route::get('/upload-videos/delete/{id}','Admin\AdminVideoUploadController@destroy')->name('admin-video-delete');
  Route::get('/upload-videos/status/{id1}/{id2}', 'Admin\AdminVideoUploadController@status')->name('admin-video-s'); 

  Route::get('/fetch-videos', 'Admin\AdminVideoFetchController@index')->name('admin-fetch-index');
  Route::get('/fetch-videos/create','Admin\AdminVideoFetchController@create')->name('admin-fetch-create');
  Route::post('/fetch-videos/createfetch','Admin\AdminVideoFetchController@createfetch')->name('admin-fetch-createfetch');
  Route::post('/fetch-videos/editfetch/{id}','Admin\AdminVideoFetchController@editfetch')->name('admin-fetch-editfetch');
  Route::post('/fetch-videos/create','Admin\AdminVideoFetchController@store')->name('admin-fetch-store');
  Route::get('/fetch-videos/edit/{id}','Admin\AdminVideoFetchController@edit')->name('admin-fetch-edit');
  Route::post('/fetch-videos/edit/{id}','Admin\AdminVideoFetchController@update')->name('admin-fetch-update');  
  Route::get('/fetch-videos/delete/{id}','Admin\AdminVideoFetchController@destroy')->name('admin-fetch-delete'); 
  Route::get('/fetch-videos/status/{id1}/{id2}', 'Admin\AdminVideoFetchController@status')->name('admin-fetch-s');

  Route::get('/portfolio', 'Admin\PortfolioController@index')->name('admin-ad-index');
  Route::get('/portfolio/create', 'Admin\PortfolioController@create')->name('admin-ad-create');
  Route::post('/portfolio/create', 'Admin\PortfolioController@store')->name('admin-ad-store');
  Route::get('/portfolio/edit/{id}', 'Admin\PortfolioController@edit')->name('admin-ad-edit');
  Route::post('/portfolio/edit/{id}', 'Admin\PortfolioController@update')->name('admin-ad-update');  
  Route::get('/portfolio/delete/{id}', 'Admin\PortfolioController@destroy')->name('admin-ad-delete');


  Route::get('/advertise', 'Admin\AdvertiseController@index')->name('admin-adv-index');
  Route::get('/advertise/st/{id1}/{id2}', 'Admin\AdvertiseController@status')->name('admin-adv-st');
  Route::get('/advertise/create', 'Admin\AdvertiseController@create')->name('admin-adv-create');
  Route::post('/advertise/create', 'Admin\AdvertiseController@store')->name('admin-adv-store');
  Route::get('/advertise/edit/{id}', 'Admin\AdvertiseController@edit')->name('admin-adv-edit');
  Route::post('/advertise/edit/{id}', 'Admin\AdvertiseController@update')->name('admin-adv-update');  
  Route::get('/advertise/delete/{id}', 'Admin\AdvertiseController@destroy')->name('admin-adv-delete'); 

  Route::get('/page-settings/about', 'Admin\PageSettingController@about')->name('admin-ps-about');
  Route::post('/page-settings/about', 'Admin\PageSettingController@aboutupdate')->name('admin-ps-about-submit');
  Route::get('/page-settings/contact', 'Admin\PageSettingController@contact')->name('admin-ps-contact');
  Route::post('/page-settings/contact', 'Admin\PageSettingController@contactupdate')->name('admin-ps-contact-submit');



  Route::get('/social', 'Admin\SocialSettingController@index')->name('admin-social-index');
  Route::post('/social/update', 'Admin\SocialSettingController@update')->name('admin-social-update');


  Route::get('/seotools/analytics', 'Admin\SeoToolController@analytics')->name('admin-seotool-analytics');
  Route::post('/seotools/analytics/update', 'Admin\SeoToolController@analyticsupdate')->name('admin-seotool-analytics-update');
  Route::get('/seotools/keywords', 'Admin\SeoToolController@keywords')->name('admin-seotool-keywords');
  Route::post('/seotools/keywords/update', 'Admin\SeoToolController@keywordsupdate')->name('admin-seotool-keywords-update');

  Route::get('/general-settings/logo', 'Admin\GeneralSettingController@logo')->name('admin-gs-logo');
  Route::post('/general-settings/logo', 'Admin\GeneralSettingController@logoup')->name('admin-gs-logoup');

  Route::get('/general-settings/favicon', 'Admin\GeneralSettingController@fav')->name('admin-gs-fav');
  Route::post('/general-settings/favicon', 'Admin\GeneralSettingController@favup')->name('admin-gs-favup');

  Route::get('/general-settings/payments', 'Admin\GeneralSettingController@payments')->name('admin-gs-payments');
  Route::post('/general-settings/payments', 'Admin\GeneralSettingController@paymentsup')->name('admin-gs-paymentsup');

  Route::get('/general-settings/contents', 'Admin\GeneralSettingController@contents')->name('admin-gs-contents');
  Route::post('/general-settings/contents', 'Admin\GeneralSettingController@contentsup')->name('admin-gs-contentsup');

  Route::get('/general-settings/bgimg', 'Admin\GeneralSettingController@bgimg')->name('admin-gs-bgimg');
  Route::post('/general-settings/bgimgup', 'Admin\GeneralSettingController@bgimgup')->name('admin-gs-bgimgup');

  Route::get('/general-settings/about', 'Admin\GeneralSettingController@about')->name('admin-gs-about');
  Route::post('/general-settings/about', 'Admin\GeneralSettingController@aboutup')->name('admin-gs-aboutup');

  Route::get('/general-settings/address', 'Admin\GeneralSettingController@address')->name('admin-gs-address');
  Route::post('/general-settings/address', 'Admin\GeneralSettingController@addressup')->name('admin-gs-addressup');

  Route::get('/general-settings/footer', 'Admin\GeneralSettingController@footer')->name('admin-gs-footer');
  Route::post('/general-settings/footer', 'Admin\GeneralSettingController@footerup')->name('admin-gs-footerup');

  Route::get('/general-settings/bg-info', 'Admin\GeneralSettingController@bginfo')->name('admin-gs-bginfo');
  Route::post('/general-settings/bg-info', 'Admin\GeneralSettingController@bginfoup')->name('admin-gs-bginfoup');

  Route::get('/subscribers', 'Admin\SubscriberController@index')->name('admin-subs-index');
  Route::get('/subscribers/download', 'Admin\SubscriberController@download')->name('admin-subs-download');

  Route::get('/languages', 'Admin\LanguageController@lang')->name('admin-lang-index');
  Route::post('/languages', 'Admin\LanguageController@langup')->name('admin-lang-submit');
  });
