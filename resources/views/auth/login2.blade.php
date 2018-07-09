@extends('layouts.app2')

@section('content')


<div class="ui middle aligned center aligned grid">
  <div class="column">
    <h2 class="ui text-white image header">
      <img src="{{ asset('img/logo_lccg.png') }}" class="image">
      <div class="content">
        Liceo Carlos Cousiño Goyenechea
      </div>
    </h2>
    <form class="ui large form" role="form" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
      <div class="ui stacked segment inverted bg-navy2">
        <div class="field{{ $errors->has('us_username') ? ' has-error' : '' }}">
          <div class="ui left icon input">
            <i class="user icon"></i>
            <input id="username" type="text" name="us_username" tipo-input="rut" placeholder="RUT" value="{{ old('us_username') }}" required autofocus>
          </div>
            @if ($errors->has('us_username'))
                <span class="help-block">
                    <strong>{{ $errors->first('us_username') }}</strong>
                </span>
            @endif
        </div>
        <div class="field{{ $errors->has('password') ? ' has-error' : '' }}">
          <div class="ui left icon input">
            <i class="lock icon"></i>
            <input id="password" type="password" name="password" placeholder="Password" required>
          </div>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <button type="submit" class="ui fluid large teal submit button">Ingresar</button>
      </div>

      <div class="ui error message"></div>

    </form>
{{-- 
    <div class="ui message inverted bg-navy2">
      New to us? <a href="#">Sign Up</a>
    </div>
 --}}
  </div>
</div>


<script type="text/javascript">
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


    $('input[tipo-input="rut"]').focus(function(){
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
@endsection
