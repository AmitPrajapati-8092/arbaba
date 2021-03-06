
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
                        <li class="active">Country</li>
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
                            <table id="datatable" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Country Name</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $sl_no=1; ?>

                                        @foreach ($toReturn as $value)
                                        <tr>
                                            <?php $id=$value['id']; ?> 
                                                <td>{{$sl_no++}}</td>
                                                <td>{{$value['country']}}</td>
                                                <td class="actions">
                                                    <a href="#" class="on-default edit-row" data-coun_id="{{$id}}" data-country_name="{{$value['country']}}" data-toggle="modal" data-target="#edit_model_practic" title="edit" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                                    <a href="{{url('tools-master/delete_country/'.$value['id'])}}" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fas fa-trash"></i></a>
                                                </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--card body-->
                    </div>
                    <!--card border-->
                </div>
                <!--col-->
            </div>
            <!--end of row-->
        </div>
    </div>
</div>
</div>

<!-- model for update-->
<div id="edit_model_practic" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-header">
                <h4 class="modal-title mt-0">Edit Country</h4> 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div> 
            <div class="modal-body"> 
                <form action ="{{url('tools-master/update_country')}}" method="post">
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group">
                                <input type="hidden" name="_token" value = "{{ csrf_token()  }}" > 
                                    <label for="field-1" class="control-label">Country</label> 
                                        <input type="hidden" id="coun_id" name="coun_id"> 
                                        <input type="text" class="form-control"  name="country_name" id="country_name"  required placeholder="enter here...about"> 
                            </div> 
                            <h6 id="country_name_edit_val"></h6>
                        </div> 
                    </div> 
            </div> 
            <div class="modal-footer"> 
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button> 
                <button type="submit" id="edit_submit" class="btn btn-info waves-effect waves-light" name="save">Edited</button> 
            </div> 
            </form>
        </div> 
    </div>
</div>
<!-- modal end-->

<script >
    $(document).ready(function() {
    $('#edit_model_practic').on('show.bs.modal' , function (event){
        var button = $(event.relatedTarget)
        var  country_name = button.data('country_name')
        var coun_id = button.data('coun_id')
        var modal = $(this)

        modal.find('.modal-body #country_name').val(country_name);
        modal.find('.modal-body #coun_id').val(coun_id);

    })
    });
</script>


<!-- modal for add-->
    <div class="modal fade bs-example-modal-md recurring-expenses" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title mt-0" id="myLargeModalLabel">New Country</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form action="{{url('tools-master/add_country')}}" method="POST">
                   @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Enter Country</label>
                            <input type="text" name="country_name" class="form-control" value="" id="country_name_add">
                        </div>
                        <h6 id="country_name_add_val"></h6>
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
  
   $("#country_name_add_val").hide();
   $("#country_name_edit_val").hide();
   

        $("#country_name_add").blur(function(){
            username3();
        });
        $("#country_name").blur(function(){
            username4();
        });
       
        
        function username3(){
          var p = $("#country_name_add").val();
          if(p.length==""){
            $("#country_name_add_val").show();
            $("#country_name_add_val").html("Please input the Country");
            $("#country_name_add_val").focus();
            $("#country_name_add_val").css("color","red");

                err_add_country=false;
                    return false;
          }
          else{
                err_add_country=true;
              $("#country_name_add_val").hide();
              
          }
        }

        function username4(){
          var p = $("#country_name").val();
          if(p.length==""){
            $("#country_name_edit_val").show();
            $("#country_name_edit_val").html("Please input the Country");
            $("#country_name_edit_val").focus();
            $("#country_name_edit_val").css("color","red");

                err_edit_country=false;
                    return false;
          }
          else{
                err_edit_country=true;
              $("#country_name_edit_val").hide();
              
          }
        }
       


        $("#btnSubmit").click(function(){
        err_add_country=true;
        username3();
        if(err_add_country==true)
        {
            return true;
        }
        else{
            return false;
        }
        });

        $("#err_edit_country").click(function(){
            err_edit_country=true;
        username4();
        if(err_edit_country==true)
        {
            return true;
        }
        else{
            return false;
            
        }

        });


  });
    </script>


















































































