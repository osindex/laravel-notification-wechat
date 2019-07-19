<?php

namespace Yansongda\LaravelNotificationWechat;

use Illuminate\Support\ServiceProvider;
use Yansongda\LaravelNotificationWechat\Credentials\DefaultCredential;
use Yansongda\LaravelNotificationWechat\Credentials\EasyWechatCredential;

class WechatServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->app->when(WechatChannel::class)
            ->needs(Wechat::class)
            ->give(function () {
                if (class_exists('EasyWeChat\Factory')) {
                    $credential = new EasyWechatCredential();
                } else {
                    $credential = new DefaultCredential(config('services.wechat.appid'), config('services.wechat.appsecret'));
                }

                return new Wechat($credential);
            });
    }

    /**
     * Register any package services.
     */
    public function register()
    {
    }
}
