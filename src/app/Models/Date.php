<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    use HasFactory;
/*
    public function date() {
        $time = [];
        $count = 30 / $this->reservation_time;
        for($i = 0 ; $i < $count ; $i++) {
            $time[] = $this->reservation_time * $i;
        }
        return $time;
    }
*/
    public function store(){
        return $this->belongsTo(Store::class);
    }
}
