<?php
/**
 * Created by PhpStorm.
 * User: molukaka
 * Date: 11/07/2018
 * Time: 10:21
 */

namespace App\Repository\User;

use App\Post;
use App\User;

class UserRepository
{

    public function __construct(){}


    function findUser($user_id){
        return User::find($user_id)->post;
    }





}