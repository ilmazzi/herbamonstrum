
$(document).ready(function(){


    const weekday = new Array(7);
    weekday[0] = "Dom";
    weekday[1] = "Lun";
    weekday[2] = "Mar";
    weekday[3] = "Mer";
    weekday[4] = "Gio";
    weekday[5] = "Ven";
    weekday[6] = "Sab";

var labelsPrenotazioni = [];
let seriesPrenotazioni = [];

    $.ajax({
        url: "/api/prenotazioniSettimana",
        method: "GET",
        success: function (result) {


                $(result).each(function(i,item){
                    var data = new Date(item.dataPrenotazione);
                    let giorno = weekday[data.getDay()];
                    labelsPrenotazioni.push(giorno);
                    seriesPrenotazioni.push(item.prenotazioni);

                    var data = {
                        // A labels array that can contain any sort of values
                        labels: labelsPrenotazioni,

                        // Our series array that contains series objects or in this case series data arrays
                        series: [
                            seriesPrenotazioni
                        ]
                    };

                    var options = {
                        width: 450  ,
                        height: 300
                    };

                    new Chartist.Line('.ct-chart', data, options);

                })

        }, error: function (error) {

        }
    })





    var data = {
        series: [100, 15]
    };

    var sum = function(a, b) { return a + b };

    new Chartist.Pie('#chart2', data, {
        labelInterpolationFnc: function(value) {
            return Math.round(value / data.series.reduce(sum) * 100) + '%';
        },
        width: 350  ,
        height: 150
    });






})
