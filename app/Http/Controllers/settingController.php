<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\country;
use App\state;
use App\cities;

class settingController extends Controller
{
    // ========================================== country ======================================
    

    public function view_country()
    {
        $toReturn=array();
        $toReturn=country::get()->toArray();
        $data['content'] ='country';
	    return view('layouts.content',compact('data'))->with('toReturn',$toReturn);
    }
    
    public function add_new_country(Request $request)
    {
        $employee = new country();
        $employee->country_name = $request->country_name;
        $employee->save();
       
        return redirect('tools-master/show_country');
    }
    
   

    public function  update(Request $Request)
    {
        
        $update_about=country::where('id',$Request->coun_id)->update(array(
            'country_name'=>$Request->country_name
        ));
       
        return redirect('tools-master/show_country');
    }

    public function delete_country($id="")
    {
        $del=country::where('id',$id)->delete();
        return redirect('tools-master/show_country');
    }

    // ==================================== state =====================================================

    public function view_state()
    {
        $toReturn=array();
        $toReturn['state']=state::get()->toArray();
        $toReturn['country']=country::get()->toArray();
        $data['content'] ='state';
        return view('layouts.content',compact('data'))->with('toReturn',$toReturn);
        
    }

    public function add_new_state(Request $request)
    {
        $new_terms = new state();
        $new_terms->state = $request->state_name;
        $new_terms->country_id = $request->country_id;
        $new_terms->save();
        return redirect('tools-master/state');
    }

    public function  update_state(Request $Request)
    {
        $update_about=state::where('id',$Request->state_id)->update(array(
            'state'=>$Request->state_name
        ));
       
        return redirect('tools-master/state');
    }

    public function delete_state($id="")
    {
        $del=state::where('id',$id)->delete();
        return redirect('tools-master/state');
    }

   // ================================================= city ============================================
  
    
   public function view_city()
   {
       $toReturn=array();
       $toReturn['country']=country::get()->toArray();
       $toReturn['state']=state::get()->toArray();
       $toReturn['cities']=cities::get()->toArray();
       $data['content'] ='city';
       return view('layouts.content',compact('data'))->with('toReturn',$toReturn);
   }

   public function add_new_city(Request $request)
   {
       $new_terms = new cities();
       $new_terms->country_id = $request->country_id;
       $new_terms->state_id = $request->state_id;
       $new_terms->city = $request->city_name;
       $new_terms->save();
       return redirect('tools-master/city');
   }
   
   public function  update_city(Request $Request)
   {
       $update_about=cities::where('id',$Request->city_id)->update(array(
           'city'=>$Request->city_name
       ));
      
       return redirect('tools-master/city');
   }

   public function delete_city($id="")
   {
       $del=cities::where('id',$id)->delete();
       return redirect('tools-master/city');
   }

   public function fetch_according_to_country($id=""){
    $data = state::where('country_id', $id)->get()->toArray();
    return $data;
}

}
