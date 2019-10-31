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
      <li><a href="#">Sales </a></li>
      <li class="active">Invoice</li>
    </ol>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
   <div class="card">
    <div class="row">
      <div class="col-md-6" style="border: 1px solid;">
        <div class="row">
          <div class="col-md-4">
           <h4 class="unp"><i class="fa fa-rupee-sign sz" aria-hidden="true"></i> &nbsp; 11,000.00 Unpaid</h4>
         </div>
         <div class="col-md-8">
          <p style="margin-top: 12px;">LAST 365 DAYS </p>
        </div>

        <div class="col-md-6">
         <h3><i class="fa fa-rupee-sign sz" aria-hidden="true"></i> 0.00</h3> OVERDUE
       </div>
       <div class="col-md-6" style="text-align: right;">
         <h3><i class="fa fa-rupee-sign sz" aria-hidden="true"></i> 118,000.00</h3> NOT DUE YET
       </div>

       <div class="col-md-12" style="margin-top: 18px;">
         <div class="progress">
          <div class="progress-bar progress-bar-striped progress-bar-animated" style="width:40%; background-color: #d8900e;"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6" style="border: 1px solid;">
   <div class="row">
    <div class="col-md-4">
     <h4><i class="fa fa-rupee-sign sz" aria-hidden="true"></i> &nbsp; 0.00 Paid</h4>
   </div>
   <div class="col-md-8">
    <p style="margin-top: 12px;">LAST 30 DAYS </p>
  </div>

  <div class="col-md-6">
   <h3><i class="fa fa-rupee-sign sz" aria-hidden="true"></i> 0.00</h3> NOT DEPOSITED
 </div>
 <div class="col-md-6" style="text-align: right;">
   <h3><i class="fa fa-rupee-sign sz" aria-hidden="true"></i> 0.00</h3> DEPOSITED
 </div>

 <div class="col-md-12" style="margin-top: 18px;">
         <div class="progress">
          <div class="progress-bar progress-bar-striped progress-bar-animated" style="width:60%; background-color: #18a96d;"></div>
        </div>
      </div>
</div>
</div>
</div>
<div class="row">
 <div class="col-md-12">
  <div class="col-md-12" style="text-align: right; margin-bottom: 4px; margin-top: 4px;">
   <button class="btn btn-primary" onclick="addInvoice();" >New transaction</button>
 </div>
 <div class="tab-content colm">
   <div class="tab-pane show active" id="home-2" role="tabpanel" aria-labelledby="home-tab-2" style="">
    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
     <thead>
      <tr>
       <th><input type="checkbox" name="chkall[]" id="selectall" onClick="selectAll(this)" /></th>
       <th>Invoice</th>
       <th>Customer</th>
       <th>Date</th>
       <th>Due Date</th>
       <th>Balance</th>
       <th>Total</th>
       <th>Status</th>
       <th>Action</th>
     </tr>
   </thead>
   <tbody>
      
          <?php $__currentLoopData = $toReturn; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 
        <tr>
        <td>&nbsp;<input type="checkbox" name="ids[]" value="" /></td>
        <td><?php echo e($value['invoice_no']); ?></td>
        <td><?php echo e($value['customer']); ?></td>
        <td><?php echo e($value['invoice_date']); ?></td>
        <td><?php echo e($value['due_date']); ?></td>
        <?php
        $total=0;
        if($value["invoice_details"]!="")
        {
            $tmp = $value["invoice_details"];
            $tmp = explode(":",$tmp);
            for($i=0;$i<count($tmp);$i++){
                $to_show = explode(",",$tmp[$i]);
                $taxes=(($to_show[5]*$to_show[6])/100);
                $total+=$to_show[5]+$taxes;
            }
        }
        ?>
        <td><?php echo e($total); ?></td>
        <td><?php echo e($total); ?></td>
        <td><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Due in 30 days (Undelivered)</td>
        <td style="color: #0077C5; font-weight: 600; cursor: pointer;">
         Receive payment <i class="fa fa-caret-down" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: black; font-size: 15px;"></i>
         <div class="dropdown-menu resp" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="<?php echo e(url('sale/invoice/print/'.$value['id'])); ?>">Print</a>
          <a class="dropdown-item" href="<?php echo e(url('sale/invoice/email/'.$value['id'])); ?>">Send</a>
          <a class="dropdown-item" href="javascript:void();" data-toggle="modal" data-target="#reminderModal">Send remainder</a>
          <a class="dropdown-item" data-toggle="modal" data-target="#shareinvoiceModal" href="javascript:void();">Share Invoice Link</a>
          <a class="dropdown-item" href="<?php echo e(url('sale/invoice/delivery_challan/'.$value['id'])); ?>">Print Delivery Challan</a>
          <a class="dropdown-item" href="#" onclick="viewEditInvoice('view', <?php echo e($value['id']); ?>);">View</a>
          <a class="dropdown-item" href="#" onclick="viewEditInvoice('edit', <?php echo e($value['id']); ?>);">Edit</a>
          <a class="dropdown-item" href="#">Copy</a>
          <a class="dropdown-item" href="<?php echo e(url('sale/invoice/delete/'.$value['id'])); ?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
        </div>
      </td> 
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>




<div id="full-width-modal" class="modal fade invoice-form-modal" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none">
 <div class="modal-dialog modal-xl">
  <div class="modal-content">
   <div class="modal-header">
    <h4 class="modal-title mt-0" id="full-width-modalLabel">Invoice no.<span id="check_invoice_no"></span></h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
<form action="<?php echo e(url('sale/invoice/add-edit')); ?>" method="post" enctype="multipart/form-data" id="form-invoice">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Customer</label>
                        <input type="text" class="form-control" id="customer" name="customer" placeholder="">
                    </div>
                </div>

                <div class="col-md-6">
                 <div class="form-group">
                    <label for="exampleInputEmail1">Customer Email</label>
                    <input type="email" class="form-control" id="customer_email" name="customer_email" placeholder="Enter email" required>
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-6" style="text-align: right;">
        <h4>BALANCE DUE</h4>
        <h2><i class="fa fa-rupee-sign sz" aria-hidden="true"></i><span id="total-span-h">0.00</span></h2>
    </div>
</div>

<div class="row">
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="exampleInputEmail1">Billing address</label>
                    <textarea class="form-control" rows="2" id="billing_address" name="billing_address" style="margin-top: 0px; margin-bottom: 0px; height: 87px;" required></textarea>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="exampleInputEmail1">Terms</label>
                    <select class="form-control" name="terms" id="terms" required>
                        <option value="0" selected>Due on receipt</option>
                        <option value="15">Net 15</option>
                        <option value="30">Net 30</option>
                        <option value="60">Net 60</option>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="exampleInputEmail1">Invoice date</label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="mm/dd/yyyy" name="invoice_date" id="datepicker" required>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="md md-event"></i></span>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-3">
                <div class="form-group">
                    <label for="exampleInputEmail1">Due date</label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="mm/dd/yyyy" name="due_date" id="datepicker2" required>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="md md-event"></i></span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="col-md-3">
        <div class="col"  style="float: right;">
            <div class="form-group">
                <label for="exampleInputEmail1">Invoice no.</label>
                <input type="text" class="form-control" value="" id="invoice_no" name="invoice_no" required>
                <span id="invoice_check"></span>
            </div>
        </div>

    </div>
</div>


<div class="col-md-3">
  <div class="form-group">
    <label for="exampleInputEmail1">Place of Supply</label>
    <select class="form-control" name="place_of_supply" id="place_of_supply" required>
        <option value="">-Please Select a Location-</option>
        <option>Andhra Pradesh</option>
        <option>Arunachal Pradesh</option>
        <option>Chandigarh</option>
        <option>Delhi</option>
        <option>Goa</option>
    </select>
</div>
</div>
<hr>

<div class="col-md-12">
    <div class="tab-content">
     <div class="tab-pane show active" id="home-2" role="tabpanel" aria-labelledby="home-tab-2">
      <table id="datatable" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
       <thead>
        <tr>
         <th><input type="checkbox" name="chkall[]" id="selectall" onClick="selectAll(this)" /></th>
         <th>Product/Service</th>
         <th>HSN/SAC</th>
         <th>Description</th>
         <th>Qty</th>
         <th>Rate</th>
         <th>Amount</th>
         <th>Tax</th>
         <th>Action</th>
     </tr>
 </thead>
 <tbody id="mytable">
    <tr>
     <td>&nbsp;<input  type="checkbox" name="ids[]" value="" /></td>
     <td>
            <select class="form-control input-sm" name="product_service[]" required>
                    <option value="" disabled selected>-Select-</option>
                    <option value="add_new" style="color: green;">Add New +</option>
                    <option value="hours">Hours</option>
                    <option value="services">Services</option>
                   
                </select>  
     </td>
     <td><input type="text" class="form-control" name="hsn_sac[]" required></td>
     <td><input type="text" class="form-control" name="description[]" required></td>
     <td><input type="text" class="form-control" name="qty[]" required></td>
     <td><input type="text" class="form-control"  name="rate[]" required></td>
     <td><input class="form-control" type="text" name="amt[]"></td>
     
            <td >
                    <select class="form-control input-sm" name="tax[]" required>
                        <option value="0" disabled selected>-Select-</option>
                        <option value="0.25">0.25% IGST</option>
                        <option value="5">5% IGST</option>
                        <option value="10">10% IGST</option>
                        <option value="2">18% IGST</option>
                    </select>
                </td>     
     
     <td>
            <button class="btn" id="del"><i class="fa fa-trash" style="color: blue;"></i></button>
    
     </td>
 </tr>


</tbody>
<tbody>
    <tr>
        <td colspan="8"></td>
        <td><a href="#" onclick="appendFormContents()"><i class="fa fa-plus-circle" aria-hidden="true" style="color:green" id="insert_more" ></i></td>
    </tr>
</tbody>
</table>
</div>
</div>
</div>
<br>

<div class="row">
    <div class="col-md-6">
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Message on invoice</label>
                <textarea class="form-control" rows="2" id="msg_on_invoice" name="msg_on_invoice" required></textarea>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Message on statement</label>
                <textarea class="form-control" rows="2" id="msg_on_statement" name="msg_on_statement" required></textarea>
            </div>
        </div>
    </div>

    <div class="col-md-6" style="text-align: right;">
        <h4>Subtotal  &nbsp; &nbsp;<i class="fa fa-rupee-sign sz" aria-hidden="true"></i><span id="subtotal-span">0.00</span></h4>
        <h4>Taxes  &nbsp; &nbsp;<i class="fa fa-rupee-sign sz" aria-hidden="true"></i><span id="taxes-span"><span>0.00</h4>
        <h4>Balance Due  &nbsp; &nbsp;<i class="fa fa-rupee-sign sz" aria-hidden="true"></i><span id="total-span">0.00</span></h4>
    </div>
</div>

<div class="col-md-4">
 <div class="form-group">
    <label for="exampleInputEmail1">Attachments</label>
    <div class="dropzone" id="dropzone" style="min-height: 55px">
        <div class="fallback">
          <input  type="file"  name="attachment" id="attachment">
        </div>
    </div>
    <span id="e_invoice_attachment"></span>
</div>
</div>



</div>
<div class="modal-footer">
    <!-- hidden inputs -->
    <input type="text" name="hidden_input_id" value="NA" >
    <input type="text" name="hidden_input_purpose" value="add" >
    <input type="text" name="hidden_input_attachment" value="NA" >
    <!-- hidden inputs -->
    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary waves-effect waves-light" id="btnSubmit">Save changes</button>
</div>
</form>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<div class="modal fade" id="reminderModal" tabindex="-1" role="dialog" aria-labelledby="reminderModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Send reminder email for&nbsp;</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">To:</label>
            <input type="text" class="form-control" id="recipient-name" value="">
          </div>
          <div class="form-group">
                <label for="recipient-name" class="col-form-label">Subject:</label>
                <input type="text" class="form-control" id="recipient-name">
              </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="shareinvoiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Send your customer link to their invoice</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                           
                            <input type="text" class="form-control" id="">
                          </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Send</button>
            </div>
          </div>
        </div>
      </div>


<!-- view model start -->
<div class="modal invoice-details-model fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mt-0" id="myLargeModalLabel">Invoice Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 0px 0;">
                <table class="table table-bordered table-striped" border="0">
                    <tbody>
                        <tr style="border: none;">
                            <td><p><strong>Invoice No</strong></p></td>
                            <td><p id="v_invoice_no"></p></td>
                        </tr>
                        <tr style="border: none;">
                            <td><p><strong>Customer</strong></p></td>
                            <td><p id="v_customer"></p></td>
                        </tr>
                        <tr style="border: none;">
                            <td><p><strong>Customer Email</strong></p></td>
                            <td><p id="v_customer_email"></p></td>
                        </tr>
                        <tr style="border: none;">
                            <td><p><strong>Billing Address</strong></p></td>
                            <td><p id="v_billing_address"></p></td>
                        </tr>
                        <tr style="border: none;">
                            <td><p><strong>Terms</strong></p></td>
                            <td><p id="v_terms"></p></td>
                        </tr>
                        <tr style="border: none;">
                            <td><p><strong>Invoice Date</strong></p></td>
                            <td><p id="v_invoice_date"></p></td>
                        </tr>
                        <tr style="border: none;">
                            <td><p><strong>Due Date</strong></p></td>
                            <td><p id="v_due_date"></p></td>
                        </tr>
                        <tr style="border: none;">
                            <td><p><strong>Place of Supply</strong></p></td>
                            <td><p id="v_place_of_supply"></p></td>
                        </tr>
                        <tr style="border: none;">
                            <td><p><strong>Message on Invoice</strong></p></td>
                            <td><p id="v_msg_on_invoice"></p></td>
                        </tr>
                        <tr style="border: none;">
                            <td><p><strong>Message on statement</strong></p></td>
                            <td><p id="v_msg_on_statement"></p></td>
                        </tr>
                        <tr style="border: none;">
                            <td><p><strong>Attachment</strong></p></td>
                            <td><p id="v_attachment"></p></td>
                        </tr>
                        <tr style="border: none;">
                            <td colspan="2">
                                <p><strong>Invoice Details</strong></p>
                                <div id="v_invoice_details">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr style="border: none; background:white !important;">
                                                <th>#</th>
                                                <th>Product/Services</th>
                                                <th>Description</th>
                                                <th>Qty</th>
                                                <th>Rate</th>
                                                <th>Amount</th>
                                                <th>Tax(%)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <div id="v_invoice_details_amounts">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
     $(document).ready(function () {
        $("#check_invoice_no").hide();
        $('#invoice_no').keyup(function () {
            invoice_no_check();                     
        });
        function invoice_no_check()
        {
            var invoice_val=$('#invoice_no').val();
            $("#check_invoice_no").html(invoice_val);
            $("#check_invoice_no").show();
        }

        $("input[name='invoice_date'").change(function(){
            // var terms_tmp = $("#terms").val();
            // var invoice_date_tmp = $("input[name='invoice_date'").val();
            // invoice_date_tmp.setDate(date.getDate() + 1);
            // alert(invoice_date_tmp);
        });
     });
</script>

<script>
     $(document).ready(function () {

    $("#invoice_check").hide();

    var err_invoice=false;
    $('#invoice_no').blur(function () {
    check_invoice();
});

function check_invoice()
{
    
    var invoice_no_val=$("#invoice_no").val();
    var regexOnlyNumbers=/^[0-9]+$/;
    if(invoice_no_val=="" || regexOnlyNumbers.test(invoice_no_val) != true)
    {
        
$("#invoice_check").show();
$("#invoice_check").html("Please enter a valid number");
$("#invoice_check").focus();
$("#invoice_check").css("color","red");
err_invoice=false;
}
else
{
 err_invoice=true;
$("#invoice_check").hide();
}
    
}
$("#btnSubmit").click(function()
 {
    check_invoice();
  
if(( err_invoice==true) )
   {
     return true;
   }  
   else
   {
        return false;
   }
 });
});
</script>


<script>
    function appendFormContents()
    {
        var data='<tr>'+
        '<td>&nbsp;<input  type="checkbox" name="ids[]" value="" /></td>'+
        '<td>'+
            ' <select class="form-control input-sm" name="product_service[]" >'+
                        '<option value="" disabled selected>-Select-</option>'+
                        '<option value="add_new" style="color: green;">Add New +</option>'+
                    ' <option value="hours">Hours</option>'+
                    ' <option value="services">Services</option>'+
                    
                ' </select>'+
        '</td>'+
        '<td><input type="text" class="form-control" name="hsn_sac[]"></td>'+
        '<td><input type="text" class="form-control" name="description[]"></td>'+
        '<td><input type="text" class="form-control" name="qty[]" required></td>'+
        '<td><input type="text" class="form-control"  name="rate[]" required></td>'+
        '<td><input class="form-control" type="text" name="amt[]" ></td>'+
        
                '<td>'+
                    ' <select class="form-control input-sm" name="tax[]">'+
                            '<option value="0" disabled selected>-Select-</option>'+
                            '<option value="0.25">0.25% IGST</option>'+
                            '<option value="5">5% IGST</option>'+
                            '<option value="10">10% IGST</option>'+
                            '<option value="2">18% IGST</option>'+
                        '</select>'+
                    '</td>'+     
        
        '<td>'+
            
                '<button class="btn" id="del"><i class="fa fa-trash" style="color: blue;"></i></button>'+

        
        '</td>'+
        '</tr>';

        // appending form contents i.e. invoice details
        $("#mytable").append(data);
    }
    $("#mytable").delegate("#del", "click", function (){
        $(this).closest("tr").remove();
        getInvoiceDetailsValues();
    });
    // calculate amounts
    $("#mytable").delegate("input[name='qty[]']", "change", function (){
        getInvoiceDetailsValues();
    });
    $("#mytable").delegate("input[name='rate[]']", "change", function (){
        getInvoiceDetailsValues();
    });
    $("#mytable").delegate("select[name='tax[]']", "change", function (){
        getInvoiceDetailsValues();
    });
    function getInvoiceDetailsValues(){
        var fieldsQty = document.getElementsByName("qty[]");
        var fieldsRate = document.getElementsByName("rate[]");
        var fieldsTax = document.getElementsByName("tax[]");
        var fieldsAmount = document.getElementsByName("amt[]");

        
            var amount=0;
            var subtotal=0;
            var taxes=0;
            var total=0;

            for(var i=0;i<fieldsAmount.length;i++)
            {
                if(fieldsQty[i].value&&fieldsRate[i].value){
                    amount=fieldsQty[i].value*fieldsRate[i].value;
                    taxes+=(amount*fieldsTax[i].value)/100;
                    subtotal+=amount;
                    fieldsAmount[i].value = amount;
                }
            }

            total+=parseFloat(subtotal)+parseFloat(taxes);
            $("#subtotal-span").html(subtotal);
            $("#taxes-span").html(taxes);
            $("#total-span").html(total);
            $("#total-span-h").html(total); // large text
        
    }
</script>


<script>
//add expanses
function addInvoice(){
    resetInvoiceForms();
    $(".invoice-form-modal").modal('show');
}
// reset expensess form fields
function resetInvoiceForms(){
    // reset all fileds in expenses form model
    document.getElementById("form-invoice").reset();
    // assigning hidden inputs
    $("input[name='hidden_input_id'").val("NA");
    $("input[name='hidden_input_purpose'").val("add");
    $("input[name='hidden_input_attachment'").val("NA");
    // removing extra row forms (expense details)
    $("#mytable").find("tr:gt(0)").remove();
    // //remove old attachment span (link)
    $("#e_invoice_attachment").html("");
}
function viewEditInvoice(purpose, id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "<?php echo e(url('sale/invoice/get-invoice-details')); ?>" + "/" + id,
        method: "GET",
        contentType: 'application/json',
        dataType: "json",
        beforeSend: function(data){
            $("#loader1").css("display","block");
        },
        error: function(xhr){
            alert("error"+xhr.status+", "+xhr.statusText);
        },
        success: function (data) {
            if(purpose=="view")
            {  
                $("#v_invoice_details tbody").html("");
                document.getElementById("v_invoice_no").innerHTML = data.id;
                document.getElementById("v_customer").innerHTML = data.customer;
                document.getElementById("v_customer_email").innerHTML = data.customer_email;
                document.getElementById("v_billing_address").innerHTML = data.billing_address;
                document.getElementById("v_terms").innerHTML = data.terms;
                document.getElementById("v_invoice_date").innerHTML = data.invoice_date;
                document.getElementById("v_due_date").innerHTML = data.due_date;
                document.getElementById("v_place_of_supply").innerHTML = data.place_of_supply;
                document.getElementById("v_msg_on_invoice").innerHTML = data.msg_on_invoice;
                document.getElementById("v_msg_on_statement").innerHTML = data.msg_on_statement;
                document.getElementById("v_attachment").innerHTML = "<a target='_blank' href='<?php echo e(url('public/images')); ?>"+"/"+data.attachment+"'>View Attachment</a>";
                

                // view invoice details
                for(var i=0; i<data.no_of_rows; i++){
                    var v_invoice_details='<tr style="border: none; background:white !important;"><td>1</td><td>'+data.invoice_details_product_services[i]+'</td><td>'+data.invoice_details_description[i]+'</td><td>'+data.invoice_details_qty[i]+'</td><td>'+data.invoice_details_rate[i]+'</td><td>'+data.invoice_details_amount[i]+'</td><td>'+data.invoice_details_tax[i]+'</td></tr>';
                    $("#v_invoice_details tbody").append(v_invoice_details);
                }
                $("#v_invoice_details_amounts").html('<div style="text-align:right;padding:5px;"><p><b>Subtotal: ₹</b>'+data.subtotal+'</p><p><b>Taxes: ₹</b>'+data.total_tax+'</p><p><b>Total: ₹</b>'+data.total+'</p></div>');
                
                $('.invoice-details-model').modal('show');
            }
            else if(purpose=="edit"){
                resetInvoiceForms(); // reseting forms
                $("#invoice_no").val(data.invoice_no);
                $("#customer").val(data.customer);
                $("#customer_email").val(data.customer_email);
                $("#customer_details").val(data.customer_details);
                $("#billing_address").val(data.billing_address);
                $("#terms").val(data.terms);
                $("input[name='invoice_date']").datepicker('setDate', data.invoice_date);
                $("input[name='due_date']").datepicker('setDate', data.due_date);
                $("#place_of_supply").val(data.place_of_supply);
                $("#msg_on_invoice").val(data.msg_on_invoice);
                $("#msg_on_statement").val(data.msg_on_statement);

                $("#e_invoice_attachment").html("<a target='_blank' href='<?php echo e(url('public/images')); ?>"+"/"+data.attachment+"'>View Previous Attachment</a>");
                
                // get form elements details
                var product_service_fields = document.getElementsByName("product_service[]");
                var hsn_sac_fields = document.getElementsByName("hsn_sac[]");
                var description_fields = document.getElementsByName("description[]");
                var qty_fields = document.getElementsByName("qty[]");
                var rate_fields = document.getElementsByName("rate[]");
                var amount_fields = document.getElementsByName("amt[]");
                var tax_fields = document.getElementsByName("tax[]");
                for(var i=0; i<data.no_of_rows; i++){
                    if(i!=0){
                        appendFormContents();
                    }
                    product_service_fields[i].value = data.invoice_details_product_services[i];
                    hsn_sac_fields[i].value = data.invoice_details_hac_sac[i];
                    description_fields[i].value = data.invoice_details_description[i];
                    qty_fields[i].value = data.invoice_details_qty[i];
                    rate_fields[i].value = data.invoice_details_rate[i];
                    amount_fields[i].value = data.invoice_details_amount[i];
                    tax_fields[i].value = data.invoice_details_tax[i];
                }

                // assigning hidden inputs
                $("input[name='hidden_input_id'").val(data.id);
                $("input[name='hidden_input_purpose'").val("edit");
                $("input[name='hidden_input_attachment'").val(data.attachment);
                
                getInvoiceDetailsValues(); // calculating all values, taxes, amount, total etc
                $('.invoice-form-modal').modal('show'); // expense insert form model
            }
            $("#loader1").css("display","none");
        }
    });
}
</script>
    

   <?php /**PATH D:\xampp\htdocs\arbaba\resources\views/sale/invoice.blade.php ENDPATH**/ ?>