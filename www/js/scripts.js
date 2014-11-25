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
});

function actualizarNumeroUbicacion(dropSeccion){
    var valor = dropSeccion.value ;
    if(valor !== "0"){
        alert(valor);
        $.ajax({
                type: 'POST',
                data: {seccion:valor},
                url: 'index.php?ctrl=ubicacion&accion=buscar',
                //url: 'view/areaConsultar.html',
                dataType: 'json',
                success: function(json){
                    console.log(json);
                },
                error:function(json){
                    //alert('falló');
                    for(i in json){
                        console.log(json[i]);
                    }

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