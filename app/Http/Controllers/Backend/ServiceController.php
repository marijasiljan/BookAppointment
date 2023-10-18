<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BaseController;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends BaseController {

    public function index(){

        $services = Service::all();

        return $this->ResponseSuccess($services);
    }

    public function store(Request $request){

        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'category' => 'required',
            'price_id' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->ResponseError(0,'Invalid data.', 404);
        }

        $service = new Service();
        $service->name = $request->input('name');
        $service->category = $request->input('category');
        $service->price_id = $request->input('price_id');
        $service->status = $request->input('status');

        $service->save();

        return $this->ResponseSuccess($service, '', 'Service added successfully!');
    }

}
