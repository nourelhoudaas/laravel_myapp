<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;
    protected $table = 'absences';
    protected $primaryKey = 'id_abs';
    public $incrementing = true; 
    protected $keyType = 'integer'; 
      // Désactiver les timestamps automatiques
      public $timestamps = false;

      protected $fillable = ['id_abs','date_abs','heure_abs','statut','id_nin','id_p','id_sous_depart','id_fichier'];

      public function employe()
      {
          return $this-> belongsTo(Employe::class,['id_nin','id_p'],['id_nin','id_p']);
      }

      public function sous_departement()
      {
          return $this-> belongsTo(Sous_departement::class,'id_sous_depart','id_sous_depart');
      }
      public function fichier()
      {
          return $this-> belongsTo(Sous_departement::class,'id_fichier','id_fichier');
      }


}

   