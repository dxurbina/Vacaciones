$(document).ready(function(){
    $(document).on('click', '.btn-add', function (e) {
        e.preventDefault();
        showDeparment();
    });

    $("#depto").change(function(){
        var _select = $("#depto").val();
        var obj = JSON.stringify({ id: _select });
        //console.log(obj);
        $.ajax({
            data: obj,
            url: "?c=Center&a=showById",
            type: "POST",
            dataType: 'json',
            contentType: 'application/json; charset= utf-8',
            beforeSend: function () 
            {
                $("#depto").prop('disabled', true);
            },
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
            },
            success: function (data) {
            //console.log(data);
            $("#depto").prop('disabled', false);
            $("#costo").find('option').remove();
                $("#costo").append('<option value="">Seleccione</option>');
                $(data).each(function(i, v){ // indice, valor
                    $("#costo").append('<option value="' + v.IdCosto + '">' + v.Codigo + " - "+ v.Nombre + '</option>');
                })
            }
            });
    }
);

function showDeparment(){
    var _Dptos = $("#depto");
        //var obj = JSON.stringify({ id: datos[0].IdDepartamento });
    $.ajax({
        data: {},
        url: "?c=Empleado&a=showDptosEmpresa",
        type: "POST",
        
        
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        beforeSend: function () 
                {
                    _Dptos.prop('disabled', true);
                },
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {
           // console.log(data);
           _Dptos.prop('disabled', false);
            
            $(data).each(function(i, v){ // indice, valor
                _Dptos.append('<option value="' + v.IdDep + '">' + v.Nombre + '</option>');
            })
        }
        });
    }
});