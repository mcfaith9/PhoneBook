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
                font-weight: 100;
                font-family: 'Lato';
                position: fixed;
                background-image: url('{{ asset("img/gbg.jpg") }}');
            }

            /*For my table*/
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;     
                height: auto;     
            }

            td, th {
                border: 1px dashed black;
                text-align: left;
                padding: 10px;
            }
            th{
                background: #4CAF50;
                color: white;
            }
            tr:hover {background-color: #f2f2f2;}
            tr:hover:nth-child(even) {background-color: #f2f2f2;}
            tbody{
                overflow: auto;
            }

            tr:nth-child(even) {
                background-color: #ddd;
            }
            .form-error{
               box-shadow: 0px 4px 20px -2px red;            
            }

           .form-error-text{
            font-size: 15px;
            height: 25px;
            color: white;
            text-shadow: 0px 0px 8px red;
           }
           .div-side{
            float: right; 
            display: block; 
            height: auto;  
            position: absolute; 
            margin-left: 400px;  
            margin-top: 100px;  
           }
           .div-side1{            
            float: left;  
            display: block; 
           }
        </style>
    </head>
    <body>
<!-- 
    <div class="print-error-msg" style="display:none;">
    <ul></ul>
    </div> -->
     <div class="div-side1">
     <form id="resetForm" class="form-style-4" method="POST" action="{{ url('/submit')}}">
             
         <label for="field1">
         <span>First Name</span><input type="text" name="fname" value="{{ Request::old('fname') }}" class="req-input-fn" />         
         </label>
         <div class="print-error-msg" style="display:none; margin-left: 30px;">
         <span id="form-text1"></span>         
         </div>

         <label for="field1">
         <span>Last Name</span><input type="text" name="lname" value="{{ Request::old('lname') }}" class="req-input-ln" />
         </label>
         <div class="print-error-msg" style="display:none; margin-left: 30px;">
         <span id="form-text2"></span>
         </div>

         <label for="field1">
         <span>Contact Number</span><input type="text" name="phone_number" value="{{ Request::old('phone_number') }}" class="req-input-pm" />
         </label>
         <div class="print-error-msg" style="display:none; margin-left: 30px;">
         <span id="form-text3"></span>
         </div>

         <label for="field1">
         <span>Tel. Number</span><input type="text" name="mobile_number" placeholder="*Optional" value="{{ Request::old('mobile_number') }}" pattern="\d{3}[\-]\d{3}[\-]\d{4}
"/> 
         </label>

         <select class="req-input-cn" id="country" name="person_country" style="display: block; margin-top: 20px; border-bottom: 1px dashed #83A4C5; background: transparent; width: 275px; outline: none;">
             @foreach($countries as $country)
             <option value="{{$country->id}}">{{$country->name}}</option>
             @endforeach
         </select>
         <div class="print-error-msg" style="display:none; margin-left: 30px;">
         <span id="form-text4"></span>
         </div>

         <select class="req-input-sta" id="states" name="person_state" style=" display: block; margin-top: 20px; margin-top: 20px; border-bottom: 1px dashed #83A4C5; background: transparent; width: 275px; outline: none;">
         </select>
         <div class="print-error-msg" style="display:none; margin-left: 30px;">
         <span id="form-text5"></span>
         </div>

         <select class="req-input-ct" id="cities" name="person_city" style=" display: block; margin-top: 20px; margin-top: 20px; border-bottom: 1px dashed #83A4C5; background: transparent; width: 275px; outline: none; ">        
         </select>
         <div class="print-error-msg" style="display:none; margin-left: 30px;">
         <span id="form-text6"></span>
         </div>

         <label for="field1">
         <span style="margin-top: 10px;">Street</span><input type="text" name="person_street" value="{{ Request::old('person_street') }}" class="req-input-str" />
         </label>
         <div class="print-error-msg" style="display:none; margin-left: 30px;">
         <span id="form-text7"></span>
         </div>

     <button class="btn-submit">Submit</button>
     </form>
   </div>

  <div class="div-side">       
   <div style="overflow-y: auto; height: 500px;">
    <table id="myTable" >
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
                <td>{{$person->person_street}}</td>
            </tr>
            @endforeach    
            
        </tbody>
    </table>
    </div>
   </div>
    </body>


    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script type="text/javascript">
      //for my dynamic phonebook country states drop down list dependent
      $(document).ready(function(){
            //For my Country State Dynamic
            $(document).on('change','#country',function(){
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

                         div.find('#states').html(" ");
                         div.find('#states').append(op);
                      },
                      error:function(){

                      }

                  });
            });
            //For my State City Dynamic
            $(document).on('change','#states',function(){
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

                         div.find('#cities').html(" ");
                         div.find('#cities').append(op);
                      },
                      error:function(){

                      }

                  });
            });

            $('#country').trigger('change')
            $('#states').trigger('change')

            
            //Store Data using validation
            $(".btn-submit").click(function(e){
                e.preventDefault();
                // var _token = $("input[name='_token']").val();
                var fname = $("input[name='fname']").val();
                var lname = $("input[name='lname']").val();
                var phone_number = $("input[name='phone_number']").val();
                var mobile_number = $("input[name='mobile_number']").val();
                var person_country = $("#country option:selected").text();
                var person_state = $("#states option:selected").text();
                var person_city = $("#cities option:selected").text();
                var person_street = 'St. ' + $("input[name='person_street']").val();


                $.ajax({
                    url: "submit",
                    type:'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    data: {fname:fname, lname:lname, phone_number:phone_number, mobile_number:mobile_number, person_country:person_country,
                            person_state:person_state, person_city:person_city, person_street:person_street },
                    success: function(data) {

                        if($.isEmptyObject(data.error)){
                            alert(data.success);
                            $('#resetForm')[0].reset();
                            $("#myTable").append("<tr class='tr'><td class='tableText'>"+fname+"</td><td class='tableText'>"+lname+"</td><td class='tableText'>"+phone_number+"</td><td>"+mobile_number+"</td><td class='tableText'>"+person_country+"</td><td class='tableText'>"+person_state+"</td><td class='tableText'>"+person_city+"</td><td class='tableText'>"+person_street+"</td></tr>");                            
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

                if (key = 'fname') {
                    $(".print-error-msg").addClass("form-error-text");
                    $("#form-text1").html("The First Name field is required.");
                    $(".req-input-fn").addClass("form-error");
                }
                if (key = 'lname') {
                    $(".print-error-msg").addClass("form-error-text");
                    $("#form-text2").html("The Last Name field is required.");
                    $(".req-input-ln").addClass("form-error");
                }
                if (key = 'phone_number') {
                    $(".print-error-msg").addClass("form-error-text");
                    $("#form-text3").html("The Countact Number field is required.");
                    $(".req-input-pm").addClass("form-error");
                }
                if (key = 'person_country') {
                    $(".print-error-msg").addClass("form-error-text");
                    $("#form-text4").html("Country is required.");
                    $(".req-input-cn").addClass("form-error");
                }
                if (key = 'person_state') {
                    $(".print-error-msg").addClass("form-error-text");
                    $("#form-text5").html("State is required.");
                    $(".req-input-sta").addClass("form-error");
                }
                if (key = 'person_city') {
                    $(".print-error-msg").addClass("form-error-text");
                    $("#form-text6").html("City is required.");
                    $(".req-input-ct").addClass("form-error");
                }
                if (key = 'person_street') {
                    $(".print-error-msg").addClass("form-error-text");
                    $("#form-text7").html("Street is required.");
                    $(".req-input-str").addClass("form-error");
                }
            });
            }
             //Reset Error
            function RemoveErrors(){
                   if($("input[name='fname']").val()){
                     $(".req-input-fn").removeClass("form-error");
                     $("#form-text1").html("");
                   }
                   if($("input[name='lname']").val()){
                     $(".req-input-ln").removeClass("form-error");
                     $("#form-text2").html("");
                   }
                   if($("input[name='phone_number']").val()){
                     $(".req-input-pm").removeClass("form-error");
                     $("#form-text3").html("");
                   }
                   if($("select[name='person_city']").val() > 0){
                     $(".req-input-ct").removeClass("form-error");
                     $("#form-text6").html("");
                   }
                   if($("select[name='person_country']").val() > 0){
                     $(".req-input-cn").removeClass("form-error");
                     $("#form-text4").html("");
                   }
                   if($("select[name='person_state']").val() > 0){
                     $(".req-input-sta").removeClass("form-error");
                     $("#form-text5").html("");
                   }
                   if($("input[name='person_street']").val()){
                     $(".req-input-str").removeClass("form-error");
                     $("#form-text7").html("");
                   }
               }

               $("input[type='text']").change(function() {
                      RemoveErrors();
                  });
                  $("select").change(function() {
                      RemoveErrors();
                  });
      });       
    </script>
</html>
