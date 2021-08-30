<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data_company extends Model
{
    use HasFactory;
    protected $table = 'data_company';
    public $timestamp = "true";
    protected $primaryKey = 'makhachhang';

}
