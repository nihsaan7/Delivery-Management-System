<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeliveryRequest;
use Illuminate\Support\Facades\Validator;

class DeliveryManagmentController extends Controller
{
    public function index(Request $request){

        $delivery_request = DeliveryRequest::paginate(5);
        return view('delivery_mangement.index', compact('delivery_request'));
    }

    public function create(Request $request){

        return view('delivery_mangement.create');

    }

    public function store(Request $request)
    {
        // dd($request);

        // Validation rules
        $validator = Validator::make($request->all(), [
            'pickup_address' => 'required|string',
            'pickup_name' => 'required|string',
            'pickup_contact_no' => 'required|string|regex:/^\d+$/', // Must be numeric
            'pickup_email' => 'nullable|email',
            'delivery_address' => 'required|string',
            'delivery_name' => 'required|string',
            'delivery_contact_no' => 'required|string|regex:/^\d+$/', // Must be numeric
            'delivery_email' => 'nullable|email',
            'type_of_good' => 'required',
            'delivery_provider' => 'required', 
            'priority' => 'required',
            'shipment_pickup_date' => 'required|date',
            'shipment_pickup_time' => 'required|date_format:H:i',
            'package_description' => 'required|string',
            'length' => 'required|integer|min:0',
            'height' => 'required|integer|min:0',
            'width' => 'required|integer|min:0',
            'weight' => 'required|integer|min:0',
        ]);

        // If validation fails, return back with errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $add = new DeliveryRequest;
        $add->pickup_address = $request->pickup_address;
        $add->pickup_name = $request->pickup_name;
        $add->pickup_contact_no = $request->pickup_contact_no;
        $add->pickup_email = $request->pickup_email;
        $add->delivery_address = $request->delivery_address;
        $add->delivery_name = $request->delivery_name;
        $add->delivery_contact_no = $request->delivery_contact_no;
        $add->delivery_email = $request->delivery_email;
        $add->type_of_good = $request->type_of_good;
        $add->delivery_provider = $request->delivery_provider;
        $add->priority = $request->priority;
        $add->shipment_pickup_date = $request->shipment_pickup_date;
        $add->shipment_pickup_time = $request->shipment_pickup_time;
        $add->package_description = $request->package_description;
        $add->length = $request->length;
        $add->height = $request->height;
        $add->width = $request->width;
        $add->weight = $request->weight;
        $add->status = 0;        
        $add->save();
       
        return redirect()->route('deliverRequest.index')->with('success', 'Delivery request submitted successfully!');
    }


    public function statusChange(Request $request)
    {
        // dd($request);

        $update = DeliveryRequest::find($request->hiddenID);

        if($update->status == 2 || $update->status == 3){
            return back()->with('withErrors', 'Can not cancel at this stage!');
        }

        $update->status = 1;
        $update->save();

        return redirect()->route('deliverRequest.index')->with('success', 'Cancelled successfully!');
    }

}
