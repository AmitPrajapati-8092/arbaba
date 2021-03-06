
<style type="text/css">
  .row {
    margin-right: 0px;
    margin-left: 0px;
  }

</style>
<!-- Start content -->
<div class="content-page">
    <div class="content">
        <div class="container-fluid">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">

                    <ol class="breadcrumb pull-right">
                        <li><a href="#">Home </a></li>
                        <li><a href="#">Tools/master </a></li>
                        <li class="active">Currency</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-border card-primary">
                        <div class="card-header">
                            <button type="button" class="btn btn-inverse btn-rounded waves-effect waves-light m-b-5" data-toggle="modal" data-target=".add_new_currency" style="float:right;">Add New </button>

                        </div>
                        <div class="card-body">
                            <table id="datatable" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Currency Name</th>
                                        <th>Currency Code</th>
                                        <th>Symbol</th>
                                        <th>Formate</th>
                                        <th>Exchange Reate</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $sl_no=1; ?>

                                        @foreach ($toReturn as $value)
                                        <tr>
                                            <?php $id=$value['id']; ?>
                                                <td>{{$sl_no++}}</td>
                                                <td>{{$value['name']}}</td>
                                                <td>{{$value['code']}}</td>
                                                <td>{{$value['symbol']}}</td>
                                                <td>{{$value['format']}}</td>
                                                <td>{{$value['exchange_rate']}}</td>
                                                <td class="actions">
                                                    <a href="#" class="on-default edit-row" data-currency_id="{{$id}}" data-currency_name="{{$value['name']}}" data-currency_code="{{$value['code']}}" data-currency_symbol="{{$value['symbol']}}" data-currency_formate="{{$value['format']}}" data-currency_exchange_rate="{{$value['exchange_rate']}}" data-toggle="modal" data-target="#edit_model_currency" title="edit" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                                    <a href="{{url('tools-master/delete_currency/'.$value['id'])}}" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fas fa-trash"></i></a>
                                                </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
</div>


<!-- model for update-->
<div id="edit_model_currency" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-header">
                <h4 class="modal-title mt-0">Edit Time Zone</h4> 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div> 
            <div class="modal-body"> 
                <form action ="{{url('tools-master/update_currency')}}" method="post">
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group">
                                <input type="hidden" name="_token" value = "{{ csrf_token()  }}" > 
                                    <label for="field-1" class="control-label">Currency Name</label> 
                                        <input type="hidden" id="currency_id" name="currency_id"> 
                                        <input type="text" class="form-control"  name="currency_name" id="currency_name"  required placeholder="enter here...about"> 
                            </div> 
                            <div class="form-group">
                                    <label for="field-1" class="control-label">Currency Code</label> 
                                        <input type="text" class="form-control"  name="currency_code" id="currency_code"  required placeholder="enter here...about"> 
                            </div>
                            <div class="form-group">
                                    <label for="field-1" class="control-label">Currency Symbol</label> 
                                        <input type="text" class="form-control"  name="currency_symbol" id="currency_symbol"  required placeholder="enter here...about"> 
                            </div>
                            <div class="form-group">
                                    <label for="field-1" class="control-label">Currency Formate</label> 
                                        <input type="text" class="form-control"  name="currency_formate" id="currency_formate"  required placeholder="enter here...about"> 
                            </div>
                            <div class="form-group">
                                    <label for="field-1" class="control-label">Currency Exchange Rate</label> 
                                        <input type="text" class="form-control"  name="currency_exchange_rate" id="currency_exchange_rate"  required placeholder="enter here...about"> 
                            </div>
                        </div> 
                    </div> 
                  
            </div> 
            <div class="modal-footer"> 
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button> 
                <button type="submit" class="btn btn-info waves-effect waves-light" name="save">Edited</button> 
            </div> 
            </form>
        </div> 
    </div>
</div>
<!-- modal end-->

<script >
    $(document).ready(function() {
    $('#edit_model_currency').on('show.bs.modal' , function (event){
        var button = $(event.relatedTarget)
        var currency_id = button.data('currency_id')
        var  currency_name = button.data('currency_name')
        var currency_code = button.data('currency_code')
        var currency_symbol = button.data('currency_symbol')
        var currency_formate = button.data('currency_formate')
        var currency_exchange_rate = button.data('currency_exchange_rate')

        var modal = $(this)

        modal.find('.modal-body #currency_id').val(currency_id);
        modal.find('.modal-body #currency_name').val(currency_name);
        modal.find('.modal-body #currency_code').val(currency_code);
        modal.find('.modal-body #currency_symbol').val(currency_symbol);
        modal.find('.modal-body #currency_formate').val(currency_formate);
        modal.find('.modal-body #currency_exchange_rate').val(currency_exchange_rate);

    })
    });
</script>


<!-- modal for add-->
    <div class="modal fade bs-example-modal-md add_new_currency" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title mt-0" id="myLargeModalLabel">New Currency</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form action="{{url('tools-master/add_currency')}}" method="POST">
                   @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Enter Currency Name</label>
                            <input type="text" name="currency_name" class="form-control" value="" id="currency_name_add" >
                        </div>
                        <h6 id="currency_name_val"></h6>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Enter Currency Code</label>
                            <input type="text" name="currency_code" class="form-control" value="" id="currency_code_add" >
                        </div>
                        <h6 id="currency_code_val"></h6>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Enter Syamboll</label>
                            <input type="text" name="currency_symbol" class="form-control" value="" id="currency_symbol_add" >
                        </div>
                        <h6 id="currency_symbol_val"></h6>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Enter Formate</label>
                            <input type="text" name="currency_formate" class="form-control" value="" id="currency_formate_add" >
                        </div>
                        <h6 id="currency_formate_val"></h6>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Enter Exchange Rate</label>
                            <input type="text" name="currency_exchange_rate" class="form-control" value="" id="currency_exchange_rate_add" >
                        </div>
                        <h6 id="currency_exchange_rate_val"></h6>
                    </div>

                    <div class="col-md-12" style="text-align: right;">
                        <button type="submit" class="btn btn-primary waves-effect" id="btnSubmit">Save</button>
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
<!-- end of model  -->





<!-- for validation  -->

<script>
$(document).ready(function()
 {
  
   $("#currency_name_val").hide();
   $("#currency_code_val").hide();
   $("#currency_symbol_val").hide();
   $("#currency_formate_val").hide();
   $("#currency_exchange_rate_val").hide();



   

        $("#currency_name_add").blur(function(){
            username1();
        });
        $("#currency_code_add").blur(function(){
            username2();
        });
        $("#currency_symbol_add").blur(function(){
            username3();
        });
        $("#currency_formate_add").blur(function(){
            username4();
        });
        $("#currency_exchange_rate_add").blur(function(){
            username5();
        });



        
        function username1(){
          var p = $("#currency_name_add").val();
          if(p.length==""){
            $("#currency_name_val").show();
            $("#currency_name_val").html("Please input Currency Name");
            $("#currency_name_val").focus();
            $("#currency_name_val").css("color","red");

                err_add_currency_name=false;
                    return false;
          }
          else{
                err_add_currency_name=true;
              $("#currency_name_val").hide();
              
          }
        }

        function username2(){
          var p = $("#currency_code_add").val();
          if(p.length==""){
            $("#currency_code_val").show();
            $("#currency_code_val").html("Please input Currency Code");
            $("#currency_code_val").focus();
            $("#currency_code_val").css("color","red");

                err_add_currency_code=false;
                    return false;
          }
          else{
                err_add_currency_code=true;
              $("#currency_code_val").hide();
              
          }
        }

        function username3(){
          var p = $("#currency_symbol_add").val();
          if(p.length==""){
            $("#currency_symbol_val").show();
            $("#currency_symbol_val").html("Please input Syamboll");
            $("#currency_symbol_val").focus();
            $("#currency_symbol_val").css("color","red");

                err_add_currency_symbol=false;
                    return false;
          }
          else{
                err_add_currency_symbol=true;
              $("#currency_symbol_val").hide();
              
          }
        }

        function username4(){
          var p = $("#currency_formate_add").val();
          if(p.length==""){
            $("#currency_formate_val").show();
            $("#currency_formate_val").html("Please input  Formate");
            $("#currency_formate_val").focus();
            $("#currency_formate_val").css("color","red");

                err_add_currency_formate=false;
                    return false;
          }
          else{
                err_add_currency_formate=true;
              $("#currency_formate_val").hide();
              
          }
        }

        function username5(){
          var p = $("#currency_exchange_rate_add").val();
          if(p.length==""){
            $("#currency_exchange_rate_val").show();
            $("#currency_exchange_rate_val").html("Please input Exchange Rate");
            $("#currency_exchange_rate_val").focus();
            $("#currency_exchange_rate_val").css("color","red");

                err_add_currency_exchange_rate=false;
                    return false;
          }
          else{
                err_add_currency_exchange_rate=true;
              $("#currency_exchange_rate_val").hide();
              
          }
        }



        $("#btnSubmit").click(function(){
        err_add_currency_name=true;
        err_add_currency_code=true;
        err_add_currency_symbol=true;
        err_add_currency_formate=true;
        err_add_currency_exchange_rate=true;
        username1();
        username2();
        username3();
        username4();
        username5();
        if((err_add_currency_name==true)&&(err_add_currency_code==true)&&(err_add_currency_symbol==true)&&(err_add_currency_formate==true)&&(err_add_currency_exchange_rate==true))
        {
            return true;
        }
        else{
            return false;
        }
        });

       


  });
    </script>















































































