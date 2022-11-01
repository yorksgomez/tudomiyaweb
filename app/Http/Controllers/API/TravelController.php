<?php


namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\TravelResource;
use App\Models\Service;
use App\Models\Travel;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class TravelController extends BaseController {
    
    public function create(Request $request) {
        $input = $request->all();

        $validator = Validator::make($input, [
            'location' => 'required',
            'information' => 'required',
            'domi_id' => 'required|exists:domis,id',
        ]);

        if($validator->fails())
            return $this->sendError("Error de validacion", $validator->errors());

        $input['customer_id'] = auth()->user()->roleable->id;
        $input['state'] = "ACTIVE";
        
        $travel = Travel::create();

        $input['service_type'] = 'App\Models\Travel';
        $input['service_id'] = $travel->id;

        $service = Service::create($input);

        return $this->sendResponse(new ServiceResource($service), 'OK');
    }

}