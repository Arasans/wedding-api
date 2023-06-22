<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wedding extends Model
{
    protected $guarded = ['id'];

    use HasFactory;
    public function suamiR()
    {
        return $this->belongsTo(Suami::class, 'id_suamis');
    }

    public function istriR()
    {
        return $this->belongsTo(Istri::class, 'id_istris');
    }
}
