function getSottocategorie() {
    
    var categoria = document.getElementById('categoria').value;
    var sottocategoria = document.getElementById('sottocategoria').value;

    alert(categoria);
    
    $.ajax({

        url : "ajax/regioni/select-sottocategorie.php?categoria=" + categoria + "&sottocategoria=" + sottocategoria,

        success : function (data) {

            document.getElementById('sottocategoria').options[0].selected = '';
            document.getElementById('sottocategoria').innerHTML = data;

        },

        error : function (richiesta, stato, errori) {

            alert("E' avvenuto un errore. Il stato della chiamata: " + errori);

        }

    });
}