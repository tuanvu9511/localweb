<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class danhsachyeucau extends Model
{
    use HasFactory;
    protected $table = "danhsachyeucau";
    public $timestamp = true;
    protected $primaryKey = "id_yeucau";
}
