<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Explorer extends Model
{
    use HasFactory;

    public function childs() {

        return $this->hasMany('App\Models\Explorer','parent_id','id') ;

    }
}
