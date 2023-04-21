<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Application;
use App\Models\Domi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;

class ApplicationController extends BaseController {

    public function create(Request $request) {
        $input = $request->all();

        $validation = Validator::make($input, [
            'name' => 'required',
            'lastname' => 'required',
            'nit' => 'required|unique:users|unique:applications',
            'email' => 'required|email|unique:users|unique:applications',
            'phone' => 'required',
            'curriculum' => [
                'required',
                File::types(['pdf'])
                ->max(10 * 1024),
            ]
        ]);

        if($validation->fails())
            return $this->sendError('Error de validacion', $validation->errors());

        $file = $request->file('curriculum');
        
        $input['curriculum'] = $file->store('curriculums');

        $input['state'] = 'WAITING';

        Application::create($input);
        
        return redirect(route('create-domi'));
    }

    public function showCurriculum(Application $application) {
        if(!str_starts_with($application->curriculum, 'curriculums/')) abort(403);

        return response(Storage::get($application->curriculum))->header('Content-Type', 'application/pdf');
    }

    public function acceptApplication(Application $application) {
        $input = $application->toArray();

        $domi = Domi::create();

        $input['role_type'] = "App\Models\Domi";
        $input['role_id'] = $domi->id;

        $input['password'] = bcrypt('abc12345');

        User::create($input);

        $application->state = 'APPROVED';
        $application->save();

        return redirect(route('view-domiciliarios'));
    }

    public function rejectApplication(Application $application) {
        $application->state = 'REJECTED';
        $application->save();

        return redirect(route('view-domiciliarios'));
    }

}