<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>@yield('title', 'default') | Panel de administracion</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/semantic-2.3/semantic.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/animate.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/demo_style.css')}}">
	<script src="{{ asset('js/jquery-3.2.0.min.js')}}"></script>
	<script src="{{ asset('js/jquery-ui.js')}}"></script>
	<script src="{{ asset('plugins/semantic-2.3/semantic.js')}}"></script>
	<script src="{{ asset('js/nprogress.js')}}"></script>
	<script src="{{ asset('js/sweetalert.min.js')}}"></script>
	<script src="{{ asset('js/jquery.stickytableheaders.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

<style type="text/css">
    a:hover {
        cursor:pointer;
    }
</style>

</head>
<body class="dimmable">

    <div id="modaldiv" class="ui modal">
        <i class="close icon"></i>
        <div class="header header-modal">
        </div>
        <div class="content modalContent">
            <i class="large loading icon"></i>
        </div>
    </div>

	@include('admin.template.nav')
	<br>
		<div class="animated fadeIn">
			<br>
		<div class="ui main container">
			@include('flash::message')
			@yield('content')
			
		</div>

			
		</div>
		
		<div style="padding-bottom: 100px"></div>
	<script type="text/javascript">
    $('.ui.checkbox')
      .checkbox()
    ;
	$('.ui.dropdown')
	  .dropdown()
	;
	
	$('.ui.accordion')
	  .accordion()
	;

	$('.message .close')
        .on('click', function() {
        $(this)
            .closest('.message')
            .transition('fade')
            ;
        })
	;
    $('.button_pulse').mouseenter(function(){
        $(this).removeClass('animatedWea pulseOut grey')
        $(this).addClass('animated pulseIn text-navy2');
    });
    $('.button_pulse').mouseleave(function(){
        $(this).removeClass('animated pulseIn text-navy2')
        $(this).addClass('animatedWea pulseOut grey');
    });

    $('.ui .menu .item')
        .tab()
    ;

    var token = $('meta[name="csrf-token"]').attr('content');
    $(document).on('click', '.btn-borrar', function(){
        var id = $(this).attr('data-id');
        var ruta = $(this).attr('data-ruta');
        var message_info = $(this).attr('data-mens_info');
        swal({
            title: "¿Está seguro de eliminar este elemento?",
            text: message_info,
            type: "input",
            inputType: "password",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "Contraseña",
        },
        function(inputValue){
            $.ajax({
                url: "{{ route('ajax.confirm_user') }}",
                type: "POST",
                dataType:"JSON",
                data: {_token:$('meta[name="csrf-token"]').attr('content') ,pass:inputValue},
                success: function(response){
                    if(!response){
                        swal.showInputError("Ingrese datos nuevamente");
                        return false;
                    }
                    if( response == 2){
                        swal.showInputError("usted no tiene permisos para editar este usuario");
                        return false;
                    }
                    $.ajax({
                        url: ruta,
                        type: "POST",
                        dataType:"JSON",
                        data: {_token:$('meta[name="csrf-token"]').attr('content'), id:id},
                        success: function(response){
                            $('tr[data-tr="'+id+'"]').remove();
                            swal({
                                title: "Correcto!",
                                text: response.msg,
                                timer: 1500,
                                type: "success",
                                showConfirmButton:false,
                            });
                            $('.input_retiro').addClass('hide');
                        }
                    });
                }
            });
        })
    })


    $(document).ready(function(){
         $('#modalButton').click(function(){
            var header = $(this).attr('header');
            var url_btn = $(this).attr('url');
                $.ajax({
                    url: url_btn,{{--' route('parametros.create.conceptos') ',--}}
                    type: "get",
                    //data: { id: id },
                    success: function(response) {
                        $('.modalContent').html(response);
                        $('#modaldiv').addClass('small')    
                         //.find('.modalContent')
                         //.load(response);
                         //.html(response)
                         .modal('show');
                         $('.header-modal').html(header);
                    }
                })


         });
    });


    $(document).ready(function(){
         $('.modalButton').click(function(){
            var header = $(this).attr('header');
            var url_btn = $(this).attr('url');
                $.ajax({
                    url: url_btn,{{--' route('parametros.create.conceptos') ',--}}
                    type: "get",
                    //data: { id: id },
                    success: function(response) {
                        $('.modalContent').html('');
                        $('.modalContent').html(response);
                        $('#modaldiv')    
                         //.find('.modalContent')
                         //.load(response);
                         //.html(response)
                         .modal('show');
                         $('.header-modal').html(header);
                    }
                })


         });
    });



/* +++++++++++++++++++++++++++ INPUT NUMEROS +++++++++++++++++++++++++++ */

    $('input[tipo-input="number"]').keypress(function(event){
        //var key = window.event ? event.keyCode : event.which;
        var key = event.keyCode;
        //$('#data_key').text(event.which)
        if ( key < 48 || key > 57 ) {
            return false;
        } else {
            return true;
        }
    });

    $('input[tipo-input="promedio"]').keypress(function(event){
        //var key = window.event ? event.keyCode : event.which;
        var key = event.keyCode;
        var val = $(this).val()
        //$('#data_key').text(event.which)
        if(val.length < 2){
            if(val.length == 0){
                if ( key < 49 || key > 55 ) {
                    return false;
                } else {
                    return true;
                }
            }else{
                if(val == 7){
                    if(key == 48){
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    if ( key < 48 || key > 57 ) {
                        return false;
                    } else {
                        return true;
                    }
                }
            }
        }else{
            return false;
        }
    });
    $(document).on('focus', 'input[tipo-input="promedio"]', function(){
        var val = $(this).val()
        if(val.length > 0){
            $(this).val(val*10);
        }
    })
    $(document).on('focusout', 'input[tipo-input="promedio"]', function(){
        var val = $(this).val()
        console.log(val.length)
        if((val.length == 1) || (val.charAt(1) == 0)){
            $(this).val(val.charAt(0)+'.0') ;
        }else if(val.length == 2){
            $(this).val(val/10);
        }
    })


/* +++++++++++++++++++++++++++ VALIDAR RUT +++++++++++++++++++++++++++ */

$(document).ready(function(){
    $('input[tipo-input="rut"]').keypress(function(event){
        //var key = window.event ? event.keyCode : event.which;
        var key = event.keyCode;
        var val = $(this).val();
        //$('#data_key').text(event.which)
        if(val.length < 9){
            if (event.keyCode === 8 || {{-- event.keyCode === 46 || --}} event.keyCode === 107) {
                return true;
            } else if ( key < 48 || key > 57 ) {
                return false;
            } else {
                return true;
            }
        }else{
            return false;
        }
    });
    $(document).on('focusout', 'input[tipo-input="rut"]', function(){
        var rut = $(this).val();
        var rut_val= '';
        for(i=0; i<rut.length;i++){
            if(rut.charAt(i) != '.' && rut.charAt(i) != '-'){
                rut_val += rut.charAt(i);
            }
        }
        var text = '';
        var text_rut = '';
        var cont = 0;
        for(i=rut_val.length-1; i>=0;i--){
            if(((cont-1)>0) && ((cont-1)%3 == 0)){
                text+='.';
            }
            text += rut_val.charAt(i);
            if(i == rut_val.length-1){
                text+='-';
            }
            cont++;
        }
        for(j=text.length-1; j>=0; j-- ){
            text_rut += text.charAt(j);

        }
        $(this).val(text_rut)
    })
    $(document).on('focus', 'input[tipo-input="rut"]', function(){
        var val = $(this).val()
        var text = ''
        for(i = 0; i<val.length; i++){
            if(val.charAt(i) != '.' && val.charAt(i) != '-'){
                text += val.charAt(i);
            }
        }
        $(this).val(text)
    })
});







	</script>
</body>
{{-- 
<footer>
	
	<div class="ui inverted segment basic bg-navy2 vertical footer form-page">
		<div class="ui center aligned container"></div>
	</div>
</footer>
 --}}
</html>
