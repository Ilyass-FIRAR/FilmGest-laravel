<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $fillable =['title','description','poster'];

    public function genre(){
        return $this->hasMany(Film::class);
    }
    public function actors(){
        return $this->belongsTo(Film::class);
    }
}
