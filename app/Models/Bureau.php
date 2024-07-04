<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bureau extends Model
{
    use HasFactory;
    protected $table = 'bureaus';
    protected $primaryKey = 'id_bureau';
    public $incrementing = true; 
    protected $keyType = 'integer'; 
    public $timestamps = false;
    protected $fillabel=['id_bureau','Num_bureau'];
}
