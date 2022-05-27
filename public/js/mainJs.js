

$(function () {
    var token = $("meta[name='_csrf']").attr("content");
    var header = $("meta[name='_csrf_header']").attr("content");
    $(document).ajaxSend(function (e, xhr, options) {
        xhr.setRequestHeader(header, token);
    });
});


/*******************
 * DOCUMENT READY
 */

$(document).ready(function(){

switch (operazione){
    case "modifica":
        $('#scegliTavoli').hide();

        $('#oraInizio').val(inizio);

        $('#oraFine').val(fine);
        $('#tavoli').empty();
        if($('#oraInizio').val() != ""){
            let dataPrenotazione = $('#dataPrenotazione').val();
            let oraInizio = $('#oraInizio').val();
            let sala = $('#sala').val();
            let coperti = $('#coperti').val();
            $.ajax({
                url: "/api/tavoliPerId/"+idPrenotazione,
                success: function(result){
                        console.log(result)
                    $(result).each(function (i, tavolo){
                        $('#tavoli').append(' <li class="list-group-item listaTavoli tavoloSelezionato"  id="'+tavolo.idTavolo+'">' +
                            ''+ tavolo.descrizione+' - Capienza: '+tavolo.capienza+'\n</li>');

                    })
                },
                error: function (exception){
                    console.log(exception);
                }

            });
            $.ajax({
                url: "/api/tavoliData/"+dataPrenotazione+"/"+oraInizio+"/"+sala,
                success: function(result){

                    $(result).each(function (i, tavolo){
                        $('#tavoli').append(' <li class="list-group-item listaTavoli"  id="'+tavolo.idTavolo+'">' +
                            ''+ tavolo.descrizione+' - Capienza: '+tavolo.capienza+'\n</li>');

                    })
                },
                error: function (exception){
                    console.log(exception);
                }

            });
        }
        break;
    case "nuova":
        /***** imposto la data di fine 2 ore dopo quella di inizio *********/
        let oraPrenotazione = new Date(data);
        let oraInizio = ora;
        $('#oraInizio').val(ora);
        stringaOra = oraInizio.split(":", 2);
        intOra = parseInt(stringaOra[0]);
        intMinuti = parseInt(stringaOra[1]);
        oraPrenotazione.setHours((intOra+2),intMinuti);
        $('#oraFine').val(oraPrenotazione.toLocaleTimeString());
        break;
}



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


    /***********************************************************
     /* ABILITA LA SCELTA DELLE PERSONE E CERCA I TAVOLI LIBERI*
     **********************************************************/



    $('#coperti').on('keyup change', function(){
        if($(this).val() != ""){

        } else {
            $('#oraInizio').prop("disabled", true);
        }
    });

    $('#oraInizio').on('keyup change', function(){
        if($(this).val() != ""){
            $('#tavoli').empty();
            $('#scegliTavoli').prop("disabled", false);
        } else {
            $('#scegliTavoli').prop("disabled", true);
        }
    });

    $(document).on('click', '#scegliTavoli', function(){

        $('#tavoli').empty();
        if($('#oraInizio').val() != ""){
            let dataPrenotazione = $('#dataPrenotazione').val();
            let oraInizio = $('#oraInizio').val();
            let coperti = $('#coperti').val();
            let sala = $('#sala').val();
            console.log("sala: " +sala);
            $.ajax({
                url: "/api/tavoliData/"+dataPrenotazione+"/"+oraInizio+"/"+sala,
                success: function(result){

                    $(result).each(function (i, tavolo){
                        $('#tavoli').append(' <li class="list-group-item listaTavoli"  id="'+tavolo.idTavolo+'">' +
                            ''+ tavolo.descrizione+' - Capienza: '+tavolo.capienza+'\n</li>');

                    })
                },
                error: function (exception){
                    console.log(exception);
                }

            });
        }
            });






    /*****************************************
     * Scelgo il Tavolo e sblocco input orario
     */

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
            $('#prenota').attr('disabled', true);


        }

    })

    $(document).on('change', '#oraInizio',function(){
       if($(this).val() != ""){
           $('#oraFine').attr('disabled', false);
       } else {
           $('#oraFine').attr('disabled', true);
       }
    });





    /************************
     /*SALVA LA PRENOTAZIONE*
     ***********************/


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
                       let sala = idSala || +$('#sala').val();
                       let oraPrenotazione = new Date(data);

                       stringaOra = oraInizio.split(":", 2);
                       intOra = parseInt(stringaOra[0]);
                       intMinuti = parseInt(stringaOra[1]);
                       oraPrenotazione.setHours((intOra),intMinuti);
                        orarioInizio =  oraPrenotazione.toLocaleTimeString();
                       stringaOra = oraFine.split(":", 2);
                       intOra = parseInt(stringaOra[0]);
                       intMinuti = parseInt(stringaOra[1]);
                       oraPrenotazione.setHours((intOra),intMinuti);
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

                       formData.append('tavoli', tavoliSelezionati);
                       formData.append('prenotaz', prenotazione);

                       let action = $('#formPrenota').attr('action');
                       $.ajax({
                           url: action,
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






});
