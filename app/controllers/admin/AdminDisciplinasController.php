<?php

class AdminDisciplinasController extends AdminController {
 
    public function getIndex()
    {
        $id = $this->getCurrentProfessor();

        $titulo = 'Disciplinas'; 
        $disciplinas = Disciplina::where('professor_id', $id)->orderBy('created_at', 'DESC')->get();
        return View::make('admin.disciplinas.index', compact('disciplinas', 'titulo'));
    }
 
    public function getInserir()
    {
        $titulo = 'Inserir Disciplinas';
        $days = Disciplina::getDays();
        return View::make('admin.disciplinas.inserir', compact('titulo', 'days'));
    }
    
    public function postInserir()
    {
        // Declarar as regras de validação
        $rules = array(
            'nome'   => 'required|min:3',
            'descricao' => 'required|min:3',
            'dia_semana' => 'required',
            'check_in_inicio' => 'required',
            'check_in_final' => 'required',
            'inicio_semestre' => 'required',
            'fim_semestre' => 'required'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {       

            $check_in = explode(":",Input::get('check_in_inicio'));
            $minutes_check_in = intval($check_in[0])*60 + intval($check_in[1]);

            $check_out = explode(":",Input::get('check_in_final'));
            $minutes_check_out = intval($check_out[0])*60 + intval($check_out[1]);

            $disciplina = new Disciplina();
 
            $disciplina->nome      = Input::get('nome');
            $disciplina->descricao = Input::get('descricao');
            $disciplina->slug      = Str::slug(Input::get('nome'));
            $disciplina->dia_semana = Input::get('dia_semana');            
            $disciplina->check_in_inicio = $minutes_check_in;
            $disciplina->check_in_final = $minutes_check_out;
            $disciplina->inicio_semestre = Input::get('inicio_semestre');
            $disciplina->fim_semestre = Input::get('fim_semestre');
            $disciplina->professor_id = $this->getCurrentProfessor();
            $disciplina->save();
 
            return Redirect::to('/admin/disciplinas');
        }    
        //Erro de validação de formulário
        return Redirect::to('admin/disciplinas/inserir')->withInput()->withErrors($validator);        
    }

    /**
     * @param  string  $slug
     * @return View
     * @throws NotFoundHttpException
    */
    public function getEditar($id)
    {
        //$disciplina = Disciplina::where('slug', '=', $slug)->first();
        $disciplina = Disciplina::find($id);
        //Verifica se a disciplina existe

        if (is_null($disciplina))
        {
             // 404 error page.
            return App::abort(404);
        }

        //Converte a quantidade de minutos em hora str
        $mm_inicio = $disciplina->check_in_inicio;
        $str_check_in_inicio = gmdate("H:i", ($mm_inicio * 60));

        $mm_final = $disciplina->check_in_final;
        $str_check_in_final = gmdate("H:i", ($mm_final * 60));
        // Declarar as regras de validação
        $titulo = 'Editar Disciplina';
        $days = Disciplina::getDays();
        return View::make('admin.disciplinas.editar', compact('disciplina', 'titulo', 'days', 'str_check_in_inicio', 'str_check_in_final'));    
    }
    
    public function postEditar()
    {
        $disciplina = Disciplina::find(Input::get('id'));
         $rules = array(
            'nome'   => 'required|min:3',
            'descricao' => 'required|min:3',
            'dia_semana' => 'required',
            'check_in_inicio' => 'required',
            'check_in_final' => 'required',
            'inicio_semestre' => 'required',
            'fim_semestre' => 'required'            
        );
        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);
        // Check if the form validates with success
        if ($validator->passes())
        {        

            $check_in = explode(":",Input::get('check_in_inicio'));
            $minutes_check_in = intval($check_in[0])*60 + intval($check_in[1]);

            $check_out = explode(":",Input::get('check_in_final'));
            $minutes_check_out = intval($check_out[0])*60 + intval($check_out[1]);

            $disciplina->nome       = Input::get('nome');
            $disciplina->descricao  = Input::get('descricao');
            $disciplina->slug       = Str::slug(Input::get('nome'));
            $disciplina->dia_semana = Input::get('dia_semana');
            $disciplina->check_in_inicio = $minutes_check_in;
            $disciplina->check_in_final = $minutes_check_out;
            $disciplina->inicio_semestre = Input::get('inicio_semestre');
            $disciplina->fim_semestre = Input::get('fim_semestre');
            $disciplina->save();
 
            return Redirect::to('/admin/disciplinas');
        }
        //Erro de validação de formulário
        return Redirect::to('admin/disciplinas/editar/' . $disciplina->id)->withInput()->withErrors($validator);
    }
    
    private function getCurrentProfessor()
    {
        $user = Auth::user();
        $professor = $user->professor();

        return $professor->first()->id;
    }

    public function getRemover($id)
    {
        $disciplina = Disciplina::find($id);
        $disciplina->delete();
        
        return Redirect::to('/admin/disciplinas');
    }

    /**
     * Exibe todas as disciplinas formatadas para Datatables
     *
     * @return Datatables JSON
     */
    public function getData()
    {

        $id = $this->getCurrentProfessor();
        $disciplinas = Disciplina::select(array('disciplinas.id', 'disciplinas.nome', 'disciplinas.dia_semana', 'disciplinas.slug', 'disciplinas.created_at'))
        ->where('professor_id', $id);

        return Datatables::of($disciplinas)

        //->edit_column('comments', '{{ DB::table(\'comments\')->where(\'post_id\', \'=\', $id)->count() }}')

        ->add_column('actions', '<a href="{{{ URL::to(\'admin/disciplinas/editar/\' . $id ) }}}" class="btn btn-default btn-xs iframe" >Editar</a>
                <a href="{{{ URL::to(\'admin/disciplinas/remover/\' . $id) }}}" class="btn btn-xs btn-danger iframe">Remover</a>
            ')

        ->remove_column('id')
        ->remove_column('slug')

        ->make();
    }

}