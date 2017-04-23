<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;

use Tymon\JWTAuth\Facades\JWTAuth;
use Qiniu\Auth as QiniuAuth;

class QiNiuController extends BaseController
{
    //
    public function __construct()
    {
        // 执行 jwt.auth 认证
        // $this->middleware('jwt.auth');
         // 执行 jwt.auth 认证
        $this->middleware('jwt.api.auth', [
            'except' => [
                //'retrievePasswordWithSendEmail'
            ]
        ]);
    }
    public function Token(Request $request)
    {
        $bucket = "clost2015";
		$accessKey = 'ft6H9nwGVIkLhxhoBT72z5zTn5IQK8SmJsF-TMYV';
		$secretKey = 'vqn97fFGM_9dDuWhW9nZuCeSvMh7ejiQWPsDLcd4';

        // $bucket = 'fade2017';

        $auth = new QiniuAuth($accessKey, $secretKey);
		$upToken = $auth->uploadToken($bucket);
        $result = [
            'uptoken' => $upToken,
        ];
        return $this->respondWithSuccess($result, '七牛token返回成功');
    }
}
