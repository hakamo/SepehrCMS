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


Auth::routes();

Route::group(['middleware' => ['web']],function(){

    //Route::get('/', function () {
    //    //return view('welcome');
    //    return view('frontend.main2');
    //});

    Route::get('/', function () {
        return redirect('/home/');
    });

    Route::get('/logout', 'HomeController@index');  

    //first page products
	Route::any('/admin/products/{language?}/{crud?}/{slug?}',[	
		'uses' => 'ProductController@getAdminPanelProducts',
		'as' => 'cms.AdminPanelProducts'
	]);  

    //first page slide
    Route::get('/admin/slides/{language?}/{crud?}/{slug?}',[	
	    'uses' => 'SlideController@getAdminPanelSlides',
	    'as' => 'cms.AdminPanelSlides'
	]);  

    //site pages
    Route::any('/admin/pages/{language?}/{crud?}/{slug?}',[	
	    'uses' => 'PageController@getAdminPanelPages',
	    'as' => 'cms.AdminPanelPages'
	]);
  	
    //menu navbar
    Route::any('/admin/menues/{language?}/{crud?}/{slug?}',[	
	    'uses' => 'MenuController@getAdminPanelMenues',
	    'as' => 'cms.AdminPanelMenues'
	]); 

    //Configuration
    Route::any('/admin/configurations/{language?}/{crud?}',[	
	   'uses' => 'admin\ConfigurationController@getConfigurationView',
	     'as' => 'cms.AdminPanelConfiguration'
	]); 

    //contacts
    Route::any('/admin/contacts/{crud?}',[	
	   'uses' => 'ContactController@getAdminPanelContacts',
	     'as' => 'cms.AdminPanelContact'
	]);

    Route::any('/admin',[	
        'uses' => 'ProductController@getAdminPanelProducts',
        'as' => 'cms.AdminPanelProducts1'
    ]); 

    Route::get('/home/{language?}', [
        'uses' => 'HomeController@index',
        'as' => 'cms.HomePage'        
    ]);
   
    Route::any('/page/{language?}/{id?}/{slug?}',[	
        'uses' => 'HomeController@getPages',
        'as' => 'cms.Pages'
    ]);

    Route::any('/search/',[	
        'uses' => 'HomeController@searchtPages',
        'as' => 'cms.SearchPages'
    ]);

    //contacts
    Route::post('/contact',[	
	   'uses' => 'ContactController@MakeContact',
	     'as' => 'cms.MakeContact'
	]);


     Route::get('/test', function () {
        return view('test');
    });
   
    Route::get('/gallery',[
         'uses' => 'GalleryController@getGalleryPages',
         'as' => 'cms.GalleryPages'
    ]);

    Route::get('/captcha',[
        'uses' => 'HomeController@getCaptcha',
        'as' => 'cms.Captcha'
    ]);

});



Route::group(['middleware' => ['CORS']],function(){
	
    Route::any('/admin/imagebrowser/{crud?}/{arg?}',[	
        'uses' => 'ImageController@getAdminPanelImages',
        'as' => 'cms.AdminPanelImages'
    ]);
  
    Route::any('/admin/gallery/{crud?}/{arg?}',[	
        'uses' => 'GalleryController@getAdminPanelGalleries',
        'as' => 'cms.AdminPanelGalleries'
    ])->middleware('auth');

});

