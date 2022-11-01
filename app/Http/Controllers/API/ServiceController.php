<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\ServiceResource;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class ServiceController extends BaseController
{
    
    public function getUserServices() {
        $customer = User::find(auth()->user()->id)->role_id;

        return $this->sendResponse(ServiceResource::collection(Service::where('customer_id', $customer)->get()), 'OK');
    }

}
