<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    protected $table = 'employes';
    protected $primaryKey = 'id_emp';
    public $incrementing = true; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable = [
       'id_emp','id_nin','id_p','Nom_emp','Prenom_emp','Nom_ar_emp','Prenom_ar_emp','Date_nais',
       'Lieu_nais','Lieu_nais_ar','adress','adress_ar','sexe','email','Phone_num',
    ];

    public function logins()
    {
        return $this->hasMany(Login::class, ['id_nin','id_p'], ['id_nin','id_p']);
    }
    public function travails()
    {
        return $this->hasMany(Travail::class, ['id_nin','id_p'], ['id_nin','id_p']);
    }
   /* public function occupes()
    {
        return $this->hasMany(Occupe::class, ['id_nin','id_p'], ['id_nin','id_p']);
        
    }*/
    public function occupeIdNin()
    {
        return $this->hasMany(Occupe::class, 'id_nin', 'id_nin');
    }
    
    public function occupeIdP()
    {
        return $this->hasMany(Occupe::class, 'id_p', 'id_p');
    }
}
