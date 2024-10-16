<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model

{
    use HasFactory;

    // Define the table associated with this model
    protected $table = 'inventory';

    // Specify the fields that are mass assignable
    protected $fillable = [
        'name',
        'description',
        'price',
    ];
}