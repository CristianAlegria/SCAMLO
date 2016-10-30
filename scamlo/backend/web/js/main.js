
$(document).on('click', '#activity-index-link', (function() {
        $.get(
        $(this).data('url'),
        function (data) {
            $('.modal-body').html(data);
            $('#modal').modal();
        }
        );
}));

$(window).scroll(function()
{
    if ($(this).scrollTop() > 50) $('nav').addClass("navbar-fixed-top");
    else $('nav').removeClass("navbar-fixed-top");
});


$(document).on('click', 'input[type="checkbox"]', function() {      
    $('input[type="checkbox"]').not(this).prop('checked', false);      
});

$(document).on('click', "input[type='checkbox']", (function() {
        if($("input[type='checkbox']").is(':checked')) {  
            $('#event-espacio_id').val($("input[type='checkbox']:checked").val());
        } else { 
            $('#event-espacio_id').val(""); 
        };  
})); 

$(document).on('click', '.fc-slats tr', function(){
    var hora = $(this).attr('data-time').substr(0,5);
    $('#event-hora_inicio').val(hora);
    $('#modal').modal('toggle');
    // $('#siguiente').show("linear");
    // $('#primero').hide("swing");
});

// obtener la id del formulario y establecer el manejador de eventos Usuarios
$("form#user-form").on("beforeSubmit", function(e) {
    var form = $(this);
    $.post(
    form.attr("action")+"&submit=true",
    form.serialize()
    )
    .done(function(result) {
        form.parent().html(result.message);
        $.pjax.reload({container:"#user-grid"});
    });
    return false;
}).on("submit", function(e){
    e.preventDefault();
    e.stopImmediatePropagation();
    return false;
});

// obtener la id del formulario y establecer el manejador de eventos Usuarios
$("form#servicio-form").on("beforeSubmit", function(e) {
    var form = $(this);
    $.post(
    form.attr("action")+"&submit=true",
    form.serialize()
    )
    .done(function(result) {
        form.parent().html(result.message);
        $.pjax.reload({container:"#servicio-grid"});
    });
    return false;
}).on("submit", function(e){
    e.preventDefault();
    e.stopImmediatePropagation();
    return false;
});

// obtener la id del formulario y establecer el manejador de eventos Cambiar contraseña
$("form#user-cambiar-clave").on("beforeSubmit", function(e) {
    var form = $(this);
    $.post(
    form.attr("action")+"&submit=true",
    form.serialize()
    )
    .done(function(result) {
        $.pjax.reload({container:"#perfil"});
    });
    return false;
}).on("submit", function(e){
    e.preventDefault();
    e.stopImmediatePropagation();
    return false;
});

$(document).on('click', '#guardar', (function(){
    var cedula = $('#user-cedula').val();
    var univalle = "Univalle";
    var clave = univalle.concat(cedula);

    $('#user-password_hash').val(clave);
    
}));

$(document).on('click', '#salir', (function(){
   $('#modal').modal('toggle');
}));

$(document).on('click', '#actualizar-clave', (function(){
    if($('#user-passwordactual').val() == ""){
        $("#user-passwordactual").css("border-color", "#a94442");
        document.getElementById("mensaje-clave").innerHTML = "Debes ingresar tu contraseña actual";
        return false;
    }
    document.getElementById("mensaje-clave").innerHTML = "";
    $("#user-passwordactual").css("border-color", "#ccc");
    return true;
}));