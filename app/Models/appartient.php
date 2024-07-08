<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class appartient extends Model
{
    use HasFactory;

    protected $table = 'appartients';
    protected $primaryKey = 'id_appar';
    public $incrementing = true; 
    protected $keyType = 'integer'; 
      // Désactiver les timestamps automatiques
      public $timestamps = false;

      protected $fillable = ['id_appar','Date_op','id_niv','id_nin','id_p'];

      public function niveau()
      {
          return $this-> belongsTo(Niveau::class,'id_niv','id_niv');
      }

      public function employe()
      {
        return $this->belongsTo(Employe::class,['id_nin','id_p'],['id_nin','id_p']);
      }

     


}