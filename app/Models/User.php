<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
       // 'email',
        'password',
        //'email_verified_at',
        'created_at',
        'updated_at',
        //'is_verified',
        //'activation_code',
        //'activation_token',
        'id_nin',
        'id_p',
        'password_changed_at',
        'password_created_at',
         'nv_password' ,
         'nbr_login'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
           // 'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function login()
    {
        return $this->hasMany(Login::class, 'id','id');
    }

    public function log()
    {
        return $this->hasMany(Log::class,'id','id');
    }
}
