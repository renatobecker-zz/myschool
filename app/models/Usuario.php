<?php
 
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
 
class Usuario extends Eloquent implements UserInterface, RemindableInterface {
 
/**
* The database table used by the model.
*
* @var string
*/
protected $table = 'usuarios';
 
/**
* The attributes excluded from the model's JSON form.
*
* @var array
*/
protected $hidden = array('senha');
 
/**
* Get the unique identifier for the user.
*
* @return mixed
*/
public function getAuthIdentifier()
{
return $this->getKey();
}
 
/**
* Get the password for the user.
*
* @return string
*/
public function getAuthPassword()
{
return $this->senha;
}
 
/**
* Get the e-mail address where password reminders are sent.
*
* @return string
*/
public function getReminderEmail()
{
return $this->email;
}
        
/**
* Retorna a imagem do usuário ou imagem pdrão
*
* @return string
*/
public function profile_photo($heigth=200, $width=200) 
{
    return (strlen($this->photo) == 0) ? "http://placehold.it/" . $heigth . "x" . $width . '"' : $this->photo;
}   

//public function userable()
//{
//    return $this->morphTo();
//}

public function disciplinas()
{
    return $this->hasManyThrough('Disciplina', 'DisciplinaUsuario', 'disciplina_id', 'user_id');
}


public function professor()
{
    return $this->hasOne('Professor', 'user_id')->get();
}

/**
* Get the token value for the "remember me" session.
*
* @return string
*/
public function getRememberToken()
{
    return $this->remember_token;
}
 
/**
* Set the token value for the "remember me" session.
*
* @param  string  $value
* @return void
*/
public function setRememberToken($value)
{
    $this->remember_token = $value;
}
 
/**
* Get the column name for the "remember me" token.
*
* @return string
*/
public function getRememberTokenName()
{
    return 'remember_token';
}

public static $rules = array(
        'nome'=>'required|min:2',
        'email'=>'required|email|unique:usuarios',
        'senha'=>'required|alpha_num|between:6,12',
        //'password_confirmation'=>'required|alpha_num|between:6,12'
    );        
 
}