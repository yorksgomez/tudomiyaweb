<?php


namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends BaseController {
    
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request) {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users',
            'nit' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'phone' => 'required'
        ]);

        if($validator->fails())
            return $this->sendError('Error de validación', $validator->errors());

        $input['password'] = bcrypt($input['password']);

        $input['role_type'] = "App\Models\Customer";
        
        $customer = Customer::create([]);

        $input['role_id'] = $customer->id;

        User::create($input);

        return $this->sendResponse('Usuario creado', 'Usuario registrado correctamente');
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request) {
        
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = auth()->user();
            
            $success['token'] = $user->createToken('tudomiyacustomer')->plainTextToken;
            $success['user'] = $user;
        
            return $this->sendResponse($success, 'Usuario logueado correctamente');
        } else {
            return $this->sendError('No autorizado', ['error' => 'No autorizado']);
        }

    }

}