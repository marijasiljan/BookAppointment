<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BaseController;
use App\Models\BookingTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingTimeController extends BaseController {

    public function index(){

        $bookingTimes = BookingTime::whereStatus(1)->get();

        return $this->ResponseSuccess($bookingTimes);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'status' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return $this->ResponseError(0,'Invalid data.', 404);
        }
        if($request->input('id')){
            $bookingTime = BookingTime::find($request->input('id'));
        }else{
            $bookingTime = new BookingTime;
        }

        $bookingTime->start_time = $request->input('start_time');
        $bookingTime->end_time = $request->input('end_time');
        $bookingTime->status = $request->input('status');

        $bookingTime->save();

        return $this->ResponseSuccess($bookingTime, '', 'Booking Time Slot created successfully');
    }

    public function destroy($id)
    {
        $bookingTime = BookingTime::findOrFail($id);
        $bookingTime->status = -1;
        $bookingTime->save();

        return $this->ResponseSuccess($bookingTime, '', 'User deleted successfully!');
    }

}
