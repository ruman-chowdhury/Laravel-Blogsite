<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //========relationship
    public function user(){
        return $this->hasOne(User::class);
    }


}
