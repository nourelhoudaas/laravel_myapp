<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stocke extends Model
{
    use HasFactory;
    protected $table = 'stocke';
    protected $primaryKey = 'id_stocke';
    public $incrementing = true; 
    protected $keyType = 'integer';
    public $timestamps = false;
    
    protected $fillable=['id_stocke','date_insertion','ref_Dossier','sous_d','id_fichier','id','mac'];
    public function dossier()
    {
        return $this->belongsTo(Post::class,'ref_Dossier','ref_Dossier');
    }
    public function users()
    {
        return $this->belongsTo(Post::class,'id','id');
    }
    public function fichier()
    {
        return $this->belongsTo(Post::class,'id_fichier','id_fichier');
    }

}
