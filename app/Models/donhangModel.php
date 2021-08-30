<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class donhangModel extends Model
{
    use HasFactory;
    protected $table="donhang";
    protected $primaryKey="id_donhang";
    public $timestamp=true;
}
