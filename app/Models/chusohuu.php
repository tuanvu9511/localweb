<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chusohuu extends Model
{
    use HasFactory;
    protected $table = 'chusohuu';
    protected $primaryKey = "id";
    public $timestamp = true;
}
