<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class especes extends Model
{
    use HasFactory;
    public function especes()
    {
        return $this->belongsTo(especes::class);
    }

    
}
