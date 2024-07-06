<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    use HasFactory;

    protected $fillable = ['store_id', 'reservation_date', 'reservation_time', 'people'];

    public function store(){
        return $this->belongsTo(Store::class);
    }
}
