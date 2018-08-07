var sum = 0;
var id_file = 0;
function addmsg(type, msg) {
    
 //console.log(msg[0].Tipo);
//    $('#notification_count').html(msg);
   // console.log(msg);
  //  console.log(msg.length);
    if(msg.length > 0){
        sum = sum + msg.length;
        $("#cont").text(sum);
        for( var i = 0; i < msg.length; i++){
            if(msg[i].Tipo == 'Respuesta'){
                $.ajax({
                    url: "?c=Notificaciones&a=destroy",
                    type: "POST",
                    data: {},
                    dataType: 'json',
                    contentType: 'application/json; charset= utf-8',
                    success: function(data){
                        
                    }
                    });
                    $(".menu").prepend(
                        
                        '<li>' + 
                       // '<a href="?c=Vacaciones&a=requests"><span class="tab fa fa-info-circle">  ' + data[i].Mensaje + '</span></a> ' + 
                      ' <div class="col-md-3 col-sm-3 col-xs-3"><span class="fa fa-info-circle"></div>'+
                      ' <div class="col-md-9 col-sm-9 col-xs-9 pd-l0"><a href="?c=SaldoVacaciones"> '+ data[i].Mensaje + '</a>'+
                       
                      '<hr>'+
                      ' </div>'+
                        '</li>'
                        );
            }else if(msg[i].Tipo == 'Solicitud' ){
                $.ajax({
                    url: "?c=Notificaciones&a=destroy",
                    type: "POST",
                    data: {},
                    dataType: 'json',
                    contentType: 'application/json; charset= utf-8',
                    success: function(data){
                        
                    }
                    });
                    $(".menu").prepend(
                        
                        '<li>' + 
                       // '<a href="?c=Vacaciones&a=requests"><span class="tab fa fa-info-circle">  ' + data[i].Mensaje + '</span></a> ' + 
                      ' <div class="col-md-3 col-sm-3 col-xs-3"><span class="fa fa-calendar"></div>'+
                      ' <div class="col-md-9 col-sm-9 col-xs-9 pd-l0"><a href="?c=Vacaciones&a=requests"> '+ data[i].Mensaje + '</a>'+
                       
                      '<hr>'+
                      ' </div>'+
                        '</li>'
                        );
            }else if(msg[i].Tipo == 'aprobacion'){
                $.ajax({
                    url: "?c=Notificaciones&a=destroy",
                    type: "POST",
                    data: {},
                    dataType: 'json',
                    contentType: 'application/json; charset= utf-8',
                    success: function(data){
                        
                    }
                    });
                    $(".menu").prepend(
                        
                        '<li >' + 
                       // '<a href="?c=Vacaciones&a=requests"><span class="tab fa fa-info-circle">  ' + data[i].Mensaje + '</span></a> ' + 
                      ' <div class="col-md-3 col-sm-3 col-xs-3"><span class="fa fa-calendar"></div>'+
                      ' <div class="col-md-9 col-sm-9 col-xs-9 pd-l0"><a onclick="riseup_modal(' +  data[i].IdNotificacion + ')" href="#" '+ data[i].Mensaje + '</a>'+
                       
                      '<hr>'+
                      ' </div>'+
                        '</li>'
                        );
            }
        }
    }
}

function riseup_modal(var_id){
    id_file = var_id;
    $("#_modal_notif_").modal("show");
    
   // value = _id;
  //  console.log(_id);
}

$(document).on('click', '#btn_update_csv_accepted', function (e) {
    e.preventDefault();
    var _select = $("#pass_3").val();
    var obj = JSON.stringify({ pass: _select });
    
    flag = false;
    $.ajax({
        data: obj,
        url: "?c=Load&a=verify",
        type: "POST",
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {
            //console.log(data.d);
            if(typeof data.IdEmpleado == "undefined"){
                flag=true;
            }
            if(flag == false){
                var obj = JSON.stringify({ id: id_file });
                $.ajax({
                    url: "?c=SaldoColaboradores&a=deduce_csv_accepted",
                    type: "POST",
                    data: obj,
                    dataType: 'json',
                    contentType: 'application/json; charset= utf-8'
                    });  
                    location.reload();
            }else{
                alert("Verifique contraseña. Dato no esperado!!");
            }
        }
            
        });

});



function showAll(){
    
        $.ajax({
            url: "?c=Notificaciones&a=showAll",
            type: "POST",
            data: {},
            dataType: 'json',
            contentType: 'application/json; charset= utf-8',
            success: function(data){
                //console.log(data);
                for( var i = 0; i <data.length; i++){
                    
                    if(data[i].Tipo == 'Respuesta'){
                        
                       // $(".menu").append('<li><a href="?c=SaldoVacaciones"><span class="tab fa fa-info-circle">  ' + data[i].Mensaje + '</span></a></li>');
                       $(".menu").prepend(
                        
                        '<li>' + 
                       // '<a href="?c=Vacaciones&a=requests"><span class="tab fa fa-info-circle">  ' + data[i].Mensaje + '</span></a> ' + 
                      ' <div class="col-md-3 col-sm-3 col-xs-3"><span class="fa fa-info-circle"></div>'+
                      ' <div class="col-md-9 col-sm-9 col-xs-9 pd-l0"><a href="?c=SaldoVacaciones"> '+ data[i].Mensaje + '</a>'+
                       
                      '<hr>'+
                      ' </div>'+
                        '</li>'
                        );
                    }else if(data[i].Tipo == 'Solicitud' ){
                       // var livacio = document.getElementById('#list').getElementsByTagName('li');
                        $(".menu").prepend(
                        
                            '<li>' + 
                           // '<a href="?c=Vacaciones&a=requests"><span class="tab fa fa-info-circle">  ' + data[i].Mensaje + '</span></a> ' + 
                          ' <div class="col-md-3 col-sm-3 col-xs-3"><span class="fa fa-calendar"></div>'+
                          ' <div class="col-md-9 col-sm-9 col-xs-9 pd-l0"><a href="?c=Vacaciones&a=requests"> '+ data[i].Mensaje + '</a>'+
                           
                          '<hr>'+
                          ' </div>'+
                            '</li>'
                            );
                        
                    }else if(data[i].Tipo == 'aprobacion'){
                            $(".menu").prepend(
                                
                                '<li id = "'+ data[i].IdNotificacion + ' ">' + 
                               // '<a href="?c=Vacaciones&a=requests"><span class="tab fa fa-info-circle">  ' + data[i].Mensaje + '</span></a> ' + 
                              ' <div class="col-md-3 col-sm-3 col-xs-3"><span class="fa fa-calendar"></div>'+
                              ' <div class="col-md-9 col-sm-9 col-xs-9 pd-l0"><a onclick="riseup_modal(' +  data[i].IdNotificacion + ')" href="#"> '+ data[i].Mensaje + '</a>'+
                               
                              '<hr>'+
                              ' </div>'+
                                '</li>'
                                );
                    }
                }
            }
            });
    
}

function waitForMsg() {

    $.ajax({
        type: "GET",
        url: "?c=Notificaciones&a=show",

        async: true,
        cache: false,
        timeout: 500000,

        success: function(data) {
            addmsg("new", data);
            
            setTimeout(
                waitForMsg,
                10000
            );
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            addmsg("error", textStatus + " (" + errorThrown + ")");
            setTimeout(
                waitForMsg,
                150000);
        }
    });
};





$(document).ready(function() {
    waitForMsg();
    showAll();
    $(document).on("click", "#notif", function(e){
                $("#cont").text(""); 
    });
    
    $(document).on("click", "#_download_", function(e){
       // console.log(id_file);
        var obj = JSON.stringify({ id: id_file });
        $.ajax({
            url: "?c=SaldoColaboradores&a=get_file",
            type: "POST",
            data: obj,
            dataType: 'json',
            contentType: 'application/json; charset= utf-8',
            success: function(data){
               // console.log(data);  
                dow_file = data;
               window.location.href='uploads/' + dow_file;
            }
            });
            
        
        
    })
});