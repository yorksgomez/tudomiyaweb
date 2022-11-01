<?php


namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\ServiceResource;
use App\Models\Delivery;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class DeliveryController extends BaseController {
    
    public function create(Request $request) {
        $input = $request->all();

        $validator = Validator::make($input, [
            'location' => 'required',
            'information' => 'required',
            'domi_id' => 'required|exists:domis,id',
        ]);

        if($validator->fails())
            return $this->sendError("Error de validacion", $validator->errors());

        $input['customer_id'] = User::find(auth()->user()->id)->roleable->id;
        $input['state'] = "ACTIVE";

        $delivery = Delivery::create();

        $input['service_type'] = "App\Models\Delivery";
        $input['service_id'] = $delivery->id;

        $service = Service::create($input);

        return $this->sendResponse(new ServiceResource($service), 'OK');
    }

}