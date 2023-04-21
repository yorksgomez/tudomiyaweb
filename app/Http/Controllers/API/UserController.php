<?php


namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController {
    
    public function getCurrentUser(Request $request) {
        $user = auth()->user();
        return $this->sendResponse(new UserResource($user), 'Usuario obtenido correctamente');
    }

    public function updateCurrentUser(Request $request) {
        $user = User::find(auth()->user()->id);

        $input = $request->all();
        
        $validator = Validator::make($input, [
            'name' => 'string',
            'lastname' => 'string',
            'email' => 'prohibited',
            'nit' => 'string',
            'password' => 'prohibited',
            'c_password' => 'prohibited',
            'phone' => 'string',
            'role_type' => 'prohibited',
            'role_id' => 'prohibited',
        ]);
        
        if($validator->fails())
            return $this->sendError("Error de validacion", $validator->errors());

        $user->fill($input)->save();

        return $this->sendResponse('Usuario actualizado correctamente', 'OK');

    }

}
