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

Route::get('/clearer', function() {
    $exitCode = \Artisan::call('config:cache');
    $exitCode = \Artisan::call('cache:clear');
    $exitCode = \Artisan::call('route:clear');
    $exitCode = \Artisan::call('view:clear');
	$exitCode = \Artisan::call('config:clear');
    return '<h1>Clear Config cleared</h1>';
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('login',array('as'=>'login',function(){
    //return view('admin/index');
	return redirect('admin/login');
}));

Route::get('/home', [ 'uses' =>'PagController@index']);

Route::get('/about', [ 'uses' =>'PagController@index']);

Route::get('/contact', [ 'uses' =>'PagController@index']);


Route::get('/gallery/{catid?}/{bycitycat?}', [ 'uses' =>'PagController@index']);
Route::get('/gallery/{catid?}/{bycitycat?}', [ 'uses' =>'PagController@index']);

Route::get('/gallerysearch/{keywords?}', [ 'uses' =>'PagController@index']);


Route::get('/blog/{bycat?}/{catid?}/{subid?}',  ['middleware' => ['cors']  ,'uses' =>'PagController@index']);
Route::get('/blogdetail/{blogid?}/{catid?}/{subid?}',  ['middleware' => ['cors']  ,'uses' =>'PagController@index']);
Route::get('/galdetail/{galid?}',  ['middleware' => ['cors']  ,'uses' =>'PagController@index']);
Route::get('/tags/jsontags/{galid?}',  ['middleware' => ['cors'] ,'uses' =>'TagController@jsonTags']);


Route::get('/gallerycat/json',  ['middleware' => ['cors']  ,'uses' =>'PortcatController@homejsondropdown']);
Route::get('/gallerycat/json/',  ['middleware' => ['cors']  ,'uses' =>'PortcatController@homejsondropdown']);
Route::get('/gallerycatsingle/json/detail/{id?}',  ['middleware' => ['cors']  ,'uses' =>'PortcatController@detail']);

Route::get('/gallerycity/json',  ['middleware' => ['cors']  ,'uses' =>'CityController@homejsondropdown']);
Route::get('/gallerycity/json/',  ['middleware' => ['cors']  ,'uses' =>'CityController@homejsondropdown']);
Route::get('/gallerycity/json/detail/{id?}',  ['middleware' => ['cors']  ,'uses' =>'CityController@detail']);


Route::get('/gallerytag/json/detail/{id?}',  ['middleware' => ['cors']  ,'uses' =>'TagController@detail']);


Route::get('/banner/json',  ['middleware' => ['cors']  ,'uses' =>'ServiceController@bannerslide']);
Route::get('/banner/json/',  ['middleware' => ['cors']  ,'uses' =>'ServiceController@bannerslide']);

Route::get('/blogcat/json/{bycat?}/{catid?}/{subid?}',  ['middleware' => ['cors']  ,'uses' =>'BlogcatController@homejsondropdown']);
Route::get('about/json/detail/{id?}',  ['middleware' => ['cors']  ,'uses' =>'AboutController@detail']);

Route::get('/about/json/detail/{id?}',  ['middleware' => ['cors']  ,'uses' =>'AboutController@detail']);

Route::get('blogghome/json/{bycat?}/{catid?}/{subid?}',  ['middleware' => ['cors']  ,'uses' =>'BlogController@indexjsonhome']);
Route::get('/blogghome/json/{bycat?}/{catid?}/{subid?}',  ['middleware' => ['cors']  ,'uses' =>'BlogController@indexjsonhome']);

Route::get('/galhome/json/{catid?}/{bycitycat?}',  ['middleware' => ['cors']  ,'uses' =>'PortfolioController@indexjsonhome']);
Route::get('/vidhome/json/{catid?}/{bycitycat?}',  ['middleware' => ['cors']  ,'uses' =>'PortfolioController@indexjsonhomevid']);

Route::get('/gal/json/{catid?}/{bycitycat?}',  ['middleware' => ['cors']  ,'uses' =>'PortfolioController@indexjsonpublic']);
Route::get('/gallerydetail/json/{galid?}',  ['middleware' => ['cors']  ,'uses' =>'PortfolioController@detailpublic']);
Route::get('/galsearch/search',  ['middleware' => ['cors']  ,'uses' =>'PortfolioController@search']);
Route::post('/galsearch/search',  ['middleware' => ['cors']  ,'uses' =>'PortfolioController@search']);

Route::get('/galsearch/search2',  ['middleware' => ['cors']  ,'uses' =>'PortfolioController@search2']);
Route::post('/galsearch/search2',  ['middleware' => ['cors']  ,'uses' =>'PortfolioController@search2']);



Route::get('/blogcaternav/json/{bycat?}/{catid?}/{subid?}',  ['middleware' => ['cors']  ,'uses' =>'BlogcatController@indexjsonnavpublic']);
Route::get('/blogcatdet/json/detail/{id?}',  ['middleware' => ['cors']  ,'uses' =>'BlogcatController@detail']);

Route::get('/blogg/json/{bycat?}/{catid?}/{subid?}',  ['middleware' => ['cors']  ,'uses' =>'BlogController@indexjsonpublic']);
Route::get('/blogdet/json/{blogid?}',  ['middleware' => ['cors']  ,'uses' =>'BlogController@detailpublic']);
Route::get('/blogsearch/search',  ['middleware' => ['cors']  ,'uses' =>'BlogController@search']);
Route::post('/blogsearch/search',  ['middleware' => ['cors']  ,'uses' =>'BlogController@search']);

Route::get('/shopcaternav/json/{bycat?}/{catid?}/{subid?}',  ['middleware' => ['cors']  ,'uses' =>'ShopcatController@indexjsonnavpublic']);
Route::get('/shopcat/json/{bycat?}/{catid?}/{subid?}',  ['middleware' => ['cors']  ,'uses' =>'ShopcatController@homejsondropdown']);
Route::get('/shopcatdet/json/detail/{id?}',  ['middleware' => ['cors']  ,'uses' =>'ShopcatController@detail']);

Route::get('/shop/{bycat?}/{catid?}/{subid?}',  ['middleware' => ['cors']  ,'uses' =>'PagController@index']);
Route::get('/shopdetail/{shopid?}/{catid?}/{subid?}',  ['middleware' => ['cors']  ,'uses' =>'PagController@index']);

Route::get('/shopp/json/{bycat?}/{catid?}/{subid?}',  ['middleware' => ['cors']  ,'uses' =>'ShoperController@indexjsonpublic']);
Route::get('/shopdet/json/{blogid?}',  ['middleware' => ['cors']  ,'uses' =>'ShoperController@detailpublic']);
Route::get('/shopsearch/search',  ['middleware' => ['cors']  ,'uses' =>'ShoperController@search']);
Route::post('/shopsearch/search',  ['middleware' => ['cors']  ,'uses' =>'ShoperController@search']);


Route::get('shopphome/json/{bycat?}/{catid?}/{subid?}',  ['middleware' => ['cors']  ,'uses' =>'ShoperController@indexjsonhome']);
Route::get('/shopphome/json/{bycat?}/{catid?}/{subid?}',  ['middleware' => ['cors']  ,'uses' =>'ShoperController@indexjsonhome']);

Route::get('/shopsearch/search',  ['middleware' => ['cors']  ,'uses' =>'ShoperController@search']);
Route::post('/shopsearch/search',  ['middleware' => ['cors']  ,'uses' =>'ShoperController@search']);

Route::post('/contacter', ['middleware' => ['cors']  ,'uses' =>'ContactController@store']);
Route::post('/contacterattach', ['middleware' => ['cors']  ,'uses' =>'ContactController@storeattach']);



//Route::post('/contacter/', ['middleware' => ['cors']  ,'uses' =>'ContactController@store']);



Route::group(['guard' => 'api'], function () {


Route::get('/dashboard/',  ['middleware' => ['userajax'] ,'uses' =>'AdminController@index']);
Route::get('/dashboard2/',  [ 'middleware' => ['userajax'] , 'uses' =>'AdminController@index']);
Route::get('/dashboard',  ['middleware' => ['userajax'] ,'uses' =>'AdminController@index']);
Route::get('/dashboard2',  ['middleware' => ['userajax'] ,'uses' =>'AdminController@index']);

Route::get('/admin/', 'AdminController@index');
Route::get('/admin/index', 'AdminController@index');
Route::get('/admin/login',  ['uses' =>'AdminController@index']);
Route::get('/admin/register',  ['middleware' => ['adminajax'],'uses' =>'AdminController@index']);
Route::get('/admin/register/',  ['middleware' => ['adminajax'],'uses' =>'AdminController@index']);

Route::get('/admin/dashboard',  ['middleware' => ['cors','userajax']  ,'uses' =>'AdminController@index']);
Route::get('/admin/dashboard2',  ['middleware' => ['cors','userajax']  ,'uses' =>'AdminController@index']);

Route::get('/admin/dashboard/',  ['middleware' => ['cors','userajax']  ,'uses' =>'AdminController@index']);
Route::get('/admin/dashboard2/',  ['middleware' => ['cors','userajax']  ,'uses' =>'AdminController@index']);

Route::get('/admin/dashboard3',  ['middleware' => ['cors','adminajax'] ,'uses' =>'AdminController@index']);
Route::get('/admin/dashboard3/',  ['middleware' => ['cors','adminajax'] ,'uses' =>'AdminController@index']);

//adminajaxowner adminowner adminajax
Route::get('/admin/users/json/{ownerid?}',  ['middleware' => ['cors','adminajax']  ,'uses' =>'UserController@indexjson']);
Route::get('/admin/user/json/{ownerid?}',  ['middleware' => ['cors','adminajaxowner']  ,'uses' =>'UserController@indexjson2']);



Route::get('/admin/user/edit/{id}',  ['middleware' => ['cors','adminajaxowner']  ,'uses' =>'UserController@edit']);


Route::get('users/json',  ['middleware' => ['cors']  ,'uses' =>'UserController@indexjson']);
Route::get('user/json/{ownerid?}',  ['middleware' => ['cors']  ,'uses' =>'UserController@indexjson2']);

Route::post('/admin/user/update/{id}', ['middleware' => ['cors','adminajaxowner'] ,'uses' => 'UserController@update']);
Route::put('/admin/user/update/{id}', ['middleware' => ['cors','adminajaxowner'] ,'uses' => 'UserController@update']);
Route::patch('/admin/user/update/{id}', ['middleware' => ['cors','adminajaxowner'] ,'uses' => 'UserController@update']);
Route::delete('admin/users/deletejson/{id}', ['middleware' => ['cors','adminajax'] ,'uses' => 'UserController@destroy']);





Route::get('/admin/addportfoliocat',  ['middleware' => ['cors','userajax', 'jwt.refresh'] ,'uses' =>'AdminController@index']);
Route::get('/admin/addportfoliocat/',  ['middleware' => ['cors','userajax', 'jwt.refresh'] ,'uses' =>'AdminController@index']);
Route::get('/admin/portfoliocat',  ['middleware' => ['cors','userajax', 'jwt.refresh'] ,'uses' =>'AdminController@index']);
Route::get('/admin/portfoliocat/',  ['middleware' => ['cors','userajax', 'jwt.refresh'] ,'uses' =>'AdminController@index']);
Route::get('/admin/portcat/json',  ['middleware' => ['cors','userajax']  ,'uses' =>'PortcatController@indexjson']);
Route::get('/admin/portcat/jsoncatdrop/{cat_id?}',  ['middleware' => ['cors','userajax']  ,'uses' =>'PortcatController@indexjsondropdown']);
Route::get('/admin/portcat/edit/{id}',  ['middleware' => ['cors','userajax']  ,'uses' =>'PortcatController@edit']);


//Route::get('portcat/json',  ['middleware' => ['cors']  ,'uses' =>'PortcatController@indexjson']);
//Route::get('portcat/jsoncatdrop/{cat_id?}',['middleware' =>['cors'],'uses' =>'PortcatController@indexjsondropdown']);


Route::post('/admin/portcat/post', ['middleware' => ['cors','userajax'] ,'uses' => 'PortcatController@store']);
Route::post('/admin/portcat/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'PortcatController@update']);
Route::put('/admin/portcat/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'PortcatController@update']);
Route::patch('/admin/portcat/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'PortcatController@update']);
Route::delete('admin/catportfolio/deletejson/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'PortcatController@destroy']);



Route::get('/admin/addcity',  ['middleware' => ['cors','userajax'] ,'uses' =>'AdminController@index']);
Route::get('/admin/addcity/',  ['middleware' => ['cors','userajax'] ,'uses' =>'AdminController@index']);
Route::get('/admin/cities',  ['middleware' => ['cors','userajax'] ,'uses' =>'AdminController@index']);
Route::get('/admin/cities/',  ['middleware' => ['cors','userajax'] ,'uses' =>'AdminController@index']);

Route::get('/admin/city',  ['middleware' => ['cors','userajax'] ,'uses' =>'AdminController@index']);
Route::get('/admin/city/',  ['middleware' => ['cors','userajax'] ,'uses' =>'AdminController@index']);


Route::get('/admin/cities/json',  ['middleware' => ['cors','userajax']  ,'uses' =>'CityController@indexjson']);
Route::get('/admin/cities/jsoncitydrop/{city_id?}',  ['middleware' => ['cors','userajax']  ,'uses' =>'CityController@indexjsondropdown']);
Route::get('/admin/city/edit/{id}',  ['middleware' => ['cors','userajax']  ,'uses' =>'CityController@edit']);


//Route::get('cities/json',  ['middleware' => ['cors']  ,'uses' =>'CityController@indexjson']);
//Route::get('cities/jsoncitydrop/{city_id?}',['middleware' =>['cors'],'uses' =>'CityController@indexjsondropdown']);


Route::post('/admin/city/post', ['middleware' => ['cors','userajax'] ,'uses' => 'CityController@store']);
Route::post('/admin/city/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'CityController@update']);
Route::put('/admin/city/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'CityController@update']);
Route::patch('/admin/city/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'CityController@update']);
Route::delete('admin/city/deletejson/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'CityController@destroy']);


Route::get('/admin/addportfolio/{catid?}/{bycitycat?}',  ['middleware' => ['cors','userajax'] ,'uses' =>'AdminController@index']);
//Route::get('/admin/addportfolio/',  ['middleware' => ['cors'] ,'uses' =>'AdminController@index']);
Route::get('/admin/portfolio/{catid?}/{bycitycat?}',  ['middleware' => ['cors','userajax'] ,'uses' =>'AdminController@index']);
Route::get('/admin/port/json/{catid?}/{bycitycat?}',  ['middleware' => ['cors','userajax']  ,'uses' =>'PortfolioController@indexjson']);
Route::get('/admin/port/jsonportdrop/{cat_id?}',  ['middleware' => ['cors','userajax']  ,'uses' =>'PortfolioController@indexjsondropdown']);
Route::get('/admin/port/edit/{id}',  ['middleware' => ['cors','userajax']  ,'uses' =>'PortfolioController@edit']);
Route::get('/admin/port/detail/{id}',  ['middleware' => ['cors','userajax']  ,'uses' =>'PortfolioController@detail']);

//Route::get('/port/edit/{id}',  ['middleware' => ['cors']  ,'uses' =>'PortfolioController@edit']);
//Route::get('/port/detail/{id}',  ['middleware' => ['cors']  ,'uses' =>'PortfolioController@detail']);
//Route::get('port/json',  ['middleware' => ['cors']  ,'uses' =>'PortfolioController@indexjson']);


Route::post('/admin/port/post', ['middleware' => ['cors','userajax'] ,'uses' => 'PortfolioController@store']);
Route::post('/admin/port/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'PortfolioController@update']);
Route::put('/admin/port/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'PortfolioController@update']);
Route::patch('/admin/port/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'PortfolioController@update']);
Route::delete('admin/deleteportfolio/deletejson/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'PortfolioController@destroy']);



Route::post('/admin/image/store', ['middleware' => ['cors','userajax'] ,'uses' => 'ImageController@store']);

Route::get('/admin/addportfolioimg/{portid?}',  ['middleware' => ['cors','userajax'] ,'uses' =>'AdminController@index']);
Route::get('/admin/addimg/{portid?}',  ['middleware' => ['cors','userajax'] ,'uses' =>'AdminController@index']);
Route::get('/admin/portfolioimg/{portid?}',  ['middleware' => ['cors','userajax'] ,'uses' =>'AdminController@index']);
Route::get('/admin/portimg/json/{portid?}',  ['middleware' => ['cors','userajax']  ,'uses' =>'GalleryportController@indexjson']);
Route::get('/admin/portimg/edit/{id}',  ['middleware' => ['cors','userajax']  ,'uses' =>'GalleryportController@edit']);
Route::get('/portimg/edit/{id}',  ['middleware' => ['cors','userajax']  ,'uses' =>'GalleryportController@edit']);

//Route::get('portfolioimg/{portid?}',  ['middleware' => ['cors'] ,'uses' =>'GalleryportController@indexjson']);

Route::post('/admin/portimg/post', ['middleware' => ['cors','userajax'] ,'uses' => 'GalleryportController@store']);
Route::post('/admin/portimg/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'GalleryportController@update']);
Route::put('/admin/portimg/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'GalleryportController@update']);
Route::patch('/admin/portimg/update/{id}', ['middleware' => ['cors','userajax'],'uses' => 'GalleryportController@update']);
Route::delete('admin/deleteportimg/deletejson/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'GalleryportController@destroy']);



Route::get('/admin/addtag',  ['middleware' => ['cors','userajax'] ,'uses' =>'AdminController@index']);
Route::get('/admin/addtag/',  ['middleware' => ['cors','userajax'] ,'uses' =>'AdminController@index']);
Route::get('/admin/tags',  ['middleware' => ['cors','userajax'] ,'uses' =>'AdminController@index']);
Route::get('/admin/tags/',  ['middleware' => ['cors','userajax'] ,'uses' =>'AdminController@index']);
Route::get('/admin/tags/json',  ['middleware' => ['cors','userajax']  ,'uses' =>'TagController@indexjson']);
Route::get('/admin/tags/jsontagdrop/{tag_id?}',  ['middleware' => ['cors','userajax']  ,'uses' =>'TagController@indexjsondropdown']);
Route::get('/admin/tags/jsontagdropEdit/{typ?}/{port_id?}',  ['middleware' => ['cors','userajax'] ,'uses' =>'TagController@jsondropdownEdit']);
Route::get('/admin/tags/jsontagArray/{port_id?}',  ['middleware' => ['cors','userajax'] ,'uses' =>'TagController@jsondropdownArray']);
Route::get('/admin/tag/edit/{id}',  ['middleware' => ['cors','userajax']  ,'uses' =>'TagController@edit']);


//Route::get('tags/json',  ['middleware' => ['cors']  ,'uses' =>'TagController@indexjson']);
//Route::get('tags/jsontagdrop/{tag_id?}',['middleware' =>['cors'],'uses' =>'TagController@indexjsondropdown']);
//Route::get('/tags/jsontagdropEdit/{typ?}/{port_id?}',  ['middleware' => ['cors'] ,'uses' =>'TagController@jsondropdownEdit']);

Route::post('/admin/tag/post', ['middleware' => ['cors','userajax'] ,'uses' => 'TagController@store']);
Route::post('/admin/tag/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'TagController@update']);
Route::put('/admin/tag/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'TagController@update']);
Route::patch('/admin/tag/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'TagController@update']);
Route::delete('admin/tag/deletejson/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'TagController@destroy']);





Route::get('/admin/addblogcat/{catid?}',  ['middleware' => ['cors','userajax'] ,'uses' =>'AdminController@index']);
//Route::get('/admin/addblogcat/',  ['middleware' => ['cors','userajax'] ,'uses' =>'AdminController@index']);

Route::get('/admin/blogcat/{bycat?}/{catid?}',  ['middleware' => ['cors','userajax'] ,'uses' =>'AdminController@index']);

Route::get('/admin/blogsub/{catid?}',  ['middleware' => ['cors','userajax'] ,'uses' =>'AdminController@index']);


//Route::get('/admin/blogcat/',  ['middleware' => ['cors','userajax'] ,'uses' =>'AdminController@index']);

Route::get('/admin/blogcater/json/{bycat?}/{catid?}',  ['middleware' => ['cors','userajax']  ,'uses' =>'BlogcatController@indexjson']);
Route::get('/admin/blogcater/jsoncatdrop/{cat_id?}',  ['middleware' => ['cors','userajax']  ,'uses' =>'BlogcatController@catdropdown']);
Route::get('/admin/blogsuber/jsonsubdrop/{catid?}/{sub_id?}',  ['middleware' => ['cors','userajax']  ,'uses' =>'BlogcatController@subdropdown']);
Route::get('/admin/blogcatupd/edit/{id}',  ['middleware' => ['cors','userajax']  ,'uses' =>'BlogcatController@edit']);
Route::get('/admin/blogcaternav/json/{bycat?}/{catid?}/{subid?}',  ['middleware' => ['cors','userajax']  ,'uses' =>'BlogcatController@indexjsonnav']);

//Route::get('blogcat/json/{catid?}',  ['middleware' => ['cors']  ,'uses' =>'BlogcatController@indexjson']);
//Route::get('blogcat/jsoncatdrop/{cat_id?}',['middleware' =>['cors'],'uses' =>'BlogcatController@catdropdown']);
//Route::get('blogsub/jsonsubdrop/{catid?}/{sub_id?}',['middleware' =>['cors'],'uses' =>'BlogcatController@subdropdown']);

Route::post('/admin/blogcat/post', ['middleware' => ['cors','userajax'] ,'uses' => 'BlogcatController@store']);
Route::post('/admin/blogcat/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'BlogcatController@update']);
Route::put('/admin/blogcat/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'BlogcatController@update']);
Route::patch('/admin/blogcat/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'BlogcatController@update']);
Route::delete('admin/catblog/deletejson/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'BlogcatController@destroy']);


Route::get('/admin/addblog/{bycat?}/{catid?}/{subid?}',  ['middleware' => ['cors','userajax'] ,'uses' =>'AdminController@index']);
Route::get('/admin/blog/{bycat?}/{catid?}/{subid?}',  ['middleware' => ['cors','userajax'] ,'uses' =>'AdminController@index']);

//Route::get('/admin/blog/json/{catid?}',  ['middleware' => ['cors','userajax']  ,'uses' =>'BlogController@indexjson']);
Route::get('/admin/blogg/json/{bycat?}/{catid?}/{subid?}',  ['middleware' => ['cors','userajax']  ,'uses' =>'BlogController@indexjson']);
Route::get('/admin/blogupd/edit/{id}',  ['middleware' => ['cors','userajax']  ,'uses' =>'BlogController@edit']);

//Route::get('/blog/edit/{id}',  ['middleware' => ['cors']  ,'uses' =>'BlogController@edit']);
//Route::get('blog/json/{bycat?}/{catid?}/{subid?}',  ['middleware' => ['cors']  ,'uses' =>'BlogController@indexjson']);
//Route::get('blogcaternav/json/{bycat?}/{catid?}/{subid?}',  ['middleware' => ['cors']  ,'uses' =>'BlogcatController@indexjsonnav']);

Route::post('/admin/blog/post', ['middleware' => ['cors','userajax'] ,'uses' => 'BlogController@store']);
Route::post('/admin/blog/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'BlogController@update']);
Route::put('/admin/blog/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'BlogController@update']);
Route::patch('/admin/blog/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'BlogController@update']);
Route::delete('admin/deleteblog/deletejson/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'BlogController@destroy']);


Route::get('/admin/addservice',  ['middleware' => ['cors','userajax'] ,'uses' =>'AdminController@index']);
Route::get('/admin/addservice/',  ['middleware' => ['cors','userajax'] ,'uses' =>'AdminController@index']);
Route::get('/admin/service',  ['middleware' => ['cors','userajax'] ,'uses' =>'AdminController@index']);
Route::get('/admin/service/',  ['middleware' => ['cors','userajax'] ,'uses' =>'AdminController@index']);

Route::get('/admin/services/json',  ['middleware' => ['cors','userajax']  ,'uses' =>'ServiceController@indexjson']);
Route::get('/admin/services/json/',  ['middleware' => ['cors','userajax']  ,'uses' =>'ServiceController@indexjson']);
Route::get('/admin/service/edit/{id}',  ['middleware' => ['cors','userajax']  ,'uses' =>'ServiceController@edit']);
Route::get('/admin/service/jsonservdrop/{cat_id?}',  ['middleware' => ['cors','userajax']  ,'uses' =>'ServiceController@indexjsondropdown']);
Route::get('/admin/service/detail/{id}',  ['middleware' => ['cors','userajax']  ,'uses' =>'ServiceController@detail']);


//Route::get('/service/edit/{id}',  ['middleware' => ['cors']  ,'uses' =>'ServiceController@edit']);
//Route::get('/service/detail/{id}',  ['middleware' => ['cors']  ,'uses' =>'ServiceController@detail']);
//Route::get('service/json',  ['middleware' => ['cors']  ,'uses' =>'ServiceController@indexjson']);


Route::post('/admin/service/post', ['middleware' => ['cors','userajax'] ,'uses' => 'ServiceController@store']);
Route::post('/admin/service/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'ServiceController@update']);
Route::put('/admin/service/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'ServiceController@update']);
Route::patch('/admin/service/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'ServiceController@update']);
Route::delete('admin/deleteservice/deletejson/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'ServiceController@destroy']);




Route::get('/admin/addservicesub/{servid?}',  ['middleware' => ['cors','userajax'] ,'uses' =>'AdminController@index']);
Route::get('/admin/servicesub/{servid?}',  ['middleware' => ['cors','userajax'] ,'uses' =>'AdminController@index']);

Route::get('/admin/servicesub/json/{servid?}',  ['middleware' => ['cors','userajax']  ,'uses' =>'ServicesubController@indexjson']);
Route::get('/admin/servicesuber/json/{servid?}',  ['middleware' => ['cors','userajax']  ,'uses' =>'ServicesubController@indexjson']);
Route::get('/admin/servicesub/json/{servid?}',  ['middleware' => ['cors','userajax']  ,'uses' =>'ServicesubController@indexjson']);

Route::get('/admin/servicesub/edit/{id}',  ['middleware' => ['cors','userajax']  ,'uses' =>'ServicesubController@edit']);

//Route::get('servicesub/json/{servid?}',  ['middleware' => ['cors'] ,'uses' =>'ServicesubController@indexjson']);

Route::post('/admin/servicesub/post', ['middleware' => ['cors','userajax'] ,'uses' => 'ServicesubController@store']);
Route::post('/admin/servicesub/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'ServicesubController@update']);
Route::put('/admin/servicesub/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'ServicesubController@update']);
Route::patch('/admin/servicesub/update/{id}', ['middleware' => ['cors','userajax'],'uses' => 'ServicesubController@update']);
Route::delete('admin/deleteservicesub/deletejson/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'ServicesubController@destroy']);






Route::get('/admin/about',  ['middleware' => ['cors','userajax'] ,'uses' =>'AdminController@index']);
Route::get('/admin/about/',  ['middleware' => ['cors','userajax'] ,'uses' =>'AdminController@index']);

Route::get('/admin/abouts/json',  ['middleware' => ['cors','userajax']  ,'uses' =>'AboutController@indexjson']);
Route::get('/admin/abouts/json/',  ['middleware' => ['cors','userajax']  ,'uses' =>'AboutController@indexjson']);
Route::get('/admin/about/edit/{id}',  ['middleware' => ['cors','userajax']  ,'uses' =>'AboutController@edit']);

Route::get('/admin/about/detail/{id}',  ['middleware' => ['cors','userajax']  ,'uses' =>'AboutController@detail']);


//Route::get('/about/edit/{id}',  ['middleware' => ['cors']  ,'uses' =>'ServiceController@edit']);
//Route::get('/about/detail/{id}',  ['middleware' => ['cors']  ,'uses' =>'ServiceController@detail']);
//Route::get('about/json',  ['middleware' => ['cors']  ,'uses' =>'ServiceController@indexjson']);

Route::post('/admin/about/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'AboutController@update']);
Route::put('/admin/about/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'AboutController@update']);
Route::patch('/admin/about/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'AboutController@update']);
Route::delete('admin/deleteabout/deletejson/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'AboutController@destroy']);
Route::get('ckeditor', 'CkeditorController@index');
Route::post('ckeditor/upload', 'CkeditorController@upload')->name('ckeditor.upload');



Route::get('/admin/addshopcat/{catid?}',  ['middleware' => ['cors','userajax'] ,'uses' =>'AdminController@index']);
Route::get('/admin/shopcat/{bycat?}/{catid?}',  ['middleware' => ['cors'] ,'uses' =>'AdminController@index']);
Route::get('/admin/shopsub/{catid?}',  ['middleware' => ['cors','userajax'] ,'uses' =>'AdminController@index']);



Route::get('/admin/shopcater/json/{bycat?}/{catid?}',  ['middleware' => ['cors','userajax']  ,'uses' =>'ShopcatController@indexjson']);
Route::get('/admin/shopcater/jsoncatdrop/{cat_id?}',  ['middleware' => ['cors','userajax']  ,'uses' =>'ShopcatController@catdropdown']);
Route::get('/admin/shopsuber/jsonsubdrop/{catid?}/{sub_id?}',  ['middleware' => ['cors','userajax']  ,'uses' =>'ShopcatController@subdropdown']);
Route::get('/admin/shopcatupd/edit/{id}',  ['middleware' => ['cors','userajax']  ,'uses' =>'ShopcatController@edit']);
Route::get('/admin/shopcaternav/json/{bycat?}/{catid?}/{subid?}',  ['middleware' => ['cors','userajax']  ,'uses' =>'ShopcatController@indexjsonnav']);



Route::post('/admin/shopcat/post', ['middleware' => ['cors','userajax'] ,'uses' => 'ShopcatController@store']);
Route::post('/admin/shopcat/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'ShopcatController@update']);
Route::put('/admin/shopcat/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'ShopcatController@update']);
Route::patch('/admin/shopcat/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'ShopcatController@update']);
Route::delete('admin/catshop/deletejson/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'ShopcatController@destroy']);


Route::get('/admin/addshop/{bycat?}/{catid?}/{subid?}',  ['middleware' => ['cors'] ,'uses' =>'AdminController@index']);
Route::get('/admin/shop/{bycat?}/{catid?}/{subid?}',  ['middleware' => ['cors'] ,'uses' =>'AdminController@index']);
Route::get('/admin/shopupd/edit/{id}',  ['middleware' => ['cors','userajax']  ,'uses' =>'ShoperController@edit']);

Route::get('/admin/shopp/json/{bycat?}/{catid?}/{subid?}',  ['middleware' => ['cors','userajax']  ,'uses' =>'ShoperController@indexjson']);
Route::get('/admin/shopdet/detail/{id}',  ['middleware' => ['cors','userajax']  ,'uses' =>'ShoperController@detailAdmin']);
Route::get('/admin/shopper/jsonshopdrop/{cat_id?}',  ['middleware' => ['cors','userajax']  ,'uses' =>'ShoperController@indexjsondropdown']);


Route::post('/admin/shop/post', ['middleware' => ['cors','userajax'] ,'uses' => 'ShoperController@store']);
Route::post('/admin/shop/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'ShoperController@update']);
Route::put('/admin/shop/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'ShoperController@update']);
Route::patch('/admin/shop/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'ShoperController@update']);
Route::delete('admin/deleteshop/deletejson/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'ShoperController@destroy']);




Route::get('/admin/addshopimg/{shopid?}',  ['middleware' => ['cors'] ,'uses' =>'AdminController@index']);

Route::get('/admin/shopimg/{shopid?}',  ['middleware' => ['cors'] ,'uses' =>'AdminController@index']);
Route::get('/admin/shopimg/edit/{id}',  ['middleware' => ['cors','userajax']  ,'uses' =>'GalleryshopController@edit']);

Route::get('/admin/shoperimg/json/{shopid?}',  ['middleware' => ['cors','userajax']  ,'uses' =>'GalleryshopController@indexjson']);


Route::post('/admin/shoperimg/post', ['middleware' => ['cors','userajax'] ,'uses' => 'GalleryshopController@store']);
Route::post('/admin/shoperimg/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'GalleryshopController@update']);
Route::put('/admin/shoperimg/update/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'GalleryshopController@update']);
Route::patch('/admin/shoperimg/update/{id}', ['middleware' => ['cors','userajax'],'uses' => 'GalleryshopController@update']);
Route::delete('admin/deleteshopimg/deletejson/{id}', ['middleware' => ['cors','userajax'] ,'uses' => 'GalleryshopController@destroy']);





Route::get('/admin/*', 'AdminController@index');
Route::get('/admin/{any}', 'AdminController@index');

});