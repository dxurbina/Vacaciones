
function mostrarInputFileModificado(numeroInput) {
    $("#archivo_oculto"+numeroInput).change(function(){
        $("#archivo"+numeroInput).val($("#archivo_oculto"+numeroInput).val());
    });}

function valtexto(e){
    
    tecla = (document.all) ? e.keyCode : e.which; // valido si es explorer, si no cualquiera. asigno valor ascii
    if (tecla==8 || tecla== 9) return true; 
    patron =/[A-Za-z]/; 
    te = String.fromCharCode(tecla); 
    return patron.test(te);
    }

function valnum(e){
    tecla= (document.all) ? e.keyCode : e.which;
    if(tecla==8){
        return true;
    }
    patron = /[0-9]/;
    te= String.fromCharCode(tecla);
    return patron.test(te);
    
}

function valform(){
    var nombre, lastname, email, nickname, pass, tel, avatar ;
    /** obtener valor de un select
     * $('select#edad').on('change',function(){
        var valor = $(this).val();
        alert(valor);
        });
     */
    nombre= $('input[name=name]').val(); lastname=$('input[name=lastName]').val();
    email= $('input[name=email]').val(); nickname=$('input[name=nickName]').val(); pass=$('input[name=passWord]').val();
    tel=$('input[name=tel]').val(); avatar=$('input[name=avatar]').val();
    var flag= true;
    if(nombre== null || nombre.length == 0 || /^s+$/.test(nombre)){
        $('#textAlert1').text("Campo Vacío o con espacios");
        $('#textAlert1').css("color", "red");
        flag = false;
    }else{ 
        $('#textAlert1').text("");
        
    }

    if( lastname== null || lastname.length == 0 || /^s+$/.test(lastname)){
        $('#textAlert2').text("Campo Vacío o con espacios");
        $('#textAlert2').css("color", "red");
        flag= false;
    }else{
        $('#textAlert2').text("");
        
    }

    if( email== null || email.length == 0 || /^s+$/.test(email)){
        $('#textAlert3').text("Campo Vacío o con espacios");
        $('#textAlert3').css("color", "red");
        flag= false;
    }else if(/\w+@\w+\.+[a-z]/.test(email)){
        $('#textAlert3').text("");
        
        }else { 
            $('#textAlert3').text("No es un Correo");
            $('#textAlert3').css("color", "red");
            flag=false;
         }

    if( nickname== null || nickname.length == 0 || /^s+$/.test(nickname)){
        $('#textAlert4').text("Campo Vacío o con espacios");
        $('#textAlert4').css("color", "red");
        flag= false;
    }else{
        $('#textAlert4').text("");
        
    }

    if( pass== null || pass.length == 0 || /^s+$/.test(pass)){
        $('#textAlert5').text("Campo Vacío o con espacios");
        $('#textAlert5').css("color", "red");
        flag= false;
    }else{
        $('#textAlert5').text("");
        
    }

    if(flag== false){
        return false;
    }
}

    