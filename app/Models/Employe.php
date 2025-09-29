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
        'id_emp', 'id_nin', 'id_p', 'NSS', 'Nom_emp', 'Prenom_emp', 'Nom_ar_emp', 'Prenom_ar_emp', 'Date_nais',
        'Lieu_nais', 'Lieu_nais_ar', 'adress', 'adress_ar', 'sexe', 'email', 'Phone_num',
        'prenom_pere', 'prenom_mere', 'nom_mere', 'prenom_pere_ar', 'prenom_mere_ar',
        'nom_mere_ar', 'Date_nais_pere', 'Date_nais_mere', 'situation_familliale', 'situation_familliale_ar',
        'nbr_enfants', 'email_pro','id_fichier'
    ];

    public function travail()
    {
        return $this->hasMany(Travail::class, 'id_nin', 'id_nin');
    }

    public function occupe()
    {
        return $this->hasMany(Occupe::class, ['id_nin','id_p'], ['id_nin','id_p']);
        
    }
    /*public function occupeIdNin()
    {
        return $this->hasMany(Occupe::class, 'id_nin', 'id_nin');
    }*/
    
    public function occupeIdP()
    {
        return $this->hasMany(Occupe::class, 'id_p', 'id_p');
    }

    public function occupeIdNin()
    {
        return $this->hasMany(Occupe::class, 'id_nin', 'id_nin');
    }


    public function congeIdNin()
    {
        return $this->hasMany(Conge::class, 'id_nin', 'id_nin');
    }
    
    public function congeIdP()
    {
        return $this->hasMany(Conge::class, 'id_p', 'id_p');
    }

    public function LogIdnin()
    {
        return $this->hasMany(Log::class, 'id_nin', 'id_nin');
    }

    //par categorie
    // Relation avec la table occupes


    // Relation avec la table travails (si besoin)
    public function travailByNin()
    {
        return $this->hasMany(Travail::class, 'id_nin', 'id_nin');
    }

    // Relation avec les fonctions via Contient
    public function fonctions()
    {
        return $this->belongsToMany(Fonction::class, 'contients', 'id_post', 'id_fonction');
    }

    // Relation avec postSups via Contient
    public function postSups()
    {
        return $this->belongsToMany(PostSup::class, 'contients', 'id_post', 'id_postsup');
    }

    // Relation avec les postes via Occupe
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'occupes', ['id_p', 'id_nin'], ['id_post']);
    }

    // Relation avec les employeurs via Occupe
    public function employers()
    {
        return $this->belongsToMany(Employe::class, 'occupes', 'id_post', ['id_p', 'id_nin']);
    }
        public function fichier()
    {
        return $this->belongsTo(Fichier::class,'id_fichier','id_fichier');
    }
}
