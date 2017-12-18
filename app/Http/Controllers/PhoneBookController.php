<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Person;
use App\Country;
use App\States;
use App\Cities;

class PhoneBookController extends Controller
{
    
    public function submit(Request $request){
        
       $this->validate($request, [
                'fname' => 'required|max:120',
                'lname' => 'required|max:120',
                'phone_number' => 'required|numeric',
            ]);

        $person = new Person;

        $person->fname = $request->input('fname');
        $person->lname = $request->input('lname');
        $person->phone_number = $request->input('phone_number');
        $person->mobile_number = $request->input('mobile_number');
        $person->save();

        return redirect('/');
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
