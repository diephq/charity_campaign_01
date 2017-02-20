<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('campaign-chat', 'CampaignChatController');

Route::resource('language', 'MultipleLanguageController', [
    'only' => ['store']
]);

Route::get('register',[
    'as' => 'register' ,
    'uses' => 'Auth\UserRegisterController@getRegister',
]);

Route::post('register',[
    'as' => 'register' ,
    'uses' => 'Auth\UserRegisterController@postRegister',
]);

Route::get('login',[
    'as' => 'get_login' ,
    'uses' => 'Auth\UserLoginController@getLogin',
]);

Route::post('login',[
    'as' => 'post_login' ,
    'uses' => 'Auth\UserLoginController@postLogin',
]);

Route::get('logout',[
    'as' => 'logout' ,
    'uses' => 'Auth\UserLoginController@logout',
]);

Route::get('link/verification/{id}/{tokenRegister?}',[
    'as' => 'verification' ,
    'uses' => 'Auth\VerifyController@index',
]);

Route::get('/redirect/{provider}', 'Auth\SocialAuthController@redirect');
Route::get('/callback/{provider}', 'Auth\SocialAuthController@callback');


Route::group(['middleware' => 'auth'], function () {

    Route::resource('user', 'UserController');

    Route::get('campaigns/create', 'CampaignController@create');

    Route::post('campaigns/create', 'CampaignController@store');

    Route::get('user/{userId}/campaigns', 'UserController@listUserCampaign');

    Route::get('user/{userId}/campaigns/{campaignId}', 'UserController@manageCampaign');

    Route::post('campaigns/approve', 'CampaignController@approveOrRemove');

    Route::post('contribution/confirm', 'ContributionController@confirmContribution');

    Route::post('campaign/active', 'CampaignController@activeOrCloseCampaign');

    Route::post('rating/ratingCampaign', 'RatingController@ratingCampaign');

    Route::post('rating/ratingUser', 'RatingController@ratingUser');

    Route::post('campaign/uploadImage', 'CampaignController@uploadImage');

    Route::post('follow/user', 'FollowController@followOrUnFollowUser');
});

Route::get('', 'CampaignController@index');

Route::get('campaigns/{id}', 'CampaignController@show');

Route::resource('contribution', 'ContributionController');

Route::post('comment/create', 'CommentController@store');

Route::post('request-join', 'CampaignController@joinOrLeaveCampaign');

Route::get('campaign/search', 'CampaignController@searchCampaign');
