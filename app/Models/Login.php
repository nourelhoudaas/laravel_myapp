<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;
    protected $table = 'logins';
    protected $primaryKey = 'id_log';
    public $incrementing = true; 
    protected $keyType = 'integer'; 
      // Désactiver les timestamps automatiques
      public $timestamps = false;


    protected $fillable = [
        'id_log', 'date_login', 'date_logout', 'id_nin', 'id_p','id',
    ];

    public function employe()
    {
        return $this->belongsTo(Employe::class, ['id_nin','id_p'], ['id_nin','id_p']);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, ['id','id'], ['id','id']);
    }

}


