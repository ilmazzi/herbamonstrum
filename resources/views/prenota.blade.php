@extends('layouts.master')
<?php
    header('Content-Type: application/json; charset=utf-8');
?>

@section('content')
<div id="intro">
<div class="container">
    <div class="card">
        <div class="card-body">
    <h3 class="text-center">CIAO  {{ Auth::user()->name }} ! MODIFICA LA PRENOTAZIONE</h3>

            <form  action="{{route('prenota.edit',$prenotazione->idPrenotazione)}}" method="post" id="formPrenota" enctype="multipart/form-data">
                {{ csrf_field() }} 
                @isset($prenotazione)
                {{ method_field('PUT') }}
                @endisset
        <div class="mb-3">
            <label for="nome" class="form-label bold">Data Prenotazione *</label>
            <input type="date" class="form-control" id="dataPrenotazione" name="dataPrenotazione"   placeholder="Inserire la data" required>
            <!--<div  class="form-text"></div>-->
        </div>
                <label for="sala" class="form-label bold">Scegli la sala per la prenotazione</label>
                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="sala" name="sala" required>
                    @isset($prenotazione)
                    <option value="0" @if( $prenotazione->sala == "0") {{ 'selected' }} @endif>Pub Pranzo</option>
                    <option value="1" @if( $prenotazione->sala == "1") {{ 'selected' }} @endif>Pub Cena</option>
                    <option value="2" @if( $prenotazione->sala == "2") {{ 'selected' }} @endif>Garden</option>
                    <option value="2" @if( $prenotazione->sala == "3") {{ 'selected' }} @endif>Cantina</option>
                    @endisset
                    @
                    @empty($prenotazione)
                    <option value="0">Pub Pranzo</option>
                    <option value="1" >Pub Cena</option>
                    <option value="2" >Garden</option>
                    <option value="2" >Cantina</option>
                    @endempty
                </select>

        <div class="mb-3">
            <label for="coperti" class="form-label bold">Persone *</label>
            <input type="number" class="form-control" id="coperti" name="coperti"  placeholder="Inserire il numero di persone al tavolo" required >
            @isset($prenotazione)
            <input type="number" hidden value="{{ $prenotazione->idPrenotazione}}" id="idPrenotazione">
            @endisset
        </div>

                <div class="mb-3">
                    <label for="oraInizio" class="form-label bold">Ora Inizio Prenotazione *</label>
                    <input type="time" class="form-control" id="oraInizio" name="oraInizio"   min="18:30" max="22:30" step="900"  placeholder="Inserire l'orario di fine prenotazione" required >

                </div>

        <div class="mb-3" >
            <label for="tavoli" class="form-label bold">Scegli tavoli *</label>
            <a role="button" for="tavoli" class="btn btn-warning" id="scegliTavoli" >Carica Disponibili </a>
            <div class="list-group" id="tavoli">
                            
            </div>
        </div>

        <div class="mb-3">
            <label for="oraFine" class="form-label bold">Ora fine Prenotazione *</label>
            <input type="time" class="form-control" id="oraFine" name="oraFine"  placeholder="Inserire l'orario di fine prenotazione" required >
            <!--<div  class="form-text"></div>-->
        </div>

    <div class="mb-3">
        <label for="nome" class="form-label bold">Nome *</label>
        <input type="text" class="form-control" id="nome" name="nomePrenotazione"  placeholder="Inserire il nome del cliente" required >
        <!--<div  class="form-text"></div>-->
    </div>


        <div class="mb-3">
            <label for="telefono" class="form-label bold">Telefono *</label>
            <input type="tel" class="form-control" id="telefono" name="telefono"  placeholder="Inserire il telefono del cliente" required >
            <!--<div  class="form-text"></div>-->
        </div>
    <div class="mb-3">
        <label for="bambini" class="form-label bold">Bambini</label>
        <input type="number" class="form-control" id="bambini" name="bambini"  placeholder="Inserire l'eventuale numero di bambini" >
        <!--<div  class="form-text"></div>-->
    </div>
        <div class="mb-3">
            <label for="note" class="form-label bold">Note</label>
            <textarea class="form-control" id="note" name="note"  placeholder="Inserire eventuali note" ></textarea>
            <!--<div  class="form-text"></div>-->
        </div>


    <button type="submit" class="btn btn-warning" id="prenota" >Salva Prenotazione </button>
</form>
        </div>
        </div>
        @isset($inserita)
        .<div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
        
                    </div>
                </div>
            </div>
        </div>
        @endisset
</div>
@endsection

@section('js')

@if(!empty(Session::get('inserita')))
<script>
 $(document).ready(function() {
    $('.modal-body').text('Prenotazione Inserita correttamente'); 
    $('#modal').modal('show');
 });
</script>
@endif


<script type="text/javascript">

var object = <?php echo json_encode($prenotazione) ?>;
  

    $('#scegliTavoli').hide();

$('#oraInizio').val(object.oraInizio);
$('#dataPrenotazione').val(object.dataPrenotazione);
$('#coperti').val(object.coperti);
$('#oraFine').val(object.oraFine);
$('#nome').val(object.nomePrenotazione);
$('#telefono').val(object.telefono);
$('#bambini').val(object.bambini);
$('#note').val(object.note);
$('#tavoli').empty();

if($('#oraInizio').val() != ""){
    let dataPrenotazione = $('#dataPrenotazione').val();
    let oraInizio = $('#oraInizio').val();
    let sala = $('#sala').val();
    let coperti = $('#coperti').val();
    const selezionati = [];
    $.ajax({
        url: "/tavoli/"+object.dataPrenotazione+"/"+object.oraInizio+"/"+object.sala,
        success: function(tavoli){


            $.ajax({
            url: "/tavoliPerId/"+object.idPrenotazione+"/"+sala,
            success: function(occupati){
               
            $(occupati).each(function (i, tavolo){
                if($("#" +tavolo.idTavolo).length == 0) {
                        $('#tavoli').append('<input name="tavoli[]" data-rimanenti= '+tavolo.postiRimanenti+' type="checkbox" value="'+tavolo.idTavolo+'" id="'+tavolo.idTavolo+'" checked>' +
                                            '<label class="list-group-item" id="label'+tavolo.idTavolo+'"  for="'+tavolo.idTavolo+'">'+ tavolo.descrizione+' - Posti rimanenti: '+tavolo.postiRimanenti +'\n</label>');
                    
                    } else {
                        let presente = $('#'+tavolo.idTavolo).attr('data-rimanenti');
                        if (tavolo.postiRimanenti < presente){
                            $('#'+tavolo.idTavolo).attr('data-rimanenti', tavolo.postiRimanenti);
                            $('#label'+tavolo.idTavolo).text(tavolo.descrizione+' - Capienza: '+tavolo.postiRimanenti)
                        }
                    }
            })
            $(tavoli).each(function (i, t){
                console.log(t.idTavolo);
                
                    $('#tavoli').append('<input name="tavoli[]" type="checkbox" value="'+t.idTavolo+'" id="'+t.idTavolo+'">' +
                                            '<label class="list-group-item" for="'+t.idTavolo+'">'+ t.descrizione+' - Capienza: '+t.postiRimanenti +'\n</label>');

         
               

            })
        },
        error: function (exception){
         
        }

    });

        },
        error: function (exception){
            console.log(exception);
        }

    });
    
}


$(document).ready(function() {
function cercaTavoli(){
        let dataPrenotazione = $('#dataPrenotazione').val();
        let oraInizio = $('#oraInizio').val();
        let sala = $("#sala").val();
        $('#tavoli').empty();
        if($('#oraInizio').val() != ""){
            let dataPrenotazione = $('#dataPrenotazione').val();
            let oraInizio = $('#oraInizio').val();
            let coperti = $('#coperti').val();
            $.ajax({
                url: "/tavoli/"+dataPrenotazione+"/"+oraInizio+"/"+sala,
                success: function(result){
                    
                    $(result).each(function (i, tavolo){
                        console.log(tavolo);
                        $('#tavoli').append('<input name="tavoli[]" type="checkbox" value="'+tavolo.idTavolo+'" id="'+tavolo.idTavolo+'">' +
                                            '<label class="list-group-item" for="'+tavolo.idTavolo+'">'+ tavolo.descrizione+' - Capienza: '+tavolo.postiRimanenti +'\n</label>');

                    
                    })
                },
                error: function (exception){
                    console.log(exception);
                }
    
            });
        }
    }


});


</script>


@endsection