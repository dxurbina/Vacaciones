$(document).ready(function(){
    jQuery('.input_let').keypress(function(e) {
        tecla = (document.all) ? e.keyCode : e.which;

        //Tecla de retroceso para borrar, siempre la permite
        if (tecla == 8) {
            return true;
        }

        // Patron de entrada, en este caso solo acepta letras
        //patron = /[A-Za-z]/;
       // patron = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/g;
       patron = /^[a-zA-ZñÑ\s\W]/;
        tecla_final = String.fromCharCode(tecla);
        return patron.test(tecla_final);
    });

    jQuery('.input_num').keypress(function(tecla) {
        if(tecla.charCode < 48 || tecla.charCode > 57) return false;
    });
});