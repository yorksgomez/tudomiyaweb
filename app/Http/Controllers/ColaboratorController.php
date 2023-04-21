<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Colaborator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ColaboratorController extends BaseController
{

    private function getColaborators() {
        return User::where('role_type', 'App\Models\Colaborator')->get();
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

        $input['role_type'] = "App\Models\Colaborator";
        
        $colaborator = Colaborator::create();

        $input['role_id'] = $colaborator->id;

        User::create($input);
        
        return redirect(route('view-colaboradores'));
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('colaboradores', ['colaboradores' => $this->getColaborators()]);
    }

}
