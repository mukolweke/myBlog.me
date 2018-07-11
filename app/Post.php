<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    // Table name
    protected $table = 'posts';

    // Primary key
    public $primaryKey = 'id';

    // Timestamps
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }

    // mutator
    public function setTitleAttribute($value){
        $this->attributes['title'] = ucwords($value);
    }

    // query scope;deleted blogs
    public function scopeArchived($query){

        return $query->onlyTrashed()->orderBy('deleted_at','desc');

    }

}
