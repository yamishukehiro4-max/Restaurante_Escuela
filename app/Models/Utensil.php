<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utensil extends Model
{
    protected $fillable = ['name', 'category', 'quantity_total', 'quantity_available', 'quantity_damaged', 'unit_measure'];
}