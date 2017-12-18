<!DOCTYPE html>
<html>
    <head>
        <title>Phone Book</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/phonebook_form.css') }}">
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

    @if(count($errors)>0)
         <div class="row">
           <div class="col-md-6">
               <ul>
                   @foreach($errors->all() as $error)
                   <li>{{@error}}</li>
                   @endforeach
               </ul>
           </div>
         </div>
       @endif

       <form class="form-style-4" method="POST" action="{{ url('/submit') }}">
           {{ csrf_field() }}
           
           <label for="field1">
           <span>First Name</span><input type="text" name="fname"/>
           </label>
           <label for="field1">
           <span>Last Name</span><input type="text" name="lname"/>
           </label>
           <label for="field1">
           <span>Contact Number</span><input type="text" name="phone_number"/>
           </label>
           <label for="field1">
           <span>Mobile Number</span><input type="text" name="mobile_number"/>
           </label>

           <select class="country">
               @foreach($countries as $country)
               <option value="{{$country->id}}">{{$country->name}}</option>
               @endforeach
           </select>

           <select>        
               <option value="0">Street</option>
           </select>

           <select class="states">
           </select>

            <span>&nbsp;</span><input type="submit" value="Send" />            
       </form>

    <table>
        <tbody>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone Number</th>
                <th>Mobile Number</th>
                <th>Street</th>
                <th>City</th>
                <th>State</th>
                <th>Country</th>
            </tr>
            
            @foreach($people as $person)
            <tr>
                <td>{{$person->fname}}</td>
                <td>{{$person->lname}}</td>
                <td>{{$person->phone_number}}</td>
                <td>{{$person->mobile_number ? $person->mobile_number : 'NA'}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
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

            $('.country').trigger('change')
      });
    </script>


    </body>
</html>
