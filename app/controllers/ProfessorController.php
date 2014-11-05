<?php

class ProfessorController extends BaseController {
 
    public function getIndex()
    {
		$professores = Professor::orderBy('created_at', 'DESC')->get();//->paginate(10);

		return View::make('professor/index', compact('professores'));
    }

    /**
     * @param  string  $slug
     * @return View
     * @throws NotFoundHttpException
    */
    public function getShow($slug)
    {
        $professor = Professor::where('slug', '=', $slug)->first();
        //Verifica se o professor existe

        if (is_null($professor))
        {
             // 404 error page.
            return App::abort(404);
        }
        
        $titulo = 'Professor';
        return View::make('professor.sobre', compact('professor'));    
    }


}