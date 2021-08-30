<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thietbicongty extends Model
{
    use HasFactory;
    protected $table="thietbicongty";
    protected $primaryKey ="id";
    public $timestamp = true;
}
