<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travail extends Model
{
    use HasFactory;

    protected $table = 'travails';
    protected $primaryKey = 'id_travail';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = false;

    protected $fillable = [
        'id_travail', 'date_chang', 'date_installation', 'notation', 'id_nin', 'id_sous_depart', 'id_p', 'id_bureau'
    ];

    public function employe()
    {
        return $this->belongsTo(Employe::class, 'id_nin', 'id_nin');
    }

    public function sous_departement()
    {
        return $this->belongsTo(Sous_departement::class, 'id_sous_depart', 'id_sous_depart');
    }

    public function bureau()
    {
        return $this->belongsTo(Bureau::class, 'id_bureau', 'id_bureau');
    }
}