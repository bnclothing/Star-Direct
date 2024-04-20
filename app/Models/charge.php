<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class charge extends Model
{
    use HasFactory;
    public function magazine()
    {
        return $this->belongsTo(Magazine::class);
    }
    public function charges()
    {
        return $this->hasMany(Charge::class, 'id_magazine', 'id');
    }
}
