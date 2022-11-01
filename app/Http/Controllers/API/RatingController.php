<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\RatingResource;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RatingController extends BaseController
{
    
    public function create(Request $request) {
        $input = $request->all();

        $validator = Validator::make($input, [
            'domi_id' => 'required',
            'rate' => 'required|numeric'
        ]);

        if($validator->fails())
            return $this->sendError("Error de validacion", $validator->errors());

        $input['customer_id'] = auth()->user()->roleable->id;
        
        $rating = Rating::create($input);

        return $this->sendResponse(new RatingResource($rating), 'OK');
    }

}
