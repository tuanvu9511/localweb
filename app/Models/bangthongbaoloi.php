<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bangthongbaoloi extends Model
{
    use HasFactory;
    protected $table="bangthongbaoloi";
    protected $primaryKey = "id";
    public $timestamp=true;
}
