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

// tu peux faire des patterns de routes pour protéger l'app des injection voir Route::pattern() dans la doc

Route::get('/', 'FrontController@index')->name('index');

Route::post('/book/{book}/rate', 'RatingController@addRating')->middleware('auth')->name('rate');



Auth::routes();

Route::resource('admin/book', 'BookController');
Route::middleware(['auth', 'checkElevation'])->group(function () {
});


//Route::resource('admin/book', 'BookController')->middleware('auth');
Route::get('books', function() {
    return App\Book::all();
});

Route::get('book/{id}', 'FrontController@show')->where(['id', '[0-9]+']);

Route::get('author/{id}', 'FrontController@showBooksByAuthor')->where(['id', '[0-9]+']);

// attention si tu fais du binding de Model il faut mettre wildcard avec le nom du modèle ici genre : /genre/{genre} puis injecter le modèle dans la méthode
Route::get('genre/{genre}', 'FrontController@showBooksByGenre')->where(['genre', '[0-9]+']);



Route::get('/home', 'HomeController@index')->name('home');
