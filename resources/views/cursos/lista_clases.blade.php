<div class="segment ui">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon book"></i>
        Clases
        {{-- $clase->asignatura->asig_nombre --}}
    </h4>
    <div class="grid ui centered">
        <div class="ten wide column">
            <div class="ui middle divided  aligned animated list">
                @if (!Auth::user()->profesor())
                    @foreach ($curso->clases as $clases)
                        <div class="item item_list" data-clases="{{ $clases->cla_id }}">
                            <div class="right floated content animated fadeIn" style="display: none;">
                                @foreach ($curso->periodo->semestres->whereNotIn('sem_estado', 0) as $semestre)
                                    <a class="label ui {{ ($semestre->sem_estado == 2) ? 'teal': 'blue' }} small button_clase" data-sem="{{ $semestre->sem_id }}" data-clases="{{ $clases->cla_id }}">{{ $semestre->sem_numero }}° Semestre</a>
                                @endforeach
                            </div>
                            <i class="icon book big"></i>
                            <div class="content">
                                <div class="header">{{ $clases->asignatura->asig_nombre }}</div>
                                <div class="description animated fadeIn" style="display: none;">
                                    <p><strong>Profesor:</strong> {{ $clases->profesor->persona->nombreCompleto() }}
                                        <br>
    {{-- 
                                        <strong>Promedio Notas:</strong> <label class="ui label circular bg-light-blue">{{ round($clases->notas->avg('not_promedio'), 1) }}</label>
                                         --}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                @else

                    @foreach ($curso->clases->where('profesor_id', $profesor->pers_id) as $clases)
                        <div class="item item_list" data-clases="{{ $clases->cla_id }}">
                            <div class="right floated content animated fadeIn" style="display: none;">
                                @foreach ($curso->periodo->semestres->whereNotIn('sem_estado', 0) as $semestre)
                                    <a class="label ui {{ ($semestre->sem_estado == 2) ? 'teal': 'blue' }} small button_clase" data-sem="{{ $semestre->sem_id }}" data-clases="{{ $clases->cla_id }}">{{ $semestre->sem_numero }}° Semestre</a>
                                @endforeach
                            </div>
                            <i class="icon book big"></i>
                            <div class="content">
                                <div class="header">{{ $clases->asignatura->asig_nombre }}</div>
                                <div class="description animated fadeIn" style="display: none;">
                                    <p><strong>Profesor:</strong> {{ $clases->profesor->persona->nombreCompleto() }}
                                        <br>
    {{-- 
                                        <strong>Promedio Notas:</strong> <label class="ui label circular bg-light-blue">{{ round($clases->notas->avg('not_promedio'), 1) }}</label>
                                         --}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                @endif
            </div>
            
        </div>
    </div>
    
</div>

<script type="text/javascript">
    $('.item_list').mouseenter(function(){
        $(this).addClass('text-navy2');
        $(this).children('.content').children('.description').show();
        $(this).children('.floated.content').show();
    })
    $('.item_list').mouseleave(function(){
        $(this).removeClass('text-navy2');
        $(this).children('.content').children('.description').hide();
        $(this).children('.floated.content').hide();
    })
</script>