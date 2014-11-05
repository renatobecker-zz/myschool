
<?php

class Aula extends Eloquent
{

	protected $table = 'aulas';

    /**
	 * Obtem a URL da Aula
	 *
	 * @return string
	 */
	public function url()
	{
		return URL::to($this->slug);
	}

	public function date($date=null)
    {
        if(is_null($date)) {
            $date = $this->created_at;
        }

        return String::date($date);
    }

	public function created_at()
	{
		return $this->date($this->created_at);
	}


	public function disciplina()
    {
        return $this->belongsTo('Disciplina');
    }    

	public function professor()
    {
    	return $this->hasOne('Professor', 'id', 'professor_id');
    }    

}