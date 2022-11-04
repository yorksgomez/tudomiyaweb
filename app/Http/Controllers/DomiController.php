<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Application;
use App\Models\Domi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DomiController extends BaseController
{

    private function getDomis() {
        return User::where('role_type', 'App\Models\Domi')->get();
    }

    private function getApplications() {
        return Application::get();
    }

    public function put(Request $request) {
        $input = $request->all();

        $validation = Validator::make($input, [
            'name' => 'required',
            'lastname' => 'required',
            'nit' => 'required|unique:users|unique:users',
            'email' => 'required|email|unique:users|unique:users',
            'phone' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);

        if($validation->fails())
            return $this->sendError('Error de validacion', $validation->errors());

        $input['password'] = bcrypt($input['password']);

        $input['role_type'] = "App\Models\Domi";
        
        $domi = Domi::create();

        $input['role_id'] = $domi->id;

        User::create($input);
        
        return redirect(route('view-domiciliarios'));
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('domiciliarios', ['domis' => $this->getDomis(), 'applications' => $this->getApplications()]);
    }

}
