<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
       $validator = Validator::make($request->all(), [
                'fname' => 'required|max:120',
                'lname' => 'required|max:120',
                'phone_number' => 'required|numeric',
                'person_country' => 'required',
                'person_state' => 'required',
                'person_city' => 'required',
            ]);
}
