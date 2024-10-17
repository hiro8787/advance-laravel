<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['store_id', 'user_id', 'post', 'description', 'image'];

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function stores(){
        return $this->belongsTo(Store::class);
    }
}
