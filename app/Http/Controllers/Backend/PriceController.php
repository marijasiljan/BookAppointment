<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BaseController;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PriceController extends BaseController {

    public function index(){

        $prices = Price::all();

        return $this->ResponseSuccess($prices);
    }

    public function store(Request $request){

        $validator = Validator::make(request()->all(), [
            'service_id' => 'required',
            'value' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->ResponseError(0,'Invalid data.', 404);
        }

        $price = new Price();
        $price->service_id = $request->input('service_id');
        $price->value = $request->input('value');
        $price->status = $request->input('status');

        $price->save();

        return $this->ResponseSuccess($price, '', 'Price added successfully!');
    }

}
