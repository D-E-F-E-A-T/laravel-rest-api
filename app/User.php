<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

/**
 * @method has(string $string)
 */
class User extends Authenticatable
{
    protected $table='users';
    use Notifiable;
    const VERIFIED_USER='1';
    const UNVERIFIED_USER='0';
    const ADMIN_USER ='true';
    const REGULAR_USER = "false";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','verified','verification_token','admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','verification_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function isVerified(){
        return $this->verified===User::VERIFIED_USER;
    }
    public function isAdmin(){
        return $this->admin===User::ADMIN_USER;
    }
    public  static  function  generateVerificationCode(){
        return Str::random(40);
    }

    /**
     * Mutator for setting name
     * @param $name
     */
    public function setNameAttribute($name){
        $this->attributes['name']=strtolower($name);
    }

    /**
     * Accessor for retriving name
     * @param $name
     * @return string
     */
    public function getNameAttribute($name){
        return ucwords($name);
    }

    /**
     * Mutator for setting name
     * @param $email
     */
    public function setEmailAttribute($email){
        $this->attributes['email']=strtolower($email);
    }
}
