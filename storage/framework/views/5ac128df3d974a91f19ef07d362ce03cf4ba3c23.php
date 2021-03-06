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

                        <!-- <div>
                     role        <?php echo e(Session::get('role')); ?> <br>
                    
                          tiem zone   <?php echo e(Session::get('time_zone')); ?><br>

                          currency  <?php echo e(Session::get('currency')); ?><br>

                       email     <?php echo e(Session::get('email')); ?><br>

                        org name     <?php echo e(Session::get('org_name')); ?><br>
                    
                       id     <?php echo e(Session::get('gorgID')); ?><br>

                       id_org    <?php echo e(Session::get('org_id')); ?><br>

                       can_id    <?php echo e(Session::get('candidate_id')); ?>

                        
                        </div> -->

<?php
      $overdue_amount=$estimate_amount=$paid_amount=$tax=$total_not_deposited =0;
      @$total_before_tax=0;
     @$taxes=0;
     @$total=0;
     @$before_tax=0;
      ?>
      <?php $__currentLoopData = @$toReturn; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
        // overdue
        if(@$value['due_date'] < date("d-m-Y") &&  $value['status'] == 1 && $value["invoice_details"]!="" && date('d-m-Y', strtotime('today + 365 days')))
        {
           
           
                $tmp = $value["invoice_details"];
                $tmp = explode(":",$tmp);
                for($i=0;$i<count($tmp);$i++){
                    $tmp_2 = explode(",",$tmp[$i]);
                    $overdue_amount += ($tmp_2[5] + (($tmp_2[5]*$tmp_2[6])/100));
                   $total_not_deposited = sprintf('%0.2f', $total_not_deposited);
                }
            }
        

         
      //unpaid
      if(@$value["invoice_details"]!="" && $value['status'] == 1 && date('d-m-Y', strtotime('today + 365 days')))
     {
         $tmp = $value["invoice_details"];
         $tmp = explode(":",$tmp);
         for($i=0;$i<count($tmp);$i++){
             $to_show = explode(",",$tmp[$i]);
             $amount=$to_show[3]*$to_show[4];
             $total_before_tax += $to_show[5];
             $taxes += (($to_show[5]*$to_show[6])/100);
         }
     }
    $total = $total_before_tax + $taxes;
    $total = sprintf('%0.2f', $total);
    //not due yet
    if($value['due_date'] > date("d-m-Y") && $value["invoice_details"]!="" && date('d-m-Y', strtotime('today + 365 days')) )
        {
                $tmp = $value["invoice_details"];
                $tmp = explode(":",$tmp);
                for($i=0;$i<count($tmp);$i++){
                    $tmp_2 = explode(",",$tmp[$i]);
                    $estimate_amount += ($tmp_2[5] + (($tmp_2[5]*$tmp_2[6])/100));
                    $estimate_amount = sprintf('%0.2f',   $estimate_amount);
                }
            }
        
//not deposited
if(@$value["invoice_details"]!="" && $value['status'] == 1 && date('d-m-Y', strtotime('today - 30 days')))
     {
         $tmp = $value["invoice_details"];
         $tmp = explode(":",$tmp);
         for($i=0;$i<count($tmp);$i++){
             $to_show = explode(",",$tmp[$i]);
             $amt=$to_show[3]*$to_show[4];
             $before_tax += $to_show[5];
             $tax += (($to_show[5]*$to_show[6])/100);
         }
     }
    @$total_not_deposited = @$before_tax + @$tax;
    @$total_not_deposited = sprintf('%0.2f', @$total_not_deposited);

        //paid
        if($value['status'] == 2 && date('d-m-Y', strtotime('today - 30 days')) && $value["invoice_details"]!="" )
        {
          
                $tmp = $value["invoice_details"];
                $tmp = explode(":",$tmp);
                for($i=0;$i<count($tmp);$i++){
                    $tmp_2 = explode(",",$tmp[$i]);
                    $paid_amount += ($tmp_2[5] + (($tmp_2[5]*$tmp_2[6])/100));
                    $paid_amount = sprintf('%0.2f', $paid_amount);
                }
            }
        
            
         ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <!-- top headder  -->
<div class="row">
  <div class="col-lg-12">
   <div class="card">
    <div class="row">
      <div class="col-md-6" style="border: 1px solid;">
        <div class="row">
          <div class="col-md-4">
           <h4 class="unp"><i class="fa fa-rupee-sign sz" aria-hidden="true"></i> &nbsp;<?php echo e($total); ?> Unpaid</h4>
         </div>
         <div class="col-md-8">
          <H style="margin-top: 12px;">LAST 365 DAYS </p>
        </div>

        <div class="col-md-6">
        <h3><i class="fa fa-rupee-sign sz" aria-hidden="true"></i><?php echo e($overdue_amount); ?></h3> OVERDUE
       </div>
       <div class="col-md-6" style="text-align: right;">
       <h3><i class="fa fa-rupee-sign sz" aria-hidden="true"></i> <?php echo e($estimate_amount); ?></h3> NOT DUE YET
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
     <h4><i class="fa fa-rupee-sign sz" aria-hidden="true"></i> &nbsp; <?php echo e($paid_amount); ?> Paid</h4>
   </div>
   <div class="col-md-8">
    <p style="margin-top: 12px;">LAST 30 DAYS </p>
  </div>

  <div class="col-md-6">
  <h3><i class="fa fa-rupee-sign sz" aria-hidden="true"></i> <?php echo e($total_not_deposited); ?></h3> NOT DEPOSITED
 </div>
 <div class="col-md-6" style="text-align: right;">
 <h3><i class="fa fa-rupee-sign sz" aria-hidden="true"></i> <?php echo e($paid_amount); ?></h3> DEPOSITED
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
    <button class="btn btn-primary" onclick="addInvoice();" >Add New Invoice</button>
 </div>
 <div class="tab-content colm">
   <div class="tab-pane show active" id="home-2" role="tabpanel" aria-labelledby="home-tab-2" style="">
    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
     <thead>
      <tr>
       
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
       ;
        <td><?php echo e($value['invoice_no']); ?></td>
        <td><?php echo e(@$value['customer_name']); ?></td>
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
        <td>
            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
          <?php
          if($value['due_date'] < date("d-m-Y"))
          {
              echo "Expired(Opened)";
          }
          elseif($value['status'] == 2)

          {
           echo "Paid(Closed)";
            }
          else{
             $diff = strtotime($value['due_date']) - strtotime(date("d-m-Y"));
                 if($diff==0) { echo "Expires Today(Opened)"; }
                 else { echo "Due in ".abs(round($diff / 86400))." Days(Opened)"; }
             }
           ?>


      </td>
        <td style="color: #0077C5; font-weight: 600; cursor: pointer;" >
            <span  onclick="receivePayment(<?php echo e(@$value['id']); ?>)" style="color: #0077C5; font-weight: 600; cursor: pointer;">Receive payment</span>&nbsp;&nbsp;<i class="fa fa-caret-down" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: black; font-size: 15px;"></i>
            <div class="dropdown-menu resp" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="<?php echo e(url('sale/invoice/print/'.@$value['id'])); ?>">Print</a>
             <!---   <a class="dropdown-item" href="<?php echo e(url('sale/invoice/email/'.@$value['id'])); ?>">Send</a>----->
                <a class="dropdown-item" href="javascript:void();" onclick="sendReminder('<?php echo e($value['customer_email']); ?>','<?php echo e(@$value['invoice_no']); ?>','<?php echo e(@$value['customer']); ?>');">Send remainder</a>
                <!-- <a class="dropdown-item" data-toggle="modal" data-target="#shareinvoiceModal" href="javascript:void();">Share Invoice Link</a> -->
                <a class="dropdown-item" href="<?php echo e(url('sale/invoice/delivery_challan/'.@$value['id'])); ?>">Print Delivery Challan</a>
                <a class="dropdown-item" href="#" onclick="viewEditInvoice('view', <?php echo e(@$value['id']); ?>);">View</a>
                <!-- <a class="dropdown-item" href="#" onclick="viewEditInvoice('edit', <?php echo e(@$value['id']); ?>);">Edit</a> -->
                <!-- <a class="dropdown-item" href="#">Copy</a> -->
                <!-- <a class="dropdown-item" href="<?php echo e(url('sale/invoice/delete/'.@$value['id'])); ?>" onclick="return confirm('Do you want to delete this data?')">Delete</a> -->
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

<!-- model  -->
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
         <div class="col-md-12">
            <div class="row">

                

              
            
           
                 <div class="col-md-4">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Customer</label>
                           
                            <div class="input-group">
                            <select class="form-control"  onchange="invoice_details_show(this.value,this)"  name="customer_name" id="customer_name"    required>
                            <option id="selected_customer_name">select</option>
                            <!-- <option id="selected_customer_name"></option> -->
                                <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <option value="<?php echo e($customer['id']); ?>"><?php echo e($customer['display_name_as']); ?> </option>
                                <!-- <option value="<?php echo e($customer['id']); ?>"><?php echo e($customer['first_name']); ?> </option> -->
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="button" id="button-addon2" data-toggle="modal"  data-target=".new_customer_add">Add New +</button>
                            </div>
                        </div>
                       
                       
                    </div>
                 </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Customer Email</label>
                    <input type="text" class="form-control"  id="selected_customer_email" name="customer_email" placeholder="Enter email">
                  </div>
                    <h6 id="email_val"></h6>
                </div>

                <div class="col-md-4" style="text-align: right;">
                        <h4>BALANCE DUE</h4>
                        <h2><i class="fa fa-rupee-sign sz" aria-hidden="true"></i><span id="total-span-h">0.00</span></h2>
                </div>
               
        </div>

    </div>



    <div class="col-md-12">
        <div class="row">


            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Due date</label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="dd/mm/yyyy" name="due_date" id="datepicker" required autocomplete="off">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="md md-event"></i></span>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Invoice date</label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="dd/mm/yyyy" name="invoice_date" id="datepicker2" required autocomplete="off">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="md md-event"></i></span>
                        </div>
                    </div>
                </div>
            </div>

             <div class="col-md-4">
               <div class="col"  style="float: right;">
                 <div class="form-group">
                   <label for="exampleInputEmail1">Invoice no.</label>
                   <input type="text" class="form-control" value="" id="invoice_no" name="invoice_no" required>
                   <span id="invoice_check"></span>
                 </div>
                  <h6 id="invoice_no_val"></h6>
               </div> 
             </div>
             
             <div class="col-md-4">
                  <div class="form-group">
                  
                          <label for="exampleInputEmail1">Terms</label>
                          <div class="input-group">
                          <input type="text" class="form-control" value="" id="terms" name="terms" required>
                          <!-- <div class="input-group">
                         <select class="form-control" onchange="terms_details_show(this.value,this)" name="terms" id="terms"   required>
                           
                            <option id="selected_customer_terms"></option>
                                <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $terms): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($terms['terms']); ?>" ><?php echo e($terms['terms']); ?> </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                            </select> -->
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="button" id="button-addon2" data-toggle="modal"  data-target=".new_terms_add">Add New +</button>
                            </div>
                        </div>
                  </div>
             </div>
           
           

             <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Place of Supply</label>
                <select class="form-control" name="place_of_supply" id="place_of_supply" required>
                   <option value="" id="selected_location">-Please Select a Location-</option>
                    <!-- <option>Andhra Pradesh</option>
                    <option>Arunachal Pradesh</option>
                    <option>Chandigarh</option>
                    <option>Delhi</option>
                    <option>Goa</option> -->
                    
                    <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cities): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($cities['city']); ?>" ><?php echo e($cities['city']); ?> </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                   
                </select>
            </div>
            </div>  



            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Billing address</label>
                    <textarea class="form-control" rows="2" id="billing_address" name="billing_address" style="margin-top: 0px; margin-bottom: 0px; height: 87px;" required></textarea>
                </div>
                <h6 id="billing_address_val"></h6>
            </div>

        </div>
        <hr>
 </div>



<hr>

<div class="col-md-12">
    <div class="tab-content">
     <div class="tab-pane show active" id="home-2" role="tabpanel" aria-labelledby="home-tab-2">
      <table id="datatable" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
       <thead>
        <tr>
        
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
     
     <td>
            <select class="form-control input-sm" onchange="subscription_details_show(this.value, this)" name="product_service[]" required>
                    <option  value="" disabled selected>-Select-</option>
                    
                    <?php $__currentLoopData = $products_and_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($value['id']); ?>" ><?php echo e($value['name']); ?> </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                   
                </select>  
     </td>
     <td><input type="text" class="form-control" name="hsn_sac[]" id="hsn_sac_abc" required></td>
     <td><input type="text" class="form-control" name="description[]"  id="description_abc" required></td>
     <td><input type="text" class="form-control" name="qty[]" id="qty_abc" required></td>
     <td><input type="text" class="form-control"  name="rate[]"  id="rate_abc" required></td>
     <td><input class="form-control" type="text" name="amt[]" readonly></td>
     
            <td >
                    <select class="form-control input-sm" name="tax[]" required id="tax">
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
<br>
<br>


</div>




    
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Message on invoice</label>
                <textarea class="form-control" rows="2" id="msg_on_invoice" name="msg_on_invoice" required></textarea>
            </div>
        </div>
         <div class="col-md-6" style="text-align: right;">
        <h4>Subtotal  &nbsp; &nbsp;<i class="fa fa-rupee-sign sz" aria-hidden="true"></i><span id="subtotal-span">0.00</span></h4>
        <h4>Taxes  &nbsp; &nbsp;<i class="fa fa-rupee-sign sz" aria-hidden="true"></i><span id="taxes-span"><span>0.00</h4>
        <h4>Balance Due  &nbsp; &nbsp;<i class="fa fa-rupee-sign sz" aria-hidden="true"></i><span id="total-span">0.00</span></h4>
        </div>
         <div class="col-md-6">
         <div class="form-group">
                <label for="exampleInputEmail1">Message on Statement</label>
                <textarea class="form-control" rows="2" id="msg_on_statement" name="msg_on_statement" required></textarea>
            </div>
       </div>
    

   


<div class="col-md-6">
 <div class="form-group">
    <label for="exampleInputEmail1">Attachments</label>
    <div class="dropzone" id="dropzone" style="min-height: 55px">
        <div class="fallback">
          <input  type="file"  name="attachment" id="attachment">
        </div>
    </div>
    <span id="e_invoice_attachment"></span>
</div>

<br>
<br>
</div>


</div>
<div class="modal-footer">
    <!-- hidden inputs -->
    <input type="text" name="hidden_input_id" value="NA" hidden>
    <input type="text" name="hidden_input_purpose" value="add" hidden>
    <input type="text" name="hidden_input_attachment" value="NA" hidden>
    <!-- hidden inputs -->
    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary waves-effect waves-light" id="btnSubmit">Save changes</button>
</div>
</form>
</div>
 </div>
     </div>

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
        <h5 class="modal-title" id="exampleModalLabel">Send reminder email for&nbsp;<span id="id_no"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="<?php echo e(url('sale/invoice/remainder_mail/'.@$value['id'])); ?>" method="POST">
        <?php echo csrf_field(); ?>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">To:</label>
            <input type="text" class="form-control" id="reminder_recipient_email" name="reminder_recipient_email">
          </div>
          <div class="form-group">
                <label for="subject" class="col-form-label">Subject:</label>
                <input type="text" class="form-control" id="subject" name="subject">
              </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message_text" name="message_text" rows="6"></textarea>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Send</button>
      </div>
    </form>
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
              <button type="submit" class="btn btn-primary" id="btnSubmit">Send</button>
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
                                                <!--<th><input  type="checkbox" name="ids[]" value="" /></th>-->
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



<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="paymentModalLabel">Receive Payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
      <form action="<?php echo e(url('sale/invoice/payment_received')); ?>" method="post" enctype="multipart/form-data">
           <?php echo csrf_field(); ?>
            <div class="row">
                   
            <div class="col-md-4">
              <div class="form-group">
            <label for="customer" class="col-form-label">Customer</label>
              <input type="text" class="form-control" id="payment_received_customer" name="payment_received_customer">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="email" class="col-form-label">Email</label>
          <input type="text" class="form-control" id="payment_received_email" name="payment_received_email">
          </div>
        </div>
        
    </div>
    <div class="row">
          <div class="col-md-3">
          <div class="form-group">
                <label for="payment-date" class="col-form-label">Payment Date</label>
                <input type="text" id="datepicker3" name="payment_received_payment_date" class="form-control">
              </div>
            </div>
        </div>
        <div class="row">
              <div class="col-md-3">
                    <div class="form-group">
                        <label for="payment-method">Payment method</label>
                        <select class="form-control" name="payment_received_method" id="payment_received_method">
                            <option value="0" selected>---Select---</option>
                            <option value="Cash">Cash</option>
                            <option value="Cheque">Cheque</option>
                            <option value="Credit Card">Credit Card</option>
                            <option value="Debit Card">Debit Card</option>
                            <option value="Net Banking">Net Banking</option>
                           
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                        <div class="form-group">
                              <label for="reference-no" class="col-form-label">Reference No.</label>
                              <input type="text" class="form-control" id="payment_received_reference_no" name="payment_received_reference_no">
                            </div>
                          </div>
                          <div class="col-md-3">
                                <div class="form-group">
                                    <label for="deposited-to">Deposited To</label>
                                    <select class="form-control" name="payment_received_deposited_to" id="payment_received_deposited_to">
                                        <option value="0" selected>---Select---</option>
                                        <option value="Axis Bank">Axis Bank</option>
                                        <option value="ICICI">ICICI</option>
                                        
                                       
                                    </select>
                                </div>
                            </div> 
                            <div class="col-md-3">
                                    <div class="form-group">
                                          <label for="amount-received" class="col-form-label">Amount Received</label>
                                          <input type="text" class="form-control" id="payment_received_amount" name="payment_received_amount">
                                        </div>
                                      </div>  

        </div>
         <br><br><br>
        <table id="datatable" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                    
                    <th>DESCRIPTION</th>
                    <th>DUE DATE</th>
                    <th>AMOUNT</th>
                    <th>TAX</th>
                    <th>TOTAL</th>
                   
                    </tr>
                </thead>
                <tbody id="receive_payment_details">
                    
                </tbody>
            </table>
           
            <div style="float:right;">
                               <div class="form-group">
                          <label for="amount-to-apply" class="col-form-label">Total Payable Amount&nbsp;:<i class="fa fa-rupee-sign sz" aria-hidden="true"></i></label>
                          <span id="payment_received_amount_to_apply" name="payment_received_amount_to_apply"></span>
                    </div>
            
           
               
           
        </div>
            
      </div>

     
        <div class="form-group">
              <label for="memo" class="col-form-label">Memo</label>
              <input type="text" class="form-control" id="payment_received_memo" name="payment_received_memo">
        </div>

        <div class="col-md-4">
            <div class="form-group">
               <label for="attachment">Attachments</label>
               <div class="dropzone" id="dropzone" style="min-height: 55px">
                   <div class="fallback">
                     <input  type="file"  name="payment_received_attachment" id="payment_received_attachment">
                   </div>
               </div>
           </div>
           </div>


      <div class="modal-footer">
          <!-- hidden fields -->
          <input type="hidden" name="payment_received_invoice_id" id="payment_received_invoice_id">
          <input type="hidden" name="payment_received_description" id="payment_received_description">
          <input type="hidden" name="payment_received_due_date" id="payment_received_due_date">
          <input type="hidden" name="payment_received_subtotal" id="payment_received_subtotal">
          <input type="hidden" name="payment_received_tax" id="payment_received_tax"> 
          <input type="hidden" name="payment_received_total_amount" id="payment_received_total_amount">
          
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Clear Payment</button>
      </div>
     
    </form>
    
    </div>
  </div>
</div>



          


<script>
    $(document).ready(function() {

    $('input[name="invoice_date"]').datepicker('setDate', '<?php echo date('d-m-Y'); ?>');

});​

    </script>
<script>
function sendReminder(email,id,name){
var subject=`Reminder: Invoice `+id+` from technical`;
var messageText = `Dear `+name+`,
Just a reminder that we have not received a payment for this invoice yet. 
Let us know if you have questions.

Thanks for your business!`;
$("#reminder_recipient_email").val(email);
$("#id_no").html(id);
$("#reminderModal").modal("show");
$("#message_text").val(messageText);
$("#subject").val(subject);
}
</script>

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
    // not accepting other than numbers
    $("#mytable").delegate("input[name='qty[]']", "keyup", function (){
        $(this).val($(this).val().replace(/\D/g, ""));
    });
    $("#mytable").delegate("input[name='rate[]']", "keyup", function (){
        $(this).val($(this).val().replace(/\D/g, ""));
    });
    $("#mytable").delegate("input[name='rate[]']", "keyup", function (){
        $(this).val($(this).val().replace(/\D/g, ""));
    });
    function appendFormContents()
    {
        // var data='<tr>'+
        // '<td>&nbsp;<input  type="checkbox" name="ids[]" value="" /></td>'+
        // '<td>'+
        //     ' <select class="form-control input-sm"  name="product_service[]" >'+
        //    
        //             //     '<option value="" disabled selected id=select_product_service id="select_services">-Select-</option>'+
        //             //     '<option value="add_new" style="color: green;">Add New +</option>'+
        //             // ' <option value="hours id="hours">Hours</option>'+
        //             // ' <option value="services id-"services">Services</option>'+
                    
        //         ' </select>'+
        // '</td>'+
        // '<td><input type="text" class="form-control" name="hsn_sac[] id="hsn_sac"></td>'+
        // '<td><input type="text" class="form-control" name="description[] id="description"></td>'+
        // '<td><input type="text" class="form-control" name="qty[]" required></td>'+
        // '<td><input type="text" class="form-control"  name="rate[]" required></td>'+
        // '<td><input class="form-control" type="text" name="amt[]" readonly></td>'+
        
        //         '<td>'+
        //             ' <select class="form-control input-sm" name="tax[]">'+
        //                     '<option value="0" disabled selected>-Select-</option>'+
        //                     '<option value="0.25">0.25% IGST</option>'+
        //                     '<option value="5">5% IGST</option>'+
        //                     '<option value="10">10% IGST</option>'+
        //                     '<option value="2">18% IGST</option>'+
        //                 '</select>'+
        //             '</td>'+     
        
        // '<td>'+
            
        //         '<button class="btn" id="del"><i class="fa fa-trash" style="color: blue;"></i></button>'+

        
        // '</td>'+
        // '</tr>';
        var data=`<tr>'+
     
     <td>
           <select class="form-control input-sm" onchange="subscription_details_show(this.value, this)" name="product_service[]" required>
                    '<option  value="" disabled selected>-Select-</option>'

                    <?php $__currentLoopData = $products_and_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e(@$value['id']); ?>" ><?php echo e(@$value['name']); ?> </option>         
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   
              </select>  
     </td>
     <td><input type="text" class="form-control" name="hsn_sac[]" id="hsn_sac_def" required></td>
     <td><input type="text" class="form-control" name="description[]"  id="description_def" required></td>
     <td><input type="text" class="form-control" name="qty[]" id="qty_def" required></td>
     <td><input type="text" class="form-control"  name="rate[]"  id="rate_def" required></td>
     <td><input class="form-control" type="text" name="amt[]" readonly></td>
     
            <td >
                    <select class="form-control input-sm" name="tax[]" required id="tax">
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
        `;
            

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
//add invoice
function addInvoice(){
    resetInvoiceForms();
    $(".invoice-form-modal").modal('show');
}
// reset invoice form fields
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
                    var v_invoice_details='<tr style="border: none; background:white !important;"><td>'+data.invoice_details_product_services[i]+'</td><td>'+data.invoice_details_description[i]+'</td><td>'+data.invoice_details_qty[i]+'</td><td>'+data.invoice_details_rate[i]+'</td><td>'+data.invoice_details_amount[i]+'</td><td>'+data.invoice_details_tax[i]+'</td></tr>';
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
            //  //  var product_service_fields = document.getElementsByName("product_services[]");
            //   var hsn_sac_fields = document.getElementsByName("hsn_sac[]");
            //   var description_fields = document.getElementsByName("description[]");
            //     var qty_fields = document.getElementsByName("qty[]");
            //    var rate_fields = document.getElementsByName("rate[]");
            //    var amount_fields = document.getElementsByName("amt[]");
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




function receivePayment(id){
    $("#receive_payment_details").html("");
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
            $("#payment_received_customer").val(data.customer);
            $("input[name='payment_received_payment_date']").datepicker('setDate', '<?php echo date('d-m-Y'); ?>');
            $("#payment_received_email").val(data.customer_email);
            $("#payment_received_amount_to_apply").html(data.total);
            $("#payment_received_invoice_id").val(id);
            $("#paymentModal").modal("show");

            var payment_receive_invoice_details='<tr style="border: none; background:white !important;"><td>Invoice#'+data.invoice_no+'</td><td>'+data.due_date+'</td><td>'+data.subtotal+'</td><td>'+data.total_tax+'</td><td>'+data.total+'</td></tr>';
            $("#receive_payment_details").html(payment_receive_invoice_details);
            $("#payment_received_amount").val(data.total);
            $("#payment_received_description").val('Invoice#'+data.invoice_no);
            $("#payment_received_due_date").val(data.due_date);
            $("#payment_received_subtotal").val(data.subtotal);
            $("#payment_received_tax").val(data.total_tax);
            $("#payment_received_total_amount").val(data.total);

            $("#loader1").css("display","none");
        }
    });
}

// yo open invoice form/ modal form if GET to open invoice
var modalOpen="";
modalOpen='<?php echo e($invoice); ?>';
$(document).ready(function(){
    if(modalOpen=="yes"){
        // to remove query from url i.e. invoice=yes
        var uri = window.location.toString();
        if (uri.indexOf("?") > 0) {
            var clean_uri = uri.substring(0, uri.indexOf("?"));
            window.history.replaceState({}, document.title, clean_uri);
        }
        // call addInvoice to open invoice modal
       setInterval(addInvoice(), 3000);
    }
});
</script>

<script>
$(document).ready(function(){
    $("#email_val").hide();
    $("#billing_address_val").hide();
    $("#invoice_no_val").hide();

    var err_invoice=true;
    var err_email_val=true;
    var err_billing_address=true;


    $("#customer_email").blur(function(){
        email_id_f();
    });
    function email_id_f(){
        var m = $("#customer_email").val();
        var v =/^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
        var result = m.match(v); 

        if((m.length=="")||(result == null)){

        $("#email_val").show();
        $("#email_val").html("Please insert valid email ");
        $("#email_val").focus();
        $("#email_val").css("color","red");

        err_email_val=false;
            return false;
        }
        else{
            err_email_val=true;
            $("#email_val").hide();
        }
    }


    $("#billing_address").blur(function(){
        billing_address_f();
    });
    function billing_address_f(){

        var d = $("#billing_address").val();

        if(d.length==""){
            $("#billing_address_val").show();
            $("#billing_address_val").html("Please insert billing address ");
            $("#billing_address_val").focus();
            $("#billing_address_val").css("color","red");

            err_billing_address=false;
            return false;
        }
        else{
            err_billing_address=true;
            $("#billing_address_val").hide();
        }
    }

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

    $("#btnSubmit").click(function(){
        err_invoice = true;
        err_email_val = true;
        err_biiling_address=true;
        
        check_invoice();
        email_id_f();
        billing_address_f();

        if((err_email_val==true)&&(err_billing_address==true)&&(err_invoice==true))
        {
            return true;
        }
        else{
            return false;
        }
    });
});
</script>



<script type="text/javascript">
  <?php
    //[{"id":"1","name":"Ben"},{"id":"1","name":"Ben"}]
    $tmp= "";
    foreach ($customers as $customer){
      $tmp.=  "{'id':'".$customer['id']."','name':'".$customer['display_name_as']."'},";
    }
    $tmp = rtrim($tmp,',');
  ?>
  var typeaheadCustomer = [<?php echo $tmp; ?>];
  console.log(typeaheadCustomer);
  var typeaheadCustomer = new Bloodhound({
    datumTokenizer: function(d) { return Bloodhound.tokenizers.whitespace(d.name); },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    // `states` is an array of state names defined in "The Basics"
    local: typeaheadCustomer
  });

  typeaheadCustomer.initialize();
  $('#customer').typeahead({
    hint: true,
    highlight: true,
    minLength: 1,
    templates: {
      empty: [
        '<div style="padding: 5px 10px;text-align: center;">',
          'unable to find any Best Picture winners that match the current query',
        '</div>'
        ].join('\n'),
        suggestion: Handlebars.compile('<div><strong>Yo</strong> – Yo</div>')
    }
  },
  {
    displayKey: 'name',
    source: typeaheadCustomer.ttAdapter()
  });

  $('#customer').on('typeahead:select', function(evt, item) {
      // item.id
      $("#customer_id").val(item.id);
  });
</script>

<script>
function viewEditInvoice(purpose, id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "<?php echo e(url('sale/invoice/get-invoice-details')); ?>" + "/" + id,
        method: "get",
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
                    var v_invoice_details='<tr style="border: none; background:white !important;"><td>'+data.invoice_details_product_services[i]+'</td><td>'+data.invoice_details_description[i]+'</td><td>'+data.invoice_details_qty[i]+'</td><td>'+data.invoice_details_rate[i]+'</td><td>'+data.invoice_details_amount[i]+'</td><td>'+data.invoice_details_tax[i]+'</td></tr>';
                    $("#v_invoice_details tbody").append(v_invoice_details);
                }
                $("#v_invoice_details_amounts").html('<div style="text-align:right;padding:5px;"><p><b>Subtotal: ₹</b>'+data.subtotal+'</p><p><b>Taxes: ₹</b>'+data.total_tax+'</p><p><b>Total: ₹</b>'+data.total+'</p></div>');
                
                $('.invoice-details-model').modal('show');
            }
            else if(purpose=="edit"){
                resetInvoiceForms(); // reseting forms
                $("#invoice_no").val(data.invoice_no);
                $("#name").val(data.customer);
                $("#selected_customer_email").val(data.customer_email);
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
     //           var product_service_fields = document.getElementsByName("product_service[]");
     //         var hsn_sac_fields = document.getElementsByName("hsn_sac");
     //       var description_fields = document.getElementsByName("description[]");
      //           $("#hsn_sac").val(data.hsn_code);
           //      $("#description").val(data.description);
      //          var qty_fields = document.getElementsByName("qty[]");
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


<!-- abhishek  -->
<!-- model for add new customer  -->
  <div class="modal fade bs-example-modal-sm new_customer_add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mt-0" id="myLargeModalLabel">New Customer</h4>
                <button type="button" class="close" onclick="closeNewCustomermodal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Customer Name</label>
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" id="token">
                        <input type="text" name="customer_name" class="form-control" value="" id="customer_name">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Company</label>
                        <!-- <input type="text" name="company_name" class="form-control" id="company_name"> -->
                        <select class="form-control input-sm" onchange="subscription_details_show2(this.value, this)" name="company_name" id="company_name" required>
                          <option  value="" disabled selected>-Select-</option>
                    
                          <?php $__currentLoopData = $company; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <option value="<?php echo e($value['org_id']); ?>" ><?php echo e($value['org_name']); ?> </option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                   
                         </select>  
                    </div>
                    <br>
                    <hr/>
                </div>
                

                <div class="col-md-12" style="text-align: right;">
                    <button type="submit" class="btn btn-primary waves-effect" onclick="closeNewCustomermodal()"  id="new_customer_insert">Save</button>
                    <button type="button" class="btn btn-secondary waves-effect" onclick="closeNewCustomermodal()">Close</button>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- end of model for add new customer  -->

<!-- for close modele for add customer  -->
  //   <script>
         //   function submitNewCustomermodal(){
          //  var radioValue2 = $("#cust_btn").val();
       //     $("#customer").val($("#customer_name").val());
        //    closeNewCustomermodal();
         //   }
            function closeNewCustomermodal(){
           $(".new_customer_add").modal('hide');
            }
        </script>
<!-- end of close modle for add customer  -->




<!-- abhishek for fetch details of customer -->
<script>
function invoice_details_show(id,e) {
    $.ajax({
        url: "<?php echo e(url('sale/invoice/get-invoice-details_bill')); ?>" + "/" + id,
            method: "GET",
            success: function (data) {
             console.log(data);
               $("#selected_customer_email").val(data.email_id);
            $("#billing_address").val(data.billing_address);
            $("#terms").val(data.terms);
    
        }
    });
}
</script>

<!-- abhishek FOR new customer add -->
<script>
        $(document).ready(function() {
            $("#new_customer_insert").click(function(e) {
            //alert();
                // alert("hello");
                e.preventDefault();
                var customer_name = $("#customer_name").val();
               
                var company_name = $("#company_name").val();
                
                var token = $("#token").val();
             
                // $.ajaxSetup({
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     }
                // });
                $.ajax({
                    url: "<?php echo e(url('sale/invoice/add_new_customer')); ?>",
                    type: 'get',

                    data: {
                        customer_name: customer_name,
                        company_name: company_name

                    },
                    dataType: "json",
                    success: function(data) {
                //    console.log(data);
               
                        $("#selected_customer_name").html(data.first_name);
                         $("#selected_customer_details").html(data.email_id);
                    }
                });
            });
        });
</script>






<!-- 16/11/19 -->
 <!-- model for add terms  -->              
 <div class="modal fade bs-example-modal-sm new_terms_add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mt-0" id="myLargeModalLabel">New Terms</h4>
                <button type="button" class="close" onclick="close_New_terms_modal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Terms</label>
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" id="token">
                        <input type="text" name="terms_name" class="form-control" value="" id="terms_name">
                    </div>
                </div>
                <div class="col-md-12" style="text-align: right;">
                    <button type="submit" class="btn btn-primary waves-effect" onclick="close_New_terms_modal()" id="new_terms_insert">Save</button>
                    <button type="button" class="btn btn-secondary waves-effect" onclick="close_New_terms_modal()">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end of add terms model  -->
<!-- for close of model  -->
<script>
    function close_New_terms_modal(){
      $(".new_terms_add").modal('hide');
    }
</script>
<!-- end of close model  -->

<!-- abhishek FOR new terms add
<script>
        $(document).ready(function() {
            $("#new_terms_insert").click(function(e) {
               // alert("hello");
                e.preventDefault();
                var terms_name = $("#terms_name").val();
                var token = $("#token").val();
              // alert(terms_name);
             //   $.ajaxSetup({
             //       headers: {
                 //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   // }
                //});
                $.ajax({
                    url: "<?php echo e(url('sale/invoice/add_new_terms')); ?>",
                    type: 'POST',

                    data: {
                        terms_name: terms_name
                    },
                    dataType: "json",
                    success: function(data) {
                    console.log(data);
                    s
                    }
                });
            });
        });
</script>

    $.ajax({
        url: "<?php echo e(url('sale/invoice/get-invoice-details_bill')); ?>" + "/" + id,
            method: "GET",
            success: function (data) {
             console.log(data);
               $("#selected_customer_email").val(data.email_id);
            $("#billing_address").val(data.billing_address);
            $("#selected_customer_terms").val(data.terms);
    
        }
    });
}
</script>

   abhishek for fetch details of terms
<script>
     function terms_details_show(id,e) {
       
   

        $.ajax({
          url: "<?php echo e(url('sale/invoice/get-invoice-details_terms')); ?>" + "/" + id,
          method: "GET",
        
          dataType: "json",
            success: function (data) {
            console.log(data);
            $("#selected_customer_terms").html(data.terms);
                        //  $("#selected_customer_details").html(data.email_id);
           //   alert("successfully added!!");   }
      });
}
</script> -->



    <!-- =============================================Sweta B ================================== -->
<script>
   function subscription_details_show(id,e) {
   //  alert(id);
      $('#hsn_sac_abc').empty();
      $('#description_abc').empty();
     $("#qty_abc").empty();
     $("#rate_abc").empty();
    // // alert(id);
    //var id=$(e).val;
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    $.ajax({
        url: "<?php echo e(url('sales_order/fetch_sales_order_details')); ?>" + "/" + id,
            method: "GET",
            contentType: 'application/json',
            dataType: "json",
            success: function (data) {
              //  console.log(data.hsn_code+data.sac_code);
              // alert(data.hsn_code+data.sac_code);
                var hsn_sac=$(e).closest('tr').find("input[name='hsn_sac[]']" );
                $(hsn_sac).val(data.hsn_code+data.sac_code);

                var desc=$(e).closest('tr').find("input[name='description[]']" );
                $(desc).val(data.description);
                
                var qty=$(e).closest('tr').find("input[name='qty[]']" );
                $(qty).val(data.unit);
               
                var rate=$(e).closest('tr').find("input[name='rate[]']" );
                $(rate).val(data.cost);
              //  console.log(price_val);
               //  $("#description_abc").val(data.description);
               //  $("#qty_abc").val(data.unit);
              //   $("#rate_abc").val(data.cost);
              // var price_val=$(e).closest('tr').find("input[name='hsn_sac[]']" );
          //   $(price_val).val(data.hsn_code);
            ///console.log(price_val);
            
             }
    });
}


</script>
// <!---------------------------------------new---------------------------------------------------->
// <!-- <script>
//     function subscription_details_show1(id,e) {
//       //  alert(id);
//         $('#hsn_sac_def').empty();
//         $('#description_def').empty();
//         $("#qty_def").empty();
//         $("#rate_def").empty();
    
//     $.ajaxSetup({
//     headers: {
//     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
//     });

//     $.ajax({
//         url: "<?php echo e(url('sales_order/fetch_sales_order_details')); ?>" + "/" + id,
//             method: "GET",
//             contentType: 'application/json',
//            dataType: 'json',
//             success: function (data) {
//                // console.log(data);
//                $("#hsn_sac_def").val(data.hsn_code+data.sac_code);
//                 // console.log(hsn_sac_def);
//             $("#description_def").val(data.description);
//             //     $("#qty_def").val(data.unit);
//         $("#rate_def").val(data.cost);
            
//             //    $(price_c).val(data.hsn_code+sac_code);
//             //    alert(price_c);
//             //    var desc=$(e).closest('tr').find("input[name='description1[]']" );
//             //    $(desc).val(data.description);
//             //    console.log(price_val);
//             //   var qty_a=$(e).closest('tr').find("input[name='qty1[]']" );
//             //    $(qty_a).val(data.unit);
//             //    var rate_a=$(e).closest('tr').find("input[name='rate1[]']" );
//             //    $(desc).val(data.cost);
              
              
//              }
//     });
// }


// </script>


<?php /**PATH C:\xampp\htdocs\arbaba\resources\views/sale/invoice.blade.php ENDPATH**/ ?>