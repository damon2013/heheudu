<?php

namespace App\Http\Controllers\Api;

use App\Http\Model\Friend;
use App\Http\Model\Users;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;


//状态
use App\Http\Model\Vip_Status;
use App\Http\Model\Basic_status;
use App\Http\Model\Users_HopePatner;
//扩展信息
use App\Http\Model\Users_Location;
use App\Http\Model\Users_Photo;
//扩展信息 包括认证状态
use App\Http\Model\Users_Identity;
use App\Http\Model\User_Big_House;
use App\Http\Model\Users_Car;
use App\Http\Model\Users_Edu;
use App\Http\Model\Users_Job;
class UserController extends BaseController
{
    public function __construct()
    {
        // 执行 jwt.auth 认证
        $this->middleware('jwt.api.auth', [
            'except' => [
                'getOtherUserInfomation'
            ]
        ]);
    }
    //更新基础信息
public function uploadBasicInfo(Request $request)
{
     $validator = Validator::make($request->all(), [
            'user_id' => ['required', 'exists:users,id']
            //'avatar' => ['required']
        ], [
            'user_id.required' => 'user_id不能为空',
            'user_id.exists' => '用户不存在',
            //'avatar.required' => 'photo不能为空',
        ]);
    if ($validator->fails()) 
    {
            return $this->respondWithFailedValidation($validator);
    }
      Users::where('id', $request->user_id)->update($request->only(['avatar','nickname', 'birthday', 
        'fade_dec','in_province','in_city','hope_marry_date']));
        return $this->respondWithSuccess(null, '基础信息更新成功');
}
   /**
     * @api {post} /updateUserInfomation.api 更新详细用户信息
     * @apiDescription 更新用户信息
     * @apiGroup User
     * @apiPermission Token
     * @apiHeader {String} token 登录成功返回的token
     * @apiHeaderExample {json} Header-Example:
     *      {
     *          "Authorization" : "Bearer {token}"
     *      }
     * @apiParam {Number} user_id 用户id
     * @apiVersion 0.0.1
     * @apiSuccessExample {json} Success-Response:
     *       {
     *           "status": "success",
     *           "code": 200,
     *           "message": "更新用户信息成功",
     *           "data": null
     *       }
     * @apiErrorExample {json} Error-Response:
     *     {
     *           "status": "error",
     *           "code": 400,
     *           "message": "更新用户信息失败"
     *      }
     */
    public function updateUserInfomation(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'user_id' => ['required', 'exists:users,id']
        ], [
            'user_id.required' => 'user_id不能为空',
            'user_id.exists' => '用户不存在'
        ]);

        if ($validator->fails()) {
            return $this->respondWithFailedValidation($validator);
        }
        // 'nickname' => $user->nickname,
        //         'birthday'=> $user->birthday,
        //         'bconstellation'=> $user->bconstellation, 
        //         'fade_dec'=> $user->fade_dec,
        //         'avatar'=> $user->avatar, 
        //         'mobile'=> $user->mobile,
        //         'wechat_number'=> $user->wechat_number,
        //         'sex'=> $user->sex,
        //          'person_height'=> $user->person_height,
        //         'person_weight'=> $user->person_weight,
        //         'in_province'=> $user->in_province,
        //         'in_city'=> $user->in_city,
        //         'home_province'=> $user->home_province,
        //         'home_city'=> $user->home_city,
        //         'education'=> $user->education,
        //         'hope_marry_date'=> $user->hope_marry_date,
        //         'salary_min'=> $user->salary_min,
        //         'salary_max'=> $user->salary_max,
        //         'marry_state'=> $user->marry_state,
        //         'have_son'=> $user->have_son,
        //         'smoke_state'=> $user->smoke_state,
        //         'family_sort'=> $user->family_sort,
        //         'parent_state'=> $user->parent_state,
        //         'date_like'=> $user->date_like,
        Users::where('id', $request->user_id)->update($request->only(['bconstellation',
            'person_height', 'person_weight', 'home_province', 'home_city', 'education',
            'salary_min', 'salary_max', 'marry_state','have_son','smoke_state', 'family_sort', 'parent_state','date_like'
            ]));
        return $this->respondWithSuccess(null, '更新用户信息成功');

    }
 //更新微信号
 public function updateUserWeChatNumber(Request $request)
 {
     $validator = Validator::make($request->all(), [
            'user_id' => ['required', 'exists:users,id'],
            'wechat_number'=>['required']
        ], [
            'user_id.required' => 'user_id不能为空',
            'user_id.exists' => '用户不存在',
            'wechat_number.required' => '微信号不能为空',
        ]);
        if ($validator->fails()) {
            return $this->respondWithFailedValidation($validator);
        }
        Users::where('id', $request->user_id)->update($request->only(['wechat_number']));
        return $this->respondWithSuccess(null, '更新用户信息成功');
 }
 //更新工作认证 
 public function updateJobInfo(Request $request)
 {
     $validator = Validator::make($request->all(), [
            'user_id' => ['required', 'exists:users,id'],
            'job_name'=>['required'],
            'job_level_name'=>['required'],
            'job_compny_name'=>['required'],
        ], [
            'user_id.required' => 'user_id不能为空',
            'user_id.exists' => '用户不存在',
            'job_name.required' => '行业|职能不能为空',
            'job_level_name.required' => '职位不能为空',
            'job_compny_name.required' => '公司/机构不能为空',
        ]);
        if ($validator->fails()) {
            return $this->respondWithFailedValidation($validator);
        }
        $input = [
        'auth_job_name'=>$request->job_name,
        'auth_job_level_name'=>$request->job_level_name,
        'auth_job_compny_name'=>$request->job_compny_name,

        ];
        Users_Job::where('user_id', $request->user_id)->update($input);
        return $this->respondWithSuccess(null, '更新用户信息成功');
 }
 // //更新工作认证 auth_job_state  0 未审核 1审核中 2审核通过
 public function authJobInfo(Request $request)
 {
     $validator = Validator::make($request->all(), [
            'user_id' => ['required', 'exists:users,id'],
            'job_url'=>['required'],
        ], [
            'user_id.required' => 'user_id不能为空',
            'user_id.exists' => '用户不存在',
            'job_url.required' => '没传职业认证图片啦'
            
        ]);
        if ($validator->fails()) {
            return $this->respondWithFailedValidation($validator);
        }
       
       $input = [
        'auth_job_img_url'=>$request->job_url,
        'auth_job_state'=>1];

        Users_Job::where('user_id', $request->user_id)->update($input);
        return $this->respondWithSuccess(null, '更新用户信息成功');
 }
 
    /**
     * @api {post} /uploadUserAvatar.api 上传用户头像
     * @apiDescription 上传用户头像
     * @apiGroup User
     * @apiPermission Token
     * @apiHeader {String} token 登录成功返回的token
     * @apiHeaderExample {json} Header-Example:
     *      {
     *          "Authorization" : "Bearer {token}"
     *      }
     * @apiParam {Number} user_id 用户id
     * @apiParam {String} photo base64编码的图片
     * @apiVersion 0.0.1
     * @apiSuccessExample {json} Success-Response:
     *       {
     *           "status": "success",
     *           "code": 200,
     *           "message": "上传头像成功",
     *           "data": null
     *       }
     * @apiErrorExample {json} Error-Response:
     *     {
     *           "status": "error",
     *           "code": 400,
     *           "message": "上传头像失败"
     *      }
     */
    public function uploadUserAvatar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => ['required', 'exists:users,id'],
            'photo' => ['required']
        ], [
            'user_id.required' => 'user_id不能为空',
            'user_id.exists' => '用户不存在',
            'photo.required' => 'photo不能为空',
        ]);
        if ($validator->fails()) {
            return $this->respondWithFailedValidation($validator);
        }

        // 获取图片
        $image = Image::make($request->photo)->resize(150, 150);
        $fileName = md5(uniqid(microtime(true), true)) . '.jpg';

        // 根据日期创建目录 uploads/user/avatar/
        $directory = 'uploads/user/avatar/';
        if (!file_exists($directory)) {
            if (!(mkdir($directory, 0777, true) && chmod($directory, 0777))) {
                return $this->respondWithErrors('无权限创建路径,请设置public下的uploads目录权限为777', 500);
            }
        }

        // 保存图片
        $avatarPath = $directory . $fileName;
        $image->save($avatarPath);

        // 修改保存的图片权限
        @chmod($avatarPath, 0777);

        // 更新记录
        $user = User::find($request->user_id);
        if ($user->avatar != 'uploads/user/default/avatar.jpg') {
            @unlink($user->avatar);
        }
        $user->avatar = $avatarPath;
        $user->save();

        return $this->respondWithSuccess(null, '上传头像成功');
    }

    /**
     * @api {get} /getUserInfomation.api 自己用户信息
     * @apiDescription 获取自己的用户信息
     * @apiGroup User
     * @apiPermission Token
     * @apiHeader {String} token 登录成功返回的token
     * @apiHeaderExample {json} Header-Example:
     *      {
     *          "Authorization" : "Bearer {token}"
     *      }
     * @apiParam {Number} user_id 用户id
     * @apiVersion 0.0.1
     * @apiSuccessExample {json} Success-Response:
     *       {
     *           "status": "success",
     *           "code": 200,
     *           "message": "获取用户信息成功",
     *           "result": {
     *               "id": 10000,
     *               "nickname": "管理员",
     *               "say": "Hello world!",
     *               "avatar": "http://www.english.com/uploads/user/avatar/9f4ed11179f6962bd57cf9635474446b.jpg",
     *               "mobile": "15626427299",
     *               "email": "admin@6ag.cn",
     *               "sex": 1,
     *               "qqBinding": 0,
     *               "weixinBinding": 0,
     *               "weiboBinding": 0,
     *               "emailBinding": 1,
     *               "mobileBinding": 1,
     *               "followersCount": 32,
     *               "followingCount": 2,
     *               "registerTime": "1471437181",
     *               "lastLoginTime": "1471715751"
     *           }
     *       }
     * @apiErrorExample {json} Error-Response:
     *     {
     *           "status": "error",
     *           "code": 400,
     *           "message": "获取用户信息失败"
     *      }
     */
    public function getSelfUserInfomation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => ['required', 'exists:users,id'],
        ], [
            'user_id.required' => 'user_id不能为空',
            'user_id.exists' => '用户不存在',
        ]);
        if ($validator->fails()) {
            return $this->respondWithFailedValidation($validator);
        }

        // 查询用户表
        $user = User::find($request->user_id);
        if ($user->status == 0) {
            return $this->respondWithErrors('用户已被禁用', 403);
        }

        return $this->respondWithSuccess([
            'id' => $user->id,
            'nickname' => $user->nickname,
            'say' => $user->say,
            'avatar' => url($user->avatar),
            'mobile' => $user->mobile,
            'email' => $user->email,
            'sex' => $user->sex,
            'adDsabled' => $user->ad_disabled,
            'qqBinding' => $user->qq_binding,
            'weixinBinding' => $user->weixin_binding,
            'weiboBinding' => $user->weibo_binding,
            'emailBinding' => $user->email_binding,
            'mobileBinding' => $user->mobile_binding,
            'followersCount' => Friend::where('user_id', $request->user_id)->where('relation', 0)->count(),
            'followingCount' => Friend::where('user_id', $request->user_id)->where('relation', 1)->count(),
            'registerTime' => (string)$user->created_at->timestamp,
            'lastLoginTime' => (string)$user->updated_at->timestamp,
        ], '获取用户信息成功');

    }

    /**
     * @api {get} /getOtherUserInfomation.api 他人用户信息
     * @apiDescription 获取他人的用户信息
     * @apiGroup User
     * @apiPermission none
     * @apiParam {Number} user_id 当前登录的用户id
     * @apiParam {Number} other_user_id 需要用户信息的用户id
     * @apiVersion 0.0.1
     * @apiSuccessExample {json} Success-Response:
     *       {
     *           "status": "success",
     *           "code": 200,
     *           "message": "获取用户信息成功",
     *           "result": {
     *               "id": 10000,
     *               "nickname": "管理员",
     *               "say": "Hello world!",
     *               "avatar": "http://www.english.com/uploads/user/avatar/9f4ed11179f6962bd57cf9635474446b.jpg",
     *               "sex": 1,
     *               "followersCount": 32,
     *               "followingCount": 2,
     *               "registerTime": "1471437181",
     *               "lastLoginTime": "1471715751"
     *           }
     *       }
     * @apiErrorExample {json} Error-Response:
     *     {
     *           "status": "error",
     *           "code": 400,
     *           "message": "获取用户信息失败"
     *      }
     */
    public function getOtherUserInfomation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'other_user_id' => ['required', 'exists:users,id'],
            'user_id' => ['required', 'exists:users,id']
        ], [
            'other_user_id.required' => 'other_user_id不能为空',
            'other_user_id.exists' => '用户不存在',
            'user_id.required' => 'user_id不能为空',
            'user_id.exists' => '用户不存在',
        ]);
        if ($validator->fails()) {
            return $this->respondWithFailedValidation($validator);
        }

        // 查询用户表
        $user = User::find($request->other_user_id);
        if ($user->status == 0) {
            return $this->respondWithErrors('用户已被禁用', 403);
        }

        // 查找当前用户是否已经关注了目标用户
        $friend = Friend::where('user_id', $request->user_id)->where('relation', 1)->where('relation_user_id', $request->other_user_id)->first();
        $followed = $request->user_id == $request->other_user_id ? 1 : (isset($friend) ? 1 : 0);

        return $this->respondWithSuccess([
            'id' => $user->id,
            'nickname' => $user->nickname,
            'say' => $user->say,
            'avatar' => url($user->avatar),
            'sex' => $user->sex,
            'followersCount' => Friend::where('user_id', $request->other_user_id)->where('relation', 0)->count(),
            'followingCount' => Friend::where('user_id', $request->other_user_id)->where('relation', 1)->count(),
            'followed' => $followed,
            'registerTime' => (string)$user->created_at->timestamp,
            'lastLoginTime' => (string)$user->updated_at->timestamp,
        ], '获取用户信息成功');

    }

 
    /**
     * @api {post} /buyDislodgeDdvertisement.api 购买去除广告
     * @apiDescription  购买去除广告
     * @apiGroup User
     * @apiPermission Token
     * @apiHeader {String} token 登录成功返回的token
     * @apiHeaderExample {json} Header-Example:
     *      {
     *          "Authorization" : "Bearer {token}"
     *      }
     * @apiParam {Number} user_id 用户id
     * @apiVersion 0.0.1
     * @apiSuccessExample {json} Success-Response:
     *       {
     *           "status": "success",
     *           "code": 200,
     *           "message": "购买去除广告成功",
     *           "data": null
     *       }
     * @apiErrorExample {json} Error-Response:
     *     {
     *           "status": "error",
     *           "code": 400,
     *           "message": "购买去除广告失败"
     *      }
     */
    public function buyDislodgeDdvertisement(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => ['required', 'exists:users,id'],
        ], [
            'user_id.required' => 'user_id不能为空',
        ]);
        if ($validator->fails()) {
            return $this->respondWithFailedValidation($validator);
        }

        $user = User::find($request->user_id);

        if (isset($user)) {
            $user->ad_disabled = 1;
            $user->save();
            return $this->respondWithSuccess(null, '禁用广告成功');
        } else {
            return $this->respondWithErrors('购买失败');
        }
    }
}
