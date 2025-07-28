<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dossier extends Model
{
    use HasFactory;
    protected $table = 'dossiers';
    protected $primaryKey = 'ref_Dossier';
   
    protected $keyType = 'string'; 
    public $timestamps = false;

    protected $fillable=['ref_Dossier',	'type'];

    public function stocke()
    {
        return $this->hasMany(Stocke::class,'ref_Dossier','ref_Dossier');
    }
}
