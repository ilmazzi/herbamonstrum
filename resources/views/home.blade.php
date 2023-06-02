
@extends('layouts.master');


@section('content')
<div id="intro">
    <div class="container ">

        <div class="card text-center">
            <div class="card-header">
                Statistiche
            </div>
            <div class="card-body ">
                <h5 class="card-title">Prenotazioni ultima settimana</h5>
            <div class="row">
                <div class="ct-chart mb-3"></div>
                <h5 >Prenotazioni della giornata</h5>
                <div class="ct-chart mb-3 " id="chart2"></div>
            </div>
            </div>
            <div class="card-footer">
                <a role="button" class="btn btn-warning" href="/nuovaPrenotazione">Prenota</a>
                <a role="button" class="btn btn-light" href="/prenotazioni" id="prenotazioni">Visualizza Prenotazioni</a>
            </div>
        </div>

    </div>

@endsection 