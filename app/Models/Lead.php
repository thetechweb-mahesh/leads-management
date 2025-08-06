<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;
    protected $fillable = [
    'name',
    'email',
    'phone',
    'lead_source',
    'status',
    'assigned_to',
    'remarks',
];


    public function user(){
        return $this->belongsTo(User::class,'assigned_to');
    }
}
