<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\adminMainController;
use App\Http\Controllers\admin\categoryController;
use App\Http\Controllers\admin\brandController;
use App\Http\Controllers\admin\productController;
use App\Http\Controllers\admin\productAttributeController;
use App\Http\Controllers\admin\productDiscountController;

use App\Http\Controllers\seller\sellerMainController;
use App\Http\Controllers\seller\sellerProductController;
use App\Http\Controllers\seller\sellerStoreController;

use App\Http\Controllers\customer\customerMainController;

use App\Http\Controllers\MasterCategoryController;
use App\Http\Controllers\MasterBrandController;
use App\Http\Controllers\DefaultAttributeController;
use App\Http\Controllers\StoreController;

use App\Livewire\HomepageComponent;
use App\Http\Controllers\homepageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserCartController;
use App\Http\Controllers\CheackoutController;

Route::controller(homepageController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/details/{id}', 'show')->name('products.show');
});

//admin routes
Route::middleware('auth', 'verified','rolemanager:admin')->group(function(){
    Route::prefix('admin')->group(function () {
        Route::controller(adminMainController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('admin');
            Route::get('/settings', 'setting')->name('admin.settings');
            Route::get('/profile', 'profile')->name('admin.account');

            Route::get('/manage/users', 'manageUser')->name('admin.manage.users');
            Route::get('/manage/seller', 'sellerAcc')->name('admin.seller.acc');
            Route::get('/manage/stores', 'manageStores')->name('admin.manage.stores');
            Route::get('/cart/history', 'cartHistory')->name('admin.cart.history');
            Route::get('/order/history', 'orderHistory')->name('admin.order.history');
        });
        //category 
        Route::controller(categoryController::class)->group(function () {
            Route::prefix('category')->group(function () {
                Route::get('/create', 'index')->name('category.create');
                Route::get('/manage', 'Manage')->name('category.manage');
            });
        });

        //subcategory
        Route::controller(brandController::class)->group(function () {
            Route::prefix('brand')->group(function () {
                Route::get('/create', 'index')->name('brand.create');
                Route::get('/manage', 'manage')->name('brand.manage');
            });
        });

        //productattribute
        Route::controller(productAttributeController::class)->group(function () {
            Route::prefix('product/attribute')->group(function () {
                Route::get('/create', 'index')->name('productattribute.create');
                Route::get('/manage', 'Manage')->name('productattribute.manage');
            });
        });

        //productdiscount
        Route::controller(productDiscountController::class)->group(function () {
            Route::prefix('discount')->group(function () {
                Route::get('/create', 'index')->name('discount.create');
                Route::get('/manage', 'Manage')->name('discount.manage');
            });
        });

        //product
        Route::controller(productController::class)->group(function () {
            Route::prefix('product')->group(function () {
                Route::get('/manage', 'index')->name('product.manage');
                Route::get('/review/manage', 'reviewManage')->name('product.reviewManage');
            });
        });

        Route::resource('category', MasterCategoryController::class);
        Route::resource('brand', MasterBrandController::class);
        Route::resource('productattribute', DefaultAttributeController::class);

        
    });
});

//seller routes
Route::middleware('auth', 'verified','rolemanager:vendor')->group(function(){
    Route::prefix('vendor')->group(function () {
        Route::controller(sellerMainController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('vendor');
            Route::get('/order/history', 'orderhestory')->name('vendor.order.history');
            Route::get('/account', 'account')->name('vendor.account');

        });
        
        Route::controller(sellerProductController::class)->group(function () {
            Route::prefix('product')->group(function () {

                Route::get('/manage', 'manage')->name('vendor.product.manage');
            });
        });


        Route::resource('stores', sellerStoreController::class);
        Route::resource('product', sellerProductController::class);




    });
});



//customer routes
Route::middleware('auth', 'verified','rolemanager:customer')->group(function(){
    Route::prefix('user')->group(function () {
        Route::controller(customerMainController::class)->group(function () {
            Route::get('/', 'index')->name('homed');

            Route::get('/order/history', 'history')->name('customer.order.history');
            Route::get('/setting/payment', 'payment')->name('customer.payment');
            Route::get('/affiliate', 'affiliate')->name('customer.affiliate');
            Route::get('/profile', 'profile')->name('customer.profile');


        });
        // Route::controller(CartController::class)->group(function () {
        //     Route::post('/add-to-cart', 'addToCart')->name('cart.add');
        //     Route::get('/cart', 'showCart')->name('cart.show');
        //     Route::post('/cart/update', 'updateQuantity')->name('cart.update');
        //     Route::post('/cart/remove', 'removeItem')->name('cart.remove');
        // });
        Route::resource('cart', UserCartController::class)->only(['index', 'store', 'destroy','update']);
        Route::resource('/checkout',CheackoutController::class);
    });
});
Route::prefix('user')->group(function () {
    Route::controller(LikeController::class)->group(function () {
        Route::post('/like', 'addTolike')->name('like.add');
        Route::get('/like', 'showlike')->name('like.show');
        Route::post('/like/update', 'updateQuantity')->name('like.update');
        Route::post('/like/remove', 'removeItem')->name('like.remove');
    });
});





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
