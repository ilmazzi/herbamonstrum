@extends('layouts.master');

@section('content')
<div class="container">
    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="dataPrenotazione" id="dataPrenotazione">
        <option selected value="ns">Seleziona la data della prenotazione:</option>
    </select>
    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="sala">
        <option selected value="ns">Seleziona la sala per la prenotazione</option>
        <option value="0">Pub Pranzo</option>
        <option value="1">Pub Cena</option>
        <option value="2">Garden</option>
        <option value="3">Cantina</option>
    </select>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
         
        </div>
      </div>
    <div class="accordion" id="listaOrari">
    
    </div>
    <div class="modal fade" id="modal" data-bs-backdrop="static" id="modal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
</div>



@endsection

@section('js')
@isset($inserita)
<script>
 $(document).ready(function() {
    $('.modal-body').text('Prenotazione Inserita correttamente'); 
    $('#modal').modal('show');
 });
</script>
@endisset
<script type="text/javascript">

var limitePerIntervallo = 11;
        
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


    $(document).ready(function () {
        
        $.ajax(
            {
                'url': '/datePrenotazioni',
                'method': 'GET',
                'success': function(result){
                
                    $(result).each(function(i, item){
                        let data = new Date();
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
                          
                        if (today == item.dataPrenotazione){
                            $('#dataPrenotazione').append('<option selected value="'+item.dataPrenotazione+'">'+item.dataPrenotazione+'</option>')
                        } else {
                            $('#dataPrenotazione').append('<option value="'+item.dataPrenotazione+'">'+item.dataPrenotazione+'</option>')
                        }

                    });
                    $('#dataPrenotazione').trigger("change");

                },
                'error':function(error){
                    console.log(error)
                }
            }
        );

        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2)
                month = '0' + month;
            if (day.length < 2)
                day = '0' + day;

            return [year, month, day].join('-');
        }
        let now = new Date();
        let oggi = formatDate(now);
        var path = /*[[@{/api/prenotazioni/}]]*/ '.';

        $(document).on('change', '#dataPrenotazione', function (){

            var dataSelezionata = $(this).val();


            $(document).on('click', '#elimina', function(){
                let idPrenotazione = $(this).attr("data-id");
                $('.modal-title').empty();
                $('.modal-body').empty();
                $('.modal-footer-').empty();
                $('.modal-title').text('Elimina Prenotazione');
                $('.modal-body').text("Sei sicuro di voler eliminare la Prenotazione?");
                $('.modal-footer').html('  <a role="button" class="btn btn-warning" data-id="'+idPrenotazione+'" id="confermaElimina">OK</a> <a role="button" class="btn btn-danger" data-bs-dismiss="modal">ANNULLA</a>')

                var myModal = new bootstrap.Modal(document.getElementById('modal'), {
                    keyboard: false
                })

                var modalToggle = document.getElementById('modal') // relatedTarget
                myModal.show(modalToggle)
            });


            $(document).on('click', '#confermaElimina', function(){
                let idPrenotazione = $(this).attr("data-id");


                $.ajax(
                    {
                        'url': "/cancellaPrenotazione/"+idPrenotazione,
                        'method': 'GET',
                        'success': function(result){
                            $('.modal-title').empty();
                            $('.modal-body').empty();
                            $('.modal-footer-').empty();
                            $('.modal-title').text('Elimina Prenotazione');
                            $('.modal-body').text(result);
                            $('.modal-footer').html('<a role="button" class="btn btn-danger" href="/prenotazioni">OK</a>')

                            var myModal = new bootstrap.Modal(document.getElementById('modal'), {
                                keyboard: false
                            })

                            var modalToggle = document.getElementById('modal') // relatedTarget
                            myModal.show(modalToggle)

                        },
                        'error':function(error){
                            $('.modal-title').empty();
                            $('.modal-body').empty();
                            $('.modal-footer-').empty();
                            $('.modal-title').text('Elimina Prenotazione');
                            $('.modal-body').text(error);
                            $('.modal-footer').html('<a role="button" class="btn btn-danger" data-bs-dismiss="modal">OK</a>')

                            var myModal = new bootstrap.Modal(document.getElementById('modal'), {
                                keyboard: false
                            })

                            var modalToggle = document.getElementById('modal') // relatedTarget
                            myModal.show(modalToggle)
                        }
                    }
                );
            });
        });
    });

    $(document).ready(function(){

/****************************
 * Ajax per orari di sala
 */
let idSala = $('#sala').val();

$(document).on('change', '#dataPrenotazione, #sala', function (){
$('#listaOrari').empty();
if($(this).val() != "ns" && $('#sala').val() !="ns"){
   var idSala = $('#sala').val();

   $.ajax({
       url: "/orari/"+idSala,
       success: function(result){

           $(result).each(function (i, orario){

               let ora = orario.orario.split(":",2);
               let listaOrari = document.getElementById('listaOrari');
               let accordionItem = document.createElement("div");
               accordionItem.classList.add('accordion-item');
               let h2 = document.createElement("h2");
               h2.classList.add('accordion-header');
               let accordionButton = document.createElement("button");
               accordionButton.setAttribute("type", "button");
               accordionButton.classList.add("orarioLibero");
               accordionButton.textContent = ora;
               accordionButton.setAttribute("data-bs-toggle", "collapse");
               accordionButton.setAttribute("data-bs-target", "#collapse_"+orario.idOrario+"");
               accordionButton.setAttribute("id", "orario_"+orario.idOrario+"");
               h2.append(accordionButton);
               accordionItem.append(h2);
               listaOrari.append(accordionItem);
               let ul = document.createElement("div");
               ul.classList.add("list-group");
               let postiRimanenti = limitePerIntervallo;
               var data = $('#dataPrenotazione').val();
               $.ajax({
                   url: "/prenotazioni/"+data+"/"+orario.orario+"/"+idSala,
                   success: function(result){
      
                       let totaleCoperti = 0;
                     if(result.prenotazione == ""){
                         let accordionContent = document.createElement("div");
                         accordionContent.classList.add('accordion-collapse');
                         accordionContent.classList.add('collapse');
                         accordionContent.setAttribute("data-bs-parent", "#listaOrari");
                         accordionContent.setAttribute("id", "collapse_"+orario.idOrario+"");
                         let accordionBody = document.createElement("div");
                         accordionBody.classList.add('accordion-body');
                         accordionBody.setAttribute('id', 'body_'+orario.idOrario);


                         accordionContent.append(accordionBody);
                         accordionItem.append(accordionContent);

                         postiRimanenti = limitePerIntervallo;
                     } else {


                         $(result.prenotazione ).each(function (i, prenotazione){
                             let accordionContent = document.createElement("div");
                             accordionContent.classList.add('accordion-collapse');
                             accordionContent.classList.add('collapse');
                             accordionContent.setAttribute("data-bs-parent", "#listaOrari");
                             accordionContent.setAttribute("id", "collapse_"+orario.idOrario+"");
                             let accordionBody = document.createElement("div");
                             accordionBody.classList.add('accordion-body');
                             accordionBody.setAttribute('id', 'body_'+orario.idOrario);


                             let a = document.createElement("a");
                             a.classList.add("list-group-item");
                             a.classList.add("list-group-item-action");
                             a.classList.add("prenotazione");
                             a.setAttribute("data-bs-toggle" ,"offcanvas");
                             a.setAttribute("href", "#offcanvasExample");
                             a.setAttribute("role", "button");
                             a.setAttribute("data-idPrenotazione", prenotazione.idPrenotazione);
                             let div1 = document.createElement("div");
                             div1.classList.add("d-flex");
                             div1.classList.add("w-100");
                             div1.classList.add("justify-content-between");
                             let h5 = document.createElement("h5");
                             h5.classList.add("mb-1");
                             h5.innerHTML= "<strong>"+prenotazione.nomePrenotazione+ " X "+prenotazione.coperti;
                             let small = document.createElement("small");
                             let tavoli = [];
                             prenotazione.tavoli.forEach(element => {
                                 tavoli.push(element.nomeTavolo);
                             });
                             tavoli = tavoli.join(',');
                             small.innerHTML="<strong>TAVOLO: "+tavoli+"</strong>";
                             div1.append(h5);
                             div1.append(small);
                             let p = document.createElement("p");
                             p.classList.add("mb-1");
                             p.innerHTML= "TERMINE: <strong>"+prenotazione.oraFine+"</strong>";
                             let small1 = document.createElement("small");
                             small1.innerHTML="NOTE: "+prenotazione.note;
                             a.append(div1);
                             a.append(p)
                             a.append(small1)

                             ul.append(a);

                             accordionBody.append(ul);

                             accordionContent.append(accordionBody);
                             accordionItem.append(accordionContent);
                             totaleCoperti = totaleCoperti+prenotazione.coperti
                             postiRimanenti = parseInt(limitePerIntervallo-totaleCoperti);


                         })
                     }
                     console.log(postiRimanenti)
                       switch (postiRimanenti){
                        
                           case 0: case-1: case-2: case-3: case-4: case-5: case-6: case-7: case-8: case-9: case-10: case-11: case-12:
                           case -13: case-14: case-15: case-16: case-17: case-18: case-19: case-20: case-21: case-22: case-23: case-24: case-25:
                           case -26: case-27: case-28: case-29: case-30: case-31: case-32: case-33: case-34: case-35: case-36: case-37: case-38:
                               accordionButton.classList.remove("orarioLibero");
                               accordionButton.classList.add("orarioOccupato");
                               const divFooter = document.createElement("div");
                               divFooter.classList.add("text-center");
                               const span = document.createElement("span");
                               span.classList.add("testoRosso");
                               span.innerHTML= "<i class=\"far fa-times-circle\"></i>LIMITE PRENOTAZIONI RAGGIUNTO";
                               divFooter.append(span);
                               let body = document.getElementById('body_'+orario.idOrario);
                               if(body){
                                   body.append(divFooter);
                               }

                               accordionButton.innerHTML = ora+" -  <strong>PRENOTATI: "+totaleCoperti+" - RIMASTI: "+postiRimanenti+" </strong>";
                               break;
                           case 1: case 2:
                               accordionButton.classList.remove("orarioLibero");
                               accordionButton.classList.add("orarioSemiPieno");
                               const divFooter1 = document.createElement("div");
                               divFooter1.classList.add("text-center");
                               const buttonPrenota = document.createElement("a");
                               buttonPrenota.classList.add("btn");
                               buttonPrenota.classList.add("btn-warning");
                               buttonPrenota.classList.add("btn-prenota");
                               buttonPrenota.setAttribute("role", "button");
                               buttonPrenota.setAttribute("href", "/prenota/"+data+"/"+orario.idOrario+"/"+idSala);
                               buttonPrenota.setAttribute("data-idSala", idSala);
                               buttonPrenota.textContent= "PRENOTA";
                               divFooter1.append(buttonPrenota);
                               let body1 = document.getElementById('body_'+orario.idOrario);
                               if(body1){
                                   body1.append(divFooter1);
                               }
                               accordionButton.innerHTML = ora+" -  <strong>PRENOTATI: "+totaleCoperti+" - RIMASTI: "+postiRimanenti+" </strong>";
                               break;
                           case 3: case 4: case 5: case 6: case 7: case 8: case 9: case 10:
                             
                               accordionButton.classList.remove("orarioLibero");
                               accordionButton.classList.add("orarioSemiVuoto");
                               const divFooter2 = document.createElement("div");
                               divFooter2.classList.add("text-center");
                               const buttonPrenota1 = document.createElement("a");
                               buttonPrenota1.classList.add("btn");
                               buttonPrenota1.classList.add("btn-warning");
                               buttonPrenota1.classList.add("btn-prenota");
                               buttonPrenota1.setAttribute("role", "button");
                               buttonPrenota1.setAttribute("href", "/prenota/"+data+"/"+orario.idOrario+"/"+idSala);
                               buttonPrenota1.setAttribute("data-idSala", idSala);
                               buttonPrenota1.textContent= "PRENOTA";
                               divFooter2.append(buttonPrenota1);
                               let body2 = document.getElementById('body_'+orario.idOrario);
                                if(body2){
                                    body2.append(divFooter2);
                                }

                               accordionButton.innerHTML = ora+" -  <strong>PRENOTATI: "+totaleCoperti+" - RIMASTI: "+postiRimanenti+" </strong>";
                               break;
                           case 11:

                               const divFooter3 = document.createElement("div");
                               divFooter3.classList.add("text-center");
                               const buttonPrenota2 = document.createElement("a");
                               buttonPrenota2.classList.add("btn");
                               buttonPrenota2.classList.add("btn-warning");
                               buttonPrenota2.classList.add("btn-prenota");
                               buttonPrenota2.setAttribute("role", "button");
                               buttonPrenota2.setAttribute("href", "/prenota/"+data+"/"+orario.idOrario+"/"+idSala);
                               buttonPrenota2.textContent= "PRENOTA";
                               divFooter3.append(buttonPrenota2);
                               let body3 = document.getElementById('body_'+orario.idOrario);
                               if(body3){
                                   body3.append(divFooter3);
                               }
                               accordionButton.innerHTML = ora+" -  <strong> NESSUNA PRENOTAZIONE </strong>";
                               break;
                       }
                   },
                   error: function (exception){
                       console.log(exception);
                   }

               });

           })
       },
       error: function (exception){
           console.log(exception);
       }

   });


}

});

$(document).on("click", ".prenotazione", function(e){
e.preventDefault();
console.log('preasd');
let idPrenotazione = $(this).attr("data-idPrenotazione");


$.ajax(
    {
        'url': "/prenotazione/"+idPrenotazione,
        'method': 'GET',
        'success': function(result){
            $('.offcanvas-body').empty();
            $('.offcanvas-title').empty();
            $('.offcanvas-title').html("<strong>PRENOTAZIONE: "+result.nomePrenotazione+"</strong>");

            $('.offcanvas-body').html('<div class="btn-group-vertical"><a role="button" class="btn btn-danger" data-id="'+idPrenotazione+'" id="elimina">ELIMINA PRENOTAZIONE</a>' +
                '<a role="button" class="btn btn-warning" href="/prenotazioneUpdate/'+idPrenotazione+'" >Modifica</a>' +                
                '</div>')

        },
        'error':function(e){
            alert(e.messageerror);
        }
    }
);
})

});


</script>
@endsection
