<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travail extends Model
{
    use HasFactory;
    protected $table = 'travails';
    protected $primaryKey = 'id_post';
    public $incrementing = true; 
    protected $keyType = 'integer';
    protected $fillable=['id_travail'	,'date_chang',	'date_installation','notation'	,'id_nin',	'id_sous_depart',	'id_p'	,'id_bureau'];

}
