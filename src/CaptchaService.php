<?php
namespace Hectorqin\ThinkCaptcha;

use think\Route;
use think\Service;
use think\Validate;

class CaptchaService extends Service
{
    public function boot(Route $route)
    {
        $route->get('captcha/[:configName]', "\\Hectorqin\\ThinkCaptcha\\CaptchaController@index");
        Validate::maker(function ($validate) {
            $validate->extend('captcha', function ($value) {
                return captcha_check($value);
            }, ':attribute错误!');
        });
    }
}
