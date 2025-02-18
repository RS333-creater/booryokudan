<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'user_id'; // 主キーをuser_idに変更

    protected $fillable = [
        'email',
        'password',
        'passport',
        'birth_day',
        'tel',
    ];

    protected $hidden = [
        'password'
    ];

    public function getAuthIdentifierName()
    {
        return 'email'; // 認証に使用するフィールドを指定
    }
}
