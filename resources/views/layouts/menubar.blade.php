<!-- ========== Left Sidebar Start ========== -->

<div class="left side-menu">

  <div class="sidebar-inner slimscrollleft">

    <div class="user-details">

    </div>

    <!--- Divider -->

    <div id="sidebar-menu">
     @if(Session::get('userRole')==3)
     <ul>
      <li><a href="{{ URL::to('dashboard')}}" class="waves-effect"><i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>HRM Dashboard</span></a></li>
      <li><a href="{{ URL::to('update-site')}}" class="waves-effect"><i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Personal Infromation</span></a></li>

    </ul>
    @elseif(Session::get('userRole')==4)
    <ul>
      <li><a href="{{ URL::to('update-site')}}" class="waves-effect"><i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Employee Dashboard</span></a></li>
      <li><a href="{{ URL::to('update-site')}}" class="waves-effect"><i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Personal Infromation</span></a></li>
      <li><a href="{{ URL::to('update-site')}}" class="waves-effect"><i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Leave info</span></a></li>
      <li><a href="{{ URL::to('update-site')}}" class="waves-effect"><i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Timesheet</span></a></li>
      <li><a href="{{ URL::to('update-site')}}" class="waves-effect"><i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Leave Managment </span></a></li>
      <li><a href="{{ URL::to('update-site')}}" class="waves-effect"><i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Setting </span></a></li>
      <li><a href="{{ URL::to('employee-profile')}}" class="waves-effect"><i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>See Your Details </span></a></li>
    </ul>
    @elseif(Session::get('userRole')==5)
    <ul>
      <li><a href="{{ URL::to('dashboard')}}" class="waves-effect"><i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>RM Dashboard</span></a></li>
      <li><a href="{{ URL::to('update-site')}}" class="waves-effect"><i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Personal Infromation</span></a></li>
      <li><a href="{{ URL::to('update-site')}}" class="waves-effect"><i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Leave info</span></a></li>
      <li><a href="{{ URL::to('update-site')}}" class="waves-effect"><i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Timesheet</span></a></li>
      <li><a href="{{ URL::to('update-site')}}" class="waves-effect"><i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Leave Managment </span></a></li>
      <li><a href="{{ URL::to('update-site')}}" class="waves-effect"><i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Setting </span></a></li>
      <li><a href="{{ URL::to('employee-profile')}}" class="waves-effect"><i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>See Your Details </span></a></li>
    </ul>
    @else
    <ul>
      <li>
        <a href="{{ URL::to('dashboard')}}" class="waves-effect"><i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Dashboard</span></a>
      </li>
      <li class="has_sub">
        <a href="#" class="waves-effect"><i class="fas fa-users"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Items</span><span class="pull-right"><i class="md md-add"></i></span></a>
        <ul class="list-unstyled">
          <li><a href="{{url('update-site')}}">Emploee Details</a></li>
        </ul>
      </li>
      <li class="has_sub">
        <a href="#" class="waves-effect"><i class="fas fa-calculator"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Banking</span><span class="pull-right"><i class="md md-add"></i></span></a>
        <ul class="list-unstyled">
          <li><a href="{{url('update-site')}}">Attendance</a></li>        
        </ul>
      </li>
      <li class="has_sub">
       <a href="#" class="waves-effect"><i class="fas fa-hand-holding-usd"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Sales</span><span class="pull-right"><i class="md md-add"></i></span></a>
       <ul class="list-unstyled">
        <li><a href="{{url('sale/all-sale')}}">All Sales</a></li>
        <li><a href="{{url('sale/invoice')}}">Invoices</a></li>
        <li><a href="{{url('sale/customers')}}">Customers</a></li>
        <li><a href="{{url('sale/products-and-services')}}">Products & Services</a></li>
      </ul>
    </li>
    <li class="has_sub">
     <a href="#" class="waves-effect"><i class="fas fa-id-card-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Purchases</span><span class="pull-right"><i class="md md-add"></i></span></a>
     <ul class="list-unstyled">
      <li><a href="{{url('update-site')}}">Candidates</a></li>
      <li><a href="{{url('purchases/vendor')}}">Vendor</a></li>
      <li><a href="{{url('purchases/recurring-expenses')}}">Recurring Expenses</a></li>
      <li><a href="{{url('purchases/purchase-order')}}">Purchase Order</a></li>
      <li><a href="{{url('purchases/bill')}}">Bill</a></li>
      <li><a href="{{url('purchases/payments-made')}}">Payments Mode</a></li>
      <li><a href="{{url('purchases/vendor-credits')}}">Vendor Credits</a></li>

    </ul>
  </li> -->
   <li class="has_sub">
    <a href="#" class="waves-effect"><i class="fas fa-id-card-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Taxes</span><span class="pull-right"><i class="md md-add"></i></span></a>
    <ul class="list-unstyled">
      <li><a href="{{url('tax/return')}}">Return</a></li>
      <li><a href="{{url('tax/payment-history')}}">Payment History</a></li>
    </ul>
  </li>
  <li class="has_sub">
    <a href="#" class="waves-effect"><i class="fas fa-id-card-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Expenses</span><span class="pull-right"><i class="md md-add"></i></span></a>
    <ul class="list-unstyled">
      <li><a href="{{url('expenses')}}">Expenses</a></li>
      <li><a href="{{url('expenses/suppliers')}}">Suppliers</a></li>

    </ul>
  </li>
  <li>
    <a href="{{url('employee')}}" class="waves-effect"><i class="fa fa-id-card-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Employee</span></a>
  </li>
  <li>
    <a href="{{url('accounting')}}" class="waves-effect"><i class="fa fa-id-card-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Accounting</span></a>
  </li> 
  @if(Session::get('role')!=3 )
<li class="has_sub">
  <a href="#" class="waves-effect"><i class="fas fa-tools"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Tools/Master </span><span class="pull-right"><i class="md md-add"></i></span></a>
    
  <ul class="list-unstyled">
    <li><a href="{{url('tools-master/tax_rate')}}">Tax Rate</a></li>
    <li><a href="{{url('tools-master/show_time_zone')}}">Time-Zone</a></li>
    <li><a href="{{url('tools-master/show_country')}}">Country</a></li>
    <li><a href="{{url('tools-master/state')}}">State</a></li>
    <li><a href="{{url('tools-master/city')}}">City</a></li>
    <li><a href="{{url('tools-master/terms')}}">Terms</a></li>
    <li><a href="{{url('tools-master/currency')}}">Currency</a></li>
    <li><a href="{{url('tools-master/department')}}">Department</a></li>
  </ul>
</li>
  @endif
<li class="has_sub">
  <a href="#" class="waves-effect"><i class="fas fa-users-cog"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Settings</span><span class="pull-right"><i class="md md-add"></i></span></a>
  <ul class="list-unstyled">
    @if(Session::get('role')==1)
    <li><a href="{{ URL::to('company')}}" class="waves-effect"><span>Company </span></a></li>
    <li><a href="{{url('setting/user')}}"><span>User</span></a></li>
    <li><a href="{{url('setting/module')}}"><span>Module</span></a></li>
    <li><a href="{{url('setting/user_role')}}"><span>User Role</span></a></li>
    @elseif(Session::get('role')==2)
    <li><a href="{{url('setting/user')}}"><span>User</span></a></li>
    @else
    @endif
    <li><a href="{{url('update-site')}}"><span>Organization structure</span></a></li>
    
  </ul>
</li>
</ul>
@endif
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</div>
</div>

