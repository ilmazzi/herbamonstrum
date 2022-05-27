<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prenotazione extends Model
{
    use HasFactory;
    protected $table = 'prenotazioni';
    protected $primaryKey = 'idPrenotazione';

    public function tavoli() {

        return $this->hasMany(PrenotazioneTavolo::class, 'prenotazione_id' , 'idPrenotazione');

    }
}
