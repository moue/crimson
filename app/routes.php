<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/** ------------------------------------------
 *  Route model binding
 *  ------------------------------------------
 */
Route::model('user', 'User');
Route::model('comment', 'Comment');
Route::model('post', 'Post');
Route::model('role', 'Role');

/** ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
 */
Route::pattern('comment', '[0-9]+');
Route::pattern('post', '[0-9]+');
Route::pattern('user', '[0-9]+');
Route::pattern('role', '[0-9]+');
Route::pattern('token', '[0-9a-z]+');

/** ------------------------------------------
 *  Admin Routes
 *  ------------------------------------------
 */
Route::group(array('prefix' => 'admin', 'before' => 'auth'), function()
{

    # Comment Management
    Route::get('comments/{comment}/edit', 'AdminCommentsController@getEdit');
    Route::post('comments/{comment}/edit', 'AdminCommentsController@postEdit');
    Route::get('comments/{comment}/delete', 'AdminCommentsController@getDelete');
    Route::post('comments/{comment}/delete', 'AdminCommentsController@postDelete');
    Route::controller('comments', 'AdminCommentsController');

    # Post Management
    Route::get('posts/{post}/show', 'AdminPostsController@getShow');
    Route::get('posts/{post}/edit', 'AdminPostsController@getEdit');
    Route::post('posts/{post}/edit', 'AdminPostsController@postEdit');
    Route::get('posts/{post}/delete', 'AdminPostsController@getDelete');
    Route::post('posts/{post}/delete', 'AdminPostsController@postDelete');
    Route::controller('posts', 'AdminPostsController');

    # User Management
    Route::get('users/{user}/show', 'AdminUsersController@getShow');
    Route::get('users/{user}/edit', 'AdminUsersController@getEdit');
    Route::post('users/{user}/edit', 'AdminUsersController@postEdit');
    Route::get('users/{user}/delete', 'AdminUsersController@getDelete');
    Route::post('users/{user}/delete', 'AdminUsersController@postDelete');
    Route::controller('users', 'AdminUsersController');

    # User Role Management
    Route::get('roles/{role}/show', 'AdminRolesController@getShow');
    Route::get('roles/{role}/edit', 'AdminRolesController@getEdit');
    Route::post('roles/{role}/edit', 'AdminRolesController@postEdit');
    Route::get('roles/{role}/delete', 'AdminRolesController@getDelete');
    Route::post('roles/{role}/delete', 'AdminRolesController@postDelete');
    Route::controller('roles', 'AdminRolesController');

    # Admin Layout Management
    Route::get('frontpages/', 'AdminFrontpagesController@getIndex');
    Route::post('frontpages/', 'AdminFrontpagesController@postIndex');
    Route::post('frontpages/select', 'AdminFrontpagesController@postSelect');
    Route::post('frontpages/new', 'AdminFrontpagesController@postNew');
    Route::post('frontpages/delete', 'AdminFrontpagesController@postDelete');

    Route::get('frontpages/edit/{id}', 'AdminFrontpagesController@getEdit');
    Route::post('frontpages/edit/{id}', 'AdminFrontpagesController@postEdit');
    Route::controller('/', 'AdminFrontpagesController');
});


/** ------------------------------------------
 *  Frontend Routes
 *  ------------------------------------------
 */

// User reset routes
Route::get('user/reset/{token}', 'UserController@getReset');
// User password reset
Route::post('user/reset/{token}', 'UserController@postReset');
//:: User Account Routes ::
Route::post('user/{user}/edit', 'UserController@postEdit');

//:: User Account Routes ::
Route::post('user/login', 'UserController@postLogin');

# User RESTful Routes (Login, Logout, Register, etc)
Route::controller('user', 'UserController');

//:: Application Routes ::

# Filter for detect language
Route::when('contact-us','detectLang');

# Contact Us Static Page
Route::get('contact-us', function()
{
    // Return about us page
    return View::make('site/contact-us');
});

# Posts - Second to last set, match slug
Route::get('{postSlug}', 'PostsController@getView');
Route::post('{postSlug}', 'PostsController@postView');

# Index Page - Last route, no matches
Route::get('/', array('before' => 'detectLang','uses' => 'PostsController@getIndex'));

# Layouts - Sidebars
View::composer('site.layouts.partials.popular_posts', function($view)
{
    $view->popularPosts = Post::orderBy('view_count','desc')->take(5)->get();
});

View::composer('admin.posts.form', function($view) {
    $section = Section::all()->lists('section', 'id');
    $users = User::all()->lists('name', 'id');
    $view->with('section', $section)->with('users', $users);
});

Route::post('posts/file', function() {

    echo "<pre>";
    var_dump(Input::file('profile'));
    echo "</pre>";

});

Route::get('posts/upload', function() {

    return Form::open(array('url' => 'posts/file', 'files' => true)) .
            Form::file('profile') .
            Form::submit('upload');

});

View::composer('site.layouts.partials.row', 'library\Composers\RowComposer');
View::composer('site.layouts.partials.flyby', 'library\Composers\SideBlogComposer');