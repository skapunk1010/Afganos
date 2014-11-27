$(document).ready(function(){

    $('#btnAsignarUbicacion').click(function(){
        $('#panelAsignarUbicacion').slideToggle("slow");
    });

    var headerheight = $('header').height();
    $('header').css('margin','0');
    var footerheight = $('footer').height();
    var windowheight = $(window).height();
    $('.main').css('min-height', windowheight - headerheight - footerheight-20);
    $("[class='checkboxSwitch']").bootstrapSwitch();

    $('#codigoEncargado').blur(function(){
        var codigoEmpleado = $(this).val();
        $.ajax({
                type: 'POST',
                data: {codigoEmpleado:codigoEmpleado},
                url: 'index.php?ctrl=empleado&accion=consultarAjax',
                dataType: 'json',
                success: function(json){
                    console.log(json);
                    var nombre = json[0].nombre + " ";
                    nombre += json[0].apellidoMaterno + " ";
                    nombre += json[0].apellidoPaterno;
                    $('#nombreEncargado').val(nombre);
                },
                error:function(json){
                    $('#nombreEncargado').val('');
                    //Mensaje no se encontraron ubicaciones para dicha sección
                }
        });
    });

    $('#aceptarAsignacion').click(function(){
        var idUbicacion = $('#numeroUbicacion').val();
        var idArea      = getVariableUrl('id');
        if(idUbicacion !== null){
            $.ajax({
                type: 'POST',
                data: {idArea:idArea,idUbicacionid:idUbicacion},
                url: 'index.php?ctrl=ubicacion&accion=insertar',
                dataType: 'json',
                success: function(json){
                    console.log(json);
                    alert('ubicacion asignada');
                },
                error:function(json){
                    //Mensaje no se encontraron ubicaciones para dicha sección
                    console.log(json);
                    alert('no se pudo asignar ubicacion');
                }
            });
        }
    });

    $('#marca').change(function(){
        var idMarca = $(this).val();
        alert(idMarca);
        $.ajax({
                type: 'POST',
                data: {idMarca:idMarca},
                url: 'index.php?ctrl=modelo&accion=buscarPorMarcaAjax',
                dataType: 'json',
                success: function(json){
                    alert('exito');
                },
                error:function(json){
                    $('#nombreEncargado').val('');
                    alert('no exito');
                    //Mensaje no se encontraron ubicaciones para dicha sección
                }
        });
    });

    $('#btnCambiarArea').click(function(){
        $('#panelCambiarArea').slideToggle("slow");
        $('#area').empty();
        $.ajax({
                type: 'POST',
                url: 'index.php?ctrl=area&accion=listarAjax',
                dataType: 'json',
                success: function(json){
                    console.log(json);
                    for(i in json){
                        $('#area').append('<option value='+json[i].idArea+'>'+json[i].area+'</option>');
                    }
                },
                error:function(json){
                    //Mensaje no se encontraron ubicaciones para dicha sección
                }
        });
        /*$('#marca').empty();
        $.ajax({
                type: 'POST',
                url: 'index.php?ctrl=marca&accion=listarAjax',
                dataType: 'json',
                success: function(json){
                    $('#area').append('<option value='+json[i].idMarca+'>'+json[i].Marca+'</option>');
                },
                error:function(json){
                    //Mensaje no se encontraron ubicaciones para dicha sección
                }
        });*/////////Sirve para marca
    });

});

function actualizarNumeroUbicacion(dropSeccion){
    var valor = dropSeccion.value ;
    if(valor !== "0"){     
        /*$.post("index.php?ctrl=ubicacion&accion=buscar",function(data,status){
          alert("Data: " + data + "\nStatus: " + status);
        });   */
        $.ajax({
                type: 'POST',
                data: {seccion:valor},
                url: 'index.php?ctrl=ubicacion&accion=buscar',
                dataType: 'json',
                success: function(json){
                    $('#numeroUbicacion').empty();
                    for(i in json){
                        $('#numeroUbicacion').append('<option value='+json[i].idUbicacion+'>'+json[i].numero+'</option>');
                    }
                },
                error:function(json){
                    $('#numeroUbicacion').empty();
                    //Mensaje no se encontraron ubicaciones para dicha sección
                }
        });
    }
}

function getVariableUrl(sParam)
{
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) 
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) 
        {
            return sParameterName[1];
        }
    }
}

//<a href="index.php?ctrl=area&accion=insertar" class="btn btn-info pull-right" id="btnAsignarUbicacion">Asignar ubicación</a>