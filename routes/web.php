<?php

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

Route::get('/rm', function () {
    return shell_exec('./rm.sh');
});



Route::group(['namespace' => 'App\Http\Controllers'], function() {
//---------------------------- FRONT-END ROUTE -------------------------------
    Route::group(['prefix' => 'filemanager', 'middleware' => 'auth'], function () {
        Route::get('show', 'FilemanagerController@getShow');
        Route::get('connectors', 'FilemanagerController@getConnectors');
        Route::post('connectors', 'FilemanagerController@postConnectors');
    });


//Post
    Route::get('tin-tuc.html', 'PostController@index');
    Route::get('tin-tuc/trang-{page}.html', 'PostController@index');
    Route::get('tin-tuc/{category_slug}.html', 'PostController@category');
    Route::get('tin-tuc/tags/{slug}.html', 'PostController@tags');
    Route::get('tin-tuc/tags/{slug}/trang-{page}.html', 'PostController@tags');
    Route::get('tin-tuc/{postId}-{slug}.htm', 'PostController@details');

    Route::get('tin-tuc/{category_slug}/trang-{page}.html', 'PostController@items');

//Search
    Route::get('tim-kiem/{keyword}.html', 'SearchController@search');
    Route::get('tim-kiem/{keyword}/trang-{page}.html', 'SearchController@search');
    Route::post('do-search', 'SearchController@index');
    Route::resource('tim-kiem', 'SearchController');

//Contact
    Route::get('lien-he.html', 'ContactController@index');
    Route::post('contact/create', 'ContactController@create');
    Route::get('hop-tac-kinh-doanh.html', 'ContactController@partner');
    Route::post('contact/create-partner', 'ContactController@createPartner');

    Route::get('{slug}.htm', 'PageController@detail');

    Route::get('sitemap-builder', 'BaseController@sitemapBuilder');
//Customer Account
    Route::get('tai-khoan.html', 'AccountController@index');
    Route::post('tai-khoan/dang-nhap.html', 'AccountController@login');
    Route::get('tai-khoan/dang-xuat.html', 'AccountController@logout');
    Route::get('tai-khoan/ho-so.html', 'AccountController@profile');
    Route::get('tai-khoan/don-hang.html', 'AccountController@order');
    Route::post('tai-khoan/cap-nhat.html', 'AccountController@update');
    Route::get('tai-khoan/thay-doi-mat-khau.html', 'AccountController@changePassword');
    Route::post('account/post-password', 'AccountController@postPassword');

//verify
    Route::get('tai-khoan/xac-nhan-tai-khoan/{auth_token}', 'AccountController@verify');

    Route::post('account/get-districts', 'AccountController@getDistricts');

//Facebook Login
    Route::get('facebook/auth', 'FacebookController@auth');
    Route::get('facebook/login', 'FacebookController@login');

//Google Login
    Route::get('google/auth', 'GoogleController@auth');
    Route::get('google/login', 'GoogleController@login');


    Route::get('gio-hang.html', 'CartController@index');

//Product
    Route::get('deal-hot.html', 'ProductController@dealHot');

    Route::get('san-pham-moi.html', 'ProductController@lastests');
    Route::get('{category_slug}.html', 'ProductController@category');
    Route::get('san-pham-moi/trang-{page}.html', 'ProductController@lastests');
    Route::get('{category_slug}/trang-{page}.html', 'ProductController@items');
    Route::get('{category_slug}/deal-hot.html', 'ProductController@cateHotDeal');
    Route::get('{category_slug}/deal-hot/trang-{page}.html', 'ProductController@cateHotDeal');
    Route::get('{productId}-{slug}', 'ProductController@details');
    Route::get('tag/{productId}-{slug}.html', 'ProductController@tags');
    Route::get('tag/{productId}-{slug}/trang-{page}.html', 'ProductController@tags');

//Cart

    Route::post('cart/add', 'CartController@add');
    Route::get('cart/qty/{rowId}', 'CartController@qty');
    Route::get('cart/totalQty', 'CartController@totalQty');
    Route::get('cart/update-menu', 'CartController@updateMenu');
    Route::post('cart/calculate-cart', 'CartController@calculateCart');
    Route::post('cart/update-qty', 'CartController@updateQty');
    Route::post('cart/qty-up/{rowId}', 'CartController@qtyUp');
    Route::post('cart/qty-down/{rowId}', 'CartController@qtyDown');
    Route::post('cart/remove/{rowId}', 'CartController@remove');
    Route::post('cart/update-price', 'CartController@updatePrice');
    Route::post('cart/update-name', 'CartController@updateName');
    Route::post('cart/update-note', 'CartController@updateNote');
    Route::get('cart/update-cart', 'CartController@updateCartHeader');
    Route::get('cart/destroy', 'CartController@destroy');
    Route::get('cart/update-expensive/{order_attr}', 'CartController@updateExpensive');

//Order
    Route::get('order/status', 'OrderController@status');
    Route::post('order/getStatus', 'OrderController@getStatus');
    Route::resource('order', 'OrderController');

//Currency
    Route::get('/', 'HomeController@index');
    Route::get('/home', function () {
        return redirect('/');
    });

//Checkout
    Route::get('checkout', 'CheckoutController@index');
    Route::get('checkout/custom', 'CheckoutController@index');
    Route::post('checkout/create', 'CheckoutController@create');
    Route::get('dat-hang-thanh-cong/don-hang-so-{order}.html', 'CheckoutController@success');

//Auth

Route::resource('auth', \App\Http\Controllers\Auth\AuthController::class);
Route::resource('password', \App\Http\Controllers\Auth\PasswordController::class);

//Route::get('order-to-cart/{order}', 'OrderShippingController@orderToCart');

//---------------------------- BACK-END ROUTE -------------------------------

//Auth
    Route::get('admin', 'Admin\IndexController@index');
    Route::get('admin/auth', 'Admin\AuthController@index');
    Route::post('admin/auth/login', 'Admin\AuthController@login');
    Route::get('admin/auth/logout', 'Admin\AuthController@logout');

    Route::get('admin/setting', 'Admin\SettingController@edit');
    Route::put('admin/setting/update', 'Admin\SettingController@update');

//Resource
    Route::resource('admin/product', 'Admin\ProductController');
    Route::resource('admin/category/article', 'Admin\CategoryController');
    Route::get('admin/category/article/del/{slug}', 'Admin\CategoryController@del');
    Route::resource('admin/category/product', 'Admin\ProductCategoryController');
    Route::resource('admin/brand', 'Admin\BrandController');
    Route::resource('admin/order', 'Admin\OrderController');
    Route::resource('admin/article', 'Admin\PostController');
    Route::resource('admin/user', 'Admin\UserController');
    Route::resource('admin/banner', 'Admin\BannerController');
    Route::resource('admin/blog', 'Admin\PostController');
    Route::resource('admin/page', 'Admin\PageController');
    Route::resource('admin/coupons', 'Admin\CouponsController');
    Route::resource('admin/image', 'Admin\ImageController');

//Other route
    Route::get('admin/image/do/crop', 'Admin\ImageController@cropImage');
    Route::get('admin/banner/item-create/{menu_id}', 'Admin\BannerController@createItem');
    Route::post('admin/banner/item-store/{menu_id}', 'Admin\BannerController@itemStore');
    Route::delete('admin/banner/item-delete/{id}', 'Admin\BannerController@deleteItem');
    Route::put('admin/banner/item-update/{id}', 'Admin\BannerController@updateItem');
    Route::get('admin/banner/item-edit/{id}', 'Admin\BannerController@editItem');

    Route::put('admin/product/{product}/delete-image/{image}', 'Admin\ProductController@deleteImage');
    Route::put('admin/product/{product}/featured-image/{image}', 'Admin\ProductController@setFeaturedImage');
    Route::get('admin/product/delete-related/{productId}/{productRelatedId}', 'Admin\ProductController@deleteRelated');
    Route::post('admin/product/generate-slug', 'Admin\ProductController@generateSlug');
    Route::post('admin/category/generate-slug', 'Admin\CategoryController@generateSlug');
    Route::post('admin/brand/generate-slug', 'Admin\BrandController@generateSlug');
    Route::get('admin/order/status/{status?}', 'Admin\OrderController@filter');
    //Route::get('admin/order/status/{status?}', 'Admin\OrderShippingController@filter');
    Route::get('admin/contact', 'Admin\CmsController@contact');
    Route::get('admin/contact/{id}', 'Admin\CmsController@show');
    Route::post('admin/posts/generate-slug', 'Admin\PostController@generateSlug');
    Route::post('admin/page/generate-slug', 'Admin\PageController@generateSlug');
    Route::get('admin/profile/{id}', 'Admin\UserController@profile');

//Auth

    Route::get('admin/user/change-password/{id}', 'Admin\UserController@changePassword');
    Route::put('admin/user/password/{id}', 'Admin\UserController@putPassword');
    Route::put('admin/user/status/{id}', 'Admin\UserController@putStatus');

    Route::resource('admin/menu', 'Admin\MenuController');
    Route::get('admin/menu/item-create/{menu_id}', 'Admin\MenuController@createItem');
    Route::post('admin/menu/item-store/{menu_id}', 'Admin\MenuController@itemStore');
    Route::delete('admin/menu/item-delete/{id}', 'Admin\MenuController@deleteItem');
    Route::put('admin/menu/item-update/{id}', 'Admin\MenuController@updateItem');
    Route::get('admin/menu/item-edit/{id}', 'Admin\MenuController@editItem');

//clear cache
    Route::get('/clear-cache', function () {
        $exitCode = Artisan::call('cache:clear');
        // return what you want
    });

    Route::resource('comment', 'CommentController');

    Route::post('/order/get-info-notify', 'OrderController@getInfoNotify');
    Route::post('/checkout/check-coupon', 'CheckoutController@checkCoupon');

    Route::get('/admin/products-by-category/{id}', 'Admin\ProductController@apiGetProductByCategory');

    Route::resource('admin/comment', 'Admin\CommentController');
    Route::post('send-message', 'ContactController@create');
});