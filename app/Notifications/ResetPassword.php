<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('这是一封密码充值文件，如果是您本人的操作，请点击以下按钮继续：')
                    ->action('重置密码', url(config('app.url').route('password.reset',$this->token,false)))
                    ->line('如果您没有执行此操作，可以忽略此邮件');
    }

}
