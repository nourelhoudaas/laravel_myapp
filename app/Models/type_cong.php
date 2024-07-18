<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class type_cong extends Model
{
    use HasFactory;
    protected $table = 'type_congs';
    protected $primaryKey = 'ref_cong';
    public $incrementing = true; 
    protected $keyType = 'integer'; 
      // Désactiver les timestamps automatiques
      public $timestamps = false;


    protected $fillable = [
        'ref_cong', 'titre_cong', 'Descriptif', 'titre_cong_ar', 'Descriptif_ar'
    ];

    public function conge()
    {
        return $this->hasMany(Conge::class, 'ref_cong','ref_cong');
    }
   
  
}
