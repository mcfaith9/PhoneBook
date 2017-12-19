<!DOCTYPE html>
<html>
    <head>
        <title>Phone Book</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/phonebook_form.css') }}">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            /*For my table*/
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;                
            }

            td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even) {
                background-color: #dddddd;
            }
        </style>
    </head>
    <body>

    <div class="print-error-msg" style="display:none">
    <ul></ul>
    </div>
     
     <form class="form-style-4" method="POST" action="{{ url('/submit')}}">
             
         <label for="field1">
         <span>First Name</span><input type="text" name="fname" value="{{ Request::old('fname') }}" class="req-input" />
         </label>
      
         <label for="field1">
         <span>Last Name</span><input type="text" name="lname" value="{{ Request::old('lname') }}" class="req-input" />
         </label>

         <label for="field1">
         <span>Contact Number</span><input type="text" name="phone_number" value="{{ Request::old('phone_number') }}" class="req-input" />
         </label>

         <label for="field1">
         <span>Tel. Number</span><input type="text" name="mobile_number" value="{{ Request::old('mobile_number') }}"/>
         </label>
         
         <select class="country" onchange="myFunction1()" id="mySelect">
             <option value="0" selected disabled>Select Country</option>
             @foreach($countries as $country)
             <option value="{{$country->id}}">{{$country->name}}</option>
             @endforeach
         </select>
         <input type="hidden" name="person_country" id="getCountry">                 
         
         <select class="states" onchange="myFunction2()" id="mySelect2">
         </select>
         <input type="hidden" name="person_state" id="getState">

         <select class="cities" onchange="myFunction3()" id="mySelect3">        
         </select>
         <input type="hidden" name="person_city" id="getCity">

         <label for="field1">
         <span>Street</span><input type="text" name="person_street" value="{{ Request::old('person_street') }}"" />
         </label>

     <button class="btn-submit">Submit</button>
     </form>
               

    <table>
        <tbody>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone Number</th>
                <th>Mobile Number</th>
                <th>Country</th>
                <th>State</th>
                <th>City</th>
                <th>Street</th>
            </tr>
            
            @foreach($people as $person)
            <tr>
                <td>{{$person->fname}}</td>
                <td>{{$person->lname}}</td>
                <td>{{$person->phone_number}}</td>
                <td>{{$person->mobile_number ? $person->mobile_number : 'NA'}}</td>
                <td>{{$person->person_country}}</td>
                <td>{{$person->person_state}}</td>
                <td>{{$person->person_city}}</td>
                <td>{{$person->person_street ? $person->person_street : 'NA'}}</td>
            </tr>
            @endforeach    
            
        </tbody>
    </table>
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script type="text/javascript">
      //for my dynamic phonebook country states drop down list dependent
      $(document).ready(function(){
            //For my Country State Dynamic
            $(document).on('change','.country',function(){
                var id=$(this).val();
                var div=$(this).parent();

                var op="<option value='0' selected disabled>State/Province</option>";

                  $.ajax({
                      type:'get',
                      url:'{!!URL::to("/state")!!}',
                      data:{'id':id},
                      success:function(data){

                          for(var i=0;i<data.length;i++){
                          op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
                         }

                         div.find('.states').html(" ");
                         div.find('.states').append(op);
                      },
                      error:function(){

                      }

                  });
            });
            //For my State City Dynamic
            $(document).on('change','.states',function(){
                var id=$(this).val();
                var div=$(this).parent();

                var op="<option value='0' selected disabled>Select City</option>";

                  $.ajax({
                      type:'get',
                      url:'{!!URL::to("/cities")!!}',
                      data:{'id':id},
                      success:function(data){

                          for(var i=0;i<data.length;i++){
                          op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
                         }

                         div.find('.cities').html(" ");
                         div.find('.cities').append(op);
                      },
                      error:function(){

                      }

                  });
            });

            $('.country').trigger('change')
            $('.states').trigger('change')

            
            //Store Data using validation
            $(".btn-submit").click(function(e){
                e.preventDefault();
                var _token = $("input[name='_token']").val();
                var fname = $("input[name='fname']").val();
                var lname = $("input[name='lname']").val();
                var phone_number = $("input[name='phone_number']").val();
                var mobile_number = $("input[name='mobile_number']").val();
                var person_country = $("input[name='person_country']").val();
                var person_state = $("input[name='person_state']").val();
                var person_city = $("input[name='person_city']").val();
                var person_street = $("input[name='person_street']").val();


                $.ajax({
                    url: "submit",
                    type:'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    data: {fname:fname, lname:lname, phone_number:phone_number, mobile_number:mobile_number, person_country:person_country,
                            person_state:person_state, person_city:person_city, person_street:person_street },
                    success: function(data) {

                        console.log(data);

                        if($.isEmptyObject(data.error)){
                            console.log(data.success);
                        }else{
                            printErrorMsg(data.error);
                        }
                    }
                });
            }); 

            function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").empty();
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append("<li>"+value+"</li>");
            });
            }

      });

      function myFunction1() {
         var x = document.getElementById("mySelect").value;
         document.getElementById("getCountry").value = x;
      }

      function myFunction2() {
         var x = document.getElementById("mySelect2").value;
         document.getElementById("getState").value = x;
      }

      function myFunction3() {
         var x = document.getElementById("mySelect3").value;
         document.getElementById("getCity").value = x;
      }
    </script>


    </body>
</html>
