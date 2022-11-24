function getProvincie() {
    var regione = document.getElementById('regione').value;
    var provincia = document.getElementById('provincia').value;
    $.ajax({

        url : "../ajax/regioni/select-provincie.php?regione=" + regione + "&provincia=" + provincia,

        success : function (data) {

            document.getElementById('provincia').options[0].selected = 'provincia';
            $("#provincia").html(data);

        },

        error : function (richiesta,stato,errori) {

            alert("E' evvenuto un errore. Il stato della chiamata: "+errori);

        }

    });
}

function getCitta() {
    var citta = document.getElementById('citta').value;
    var provincia = document.getElementById('provincia').value;
    $.ajax({

        url : "../ajax/regioni/select-citta.php?citta=" + citta + "&provincia=" + provincia,

        success : function (data) {

            document.getElementById('citta').options[0].selected = 'citta';
            $("#citta").html(data);

        },

        error : function (richiesta,stato,errori) {

            alert("E' evvenuto un errore. Il stato della chiamata: "+errori);

        }

    });
}

function getProvincie2() {
    var regione = document.getElementById('regione2').value;
    var provincia = document.getElementById('provincia2').value;
    $.ajax({

        url : "../ajax/regioni/select-provincie.php?regione=" + regione + "&provincia=" + provincia,

        success : function (data) {

            document.getElementById('provincia2').options[0].selected = 'provincia';
            $("#provincia2").html(data);

        },

        error : function (richiesta,stato,errori) {

            alert("E' evvenuto un errore. Il stato della chiamata: "+errori);

        }

    });
}

function getCitta2() {
    var citta = document.getElementById('citta2').value;
    var provincia = document.getElementById('provincia2').value;
    $.ajax({

        url : "../ajax/regioni/select-citta.php?citta=" + citta + "&provincia=" + provincia,

        success : function (data) {

            document.getElementById('citta2').options[0].selected = 'citta';
            $("#citta2").html(data);

        },

        error : function (richiesta,stato,errori) {

            alert("E' evvenuto un errore. Il stato della chiamata: "+errori);

        }

    });
}