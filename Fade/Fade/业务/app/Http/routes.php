<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/hello1',function(){
    return "Hello Laravel[GET]!";
});
// POST请求
Route::get('/testPost',function(){
    $csrf_token = csrf_token(); 
    $form = <<<FORM
        <form action="/hello" method="POST">
            <input  name="_token" value="{$csrf_token}">
            <input type="submit" value="Test"/>
        </form>
FORM;
    return $form;
});

Route::post('/hello',function(){
    return "Hello Laravel[POST]!";
});

//post  get 其他形式
Route::match(['get','post'],'/hello',function(){
   return "Hello Laravel!-----";
});
Route::any('/hello/{name}',function($name)
	{
        
		 return "Hello Laravel!-----{$name}";
	});

//多个参数
Route::get('/hello/{name}/by/{user}',function($name,$user){
    return "Hello {$name} by {$user}!";
});

//可选参数&&正则
Route::get('/hello6/{name?}',function($name){
    return "Hello {$name} by ";
})->where('name','[A-Za-z]+');


//路由重命名
Route::get('/hello/laravelacademy',['as'=>'academy',function(){
    return 'Hello LaravelAcademy！';
}]);

Route::get('/testNamedRoute',function(){

	return route('academy');
    //return redirect()->route('academy');
});

//路由分组
Route::group(['as' => 'admin-'], function () {
    Route::get('dashboard', ['as' => 'dashboard', function () {
        //
        return "路由分组";
    }]);
});

Route::get('/testNamedRoute',function(){
    //return route('admin::dashboard');
    return redirect()->route('admin-dashboard');
});

//中间件分组
Route::group(['middleware'=>'test'],function(){
    Route::get('/write/laravelacademy',function(){
        //使用Test中间件
    });
    Route::get('/update/laravelacademy',function(){
       //使用Test中间件
    });
});

Route::get('/age/refuse',['as'=>'refuse',function(){
    return "未成年人禁止入内！";
}]);

//RESTFul
Route::resource('post','PostController');
//Request
Route::controller('request','RequestController');


//dingo Api
// 接管路由
$api = app('Dingo\Api\Routing\Router');
// add in header    Accept:application/vnd.lumen.v2+json
$api->version('v1', ['namespace' => 'App\Http\Controllers\Api'], function ($api) {
$api->get('register.api', 'AuthenticateController@getRister');

$api->group(['prefix' => 'auth'], function ($api) {

        // 发送验证码
        $api->post('sendCode.api', 'AuthenticateController@sendCkeckCode');

        // 注册
         $api->post('register.api', 'AuthenticateController@register');

        // 登录
        $api->post('login.api', 'AuthenticateController@login');

        // 修改密码
        $api->post('modifyUserPassword.api', 'AuthenticateController@modifyUserPassword');

        // 发送重置密码邮件
        $api->post('retrievePasswordWithSendEmail.api', 'AuthenticateController@retrievePasswordWithSendEmail');
    });

});

