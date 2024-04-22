<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class check extends Model
{
    use HasFactory;
    public function cofre()
    {
        return $this->belongsTo(Cofre::class);
    }
}
