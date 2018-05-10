 $(document).on('click', '#btnUserI', function (e) {
        e.preventDefault();

        var _select = $("#usr").val();
        //console.log(_select);
        var obj = JSON.stringify({ Nombre: _select });
        flag = false;
        $.ajax({
            data: obj,
            url: "?c=Empleado&a=GetUser",
            type: "POST",
            dataType: 'json',
            contentType: 'application/json; charset= utf-8',
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
            },
            success: function (data) {
              //  console.log(data);
                $(data).each(function(i, v){ // indice, valor
                    if(v.Usuario == _select && v.IdUsuario != row ){
                        flag = true;
                    }
                })
                if(flag == false){
                    var user = $('#usr').val();
                    var pass = $('#pass').val();
                    if( pass.length > 4 && pass.length < 20 && user.length > 3){
                                
                                var obj = JSON.stringify({ Id: row, Usuario: user, Pass: pass });
                                flag = false;
                                $.ajax({
                                    data: obj,
                                    url: "?c=Empleado&a=updateUser",
                                    type: "POST",
                                    dataType: 'json',
                                    contentType: 'application/json; charset= utf-8',
                                    error: function(xhr, ajaxOptions, thrownError){
                                        console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
                                    },
                                    success: function (data) {
                                        location.reload();
                                    }
                                        
                                    });  
                            
                    }else{
                        alert('Dato no esperado');
                    }
                    

                }else{
                    alert("Nombre de usuario ya existe!!");
                }
            }
                
            });

    });