<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conge extends Model
{
    use HasFactory;
    protected $table = 'conges';
    protected $primaryKey = 'id_cong';
    public $incrementing = true; 
    protected $keyType = 'integer'; 
      // Désactiver les timestamps automatiques
      public $timestamps = false;


    
    protected $fillable = [
        'id_cong', 'date_debut_cong', 'date_fin_cong', 'ref_cong', 'id_nin','id_p'
    ];

    public function type_conge()
    {
        return $this->belongsTo(Type_cong::class, 'ref_cong','ref_cong');
    }

    public function employe()
    {
        return $this->belongsTo(Employe::class, ['id_nin','id_p'],['id_nin','id_p']);
    }

}
