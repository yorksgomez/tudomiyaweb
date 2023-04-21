<?php

namespace App\Http\Controllers\API\Domi;

use App\Http\Controllers\API\BaseController;
use App\Http\Resources\ServiceResource;
use App\Models\Delivery;
use App\Models\Service;
use App\Models\Travel;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ServiceController extends BaseController
{
    
    public function create(Request $request) {
        $input = $request->all();

        $validator = Validator::make($input, [
            'location' => 'required',
            'information' => 'required',
            'service_type' => 'required'
        ]);

        if($validator->fails())
            return $this->sendError("Error de validacion", $validator->errors());

        $input['customer_id'] = auth()->user()->roleable->id;
        $input['state'] = "ACTIVE";

        if($input['service_type'] == "App\\Models\\Travel") {
            $travel = Travel::create();
            $input['service_id'] = $travel->id;
        } else if($input['service_type'] == "App\\Models\\Delivery") {
            $delivery = Delivery::create();
            $input['service_id'] = $delivery->id;
        } else {
            abort(403);
        }

        $input['domi_id'] = 1;

        $service = Service::create($input);

        $service->domi;
        $service->domi->user;

        return $this->sendResponse($service, 'OK');
    }

    public function cancel(Request $request) {
        $customer_id = auth()->user()->role_id;

        Service::where('customer_id', $customer_id)->where('state', 'ACTIVE')->update(['state' => 'CANCELLED']);
        $service = Service::orderBy('created_at')->first();

        return $this->sendResponse(new ServiceResource($service)    , 'OK');
    }

    public function getUserServices() {
        $customer = User::find(auth()->user()->id)->role_id;

        return $this->sendResponse(ServiceResource::collection(Service::where('customer_id', $customer)->get()), 'OK');
    }

}
