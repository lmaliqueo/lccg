<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    protected $table = "matricula";

    protected $primaryKey = 'mat_id';

    protected $fillable = ['mat_id', 'alumno_rut', 'est_anterior_id', 'periodo_id', 'mat_numero', 'mat_prom_general','mat_grado_curso', 'mat_tipo_alumno','mat_estado', 'mat_fecha_ingreso', 'mat_fecha_retiro', 'mat_motivo', 'mat_cuota_pagar', 'mat_observacion', 'mat_prom_ingreso', 'mat_posicion_lista', 'mat_condicional', 'mat_causas_cond', 'mat_clases_religion', 'mat_apod_retira', 'mat_sit_padres', 'mat_convive', 'mat_cant_hermanos', 'mat_prom_asis'];


public function rules()
{
    //dd(($this->mat_condicional == 1) ? 'required':'');
    return [
        //'al_rut' => 'required|max:12',
        'mat_grado_curso' => 'required',
        'mat_prom_ingreso' => 'required',
        'mat_fecha_ingreso' => 'required',
        'mat_sit_padres' => 'required',
        'mat_convive' => 'required|alpha_spaces',
        'mat_causas_cond' => ($this->mat_condicional == 1) ? 'required':'',
        'mat_cant_hermanos' => 'required|min:0',
        'establecimiento_ant' => ($this->mat_grado_curso == 1) ? 'required|alpha_spaces|max:100':'nullable|alpha_spaces|max:100',
    ];
}
public function attr_name()
{
    return [
        'mat_grado_curso' => 'Nivel Curso',
        'mat_prom_ingreso' => 'Promedio de Ingreso',
        'mat_fecha_ingreso' => 'Fecha de Ingreso',
        'mat_sit_padres' => 'Situación de Padres',
        'mat_convive' => 'Conviven',
        'mat_cant_hermanos' => 'Cantidad de Hermanos',
        'mat_causas_cond' => 'Causas Condicional',
        'establecimiento_ant' => 'Establecimiento Anterior'
    ];

}


    public function sit_padres()
    {
        if ($this->mat_sit_padres == 1) {
            return 'Casados';
        }elseif($this->mat_sit_padres == 2){
            return 'Conviven';
        }elseif($this->mat_sit_padres == 3){
            return 'Solo Madre';
        }else{
            return 'Separados';
        }
    }

    public function scopeSearch($query, Request $request)
    {

        if ($request->has('periodo')) {
            $query->where('periodo_id', $request->periodo);
        }
        if ($request->has('numero')) {
            $query->where('mat_numero', $request->numero);
        }
        if ($request->has('estado')) {
            $query->where('mat_estado', $request->estado);
        }
        if ($request->has('rut')) {
            $query->where('alumno_rut', 'like','%'.$request->rut.'%');
        }
        if ($request->has('nombre')) {
            $alumnos = Alumno::where('al_nombres', 'like','%'.$request->nombre.'%')->orWhere('al_apellido_pat', 'like','%'.$request->nombre.'%')->orWhere('al_apellido_mat', 'like','%'.$request->nombre.'%')->pluck('al_rut');
            $query->whereIn('alumno_rut', $alumnos);
        }
        if ($request->has('curso')) {
            $curso = Curso::find($request->curso);
            $query->whereIn('mat_id', $curso->listaAlumnos->pluck('mat_id'));
        }
        return $query;



        //dd($s->prom);
        return $query->where('mat_numero', 'like', '%'.$s->numero.'%')
                    ->where('alumno_rut', 'like', '%'.$s->rut.'%')
                    ->where('mat_estado', 'like', '%'.$s->estado.'%')
                    ->where('mat_prom_general', 'like', '%'.$s->prom.'%');
    }

    public function scopeSearchAlu($query, Request $request)
    {

        if ($request->has('numero')) {
            $query->where('mat_numero', $request->numero);
        }
        if ($request->has('estado')) {
            $query->where('mat_estado', $request->estado);
        }
        if ($request->has('rut')) {
            $query->where('alumno_rut', 'like','%'.$request->rut.'%');
        }
        if ($request->has('nombre')) {
            $alumnos = Alumno::where('al_nombres', 'like','%'.$request->nombre.'%')->orWhere('al_apellido_pat', 'like','%'.$request->nombre.'%')->orWhere('al_apellido_mat', 'like','%'.$request->nombre.'%')->pluck('al_rut');
            $query->whereIn('alumno_rut', $alumnos);
        }
        if ($request->has('sexo')) {
            if ($request->sexo != 'ambos') {
                $alu = $query->pluck('alumno_rut');
                $alumnos = Alumno::whereIn('al_rut', $alu)->where('al_sexo', $request->sexo)->pluck('al_rut');
                $query->whereIn('alumno_rut', $alumnos);
            }
        }
        if ($request->has('curso')) {
            $curso = Curso::find($request->curso);
            $query->whereIn('mat_id', $curso->listaAlumnos->pluck('mat_id'));
        }
        return $query;



        //dd($s->prom);
        return $query->where('mat_numero', 'like', '%'.$s->numero.'%')
                    ->where('alumno_rut', 'like', '%'.$s->rut.'%')
                    ->where('mat_estado', 'like', '%'.$s->estado.'%')
                    ->where('mat_prom_general', 'like', '%'.$s->prom.'%');
    }


    public function curso()
    {
        return $this->belongsToMany('App\Curso', 'alumno_esta', 'matricula_id', 'curso_id')->where('cu_tipo', 1);
    }

    public function talleres()
    {
        return $this->belongsToMany('App\Curso', 'alumno_esta', 'matricula_id', 'curso_id')->where('cu_tipo', 2);
    }

    public function alumno()
    {
    	return $this->belongsTo('App\Alumno', 'alumno_rut', 'al_rut');
    }

    public function periodo()
    {
    	return $this->belongsTo('App\PeriodoAcademico', 'periodo_id', 'pac_id');
    }

    public function escuela()
    {
    	return $this->belongsTo('App\EstablecimientoAnterior', 'est_anterior_id', 'eant_id');
    }

    public function apoderados()
    {
    	return $this->belongsToMany('App\Apoderado', 'apoderado_representa', 'matricula_id', 'apoderado_id');
    }

    public function padres()
    {
    	return $this->belongsToMany('App\Padres', 'alumno_tiene', 'matricula_id', 'padres_rut');
    }

    public function cursos()
    {
        return $this->belongsToMany('App\Curso', 'alumno_esta', 'matricula_id', 'curso_id');
    }

    public function conceptos()
    {
        return $this->belongsToMany('App\Concepto', 'eva_comportamiento', 'matricula_id', 'concepto_id')->withPivot('detallepauta_id');
    }

    public function detallesConceptos()
    {
        return $this->belongsToMany('App\DetallePauta', 'eva_comportamiento', 'matricula_id', 'detallepauta_id')->withPivot('concepto_id');
    }

    public function asistencias()
    {
        return $this->hasMany('App\Asistencia', 'matricula_id', 'mat_id');
    }

    public function notas()
    {
        return $this->hasMany('App\Notas', 'matricula_id', 'mat_id');
    }

    public function ensayos()
    {
        return $this->belongsToMany('App\Ensayo', 'alumno_realiza', 'matricula_id', 'ensayo_id')->withPivot('alr_resultado');
    }

    public function enfermedades()
    {
        return $this->hasMany('App\Enfermedad', 'matricula_id', 'mat_id');
    }

    public function diaClases()
    {
        return $this->belongsToMany('App\DiaClase', 'alumno_asiste', 'matricula_id', 'dia_clase_id')->withPivot('ala_estado');
    }

    public function estado()
    {
        if ($this->mat_estado == 1) {
            return 'Activo';
        }
        if ($this->mat_estado == 0) {
            return 'Pendiente';
        }
        if ($this->mat_estado == 3) {
            return 'Retirado';
        }
        if ($this->mat_estado == 2) {
            return 'Finalizado';
            //return 'Egresado';
        }
        if ($this->mat_estado == 4) {
            return 'Repitente';
        }
    }

    public function color_estado()
    {
        if ($this->mat_estado == 1) {
            return 'blue';
        }
        if ($this->mat_estado == 0) {
            return '';
        }
        if ($this->mat_estado == 3) {
            return 'red';
        }
        if ($this->mat_estado == 2) {
            return 'green';
        }
        if ($this->mat_estado == 4) {
            return 'warning';
        }
    }

    public function condicional()
    {
        return ($this->mat_condicional) ? 'Si':'No';
    }


    /*-----------------------------------------------------------------------------*/
    public function print_nota($not)
    {
        return (strlen($not) == 1) ? $not.'.0': round($not, 1);
    }

    public function prom_sem($sem)
    {
        $prom = round($this->notas->where('semestre_id', $sem)->where('not_promedio', '<>', null)->avg('not_promedio'), 1);
        if ($prom != null) {
            return (strlen($prom) == 1) ? $prom.'.0': $prom ;
        }else{
            return '-';
        }
    }

    public function prom_clase_sem($clase, $sem)
    {
        $prom = round($this->notas->where('semestre_id', $sem)->where('clase_id', $clase)->where('not_promedio', '<>', null)->avg('not_promedio'), 1);
        if ($prom != null) {
            return (strlen($prom) == 1) ? $prom.'.0': $prom ;
        }else{
            return '-';
        }
    }

    public function prom_not_clase($cla)
    {
        $prom = round($this->notas->where('clase_id', $cla)->where('not_promedio', '<>', null)->avg('not_promedio'), 1);
        if ($prom != null) {
            return (strlen($prom) == 1) ? $prom.'.0': $prom ;
        }else{
            return '-';
        }
    }

    /*-----------------------------------------------------------------------------*/

    public function prom_asis_sem($sem)
    {

        $semestre = Semestre::find($sem);
        if ($this->diaClases->where('semestre_id', $semestre->sem_id)->count()) {
            $prom = $this->diaClases->where('semestre_id', $semestre->sem_id)->avg('pivot.ala_estado');
        //dd($this->diaClases);
            return round(($prom*100), 1);
        }else{
            return '-';
        }

        /*
        $dias = $this->periodo->semestres->find($sem)->diaClase->pluck('dc_id');
        $clases = $this->curso->first()->clases->pluck('cla_id');
        $clases_r = ClasesRealizadas::whereIn('dia_clase_id', $dias)->where('clase_id', $clases)->pluck('cr_id');
        $prom_asis = $this->asistencias->whereIn('cla_realizados_id', $clases_r)->avg('asis_estado');
        return round($prom_asis*100, 1);
        */
    }
    public function prom_inasis_sem($sem)
    {
        /*
        $dias = $this->periodo->semestres->find($sem)->diaClase->pluck('dc_id');
        $clases = $this->curso->first()->clases->pluck('cla_id');
        $clases_r = ClasesRealizadas::whereIn('dia_clase_id', $dias)->where('clase_id', $clases)->pluck('cr_id');

        $count_inasis = $this->asistencias->whereIn('cla_realizados_id', $clases_r)->where('asis_estado', 0)->count();
        $count_total = $this->asistencias->whereIn('cla_realizados_id', $clases_r)->count();
        */

        $semestre = Semestre::find($sem);
        $count_inasis = $this->diaClases()->wherePivot('ala_estado', '=',0)->where('semestre_id', $semestre->sem_id)->count();
        $count_total = $this->diaClases->where('semestre_id', $semestre->sem_id)->count();

        if ($count_total > 0) {
            $prom_inasis = ($count_inasis/$count_total)*100;
            return round($prom_inasis, 1);
        }else{
            return '-';
        }
    }

    public function prom_asis_cla_sem($sem, $cla)
    {
        $dias = $this->periodo->semestres->find($sem)->diaClase->pluck('dc_id');
        $clases_r = $this->curso->first()->clases->find($cla)->clasesRealizadas->whereIn('dia_clase_id', $dias)->pluck('cr_id');
        $prom_asis = $this->asistencias->whereIn('cla_realizados_id', $clases_r)->avg('asis_estado');
        if ($prom_asis != null) {
            return round($prom_asis*100, 1);
        }else{
            return '-';
        }
    }

    public function prom_inasis_cla_sem($sem, $cla)
    {
        $dias = $this->periodo->semestres->find($sem)->diaClase->pluck('dc_id');
        $clases_r = $this->curso->first()->clases->find($cla)->clasesRealizadas->whereIn('dia_clase_id', $dias)->pluck('cr_id');
        $count_inasis = $this->asistencias->whereIn('cla_realizados_id', $clases_r)->where('asis_estado', 0)->count();
        $count_total = $this->asistencias->whereIn('cla_realizados_id', $clases_r)->count();
        if ($count_total > 0) {
            $prom_inasis = $count_inasis/$count_total;
            return round($prom_inasis*100, 1);
        }else{
            return '-';
        }
    }

    public function prom_asis_anual_clase($cla)
    {
        $prom_total = 0;
        $cant_sem = $this->periodo->semestres->where('sem_estado', '<>', 0)->count();
        foreach ($this->periodo->semestres as $sem) {
            $dias = $this->diaClases->where('semestre_id', $sem->sem_id)->pluck('dc_id');
            $clases_r = $this->curso->first()->clases->find($cla)->clasesRealizadas->whereIn('dia_clase_id', $dias)->pluck('cr_id');
            $prom_asis = $this->asistencias->whereIn('cla_realizados_id', $clases_r)->avg('asis_estado');
            $prom_total += $prom_asis;
        }
        if ($cant_sem > 0) {
            $prom_total = $prom_total/$cant_sem;
            return round($prom_total*100, 1);
        }else{
            return '-';
        }
        /*
        if ($prom_asis != null) {
            return round($this->asistencias->whereIn('cla_realizados_id', $clases_r)->avg('asis_estado')*100, 1).' %';
        }else{
            return '-';
        }*/
    }

    public function prom_inasis_anual_clase($cla)
    {
        $prom_total = 0;
        $cant_sem = $this->periodo->semestres->where('sem_estado', '<>', 0)->count();
        foreach ($this->periodo->semestres as $sem) {
            $dias = $this->diaClases->where('semestre_id', $sem->sem_id)->pluck('dc_id');
            $clases_r = $this->curso->first()->clases->find($cla)->clasesRealizadas->whereIn('dia_clase_id', $dias)->pluck('cr_id');
            $cont_inas = $this->asistencias->whereIn('cla_realizados_id', $clases_r)->where('asis_estado', 0)->count();
            $cont_total = $this->asistencias->whereIn('cla_realizados_id', $clases_r)->count();
            if ($cont_total) {
                $prom_inas = $cont_inas/$cont_total;
            }else{
                $prom_inas = 0;
            }
            $prom_total += $prom_inas;
        }
        if ($cant_sem > 0) {
            $prom_total = $prom_total/$cant_sem;
            return round($prom_total*100, 1);
        }else{
            return '-';
        }
        /*
        if ($prom_asis != null) {
            return round($this->asistencias->whereIn('cla_realizados_id', $clases_r)->avg('asis_estado')*100, 1).' %';
        }else{
            return '-';
        }*/
    }

    public function prom_asis_anual()
    {
        $prom_final = 0;
        $prom_sem = 0;
        $semestres = $this->periodo->semestres->where('sem_estado', '<>', 0);
        $cant_sem = $semestres->count();
        foreach ($semestres as $semestre) {
            $prom_sem += $this->diaClases->whereIn('semestre_id', $semestre->sem_id)->avg('pivot.ala_estado');
        }
        //$prom = ($prom_sem/$cant_sem)*100;
        //dd(round($prom, 1));
        //$this->diaClases->whereIn('semestre_id', $semestres->pluck('sem_id'))->avg('pivot.ala_estado');
        //$prom = $prom*100;
        //dd(round($prom_final, 1));
        /*
        foreach ($semestres as $sem) {
            $prom_final += $prom;
        }*/
        if ($cant_sem > 0) {
            $prom_final = ($prom_sem/$cant_sem)*100;
            return round($prom_final, 1);
        }else{
            return '-';
        }


        /*
        $prom = round($this->diaClases()->avg('ala_estado') * 100, 1);
        return $prom.' %';*/
    }
    public function prom_inasis_anual()
    {
        $prom_final = 0;
        $semestres = $this->periodo->semestres->where('sem_estado', '<>', 0);
        $cant_sem = $semestres->count();
        foreach ($this->periodo->semestres as $sem) {
            $cant_inas = $this->diaClases()->where('semestre_id', $sem->sem_id)->wherePivot('ala_estado', 0)->count();
            $total_sem = $this->diaClases->where('semestre_id', $sem->sem_id)->count();

            if ($total_sem) {
                $prom_final += $cant_inas/$total_sem;
            }else{
                $prom_final += 0;
            }
        }
        if ($cant_sem > 0) {
            $prom_final = ($prom_final/$cant_sem)*100;
            return round($prom_final, 1);
        }else{
            return '-';
        }


        /*
        $prom = round($this->diaClases()->avg('ala_estado') * 100, 1);
        return $prom.' %';*/
    }

}
