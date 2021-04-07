<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'App\Http\Controllers\PublicController@get_HomeData')->name('home');
Route::get('/home', function(){
    return redirect()->route('home');
});
Route::get('/trending', 'App\Http\Controllers\PublicController@get_TrendingData')->name('trending_page');
Route::get('/history', 'App\Http\Controllers\PublicController@get_HistoryData')->name('history_page');
Route::get('/watch-later', 'App\Http\Controllers\PublicController@get_WatchLaterData')->name('watch_later_page');
Route::get('/like-video', 'App\Http\Controllers\PublicController@get_LikeVideoData')->name('like_video_page');
Route::get('/search-result', 'App\Http\Controllers\PublicController@get_SearchResultData')->name('search_result_page');
Route::get('/settings', 'App\Http\Controllers\PublicController@get_SettingsData')->name('settings_page');
Route::get('/about', 'App\Http\Controllers\PublicController@get_AboutPage')->name('about_page');
Route::get('/play/{videoID}', 'App\Http\Controllers\PublicController@get_VideoData')->name('play_page');
Route::get('/like/{videoID}', 'App\Http\Controllers\PublicController@set_LikedVideo')->name('likedVideo');
Route::get('/dislike/{videoID}', 'App\Http\Controllers\PublicController@set_DislikedVideo')->name('dislikedVideo');
Route::post('/add-watch-later', 'App\Http\Controllers\PublicController@set_WatchLater');

Route::prefix('/admin')->group(function(){
    Route::get('/home', 'App\Http\Controllers\AdminController@get_HomeAdmin')->name('home_admin');
    Route::get('/cud-video-data', 'App\Http\Controllers\AdminController@get_CudData')->name('cud_admin');
    Route::get('/top-video-like', 'App\Http\Controllers\AdminController@get_TopVideoLikeData')->name('top_video_like_admin');
    Route::get('/top-video-dislike', 'App\Http\Controllers\AdminController@get_TopVideoDislike')->name('top_video_dislike_admin');
    Route::get('top-video-watch', 'App\Http\Controllers\AdminController@get_TopVideoWatch')->name('top_video_watch_admin');
});

Route::fallback(function(){
	//https://laravel.com/docs/8.x/routing#fallback-routes
    // return response()->json([
    //     ' message' => 'Page Not Found. If error persists, contact info@website.com'], 404);
    return view('error-page');
});

//cobak practice menampilkan video sendiri lewat element source car di sumber ne https://stackoverflow.com/questions/22974106/how-can-i-store-a-video-inside-a-database


//ngai fungsi filter waktu pank waktu upload lebih sederhana ditampilkan
//ngai fungi mempersingkat tampilan angka view, like dislike

//lanjut ngai error handling di app.exception uli laravel resmi

//lanjut CSS : lanjut benerin posisi icon later dik, ngedit posisi watchltaer icon di home, edit ukuran font 