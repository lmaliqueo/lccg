
<div class="ui attached segment no-margin">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon cut"></i>
        Taller
    </h4>
    <a class="ui red right corner label remove_taller">
        <i class="remove icon"></i>
    </a>
    <table class="ui table celled">
        <thead>
            <tr>
                <th>Nombre Taller</th>
                <td>{{ $taller->nombreTaller() }}</td>
                <th>Periodo</th>
                <td>{{ $taller->periodo->pac_ano }}</td>
            </tr>
            <tr>
                <th>Profesor Encargado</th>
                <td>{{ $taller->profesorJefe->persona->nombreCompleto() }}</td>
                <th>Aula</th>
                <td>{{ $taller->aula_id }}</td>
            </tr>
        </thead>
    </table>

</div>


<div class="ui styled accordion fluid inverted">
    <div class="title bg-navy1 text-center">
        <i class="dropdown icon"></i>
        Ver lista de alumnos
    </div>
    <div class="content secondary">
        <table class="ui table celled">
            <thead>
                <tr>
                    <th>N° Matricula</th>
                    <th>Nombres</th>
                    <th>RUN</th>
                    <th>Curso</th>
                    <th>Sexo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($taller->listaAlumnos as $alumno)
                    <td>{{ $alumno->mat_numero }}</td>
                    <td>{{ $alumno->alumno->nombreCompleto() }}</td>
                    <td>{{ $alumno->alumno_rut }}</td>
                    <td>{{ $alumno->curso->first()->nombreCurso() }}</td>
                    <td>{{ $alumno->alumno->al_sexo }}</td>
                @endforeach
            </tbody>
        </table>

    </div>
</div>


<script type="text/javascript">
    $('.accordion').accordion();


    $('.remove_taller').on('click', function(){
        $('.select_taller').dropdown('clear')
        $('#content_taller').hide();
        $('.ins_button').addClass('disabled');

    })



</script>