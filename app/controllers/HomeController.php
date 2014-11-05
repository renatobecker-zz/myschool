<?php

class HomeController extends BaseController {
 
    public function getIndex()
    {
        return View::make('home/index');
    }

    public function getRegistrar(){

        if (Auth::check())
        {
            return Redirect::to('/');    
        }

        $mode = 'create';
        $titulo = 'Registrar - MySchool';
        return View::make('home/registrar', compact('titulo', 'mode'));
    }

    public function postRegistrar(){
        
        // Validate the inputs
        $validator = Validator::make(Input::all(), Usuario::$rules);

 
        if ($validator->passes()) {

            $usuario = new Usuario();
            $usuario->nome = Input::get( 'nome' );
            $usuario->email = Input::get( 'email' );
            $usuario->senha = Hash::make(Input::get( 'senha' ));
            
            $usuario->save();

            // Autenticação
            if (Auth::attempt(array(
                'email' => Input::get('email'),
                'password' => Input::get('senha')
                )))
            {
                return Redirect::to('/');
            }

        } else {
            return Redirect::to('registrar')->withInput(Input::except('senha'))->withErrors($validator);                
        }
    }
 
    public function getEntrar()
    {
        $titulo = 'Entrar - MySchool';
        return View::make('home/entrar', compact('titulo'));
    }
 
    public function postEntrar()
    {
        // Opção de lembrar do usuário
        $remember = false;
        if(Input::get('remember'))
        {
            $remember = true;
        }
        
        // Autenticação
        if (Auth::attempt(array(
            'email' => Input::get('email'),
            'password' => Input::get('senha')
            ), $remember))
        {
            return Redirect::to('/');
        }
        else
        {
            return Redirect::to('entrar')
                ->with('flash_error', 1)
                ->withInput();
        }
    }
    
    public function getSair()
    {
        Auth::logout();
        return Redirect::to('/entrar');
    }
}