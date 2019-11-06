<?php

/**
 * @param string $id
 * @param string  $configName
 * @return \think\Response
 */
function captcha($id = '', $configName = '')
{
    $captcha = new \Hectorqin\ThinkCaptcha\Captcha();
    return $captcha->entry($id, $configName);
}

/**
 * @param $id
 * @return string
 */
function captcha_src($id = '', $configName = '')
{
    return Url::build('/captcha' . ($configName ? "/{$configName}" : '') . ($id ? "?id={$id}" : ''));
}

/**
 * @param $id
 * @return mixed
 */
function captcha_img($id = '', $configName = '')
{
    return '<img src="' . captcha_src($id, $configName) . '" alt="captcha" />';
}

/**
 * @param        $value
 * @param string $id
 * @param array  $config
 * @return bool
 */
function captcha_check($value, $id = '')
{
    $captcha = new \Hectorqin\ThinkCaptcha\Captcha();
    return $captcha->check($value, $id);
}

// 兼容TP5
if (version_compare(\think\App::VERSION, '5.1.0', '>=') && version_compare(\think\App::VERSION, '6.0.0', '<')) {
    Route::get('captcha/[:configName]', "\\Hectorqin\\ThinkCaptcha\\CaptchaController@index");

    Validate::extend('captcha', function ($value, $id = '') {
        return captcha_check($value, $id);
    });

    Validate::setTypeMsg('captcha', ':attribute错误!');
}