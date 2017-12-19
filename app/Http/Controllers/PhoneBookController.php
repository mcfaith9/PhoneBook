<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Person;
use App\Country;
use App\States;
use App\Cities;
use Validator;

class PhoneBookController extends Controller
{
    
    public function submit(Request $request){
        
       $validator = Validator::make($request->all(), [
                'fname' => 'required|max:120',
                'lname' => 'required|max:120',
                'phone_number' => 'required|numeric',
                'person_country' => 'required',
                'person_state' => 'required',
                'person_city' => 'required',
            ]);
         
         if($validator->passes()) {

          $person = new Person;

          $person->fname = $request->input('fname');
          $person->lname = $request->input('lname');
          $person->phone_number = $request->input('phone_number');
          $person->mobile_number = $request->input('mobile_number');
          $person->person_country = $request->input('person_country');
          $person->person_state = $request->input('person_state');
          $person->person_city = $request->input('person_city');
          $person->person_street = $request->input('person_street');
          $person->save();  
          
          return response()->json(['success'=>'Added new records.']);
         }
           
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function view(){
      $countries = Country::all();
      $people = Person::all();
      return view('welcome', compact('countries','people'));
    }

    public function getStates(Request $request)
    {
      $states =States::select('id','name')->where('country_id',$request->id)->get();
      return response()->json($states);
    }

    public function getCities(Request $request)
    {
      $cities =Cities::select('id','name')->where('state_id',$request->id)->get();
      return response()->json($cities);
    }
}
