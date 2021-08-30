<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thongbaoloi extends Model
{
    use HasFactory;
    protected $table="thongbaoloi";
    protected $primaryKey='id';
    public $timestamp = true;
}
