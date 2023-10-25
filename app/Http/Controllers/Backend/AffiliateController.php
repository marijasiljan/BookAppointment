<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AffiliateController extends BaseController {

    public function index(){

        $affiliates = Affiliate::whereStatus(1)->get();

        return $this->ResponseSuccess($affiliates);
    }

    public function store(Request $request){

        $validator = Validator::make(request()->all(), [
            'email' => 'required',
            'address' => 'required',
            'city' => 'required',
            'phone' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->ResponseError(0,'Invalid data.', 404);
        }
        if($request->input('id')){
            $affiliate = Affiliate::find($request->input('id'));
        }else{
            $affiliate = new Affiliate();
        }

        $affiliate->email = $request->input('email');
        $affiliate->address = $request->input('address');
        $affiliate->city = $request->input('city');
        $affiliate->phone = $request->input('phone');
        $affiliate->status = $request->input('status');

        $affiliate->save();

        return $this->ResponseSuccess($affiliate, '', 'Affiliate added successfully!');
    }

    public function destroy($id)
    {
        $affiliate = Affiliate::findOrFail($id);
        $affiliate->status = -1;
        $affiliate->save();

        return $this->ResponseSuccess($affiliate, '', 'User deleted successfully!');
    }

}
