
<?php

class Disciplina extends Eloquent
{
    /**
	 * Obtem a URL da disciplina
	 *
	 * @return string
	 */
	public function url()
	{
		return URL::to($this->slug);
	}

	public function str_day(){

		$days = $this->getDays();
		return ($this->dia_semana <= 6) ? $days[$this->dia_semana ] : 'Não informado';		
	}

    public function delete()
    {
        // Deleta Aulas relacionadas
        $this->aulas()->delete();

        // Deleta usuários relacionadas
        $this->usuarios()->delete();

        // Deleta o registro da Aula
        return parent::delete();
    }

    public static function getDays()
    {
        $days = array();
        $days[1] = 'Segunda-Feira';
        $days[2] = 'Terça-Feira';
        $days[3] = 'Quarta-Feira';        
        $days[4] = 'Quinta-Feira';
        $days[5] = 'Sexta-Feira';
        $days[6] = 'Sábado';        

        return $days;
    }

	public function professor()
    {
        return $this->hasOne('Professor', 'id', 'professor_id');
    }	

    public function aulas()
    {
        return $this->hasMany('Aula');
    }

    public function usuarios()
    {
        return $this->hasMany('DisciplinaUsuario', 'disciplina_id', 'id');
    }

    /**
    * Retorna o background image ou imagem pdrão
    *
    * @return string
    */
    public function background_photo($heigth=1920, $width=400) 
    {
        return (strlen($this->photo) == 0) ? "http://placehold.it/" . $heigth . "x" . $width . '"' : URL::to('/img/'. $this->photo);
    }   

    public function usuario_inscrito($user)
    {    

        if(!empty($user)) {

            $registro = DisciplinaUsuario::where('disciplina_id', '=', $this->id)
                                           ->where('user_id', '=', $user->id)
                                           ->first();
            return (! is_null($registro));
        }
        
        return false;    
    }

}