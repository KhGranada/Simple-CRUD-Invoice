<div class="box box-info padding-1">
    <div class="box-body">
        <!--
        <div class="form-group">
            {{ Form::label('codigo') }}
            {{ Form::text('codigo', $invoice->codigo, ['class' => 'form-control' . ($errors->has('codigo') ? ' is-invalid' : ''), 'placeholder' => 'Codigo']) }}
            {!! $errors->first('codigo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('id_cliente') }}
            {{ Form::text('id_cliente', $invoice->id_cliente, ['class' => 'form-control' . ($errors->has('id_cliente') ? ' is-invalid' : ''), 'placeholder' => 'Id Cliente']) }}
            {!! $errors->first('id_cliente', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('valor_factura') }}
            {{ Form::text('valor_factura', $invoice->valor_factura, ['class' => 'form-control' . ($errors->has('valor_factura') ? ' is-invalid' : ''), 'placeholder' => 'Valor Factura']) }}
            {!! $errors->first('valor_factura', '<div class="invalid-feedback">:message</div>') !!}
        </div> -->

  
      <section class="mt-3">
         <div class="container-fluid">
         <h4 class="text-center" style="color:green"> Blu Restaurant & Hotel </h4>
         {{-- <h6 class="text-center"> Shine Metro Mkadi Naka (New - Delhi)</h6> --}}
         <div class="row">
            <div class="col-md-5  mt-4 ">
               <table class="table" style="background-color:#e0e0e0;" >
                 
                  <thead>
                     <tr>
                        <th>No.</th>
                        <th>Meal Items</th>
                        <th style="width: 31%">Qty</th>
                        <th>Price</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td scope="row">1</td>
                        <td style="width:60%">
                           <select name="vegitable" id="vegitable"  class="form-control">
                             <option value="test">test</option>
                           
                           </select>
                        </td>
                        <td style="width:1%">
                          <input type="number" id="qty" min="0" value="0" class="form-control">
                        </td>
                        <td>
                           <h5 class="mt-1" id="price" ></h5>
                        </td>
                        <td><button id="add" class="btn btn-success">Add</button></td>
                     </tr>
                     <tr>
                     </tr>    
                  
                  </tbody>
               </table>
               <div role="alert" id="errorMsg" class="mt-5" >
                 <!-- Error msg  -->
              </div>
            </div>
            <div class="col-md-7  mt-4" style="background-color:#f5f5f5;">
               <div class="p-4">
                  <div class="text-center">
                     <h4>Receipt</h4>
                  </div>
                  <span class="mt-4"> Time : </span><span  class="mt-4" id="time"></span>
                  <div class="row">
                     <div class="col-xs-6 col-sm-6 col-md-6 ">
                        <span id="day"></span> : <span id="year"></span>
                     </div>
                     <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                        <p>Order No:1234</p>
                     </div>
                  </div>
                  <div class="row">
                     </span>
                     <table id="receipt_bill" class="table">
                        <thead>
                           <tr>
                              <th> No.</th>
                              <th>Product Name</th>
                              <th>Quantity</th>
                              <th class="text-center">Price</th>
                              <th class="text-center">Total</th>
                           </tr>
                        </thead>
                        <tbody id="new" >
                          
                        </tbody>
                        <tr>
                           <td> </td>
                           <td> </td>
                           <td> </td>
                           <td class="text-right text-dark" >
                                <h5><strong>Sub Total:  ₹ </strong></h5>
                                <p><strong>Tax (5%) : ₹ </strong></p>
                           </td>
                           <td class="text-center text-dark" >
                              <h5> <strong><span id="subTotal"></strong></h5>
                              <h5> <strong><span id="taxAmount"></strong></h5>
                           </td>
                        </tr>
                        <tr>
                           <td> </td>
                           <td> </td>
                           <td> </td>
                           <td class="text-right text-dark">
                              <h5><strong>Gross Total: ₹ </strong></h5>
                           </td>
                           <td class="text-center text-danger">
                              <h5 id="totalPayment"><strong> </strong></h5>
                               
                           </td>
                        </tr>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </section>
</html>
<script>
    $(document).ready(function(){
      $('#vegitable').change(function() {
       var ids =   $(this).find(':selected')[0].id;
        $.ajax({
           type:'GET',
           url:'getPrice/{id}',
           data:{id:ids},
           dataType:'json',
           success:function(data)
             {
                
                 $.each(data, function(key, resp)
                 {     
                  $('#price').text(resp.product_price);
                });
             }
        });
      });
     
      //add to cart 
      var count = 1;
      $('#add').on('click',function(){
     
         var name = $('#vegitable').val();
         var qty = $('#qty').val();
         var price = $('#price').text();
  
         if(qty == 0)
         {
            var erroMsg =  '<span class="alert alert-danger ml-5">Minimum Qty should be 1 or More than 1</span>';
            $('#errorMsg').html(erroMsg).fadeOut(9000);
         }
         else
         {
            billFunction(); // Below Function passing here 
         }
          
         function billFunction()
           {
           var total = 0;
        
           $("#receipt_bill").each(function () {
           var total =  price*qty;
           var subTotal = 0;
           subTotal += parseInt(total);
           
           var table =   '<tr><td>'+ count +'</td><td>'+ name + '</td><td>' + qty + '</td><td>' + price + '</td><td><strong><input type="hidden" id="total" value="'+total+'">' +total+ '</strong></td></tr>';
           $('#new').append(table)
  
            // Code for Sub Total of Vegitables 
             var total = 0;
             $('tbody tr td:last-child').each(function() {
                 var value = parseInt($('#total', this).val());
                 if (!isNaN(value)) {
                     total += value;
                 }
             });
              $('#subTotal').text(total);
                
             // Code for calculate tax of Subtoal 5% Tax Applied
               var Tax = (total * 5) / 100;
               $('#taxAmount').text(Tax.toFixed(2));
  
              // Code for Total Payment Amount
  
              var Subtotal = $('#subTotal').text();
              var taxAmount = $('#taxAmount').text();
  
              var totalPayment = parseFloat(Subtotal) + parseFloat(taxAmount);
              $('#totalPayment').text(totalPayment.toFixed(2)); // Showing using ID 
         
          });
          count++;
         } 
        });
            // Code for year 
 
            var currentdate = new Date(); 
              var datetime = currentdate.getDate() + "/"
                 + (currentdate.getMonth()+1)  + "/"
                 + currentdate.getFullYear();
                 $('#year').text(datetime);
    
 
              
            // Code for extract Weekday     
                 function myFunction()
                  {
                     var d = new Date();
                     var weekday = new Array(7);
                     weekday[0] = "Sunday";
                     weekday[1] = "Monday";
                     weekday[2] = "Tuesday";
                     weekday[3] = "Wednesday";
                     weekday[4] = "Thursday";
                     weekday[5] = "Friday";
                     weekday[6] = "Saturday";
  
                     var day = weekday[d.getDay()];
                     return day;
                     }
                 var day = myFunction();
                 $('#day').text(day);
      });
 </script>
 <script>
    window.onload = displayClock();
 
     function displayClock(){
       var time = new Date().toLocaleTimeString();
       document.getElementById("time").innerHTML = time;
        setTimeout(displayClock, 1000); 
     }
</script>


    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>