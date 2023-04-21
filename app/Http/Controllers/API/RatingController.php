<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\RatingResource;
use App\Models\Rating;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RatingController extends BaseController
{
    
    public function create(Request $request) {
        $input = $request->all();

        $validator = Validator::make($input, [
            'rate' => 'required|numeric'
        ]);

        if($validator->fails())
            return $this->sendError("Error de validacion", $validator->errors());

        $input['customer_id'] = auth()->user()->roleable->id;
        
        $service = Service::where('customer_id', $input['customer_id'])->orderBy('created_at')->first();
        $domi_id = $service->domi_id;

        $input['domi_id'] = $domi_id;

        $rating = Rating::create($input);

        return $this->sendResponse(new RatingResource($rating), 'OK');
    }

}
