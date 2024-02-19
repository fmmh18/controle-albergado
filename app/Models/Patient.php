<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'year',
        'origin',
    ];


    public function cards()
    {
        return $this->hasMany(Card::class, 'patient_id', 'id');
    }
}
