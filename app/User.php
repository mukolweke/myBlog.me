<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $fullName, $email_name;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function post(){
        return $this->hasMany('App\Post');
    }

    public function setTitleAttribute($value){
        $this->attributes['name'] = strtoupper($value);
    }

    public function setUserFullName($full_name){

    $this->fullName = $full_name;

    }

    public function getUserFullName(){

        return $this->fullName;

    }

    public function setUserEmailAddress($email_name){

        $this->email_name= $email_name;

    }

    public function getUserEmailAddress(){

        return $this->email_name;

    }

    public function getUserArrayVariables(){
        return [
            'full_name' => $this->getUserFullName(),
            'email'=>$this->getUserEmailAddress()
        ];
    }
}
