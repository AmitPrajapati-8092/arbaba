
<style type="text/css">
  .row {
    margin-right: 0px;
    margin-left: 0px;
  }

</style>
<!-- Start content -->
<div class="content-page" >
    <div class="content">
        <div class="container-fluid">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">

                <ol class="breadcrumb pull-right">
                    <li><a href="#">Home </a></li>
                    <li><a href="#">purchase </a></li>
                    <li class="active">Bill</li>
                </ol>
                </div>
            </div>



            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-border card-primary">
                        <div class="card-header">
                            <button type="button" class="btn btn-inverse btn-rounded waves-effect waves-light m-b-5" data-toggle="modal" data-target=".recurring-expenses" style="float:right;">Add New </button>
                        </div> 
                        <div class="card-body"> 
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                    <th><input type="checkbox" name="chkall[]" id="selectall" onClick="selectAll(this)" /></th>
                                    <th>Date</th>
                                    <th>Bill</th>
                                    <th>Reference Number</th>
                                    <th>Vendor Name</th>
                                    <th>Status</th>
                                    <th>Due Date</th>
                                    <th>Amount</th>
                                    <th>Balance Due</th> 
                                    </tr>
                                </thead> 
                            </table>
                        </div>
                    </div>
                </div>
            


            </div>
        </div>
    </div>
</div>


<!-- modal -->

<form action="#" method="POST">
  <?php echo csrf_field(); ?>
  <!--  Modal content for the above example -->
  <div class="modal fade bs-example-modal-lg recurring-expenses" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title mt-0" id="myLargeModalLabel">Bill</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
                 


          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Vendor Name</label>
                <input type="text" name="vendor_name" class="form-control" value="" id="vendor_name" maxlength="25">
                <h6 id="vendor_name_val"></h6>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Bill</label>
                <input type="text" name="bill" class="form-control" value="" id="bill" maxlength="18">
              </div>
                <h6 id="bill_val"></h6>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Order Number</label>
                <input type="text" name="order_number" class="form-control" value="" id="order_number" maxlength="18">
                <h6 id="order_number_val"></h6>
              </div>
            </div>


           <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Bill Date</label>
                <input type="date" name="bill_date" class="form-control" value="" id="bill_date" placeholder="dd/mm/yyyy">
                
              </div>
                  <h6 id="bill_date_val"></h6>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Due Date</label>
                <input type="date" name="due_date" class="form-control" value="" id="due_date" placeholder="dd/mm/yyyy">
                 
              </div>
                <h6 id="due_date_val"></h6>
            </div>

            <div class="col-md-4">
            <div class="form-group row">
              <label class="exampleInputEmail1">Payment Terms</label>
                <select class="form-control" name="product_type" id="product_type">
                  <option>-Select-</option>
                  <option></option>
                  <option></option>
                  <option></option>
                  <option></option>
                </select>  
            </div>
          </div>

         
       
            
                <div class="col-lg-12">
                     <hr/>
                        <div class="form-group row"> 
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                    <th><input type="checkbox" name="chkall[]" id="selectall" onClick="selectAll(this)" /></th>
                                    <th>Iteam Details</th>
                                    <th>Account</th>
                                    <th>Quantity</th>
                                    <th>Rate</th>
                                    <th>Customer Details</th>
                                    <th>Amount</th>
                                    </tr>
                                </thead>
                               <tbody>
                               		<tr>
                               			<td><input type="checkbox" name="chkall[]" id="selectall" onClick="selectAll(this)" /></td>
                                    	<td>iteams12</td>
                                    	<td>123456789</td>
                                    	<td>12</td>
                                    	<td>500</td>
                                      <td>    </td>
                                      <td>500</td>
                                    	
                                    </tr>
                               </tbody>
                            </table>
                        </div>
                    </div>   
            </div>

                      
            <div class="col-md-12">
			    <div class="row">
					<div class="col-md-12" style="text-align: right;">
						<tr>
					        <td><h4>Subtotal  &nbsp; &nbsp;<i class="fa fa-rupee-sign sz" aria-hidden="true"></i><span id="subtotal-span">0.00</span></h4></td>
					        <td><h4>Discount  &nbsp; &nbsp;<i class="fa fa-rupee-sign sz" aria-hidden="true"></i><span id="taxes-span"><span>0.00</h4></td>
                   <td><h4>TDS  &nbsp; &nbsp;<i class="fa fa-rupee-sign sz" aria-hidden="true"></i><span id="taxes-span"><span>0.00</h4></td>  
					        <td><h4>Adjustment  &nbsp; &nbsp;<i class="fa fa-rupee-sign sz" aria-hidden="true"></i><span id="total-span">0.00</span></h4></td>
					     </tr>   
			    	</div>	
			    </div>
			    <hr/>
            </div>

            <div class="col-md-12">
			    <div class="row">
					<div class="col-md-12" style="text-align: right;">
					        <h4>Total  &nbsp; &nbsp;<i class="fa fa-rupee-sign sz" aria-hidden="true"></i><span id="subtotal-span">0.00</span></h4>
					       
			    	</div>
			    </div>
			    <hr/>
            </div>


           <div class="col-md-12">
           	
            <div class="form-group">
                <label class="notes">Notes</label>
                <textarea class="form-control" rows="3" id="notes" name="notes" required></textarea>
            </div>
           </div>

        </div>

            <div class="col-md-12">
				 <div class="form-group">
				    <label for="exampleInputEmail1">Attachments</label>
				    <div class="dropzone" id="dropzone" style="min-height: 55px">
				        <div class="fallback">
				          <input  type="file"  name="attachment" id="attachment">
				        </div>
		            </div>
                 </div>
                 <hr/>
            </div>
        
        <div class="col-md-12" style="text-align: right;">
            <button type="submit" class="btn btn-primary waves-effect" id="btn">Save</button>
            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
        </div>
      </div><!-- /.modal-content -->

    </div><!-- /.modal-dialog -->
 </div><!-- /.modal -->
</div>



<script>
$(document).ready(function(){
   
    $("#vendor_name_val").hide();
    $("#bill_val").hide();
    $("#order-number_val").hide();
    $("#bill_date_val").hide();
    $("#due_date_val").hide();


    
    var err_vendor_name_val=true;
    var err_bill_val=true;
    var err_order_number_val=true;
    var err_bill_date_val=true;
    var err_due_date_val=true;




    $("#vendor_name").blur(function(){
        vendor_name_f();
    });
    function  vendor_name_f(){

        var d = $("#vendor_name").val();

        if(d.length==""){
            $("#vendor_name_val").show();
            $("#vendor_name_val").html("This field is required ");
            $("#vendor_name_val").focus();
            $("#vendor_name_val").css("color","red");

            err_vendor_name_val=false;
            return false;
        }
        else{
           err_vendor_name_val=true;
            $("#vendor_name_val").hide();
        }
    }

   
    $('#bill').blur(function () {
        bill_f();
    });
    function bill_f()
    {
        
        var z=$("#bill").val();
        var regexOnlyNumbers=/^[0-9]+$/;
        if(z=="" || regexOnlyNumbers.test(z) != true)
        {
            
            $("#bill_val").show();
            $("#bill_val").html("Please enter a valid number");
            $("#bill_val").focus();
            $("#bill_val").css("color","red");
            err_bill_val=false;
        }
        else
        {
            err_bill_val=true;
            $("#bill_val").hide();
        }  
    }
 $('#order_number').blur(function () {
        order_number_f();
    });
    function order_number_f()
    {
        
        var l=$("#order_number").val();
        var regexOnlyNumbers=/^[0-9]+$/;
        if(l=="" || regexOnlyNumbers.test(l) != true)
        {
            
            $("#order_numberorder_number_val").show();
            $("#order_number_val").html("Please enter a valid number");
            $("#order_number_val").focus();
            $("#order_number_val").css("color","red");
            err_order_number_val=false;
        }
        else
        {
            err_order_number_val=true;
            $("#order_number_val").hide();
        }  
    }


     $('#bill_date').blur(function () {
        bill_date_f();
    });
    function bill_date_f()
    {
        
        var b=$("#bill_date").val();
       
        if(b.length=="")
        {
            
            $("#bill_date_val").show();
            $("#bill_date_val").html("This field is required");
            $("#bill_date_val").focus();
            $("#bill_date_val").css("color","red");
            err_bill_date_val=false;
        }
        else
        {
            err_bill_date_val=true;
            $("#bill_date_val").hide();
        }  
    }

     $('#due_date').blur(function () {
        due_date_f();
    });
    function due_date_f()
    {
        
        var b=$("#due_date").val();
       
        if(b.length=="")
        {
            
            $("#due_date_val").show();
            $("#due_date_val").html("This field is required");
            $("#due_date_val").focus();
            $("#due_date_val").css("color","red");
            err_due_date_val=false;
        }
        else
        {
            err_due_date_val=true;
            $("#due_date_val").hide();
        }  
    }



    $("#btn").click(function(){
    
     err_vendor_name_val=true;
     err_bill_val=true;
     err_order_number_val=true;
     err_bill_date_val=true;
     err_due_date_val=true;


        
        
        vendor_name_f();
        bill_f();
        order_number_f();
        bill_date_f();
        due_date_f();

        if((err_vendor_name_val==true)&&(err_bill_val==true)&&(err_order_number_val==true)&&(err_bill_date_val==true)&&(err_due_date_val==true))
        {
            return true;
        }
        else{
            return false;
        }
    });
});
</script><?php /**PATH C:\xampp\htdocs\arbaba\resources\views/purchases/bill.blade.php ENDPATH**/ ?>