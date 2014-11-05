
<?php

class DisciplinaUsuario extends Eloquent
{

    protected $table = 'disciplinas_usuarios';

    public function disciplina()
    {
        return $this->belongsTo('Disciplina', 'disciplina_id');        
    }

    public function usuario()
    {
        return $this->belongsTo('Usuario', 'user_id');        
    }

}