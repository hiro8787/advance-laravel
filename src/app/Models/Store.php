<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Store extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'store_name',
        'image',
        'location',
        'category',
        'explanation',
    ];

    public function likes(){
        return $this->hasMany(Like::class, 'store_id');
    }

    public function dates(){
        return $this->hasMany('App\Models\Date');
    }

    public function posts(){
        return $this->hasMany('App\Models\Post');
    }
}
