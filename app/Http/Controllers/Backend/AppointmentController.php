<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends BaseController {
    public function index(){

        $appointments = Appointment::whereStatus(1)->get();

        return $this->ResponseSuccess($appointments);
    }

    public function store(Request $request){

        $validator = Validator::make(request()->all(), [
            'booking_time_id' => 'required',
            'client_id' => 'required',
            'employee_id' => 'required',
            'price' => 'required',
            'status' => 'required',
            'service_id' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->ResponseError(0,'Invalid data.', 404);
        }
        if($request->input('id')){
            $appointment = Appointment::find($request->input('id'));
        }else{
            $appointment = new Appointment();
        }

        $appointment->booking_time_id = $request->input('booking_time_id');
        $appointment->client_id = $request->input('client_id');
        $appointment->employee_id = $request->input('employee_id');
        $appointment->price = $request->input('price');
        $appointment->status = $request->input('status');
        $appointment->service_id = $request->input('service_id');

        $appointment->save();

        return $this->ResponseSuccess($appointment, '', 'Appointment created successfully!');
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = -1;
        $appointment->save();

        return $this->ResponseSuccess($appointment, '', 'User deleted successfully!');
    }
}
