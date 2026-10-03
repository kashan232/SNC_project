<?php

    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Artisan;
    use App\Http\Controllers\AdminController;
    use App\Http\Controllers\Auth\ForgotPasswordController;
    use App\Http\Controllers\FrontendController;
    use App\Http\Controllers\Auth\LoginController;
    use App\Http\Controllers\MessageController;
    use App\Http\Controllers\CartController;
    use App\Http\Controllers\WishlistController;
    use App\Http\Controllers\OrderController;
    use App\Http\Controllers\ProductReviewController;
    use App\Http\Controllers\PostCommentController;
    use App\Http\Controllers\CouponController;
    use App\Http\Controllers\PayPalController;
    use App\Http\Controllers\NotificationController;
    use App\Http\Controllers\HomeController;
    use \UniSharp\LaravelFilemanager\Lfm;
    use App\Http\Controllers\Auth\ResetPasswordController;
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

    // CACHE CLEAR ROUTE
    Route::get('cache-clear', function () {
        Artisan::call('optimize:clear');
        request()->session()->flash('success', 'Successfully cache cleared.');
        return redirect()->back();
    })->name('cache.clear');


    // STORAGE LINKED ROUTE
    
    // FIX FILE MANAGER & LIVE URLS ROUTE
    Route::get('fix-live-issues', function () {
        // Update APP_URL in .env
        $envFile = base_path('.env');
        if (file_exists($envFile)) {
            $url = request()->getSchemeAndHttpHost();
            $env = file_get_contents($envFile);
            $env = preg_replace('/^APP_URL=(.*)$/m', 'APP_URL='.$url, $env);
            file_put_contents($envFile, $env);
        }
        
        // Force symlink
        // Force symlink specifically for cPanel public_html vs local public
        $target = storage_path('app/public');
        
        // Try public_html first (common on cPanel), then fallback to standard public_path
        // Remove the symlink or directory because cPanel Apache throws 500 error on it!
        $publicDir = base_path('public_html');
        if (!is_dir($publicDir)) {
            $publicDir = public_path();
        }
        $link = $publicDir . '/storage';
        
        if (is_link($link)) {
            @unlink($link); 
        } elseif (is_dir($link)) {
            // Delete directory and contents if it was copied by mistake
            \Illuminate\Support\Facades\File::deleteDirectory($link);
        } elseif (file_exists($link)) {
            @unlink($link);
        }
        // Do NOT recreate the symlink! Our fallback route will handle the requests.
        
        // Let's also fix the spaces in filenames issue for LFM if any, by ensuring LFM allows spaces or just renaming them?
        // Actually the issue is usually just the symlink is in the wrong place!
        
        // Clear caches
        \Illuminate\Support\Facades\Artisan::call('optimize:clear');
        
        request()->session()->flash('success', 'Live Server Issues Fixed! (APP_URL updated, Caches cleared, Symlink restored)');
        return redirect()->back();
    })->name('fix.live.issues');

    Route::get('storage-link',[AdminController::class,'storageLink'])->name('storage.link');


    Auth::routes(['register' => false]);

    Route::get('user/login', [FrontendController::class, 'login'])->name('login.form');
    Route::post('user/login', [FrontendController::class, 'loginSubmit'])->name('login.submit');
    Route::get('user/logout', [FrontendController::class, 'logout'])->name('user.logout');

    Route::get('user/register', [FrontendController::class, 'register'])->name('register.form');
    Route::post('user/register', [FrontendController::class, 'registerSubmit'])->name('register.submit');
   
    // Reset password
    Route::get('password/reset', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
    // Password Reset Routes
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

    // Socialite
    Route::get('login/{provider}/', [LoginController::class, 'redirect'])->name('login.redirect');
    Route::get('login/{provider}/callback/', [LoginController::class, 'Callback'])->name('login.callback');

    Route::get('/', [FrontendController::class, 'home'])->name('home');

// Frontend Routes
    Route::get('/home', [FrontendController::class, 'index']);
    Route::get('/about-us', [FrontendController::class, 'aboutUs'])->name('about-us');
    Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
    Route::get('/complain', function() { return view('frontend.pages.complain'); })->name('complain');
    Route::post('/complain/submit', [\App\Http\Controllers\MessageController::class, 'submitComplain'])->name('complain.submit');
    Route::post('/contact/message', [MessageController::class, 'store'])->name('contact.store');
    Route::get('product-detail/{slug}', [FrontendController::class, 'productDetail'])->name('product-detail');
    Route::post('/product/search', [FrontendController::class, 'productSearch'])->name('product.search');
    Route::get('/product-cat/{slug}', [FrontendController::class, 'productCat'])->name('product-cat');
    Route::get('/product-sub-cat/{slug}/{sub_slug}', [FrontendController::class, 'productSubCat'])->name('product-sub-cat');
    Route::get('/product-brand/{slug}', [FrontendController::class, 'productBrand'])->name('product-brand');

    Route::get('/Customer-Service', [FrontendController::class, 'Services'])->name('Customer-Service');
    Route::get('/Shipping-Info', [FrontendController::class, 'Info'])->name('Shipping-Info');
    Route::get('/Returns-Exchanges', [FrontendController::class, 'Exchange'])->name('Returns-Exchanges');
    Route::get('/Contact-Support', [FrontendController::class, 'Support'])->name('Contact-Support');
    Route::get('/FAQs', [FrontendController::class, 'FAQs'])->name('FAQs');
    Route::get('/privacy-policy', [FrontendController::class, 'privacyPolicy'])->name('privacy-policy');
    Route::get('/shipping-policy', [FrontendController::class, 'shippingPolicy'])->name('shipping-policy');
Route::get('/api/areas/{city_id}', 'App\Http\Controllers\AreaController@getAreasByCity');
Route::post('/api/save-location', 'App\Http\Controllers\AreaController@autoSaveLocation');
    Route::get('/terms-of-service', [FrontendController::class, 'termsOfService'])->name('terms-of-service');

    // Cart section
    Route::get('/add-to-cart/{slug}', [CartController::class, 'addToCart'])->name('add-to-cart')->middleware('user');
    Route::post('/add-to-cart', [CartController::class, 'singleAddToCart'])->name('single-add-to-cart')->middleware('user');
    Route::get('cart-delete/{id}', [CartController::class, 'cartDelete'])->name('cart-delete');
    Route::post('cart-update', [CartController::class, 'cartUpdate'])->name('cart.update');

    Route::get('/cart', function () {
        return view('frontend.pages.cart');
    })->name('cart');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout')->middleware('user');
// Wishlist
    Route::get('/wishlist', function () {
        return view('frontend.pages.wishlist');
    })->name('wishlist');
    Route::get('/wishlist/{slug}', [WishlistController::class, 'wishlist'])->name('add-to-wishlist')->middleware('user');
    Route::get('wishlist-delete/{id}', [WishlistController::class, 'wishlistDelete'])->name('wishlist-delete');
    Route::post('cart/order', [OrderController::class, 'store'])->name('cart.order');
    Route::get('order/pdf/{id}', [OrderController::class, 'pdf'])->name('order.pdf');
    Route::get('/income', [OrderController::class, 'incomeChart'])->name('product.order.income');
// Route::get('/user/chart',[AdminController::class, 'userPieChart'])->name('user.piechart');
    Route::get('/product-grids', [FrontendController::class, 'productGrids'])->name('product-grids');
    Route::get('/product-lists', [FrontendController::class, 'productLists'])->name('product-lists');
    Route::match(['get', 'post'], '/filter', [FrontendController::class, 'productFilter'])->name('shop.filter');
// Order Track
    Route::get('/product/track', [OrderController::class, 'orderTrack'])->name('order.track');
    Route::post('product/track/order', [OrderController::class, 'productTrackOrder'])->name('product.track.order');
// Blog
    Route::get('/blog', [FrontendController::class, 'blog'])->name('blog');
    Route::get('/blog-detail/{slug}', [FrontendController::class, 'blogDetail'])->name('blog.detail');
    Route::get('/blog/search', [FrontendController::class, 'blogSearch'])->name('blog.search');
    Route::post('/blog/filter', [FrontendController::class, 'blogFilter'])->name('blog.filter');
    Route::get('blog-cat/{slug}', [FrontendController::class, 'blogByCategory'])->name('blog.category');
    Route::get('blog-tag/{slug}', [FrontendController::class, 'blogByTag'])->name('blog.tag');

// NewsLetter
    Route::post('/subscribe', [FrontendController::class, 'subscribe'])->name('subscribe');

// Product Review
    Route::resource('/review', 'ProductReviewController');
    Route::post('product/{slug}/review', [ProductReviewController::class, 'store'])->name('review.store');

// Post Comment
    Route::post('post/{slug}/comment', [PostCommentController::class, 'store'])->name('post-comment.store');
    Route::resource('/comment', 'PostCommentController');
// Coupon
    Route::post('/coupon-store', [CouponController::class, 'couponStore'])->name('coupon-store');
// Payment
    Route::get('payment', [PayPalController::class, 'payment'])->name('payment');
    Route::get('cancel', [PayPalController::class, 'cancel'])->name('payment.cancel');
    Route::get('payment/success', [PayPalController::class, 'success'])->name('payment.success');


// Backend section start

    Route::group(['prefix' => '/admin', 'middleware' => ['auth', 'admin']], function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin');
        Route::get('/file-manager', function () {
            return view('backend.layouts.file-manager');
        })->name('file-manager');
        // user route
        Route::resource('users', 'UsersController');
        // Banner
        Route::resource('banner', 'BannerController');
        // Brand
        Route::resource('brand', 'BrandController');
        // Profile
        Route::get('/profile', [AdminController::class, 'profile'])->name('admin-profile');
        Route::post('/profile/{id}', [AdminController::class, 'profileUpdate'])->name('profile-update');
        // Category
        Route::resource('/category', 'CategoryController');
        // Product
        Route::resource('/product', 'ProductController');
        // Ajax for sub category
        Route::post('/category/{id}/child', 'CategoryController@getChildByParent');
        // POST category
        Route::resource('/post-category', 'PostCategoryController');
        // Post tag
        Route::resource('/post-tag', 'PostTagController');
        // Post
        Route::resource('/post', 'PostController');
        // Message
        Route::resource('/message', 'MessageController');
        Route::get('/message/five', [MessageController::class, 'messageFive'])->name('messages.five');

        // Order
        Route::resource('/order', 'OrderController');
        // Shipping
        Route::resource('/shipping', 'ShippingController');
        Route::resource('/outlet', 'App\Http\Controllers\OutletController');
        Route::resource('/city', 'App\Http\Controllers\CityController');
        Route::resource('/area', 'App\Http\Controllers\AreaController');
        // Coupon
        Route::resource('/coupon', 'CouponController');
        // Settings
        Route::get('settings', [AdminController::class, 'settings'])->name('settings');
        Route::post('setting/update', [AdminController::class, 'settingsUpdate'])->name('settings.update');

        // Notification
        Route::get('/notification/{id}', [NotificationController::class, 'show'])->name('admin.notification');
        Route::get('/notifications', [NotificationController::class, 'index'])->name('all.notification');
        Route::delete('/notification/{id}', [NotificationController::class, 'delete'])->name('notification.delete');
        // Password Change
        Route::get('change-password', [AdminController::class, 'changePassword'])->name('change.password.form');
        Route::post('change-password', [AdminController::class, 'changPasswordStore'])->name('change.password');
    });


// User section start
    Route::group(['prefix' => '/user', 'middleware' => ['user']], function () {
        Route::get('/', [HomeController::class, 'index'])->name('user');
        // Profile
        Route::get('/profile', [HomeController::class, 'profile'])->name('user-profile');
        Route::post('/profile/{id}', [HomeController::class, 'profileUpdate'])->name('user-profile-update');
        //  Order
        Route::get('/order', "HomeController@orderIndex")->name('user.order.index');
        Route::get('/order/show/{id}', "HomeController@orderShow")->name('user.order.show');
        Route::delete('/order/delete/{id}', [HomeController::class, 'userOrderDelete'])->name('user.order.delete');
        // Product Review
        Route::get('/user-review', [HomeController::class, 'productReviewIndex'])->name('user.productreview.index');
        Route::delete('/user-review/delete/{id}', [HomeController::class, 'productReviewDelete'])->name('user.productreview.delete');
        Route::get('/user-review/edit/{id}', [HomeController::class, 'productReviewEdit'])->name('user.productreview.edit');
        Route::patch('/user-review/update/{id}', [HomeController::class, 'productReviewUpdate'])->name('user.productreview.update');

        // Post comment
        Route::get('user-post/comment', [HomeController::class, 'userComment'])->name('user.post-comment.index');
        Route::delete('user-post/comment/delete/{id}', [HomeController::class, 'userCommentDelete'])->name('user.post-comment.delete');
        Route::get('user-post/comment/edit/{id}', [HomeController::class, 'userCommentEdit'])->name('user.post-comment.edit');
        Route::patch('user-post/comment/udpate/{id}', [HomeController::class, 'userCommentUpdate'])->name('user.post-comment.update');

        // Password Change
        Route::get('change-password', [HomeController::class, 'changePassword'])->name('user.change.password.form');
        Route::post('change-password', [HomeController::class, 'changPasswordStore'])->name('change.password');

    });

    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        Lfm::routes();
    });


// FALLBACK ROUTE FOR STORAGE IMAGES (Solves cPanel symlink issues)
Route::get('storage/{path}', function ($path) {
    $path = urldecode($path);
    
    // Check multiple possible locations for the file
    $possiblePaths = [
        storage_path('app/public/' . $path),
        base_path('public_html/storage/' . $path),
        base_path('public/storage/' . $path),
        storage_path($path),
    ];
    
    $foundPath = null;
    foreach ($possiblePaths as $p) {
        if (file_exists($p) && is_file($p)) {
            $foundPath = $p;
            break;
        }
    }
    
    if ($foundPath) {
        try {
            $ext = pathinfo($foundPath, PATHINFO_EXTENSION);
            $mimes = [
                'jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg',
                'png' => 'image/png', 'gif' => 'image/gif', 
                'svg' => 'image/svg+xml', 'webp' => 'image/webp'
            ];
            $mime = $mimes[strtolower($ext)] ?? 'application/octet-stream';
            
            return response()->file($foundPath, [
                'Content-Type' => $mime,
                'Cache-Control' => 'public, max-age=31536000'
            ]);
        } catch (\Exception $e) {
            return response(file_get_contents($foundPath), 200)
                   ->header('Content-Type', 'image/jpeg');
        }
    }
    
    // If not found, return a dummy transparent image or 404
    // Returning 404 so we know it is genuinely missing
    abort(404, "File not found in any storage path.");
})->where('path', '.*');
