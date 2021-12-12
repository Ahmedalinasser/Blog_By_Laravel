<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // protected $fillable =['title','content','post_image'] ; 



    ///
    ///          we can use the guarded instad of fillable in case we 
    ///          don want to put in each single proprity 
        /**/     protected $guarded =[];   /**/  
    ///
    ///
    public function user(){
        return $this->belongsTo(User::class);
    }


    //  this to set the data befor it go to database 
    // public function setPostImageAttribute($value){
    //     $this->attributes['post_image'] = asset($value);
    // }

    public function getPostImageAttribute($value) {
        if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
            return $value;
        }
        return asset('storage/' . $value);
        }
}
