@extends('layouts.app')

@section('content')
<div class="col-md-10">
    <div class="card border-0 shadow rounded">
        <div class="card-body">
            Selamat Datang <strong>{{ auth()->user()->name }}</strong>
            <hr>
            <a href="{{ route('logout') }}" style="cursor: pointer" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" class="btn btn-md btn-primary">LOGOUT</a>
            <a href="{{ route('home.index') }}" style="cursor: pointer" class="btn btn-md btn-primary">BACK TO HOME</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <div class="container">
                <h1>Laravel 8 Ajax CRUD </h1>
                <a class="btn btn-success" href="javascript:void(0)" id="createNewCustomer">Create New Customer</a>
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Details</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            
            <div class="modal fade" id="ajaxModel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelHeading"></h4>
                        </div>
                        <div class="modal-body">
                            <form id="CustomerForm" name="CustomerForm" class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                               <input type="hidden" name="customer_id" id="customer_id">
                                <div class="form-group">
                                    <label for="first_name" class="col-sm-4 control-label">First Name</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" value="" maxlength="50" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="first_name" class="col-sm-4 control-label">Last Name</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" value="" maxlength="50" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address" class="col-sm-4 control-label">Address</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" value="" maxlength="50" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address" class="col-sm-4 control-label">Foto Customer</label>
                                    <div class="col-sm-12">
                                        <div id="divFoto">
                                            <br>
                                            Current Foto :
                                            <br>
                                            <img id="fotocustomer" src="" alt="">
                                        </div>
                                        <input type="file" name="foto"  class="form-control" placeholder="Foto">
                                    </div>
                                </div>
                               
                                <div class="col-sm-offset-2 col-sm-10">
                                 <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                                 </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')
<script type="text/javascript">
     $(document).ready(function(){
  
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });
  
      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('customers.list') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'first_name', name: 'first_name'},
              {data: 'last_name', name: 'last_name'},
              {data: 'action', name: 'action', orderable: false, searchable: false}
          ]
      });
  
      $('#createNewCustomer').click(function () {
        $('#divFoto').hide();
          $('#saveBtn').val("create-Customer");
          $('#customer_id').val('');
          $('#CustomerForm').trigger("reset");
          $('#modelHeading').html("Create New Customer");
          $('#ajaxModel').modal('show');
          $('#fotocustomer').attr('src',"")
          $('#divFoto').hide();
      });
  
      $('body').on('click', '.editCustomer', function () {
        var Customer_id = $(this).data('id');
        $.get("" +'/customers/' + Customer_id +'/edit', function (data) {
            $('#modelHeading').html("Edit Customer");
            $('#saveBtn').val("edit-user");
            $('#ajaxModel').modal('show');
            $('#customer_id').val(data.id);
            $('#first_name').val(data.first_name);
            $('#last_name').val(data.last_name);
            $('#address').val(data.address);
            $('#fotocustomer').attr('src',"{{asset('storage')}}/"+data.foto)
            $('#divFoto').show();
        })
     });
  
     $('#CustomerForm').submit(function(e) {
          e.preventDefault();
          $('#saveBtn').html('Sending..');
          let formData = new FormData(this);
          let customer_id = $('#customer_id').val();
          let url;
          if(customer_id == ''){
            url = "{{ route('customers.store') }}"
          }else{
            url = "{{ route('customers.update') }}"
          }

          $.ajax({
            data: formData,
            url:  url,
            type: "POST",
            contentType: false,
            processData: false,
            success: function (data) {
                $('#CustomerForm').trigger("reset");
                $('#ajaxModel').modal('hide');
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
        $('#saveBtn').html('Save Changes');
      });

  
      $('body').on('click', '.deleteCustomer', function () {
  
          var Customer_id = $(this).data("id");
          if (window.confirm("Are You sure want to delete ?")) {
            $.ajax({
              type: "DELETE",
              data: {
                    '_token':"{{ csrf_token() }}"
              },
              url: ""+'customers/destroy/'+Customer_id,
              success: function (data) {
                  table.draw();
              },
              error: function (data) {
                  console.log('Error:', data);
              }
          });
        }
         
      });
  
    });
  </script>
@endsection