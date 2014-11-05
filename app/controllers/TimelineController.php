<?php

class TimelineController extends BaseController {
 
    public function getIndex()
    {
		//$professores = Professor::orderBy('created_at', 'DESC')->get();//->paginate(10);

		return View::make('timeline/index', compact('disciplinas'));
    }

}