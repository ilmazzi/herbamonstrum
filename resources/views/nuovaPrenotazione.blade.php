@extends('layouts.master')

@section('content')

<div id="intro">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center">CIAO  {{ Auth::user()->name }}! INSERISCI LA PRENOTAZIONE</h3>

                <form  action="/prenota/nuova" method="POST" id="formPrenota">
                   
                    @csrf

                    <div class="mb-3">
                        <label for="nome" class="form-label bold">Data Prenotazione *</label>
                        <input type="date" class="form-control" id="dataPrenotazione" name="dataPrenotazione"   placeholder="Inserire la data" required>
                        <!--<div  class="form-text"></div>-->
                    </div>
                    <label for="sala" class="form-label bold">Scegli la sala per la prenotazione</label>
                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="sala" name="sala"required >
                        <option value="">--</option>
                        @isset($idSala)
                        <option value="0" @if( $idSala == "0") {{ 'selected' }} @endif>Pub Pranzo</option>
                        <option value="1" @if( $idSala == "1") {{ 'selected' }} @endif>Pub Cena</option>
                        <option value="2" @if( $idSala == "2") {{ 'selected' }} @endif>Garden</option>
                        <option value="2" @if( $idSala == "3") {{ 'selected' }} @endif>Cantina</option>
                        @endisset
                        @empty($idSala)
                        <option value="0">Pub Pranzo</option>
                        <option value="1" >Pub Cena</option>
                        <option value="2" >Garden</option>
                        <option value="2" >Cantina</option>
                        @endempty
                    </select>

                    <div class="mb-3">
                        <label for="coperti" class="form-label bold">Persone *</label>
                        <input type="number" class="form-control" id="coperti" name="coperti"  placeholder="Inserire il numero di persone al tavolo" required disabled>

                    </div>

                    <div class="mb-3">
                        <label for="oraInizio" class="form-label bold">Ora Inizio Prenotazione *</label>
                        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="oraInizio" name="oraInizio"  required >
                        <option value="">--</option>
                        </select>


                    </div>

                    <div class="mb-3" >
                        <label for="tavoli" class="form-label bold" name="tavoli">Scegli tavoli *</label>
                        <!-- <a role="button" for="tavoli" class="btn btn-warning" id="scegliTavoli" >Carica Disponibili </a>-->
                        <div class="list-group" id="tavoli">
                            
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="oraFine" class="form-label bold" >Ora fine Prenotazione *</label>
                        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="oraFine" name="oraFine"  required disabled>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="nome" class="form-label bold" >Nome *</label>
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
                        <input type="number" class="form-control" id="bambini" name="numeroBambini"  placeholder="Inserire l'eventuale numero di bambini" >
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
    </div>
</div>
<div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
@isset($dataPrenotazione)

<script type="text/javascript">

function convertDate(inputFormat) {
  function pad(s) { return (s < 10) ? '0' + s : s; }
  var d = new Date(inputFormat)
  return [d.getFullYear(),  pad(d.getMonth()+1), pad(d.getDate()) ].join('-')
}


    var langs =" {{ $dataPrenotazione }}";
    var ora ="{{ $oraInizio }}";
   
    $(document).ready(function() {
 
    $('#dataPrenotazione').val(convertDate(langs));
    let oraPrenotazione = new Date(convertDate(langs));
   
    $.ajax({
                    url: "/orari/"+$('#sala').val(),
                    success: function(result){
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

                        $(result).each(function (i, orario){
                            $('#oraInizio').append(' <option data-idOrario="'+orario.idOrario+'" value="'+orario.orario+'" >' +
                                ''+orario.orario+'</option>');
                            $('#oraInizio').prop("disabled", false);
                            $('#oraFine').append(' <option data-idOrario="'+orario.idOrario+'" value="'+orario.orario+'" >' +
                                ''+orario.orario+'</option>');
                            $('#oraFine').prop("disabled", false);
                            $('#oraInizio').val(ora);
                           $('#coperti').removeAttr('disabled');
                        })
                        cercaTavoli();
                    },
                    error: function (exception){
                        console.log(exception);
                    }
    
                });
       
       
    });
   
</script>

@endisset

<script type="text/javascript"> 



    $(document).ready(function() {

   
        
       
        /*************************************
         * DISABILITA LE DATE PRIMA DI OGGI
         * @type {Date}
         */
    
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!
        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd
        }
        if (mm < 10) {
            mm = '0' + mm
        }
    
        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById("dataPrenotazione").setAttribute("min", today);
    
        /*********************************
         * Setto l'orario di fine prenotazione 2 ore dopo quella di inizio
         */
    
    
        $('#dataPrenotazione').on('keyup change ', function(){
            if($(this).val() != ""){
                $('#sala').prop("disabled", false);
            } else {
                $('#sala').prop("disabled", true);
            }
        });
    
        $('#sala').on('keyup change keydown', function(){
           console.log("chanmgwewEASD");
                $.ajax({
                    url: "/orari/"+$(this).val(),
                    success: function(result){
                        $(result).each(function (i, orario){
                            $('#oraInizio').append(' <option data-idOrario="'+orario.idOrario+'" value="'+orario.orario+'" >' +
                                ''+orario.orario+'</option>');
                            $('#oraInizio').prop("disabled", false);
                            $('#oraFine').append(' <option data-idOrario="'+orario.idOrario+'" value="'+orario.orario+'" >' +
                                ''+orario.orario+'</option>');
                            $('#oraFine').prop("disabled", false);
    
                        })
                    },
                    error: function (exception){
                        console.log(exception);
                    }
    
                });
                $('#coperti').prop("disabled", false);
     
        });
    
    $('#coperti').on("change", function (){
    
    if($(this).val() != "") {
        $('#oraInizio').prop("disabled", false);
    } else {
        $('#oraInizio').prop("disabled", true);
        }
    });

    function cercaTavoli(){
        let dataPrenotazione = $('#dataPrenotazione').val();
        let oraInizio = $('#oraInizio').val();
        let sala = $("#sala").val();
        $('#tavoli').empty();
        if($('#oraInizio').val() != ""){
    let dataPrenotazione = $('#dataPrenotazione').val();
    let oraInizio = $('#oraInizio').val();
    let sala = $('#sala').val();
    let coperti = $('#coperti').val();
    const selezionati = [];
    $.ajax({
        url: "/tavoli/"+dataPrenotazione+"/"+oraInizio+"/"+sala,
        success: function(tavoli){


            $.ajax({
            url: "/tavoliPerId/"+idPrenotazione+"/"+sala,
            success: function(occupati){
               
            $(occupati).each(function (i, tavolo){
                selezionati.push( tavolo.idTavolo);
            })
            $(tavoli).each(function (i, t){
              
                if (selezionati.indexOf(t.idTavolo) !== -1) {
                    if($("#" +t.idTavolo).length == 0) {
                        $('#tavoli').append('<input name="tavoli[]" data-rimanenti= '+t.postiRimanenti+' type="checkbox" value="'+t.idTavolo+'" id="'+t.idTavolo+'" checked>' +
                                            '<label class="list-group-item" id="label'+t.idTavolo+'"  for="'+t.idTavolo+'">'+ t.descrizione+' - Capienza: '+t.postiRimanenti +'\n</label>');
                    
                    } else {
                        let presente = $('#'+t.idTavolo).attr('data-rimanenti');
                        if (t.postiRimanenti < presente){
                            $('#'+t.idTavolo).attr('data-rimanenti', t.postiRimanenti);
                            $('#label'+t.idTavolo).text(t.descrizione+' - Capienza: '+t.postiRimanenti)
                        }
                    }
                    

                } else {
                    $('#tavoli').append('<input name="tavoli[]" type="checkbox" value="'+t.idTavolo+'" id="'+t.idTavolo+'">' +
                                            '<label class="list-group-item" for="'+t.idTavolo+'">'+ t.descrizione+' - Capienza: '+t.postiRimanenti +'\n</label>');

                }

               

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
    }
    
        $(document).on('click', '#scegliTavoli', function(){
          cercaTavoli();
        });
    
        
    
    $('#oraInizio').on("change", function (){
        let idOrarioInizio = parseInt($('option:selected', this).attr('data-idorario'));
    
    let idOrarioFine = idOrarioInizio+8;
    let lunghezza = $('#oraFine option').length;
        if(idOrarioFine > lunghezza){
            let valFine = $('#oraFine option[data-idorario="'+lunghezza+'"]').val();
            $('#oraFine').val(valFine);
        }  else {
    
            let valFine = $('#oraFine option[data-idorario="'+idOrarioFine+'"]').val();
            $('#oraFine').val(valFine);
        }
    cercaTavoli();
    
    });
    
        $(document).on('click', '.listaTavoli',function(){
    
            if($(this).hasClass('tavoloSelezionato')){
                $(this).removeClass('tavoloSelezionato');
            } else {
                $(this).addClass('tavoloSelezionato')
            }
            if ($(".tavoloSelezionato")[0]){
                $('#prenota').removeAttr('disabled');
            } else {
                console.log('NON esiste');
                //$('#prenota').attr('disabled', true);
    
    
            }
    
        })
    
        /************************
         /*SALVA LA PRENOTAZIONE*
         **********************
    
    
        $('#prenota').on('click', function(e) {
    
            var exp = /[^a-zA-Z 0-9\n\r]+/g;
            if (exp.test($("#note").val())) {
                alert("Hai inserito un carattere non valido nelle note!");
            } else {
    
                if($('#formPrenota')[0].checkValidity()) {
    
    
    
                    var form = $('#formPrenota');
                    var time1 = document.getElementById('oraInizio').value;
                    var time2 = document.getElementById('oraFine').value;
                    if (time1 != "" && time2 != "") {
                        var time1Date = new Date("01/01/2000 " + time1);
                        var time2Date = new Date("01/01/2000 " + time2);
    
                        if (time1Date > time2Date) {
                            $('.modal-title').empty();
                            $('.modal-body').empty();
                            $('.modal-footer').empty();
                            $('.modal-title').text("Errore nell'orario");
                            $('.modal-body').text("L'orario di fine non può essere inferiore all'orario di inizio prenotazione");
                            $('.modal-footer').html('  <a role="button" class="btn btn-secondary"  data-bs-dismiss="modal">OK</a>')
    
                            var myModal = new bootstrap.Modal(document.getElementById('modal'), {
                                keyboard: false
                            })
                            var modalToggle = document.getElementById('modal') // relatedTarget
                            myModal.show(modalToggle)
                            $('#oraFine').val('');
                        } else {
                            var formData = new FormData();
    
                            let dataPrenotazione = $('#dataPrenotazione').val();
                            let nome = $('#nome').val();
                            let telefono = $('#telefono').val();
                            let coperti = $('#coperti').val();
                            let oraInizio = $('#oraInizio').val();
                            let oraFine = $('#oraFine').val();
                            let numeroBambini = $('#bambini').val() || 0;
                            let note = $('#note').val() || " ";
                            let sala = $('#sala').val();
                            let oraPrenotazione = new Date();
    
                            stringaOra = oraInizio.split(":", 2);
                            intOra = parseInt(stringaOra[0]);
                            intMinuti = parseInt(stringaOra[1]);
                            oraPrenotazione.setHours((intOra),intMinuti,0);
                            orarioInizio =  oraPrenotazione.toLocaleTimeString();
                            stringaOra = oraFine.split(":", 2);
                            intOra = parseInt(stringaOra[0]);
                            intMinuti = parseInt(stringaOra[1]);
                            oraPrenotazione.setHours((intOra),intMinuti,0);
                            orarioFine = oraPrenotazione.toLocaleTimeString();
    
    
    
    
    
                            let prenotazione = '{'
                                + '"nomePrenotazione" : "' + nome + '",'
                                + '"dataPrenotazione"  : "' + dataPrenotazione + '",'
                                + '"telefono" : ' + telefono + ','
                                + '"coperti" : ' + coperti + ','
                                + '"oraInizio" : "' + orarioInizio + '",'
                                + '"oraFine" : "' + orarioFine + '",'
                                + '"numeroBambini" : ' + numeroBambini + ','
                                + '"note" : "' + note + '",'
                                + '"sala" : "' + sala + '"'
                                + '}';
    
    
                            let tavoliSelezionati = []
    
                            $('li.tavoloSelezionato').each(function () {
                                var idTavolo = $(this).attr('id');
    
                                if (idTavolo != "") {
    
                                    tavoliSelezionati.push(idTavolo);
                                }
    
                            });
                            
                            var jsonPrenotaz = JSON.stringify(prenotazione);
                            var jsonTavoli = JSON.stringify(tavoliSelezionati);

                            formData.append('tavoli', tavoliSelezionati);
                            formData.append('prenotaz', prenotazione);
    
                            let action = $('#formPrenota').attr('action');
                            $.ajax({
                                url: action+'?_token=' + '{{ csrf_token() }}',
                                data: formData,
                                method: "POST",
                                processData: false,
                                contentType: false,
                                success: function (result) {
                                    $('.modal-title').empty();
                                    $('.modal-body').empty();
                                    $('.modal-footer').empty();
                                    $('.modal-title').text('Inserimento Prenotazione');
                                    $('.modal-body').text(result);
                                    $('.modal-footer').html('  <a role="button" class="btn btn-secondary"  href="/prenotazioni">OK</a>')
    
                                    var myModal = new bootstrap.Modal(document.getElementById('modal'), {
                                        keyboard: false
                                    })
    
                                    var modalToggle = document.getElementById('modal') // relatedTarget
                                    myModal.show(modalToggle)
    
                                }, error: function (error) {
                                    $('.modal-title').empty();
                                    $('.modal-body').empty();
                                    $('.modal-footer').empty();
                                    $('.modal-title').text('Inserimento Prenotazione');
                                    $('.modal-body').text(error);
                                    $('.modal-footer').html('  <a role="button" class="btn btn-secondary"  data-bs-dismiss="modal">OK</a>')
                                    var myModal = new bootstrap.Modal(document.getElementById('modal'), {
                                        keyboard: false
                                    })
    
                                    var modalToggle = document.getElementById('modal') // relatedTarget
                                    myModal.show(modalToggle)
    
                                }
                            })
                        }
                    }
                } else {
                    $('#formPrenota')[0].reportValidity();
                }
            }
    
    
        });
    
   
     */
    });

</script>
@endsection