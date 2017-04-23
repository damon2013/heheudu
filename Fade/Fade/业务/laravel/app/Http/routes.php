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


//dingo Api
// 接管路由
$api = app('Dingo\Api\Routing\Router');
// add in header    Accept:application/vnd.lumen.v2+json
$api->version('v1', ['namespace' => 'App\Http\Controllers\Api'], function ($api) {

$api->group(['prefix' => 'auth'], function ($api) {

        // 发送验证码
        $api->post('sendCode.api', 'AuthenticateController@sendCheckCode');

        // 注册
         $api->post('register.api', 'AuthenticateController@register');

        // 登录
        $api->post('login.api', 'AuthenticateController@login');

        // 修改密码
        $api->post('modifyUserPassword.api', 'AuthenticateController@modifyUserPassword');

        // 发送重置密码邮件
        $api->post('retrievePasswordWithSendEmail.api', 'AuthenticateController@retrievePasswordWithSendEmail');
    });
   // 更新用户信息
 
  //更新基础信息
  $api->post('uploadBasicInfo.api', 'UserController@uploadBasicInfo');
   //更新详细信息
  $api->post('updateUserInfomation.api', 'UserController@updateUserInfomation');
  //更新微信号
  $api->post('updateUserWeChatNumber.api', 'UserController@updateUserWeChatNumber');
  //更新职业信息
  $api->post('updateJobInfo.api', 'UserController@updateJobInfo');
  //认证职业信息
  $api->post('authJobInfo.api', 'UserController@authJobInfo');
  
  //上传图片的token
  $api->post('getQiNiuToken.api', 'QiNiuController@Token');
 
  
  
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




//dingo Api

// $api = app('Dingo\Api\Routing\Router');
// $api->version('v1', function ($api) {
//     $api->group(['namespace' => 'App\Http\Controllers\Api'], function ($api) {
// //namespace声明路由组的命名空间，因为上面设置了"prefix"=>"api",所以以下路由都要加一个api前缀，比如请求/api/users_list才能访问到用户列表接口
//         $api->group(['middleware'=>['role:admin']], function ($api) {
//         #管理员可用接口
//             #用户列表api
//             $api->get('/users_list','AdminApiController@usersList');
//             #添加用户api
//             $api->post('/add_user','AdminApiController@addUser');
//             #编辑用户api
//             $api->post('/edit_user','AdminApiController@editUser');
//             #删除用户api
//             $api->post('/del_user','AdminApiController@delUser');
//             #上传头像api
//             $api->post('/upload_avatar','UserApiController@uploadAvatar');
            
//         });
        
//     });
// });