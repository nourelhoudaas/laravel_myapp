<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    use HasFactory;
    
    protected $table = 'filieres';
    protected $primaryKey = 'id_filiere';
    public $incrementing = true; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable = ['id_filiere','Nom_filiere','Nom_filiere_ar'];

   
    public function secteur()
    {
        return $this->hasMany(secteur::class, 'id_filiere','id_filiere');
    }
  
}
