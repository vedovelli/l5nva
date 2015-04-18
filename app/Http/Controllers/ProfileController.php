<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Request as Request;

class ProfileController extends Controller {

    protected $loggedUser;

    function __construct()
    {
        $this->loggedUser = \Auth::user();
    }

	public function profile()
    {
        return view('profile.profile')->with('loggedUser', $this->loggedUser);
    }

    public function edit()
    {
		return view('profile.edit')->with('loggedUser', $this->loggedUser);
	}

	public function password()
    {
		return view('profile.password')->with('loggedUser', $this->loggedUser);
	}

    public function passwordUpdate()
    {
        $this->loggedUser->password = \Request::get('password');

        $this->loggedUser->save();

        \Auth::logout();

        return redirect('auth/login')->with('message', 'Senha atualizada. Favor logar novamente.');
    }

    public function update()
    {
        $current = $this->loggedUser->email;

        $new = \Request::get('email');

        $this->loggedUser->fill(\Request::all());

        $this->loggedUser->save();

        if($current != $new)
        {
            \Auth::logout();

            return redirect('auth/login')->with('message', 'E-mail trocado. Favor logar novamente.');
        }

        return redirect()->route('profile.index')->with('success', 'Seu usuário foi atualizado!');
    }



}
