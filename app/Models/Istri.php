<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Istri extends Model
{
    protected $guarded = ['id'];

    use HasFactory;
    public function wedding()
    {
        return $this->hasOne(Wedding::class, 'id_istris');
    }
}
