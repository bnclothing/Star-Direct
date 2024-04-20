<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magazine extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_magazine',
        'magazine_name',
        'magazine_adresse',
        'magazine_type',
        'responsable_id',
        'id_primary_magazine'
    ];
    public function charges()
    {
        return $this->hasMany(Charge::class, 'id_magazine', 'id');
    }
}
