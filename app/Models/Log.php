<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $table = 'logs';
    protected $primaryKey = 'id_log';
    public $incrementing = true; 
    protected $keyType = 'integer'; 
    public $timestamps = false;
    
    protected $fillablel=['id_log'	,'action'	,'id_nin',	'id','date_action'
];
  
    public function employe()
    {
        return $this->belongsTo(Employe::class, 'id_nin','id_nin');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id','id');
    }
}
