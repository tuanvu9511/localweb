<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hang extends Model
{
    use HasFactory;
    protected $table="hang";
    public $timestamp=true;
    protected $primaryKey = "id";
}
