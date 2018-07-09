	

			
	{!! Form::open(['route' => ['proveedores.update', $proveedor], 'method'=>'PUT', 'class'=>'ui form']) !!}

		<div class="field">
			{!! Form::label('prov_razon_social', 'Razón Social') !!}
				{!! Form::text('prov_razon_social', $proveedor->prov_razon_social, ['placeholder'=>'', 'maxlength'=>30]) !!}
		</div>

		<div class="field">
			{!! Form::label('comuna_id', 'Comuna') !!}
			{!! Form::select('comuna_id', $comunas, $proveedor->comuna_id, ['placeholder'=>'', 'class'=>'ui fluid dropdown']) !!}
		</div>

		<div class="field">
			{!! Form::label('prov_direccion', 'Dirección') !!}
				{!! Form::text('prov_direccion', $proveedor->prov_direccion, ['placeholder'=>'',]) !!}
		</div>

		<div class="field">
			{!! Form::label('prov_contacto', 'Contacto') !!}
				{!! Form::text('prov_contacto', $proveedor->prov_contacto, ['placeholder'=>'', 'tipo-input'=>'number']) !!}
		</div>

	    <div class="actions text-right">

	        <div class="ui negative button" data-value="Cancel" name="Cancel">
	            Cancelar
	        </div>
			{!! Form::submit('Guardar', ['class'=>'ui button teal']) !!}

	    </div>

	{!! Form::close() !!}


<script type="text/javascript">

 	$('.dropdown').dropdown();

</script>



