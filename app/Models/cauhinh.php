<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cauhinh extends Model
{
    use HasFactory;
    protected $table="cauhinh";
    public $timestamp= true;
    protected $primaryKey = "id";
}
