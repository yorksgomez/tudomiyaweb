<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Pqr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;

class PqrController extends BaseController
{
    
    private function getPqrs() {
        return Pqr::get();
    }

    public function showEMbed(Pqr $pqr) {
        if(!str_starts_with($pqr->embed, 'pqr_embeds/')) abort(403);

        return Storage::response($pqr->embed);
    }

    public function create(Request $request) {
        $input = $request->all();

        $validation = Validator::make($input, [
            'full_name' => 'required',
            'email' => 'required|email',
            'type' => 'required',
            'information' => 'required',
            'embed' => [
                File::types(['pdf', 'jpg', 'jpeg', 'png'])
                ->max(10 * 1024),
            ]
        ]);

        if($validation->fails())
            return $this->sendError('Error de validacion', $validation->errors());

        $file = $request->file('embed');

        if($file != null)
            $input['embed'] = $file->store('pqr_embeds');

        $input['state'] = 'WAITING';

        Pqr::create($input);
        
        return redirect(route('create-pqr'));
    }

    public function processPqr(Pqr $pqr) {
        $pqr->state = "PROCESSED";
        $pqr->save();

        return redirect(route('view-pqrs'));
    }

    public function render() {
        return view("pqrs", ["pqrs" => $this->getPqrs()]);
    }

}
