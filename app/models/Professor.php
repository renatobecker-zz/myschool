
<?php

class Professor extends Eloquent
{

	protected $table = 'professores';

    /**
	 * Obtem a URL do Professor
	 *
	 * @return string
	 */
	public function url()
	{
		return URL::to('professores/' . $this->slug);
	}

	public function usuario()
    {
    	return $this->belongsTo('Usuario', 'user_id');
    	//return $this->morphOne('Usuario', 'userable');
    }	

	public function disciplinas()
    {
        return $this->hasMany('Disciplina');
    }    

    public function profile_photo($heigth=200, $width=200) 
	{
    	return $this->usuario->profile_photo($heigth, $width);
	}   
}