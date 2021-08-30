<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class danhsachthietbisua extends Model
{
    use HasFactory;
    protected $table="danhsachthietbisua";
    protected $primaryKey = "id";
    public $timestamp=true;
}
