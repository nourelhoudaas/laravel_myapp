<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Stocke;
class fichier extends Model
{
    use HasFactory;
    protected $table = 'fichier';
    protected $primaryKey = 'id_fichier';
    public $incrementing = true; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable=['id_fichier',	'nom_fichier',	'hash_fichier','taille_fichier','date_cree_fichier'];

    public function stocke()
    {
        return $this->hasMany(Stocke::class,'id_fichier','id_fichier');
    }
}
