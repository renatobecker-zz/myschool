<?php

class DisciplinasController extends BaseController {
 
    public function getIndex()
    {
		$disciplinas = Disciplina::orderBy('nome')->paginate(10);

		return View::make('disciplinas/index', compact('disciplinas'));
    }

	public function postSearch()
	{
		$q = Input::get('query');

		$disciplinas = Disciplina::where('nome', 'LIKE', '%'.$q.'%')->orderBy('nome')->paginate(10);

		return View::make('disciplinas/index', compact('disciplinas'));
	}    

    /**
     * @param  string  $slug
     * @return View
     * @throws NotFoundHttpException
    */
    public function getShow($slug)
    {
        $disciplina = Disciplina::where('slug', '=', $slug)->first();
        //Verifica se o professor existe

        if (is_null($disciplina))
        {
             // 404 error page.
            return App::abort(404);
        }
        
        $titulo = 'Disciplina';
        return View::make('disciplinas.sobre', compact('disciplina'));    
    }

    /**
     * Exibe todas as disciplinas formatadas para Datatables
     *
     * @return Datatables JSON
     */
    public function getData($id)
    {

        $disciplinas = Disciplina::select(array('disciplinas.id', 'disciplinas.nome', 'disciplinas.dia_semana', 'disciplinas.slug', 'disciplinas.created_at'))
        ->where('professor_id', $id);

        return Datatables::of($disciplinas)

        //->edit_column('comments', '{{ DB::table(\'comments\')->where(\'post_id\', \'=\', $id)->count() }}')

        ->add_column('actions', '<a href="{{{ URL::to(\'disciplinas/\' . $slug ) }}}" class="btn btn-default btn-xs iframe" >Detalhes</a>                
            ')

        ->remove_column('id')
        ->remove_column('slug')

        ->make();
    }

    public function inscricao_usuario()
    {
    	$result = false;

    	if ( Request::ajax() ) {

    		$data = Input::all();
   			$disciplina_id = $data['disciplina_id'];
   			$inscrever = $data['inscrever'];

    	} else {
    		$disciplina_id = $POST['disciplina_id'];
   			$inscrever = $POST['inscrever'];    			
    	}

    	$user = Auth::user();	

	    $registro = DisciplinaUsuario::where('disciplina_id', '=', $disciplina_id)
    	                                ->where('user_id', '=', $user->id)
    	                                ->first();                     
                                        
	    if (($inscrever == 'true') && is_null($registro)) {

    		$record = new DisciplinaUsuario;
			$record->disciplina_id = $disciplina_id;
			$record->user_id = $user->id;
			$result = $record->save();

		} else if ( ($inscrever == 'false' ) && (! is_null($registro)) ) {

			$registro->delete();
		}

		$result = DisciplinaUsuario::where('disciplina_id', '=', $disciplina_id)->count();                     

		if(Request::ajax()) {	
           	return Response::json($result);
        }
        else {
           	return $result;
        }			
	}		

}	