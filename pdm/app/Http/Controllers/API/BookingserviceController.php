<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bookingservice;
use Illuminate\Support\Facades\Validator;
class BookingserviceController extends Controller
{
    public function getBookingService($id){
        $book = Bookingservice::where('booking_id', $id)->get();
        return response()->json($book);
    }

    public function saveBookingService(Request $request){

        $validator = Validator::make($request->all(),[
            'service_id' => 'sometimes|nullable',
            'booking_id' => 'sometimes|nullable',
            'quantity' => 'sometimes|nullable',
            'amount' => 'sometimes|nullable',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }
        foreach($request->bookings as $book) {
            $program = Bookingservice::create([
                'service_id' => $book['service_id'],
                'booking_id' => $book['booking_id'],
                'quantity' => $book['quantity'],
                'amount' => $book['amount'],
            ]);
        }

        return response()->json(['Booking created successfully.', $request->bookings]);
    }


    public function updateBookingService(Request $request, $id){
        Bookingservice::where('booking_id', $id)->delete();
        $validator = Validator::make($request->all(),[
            'service_id' => 'sometimes|nullable',
            'booking_id' => 'sometimes|nullable',
            'quantity' => 'sometimes|nullable',
            'amount' => 'sometimes|nullable',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }
        foreach($request->bookings as $book) {
            $program = Bookingservice::create([
                'service_id' => $book['service_id'],
                'booking_id' => $book['booking_id'],
                'quantity' => $book['quantity'],
                'amount' => $book['amount'],
            ]);
        }
        return response()->json(['Booking created successfully.', $request->bookings]);
    }

}
