<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrenotazioneTavolo extends Model
{
    use HasFactory;

    protected $table = 'prenotazione_tavolo';
    protected $primaryKey = 'prenotazione_id';
    protected $fillable = [
        'prenotazione_id', 'tavolo', 'postiOccupati', 'sala', 'nomeTavolo', 'postiRimanenti', 'dataPrenotazione', 'oraInizio', 'oraFine'
    ];

    public function prenotazione()
    {
        return $this->belongsTo(Prenotazione::class);
    }
}
