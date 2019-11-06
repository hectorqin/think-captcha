# think-captcha

验证码类库 For ThinkPHP5.1 和 ThinkPHP6.0 基于[top-think/think-captcha](https://github.com/top-think/think-captcha) 修改而来

## 安装

```bash
composer require hectorqin/think-captcha
```

## 配置

修改 config/captcha.php 配置文件，支持多个验证码配置，也支持实例化时传入配置进行覆盖（优先级最高）

## 使用

### 模板里输出验证码

```html
<div>{:captcha_img()}</div>
```

或者

```html
<div><img src="{:captcha_src()}" alt="captcha" /></div>
```

> 上面两种的最终效果是一样的

### 接口输出验证码

```php
class CaptchaController
{
    public function index($id = "", $configName = "")
    {
        $captcha = new Captcha(); // 可传入数组配置进行覆盖<优先级最高>
        return $captcha->entry($id, $configName); // 可选择配置模式
    }
}
```

### 控制器里验证

使用TP5的内置验证功能即可

```php
$this->validate($data,[
    'captcha|验证码'=>'require|captcha'
]);
```

或者手动验证

```php
if(!captcha_check($captcha)){
 //验证失败
};
```
