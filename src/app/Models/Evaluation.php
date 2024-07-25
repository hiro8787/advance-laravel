<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;
    protected $fillable = ['date_id', 'review', 'comment'];

    public function dates(){
        return $this->belongsTo(Date::class);
    }

}

