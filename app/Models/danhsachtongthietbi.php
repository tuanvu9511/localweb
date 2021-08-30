<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class danhsachtongthietbi extends Model
{
    use HasFactory;
    protected $table='danhsachtongthietbi';
    protected $primaryKey = "id";
    public $timestamp = true;
}
