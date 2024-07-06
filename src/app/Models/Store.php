<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    public function scopeSearch(){
        
    }

    public function likes(){
        return $this->hasMany(Like::class, 'store_id');
    }
    public function dates(){
        return $this->hasMany('App\Models\Date');
    }
}
