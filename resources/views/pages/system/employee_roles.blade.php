@extends('layouts.app')

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-11">
                  <h3 class="card-title">
                    <span>Summary</span>
                  </h3>
                </div>
                <div class="col-md-1">
                  @if($utils::checkPermissions('add_employee_roles'))
                  <button type="button" class="btn btn-block btn-success btn-xs" onclick="showModal('add_item','')">Add</button>
                  @endif
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($list))
                  @foreach($list as $key => $value)
                    <tr>
                      <td>{{$value['id']}}</td>
                      <td><span id="td_name_{{$value['id']}}">{{$value['name']}}</td></span>
                      <td><span id="td_desc_{{$value['id']}}">{{$value['description']}}</span></td>
                      <td>{{$utils::statusIntToString($value['status'])}}</td>
                      <td>
                        
                        <form action="{{ route('updateEmployeeRoles') }}" method="POST" id="formUpdateStatus">
                          @csrf
                          @if($utils::checkPermissions('edit_employee_roles'))
                          <button type="button" class="btn btn-xs" onclick="showModal('update_item','{{$value['id']}}')"><i class="fa fa-edit" title="Edit"></i></button>
                          @endif
                          @if($value['status'] != 2 && $utils::checkPermissions('disable_employee_roles'))
                            <button type="button" class="btn btn-xs" data-toggle="modal" data-target="#modal-default" onclick="editStatus('disable_item','{{2}}','{{$value['id']}}')"><i class="fa fa-ban" title="Disable"></i>
                            </button>
                          @endif
                          @if($value['status'] != 1 && $utils::checkPermissions('disable_employee_roles'))
                            <button type="button" class="btn btn-xs" data-toggle="modal" data-target="#modal-default" onclick="editStatus('active_item','{{1}}','{{$value['id']}}')"><i class="fa fa-check-circle" title="Active"></i>
                            </button>
                          @endif
                          @if($utils::checkPermissions('delete_employee_roles'))
                            <button type="button" class="btn btn-xs" data-toggle="modal" data-target="#modal-default" onclick="editStatus('trash_item','{{0}}','{{$value['id']}}')"><i class="fa fa-trash" title="Delete"></i></button>
                            <input type="hidden" id="status" name="status">
                            <input type="hidden" id="status_id" name="status_id">
                          @endif
                          <button type="button" class="btn btn-xs" onclick="openTools('{{$value['id']}}')"><i class="fa fa-tools" title="Tools"></i></button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                @endif
                </tbody>
                <tfoot>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    @if($utils::checkPermissions('add_employee_roles') || $utils::checkPermissions('edit_employee_roles'))
      <!-- ADD MODAL -->
      <div class="modal fade" id="modal-form">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="modal-h4">Add Employee Roles</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="{{ route('addEmployeeRoles') }}" method="POST" id="formAddTeams">
                @csrf
                <div class="modal-body">
                    <!-- form start -->
                      <div class="card-body">
                        <div class="form-group">
                          <label for="team_name">Name</label>
                          <input type="text" class="form-control" id="name" name="name" value="" placeholder="Enter tools name" required>
                        </div>
                        <div class="form-group">
                          <label for="description">Description</label>
                          <input type="text" class="form-control" id="description" name="description" placeholder="Enter team description" value="">
                        </div>
                        <input type="hidden" id="data_id" name="data_id">
                      </div>
                      <!-- /.card-body -->
                    
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" id="submitBtn" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">Save changes</button>
                </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      </div>
      <!-- END MODAL -->
    @endif
    @if($utils::checkPermissions('edit_employee_roles'))
      <!-- ADD MODAL -->
      <div class="modal fade" id="modal-tools">
          <div class="modal-dialog modal-lg">
            <div class="modal-content" id="modal-content-tools">
              <div class="modal-header">
                <h4 class="modal-title" id="modal-h4">Tools Management</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <div class="modal-body">
                    <!-- form start -->
                  <div class="card-body">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-4">
                          <label>Select Tools:</label>
                          <span class="span-modal" id="tool_name"></span>
                          <input type="hidden" id="tool_id" name="tool_id">
                          <input type="hidden" id="er_id" name="er_id">
                          <br>
                          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" id="btn-tools" disabled>
                            Tools
                          </button>
                          <div class="dropdown-menu" id="drp-tools">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <label>Select Category:</label>
                          <span class="span-modal" id="cat_name"></span>
                          <input type="hidden" id="cat_id" name="cat_id">
                          <br>
                          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            Category
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="#" onclick="selectCat(1,'Primary')">Primary</a>
                            <a class="dropdown-item" href="#" onclick="selectCat(2,'Secondary')">Secondary</a>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <button type="button" class="btn btn-block btn-success btn-sm" onclick="addTools()">Add</button>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">
                            <span>Primary Tools</span>
                          </h3>
                        </div>
                        <div class="card-body">
                          <table id="tool-primary-table" class="table table-bordered">
                            <thead>
                            <tr>
                              <th>Name</th>
                              <th>Action</th>
                            </tr>
                            </thead>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">
                            <span>Secondary Tools</span>
                          </h3>
                        </div>
                        <div class="card-body">
                          <table id="tool-secondary-table" class="table table-bordered">
                            <thead>
                            <tr>
                              <th>Name</th>
                              <th>Action</th>
                            </tr>
                            </thead>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                      <!-- /.card-body -->
                <div class="modal-footer justify-content-between">
                </div>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      </div>
      <!-- END MODAL -->
    @endif
    @section('custom_script')
      <script>
        $(function () {
          $("#example2").DataTable();
        });

        function loadPrimaryToolsTable() {
          $("#tool-primary-table").DataTable().destroy();
          $("#tool-primary-table").DataTable(
            {
                processing: true,
                serverSide: true,
                ajax: {
                  url: '{!! route('datatables.primary-tools') !!}',
                  type: 'GET',
                  data: function (d) {
                    d.er_id = $('#er_id').val();;
                  }
                },
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'id', render: function (dataField) {
                     return '<button type="button" class="btn btn-xs" onclick="removeTools('+dataField+')"><i class="fa fa-trash" title="Tools"></i></button>'; }
                    }
                ]
            });
        }

        function loadSecondaryToolsTable() {
          $("#tool-secondary-table").DataTable().destroy();
          $("#tool-secondary-table").DataTable(
            {
                processing: true,
                serverSide: true,
                ajax: {
                  url: '{!! route('datatables.secondary-tools') !!}',
                  type: 'GET',
                  data: function (d) {
                    d.er_id = $('#er_id').val();;
                  }
                },
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'id', render: function (dataField) {
                     return '<button type="button" class="btn btn-xs" onclick="removeTools('+dataField+')"><i class="fa fa-trash" title="Tools"></i></button>'; }
                    }
                ]
            });
        }

        function addToolsER(){
          $.post("{{route('ajax.add-er-tools')}}", { er_id: $('#er_id').val(), tool_id: $('#tool_id').val(), category_id: $('#cat_id').val(), _token: "{{ csrf_token() }}" }, function(data, status){
            if(status === 'success'){
              alerts_float(data.alert_status,data.alert_msg,data.alert_class);
              refreshAjaxCall();
            }
          })
          .fail(function(response) { 
            alerts_float('Error',"All fields are required!",'bg-danger');
          });
        }

        $('#submitBtn').click(function() {
             $('#modal_header').text("Confirmation");
             $('#modal_message').text("Are you sure you want to procced?");
             $('#confirm_submit').attr("onclick","submit_form('formAddTeams')");
        });

        function editStatus($action,$statusTo,$id){
            $('#modal_header').text("Confirmation");
            $('#modal_message').text("Are you sure you want to procced?");
            $('#confirm_submit').attr("onclick","submit_form('formUpdateStatus')");
            $('#status').val($statusTo);
            $('#status_id').val($id);
        }

        function showModal($action,$id){
          if($action == 'update_item'){
            $('#modal-h4').text("Update Team");
            $('#data_id').val($id);
            $('#name').val($('#td_name_'+$id).text());
            $('#description').val($('#td_desc_'+$id).text());
          }

          $('#modal-form').modal()
        }

        function getTools(){
          $.get("{{route('getTools')}}",{er_id: $('#er_id').val()}, function(data, status){
            if(status === 'success'){
              $('#drp-tools').empty();
              if(data.length > 0){
                $.each(data, function(i, item) {
                  $('#drp-tools').append($('<a />' , { 'class' : 'dropdown-item' , 'href' : '#', 'text' : data[i].name, 'onclick' : 'selectTools("'+data[i].id+'","'+data[i].name+'")'}));
                }); 
                $('#btn-tools').removeAttr('disabled');
              }
              
            }
          });
        }

        function openTools(er_id){
          $('#tool_id').val('');
          $('#tool_name').html('');
          $('#cat_id').val('');
          $('#cat_name').text('');
          $('#er_id').html('');
          $('#er_id').val(er_id);
          $('#modal-tools').modal();
          refreshAjaxCall();
        }

        function selectTools(tool_id,name){
          $('#tool_id').val(tool_id);
          $('#tool_name').text(name);
        }

        function selectCat(id,name){
          $('#cat_id').val(id);
          $('#cat_name').text(name);
        }

        function removeTools(id){
          $.post("{{route('ajax.delete-er-tools')}}", { ert_id: id, _token: "{{ csrf_token() }}" }, function(data, status){
            if(status === 'success'){
              alerts_float(data.alert_status,data.alert_msg,data.alert_class);
              refreshAjaxCall();
            }
          })
          .fail(function(response) { 
            alerts_float('Error',"Error Occur. Please try again!",'bg-danger');
          });
        }

        function addTools(){
          addToolsER();
        }

        function refreshAjaxCall(){
          $('#modal-content-tools').prepend('<div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync fa-spin"></i></div>');
          $('#tool_id').val('');
          $('#tool_name').html('');
          $('#cat_id').val('');
          $('#cat_name').text('');
          getTools();
          loadPrimaryToolsTable();
          loadSecondaryToolsTable();
        }
        $(document).ajaxStop(function() {
          $('.overlay').remove();
        });
      </script>
    @endsection
@endsection
