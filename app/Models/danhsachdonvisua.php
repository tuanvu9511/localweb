<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class danhsachdonvisua extends Model
{
    use HasFactory;
    protected $table="danhsachdonvisua";
    protected $primaryKey = "id";
    public $timestamp = true;
}
