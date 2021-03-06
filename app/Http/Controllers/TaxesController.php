<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\taxes_return;
use App\record_payment;
use DB;

class TaxesController extends Controller
{
    //
    //taxes:tax return
   public function insert_tax_return(Request $request)
   {
        $taxes_return = new taxes_return(); 
        $taxes_return->tax_name  =  $request->tax_name;
        $taxes_return->tax_description  =  $request->tax_description;
        $taxes_return->tax_agency =  $request->tax_agency;

        $taxes_return->sales_rate =  $request->sales_rate;
        $taxes_return->sales_account=  $request->sales_account; 
        $taxes_return->sales_tax_amount= $request->sales_tax_amount 	;
        $taxes_return->purchase_rate =  $request->purchase_rate;
        $taxes_return->purchase_account =  $request->purchase_account; 
        $taxes_return->purchase_tax_amount =  $request->purchase_tax_amount;
     
        $taxes_return->group_name =  $request->group_name;
        $taxes_return->group_description =  $request->group_description;
        $taxes_return->tax_rate =  $request->tax_rate;
        $taxes_return->applicable_on =  $request->applicable_on;
        $taxes_return->custom_tax_name =  $request->custom_tax_name;
        $taxes_return->custom_description =  $request->custom_description;
        $taxes_return->tax_agency_name =  $request->tax_agency_name;
        $taxes_return->registration_number =  $request->registration_number;
        $taxes_return->tax_period =  $request->tax_period;
        $taxes_return->filling_frequency =  $request->filling_frequency;
        $taxes_return->reporting_method =  $request->reporting_method;
        $taxes_return->tax_collected_on_sales =  $request->tax_collected_on_sales;
        $taxes_return->tax_collected_on_purchase =  $request->tax_collected_on_purchase;
        $taxes_return->status="Open";
        $taxes_return->save();


      return redirect('tax/return');

   }

   public function calender()
   {
      return view('taxes.tax_adjustment');
   }

   // taxes: record cst payment
   function record_cst_payment(Request $Request)
   {
      $record_payment=new record_payment();
      $record_payment->purpose=$Request->rec_cst_pay_purpose;
      $record_payment->period=$Request->rec_cst_pay_cst_period;
      $record_payment->payment_date=date("Y-m-d", strtotime($Request->rec_cst_pay_payment_date));
      $record_payment->payment_amount=$Request->rec_cst_pay_payment_amount;
      $record_payment->pay_memo=$Request->rec_cst_pay_memo;

      // finall query create, edit
      if($Request->hidden_input_purpose=="edit")
      {
         $update_values_array = json_decode(json_encode($record_payment), true);
         $update_query = record_payment::where('id', $Request->hidden_input_id)->update($update_values_array);
      }
      else if($Request->hidden_input_purpose=="add")
      {
         $record_payment->save();
      }

      return  redirect('/tax/payment-history');
   }
   
// get employee details -> for -> view and edit -> in jquery ajax
public function get_payment_details($id=""){
$data = record_payment::where('id', $id)->first();
$data->payment_date = date("d-m-Y", strtotime($data->rec_cst_pay_payment_date));

return $data;
}


   function tax_return_view()
   {
      $join = DB::table('taxes_return')
      ->leftJoin('record_payment', 'taxes_return.ID', '=', 'record_payment.id')
      ->distinct('record_payment.id')
      ->get()->toArray();
//    echo "<pre>";
// print_r($join);
// exit;
   // return $join;
      

      $data['content'] = 'taxes.return';
	 return view('layouts.content',compact('data'))->with('toReturn', $join);

   }

   function tax_payment_history_view()
   {
      $toReturn=array();
      $toReturn=record_payment::get()->toArray();
      
       $data['content'] = 'taxes.payment_history';
	 	return view('layouts.content',compact('data'))->with('toReturn',$toReturn);
  
   }

   function payment_history_del($id="")
   {
     
      $del=record_payment::where('id',$id)->delete();
      
      return redirect('tax/payment-history');

   }
}
