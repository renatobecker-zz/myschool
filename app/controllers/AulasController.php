<?php

class AulasController extends BaseController {

	/**
	 * Envia todas as aulas em JSON
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json(Aula::with('disciplina')->with('professor.usuario')->orderBy('data', 'DESC')->get());
	}

}