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
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="sys-role-table" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Role Key</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($list))
                  @foreach($list as $key => $value)
                    <tr>
                      <td><span id="td_name_{{$value['id']}}">{{$value['role_key']}}</td></span>
                      <td><span id="td_desc_{{$value['id']}}">{{$value['description']}}</span></td>
                      <td>
                          <button type="button" class="btn btn-xs" onclick="openSR('{{$value['role_key']}}')"><i class="fa fa-tools" title="System Role"></i></button>
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
    @if($utils::checkPermissions('add_tools') || $utils::checkPermissions('edit_tools'))
      <!-- ADD MODAL -->
      <div class="modal fade" id="modal-tools">
          <div class="modal-dialog modal-lg">
            <div class="modal-content" id="modal-content-tools">
              <div class="modal-header">
                <h4 class="modal-title" id="modal-h4">System Permission Management</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <div class="modal-body">
                    <!-- form start -->
                  <div class="card-body">
                    <div class="form-group">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">
                            <input type="hidden" id="role_key" name="role_key">
                            <span>Permission</span>
                          </h3>
                        </div>
                        <div class="card-body">
                          <table id="system-permission-table" class="table table-bordered">
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
          $("#sys-role-table").DataTable();
        });

        $('#submitBtn').click(function() {
             $('#modal_header').text("Confirmation");
             $('#modal_message').text("Are you sure you want to procced?");
             $('#confirm_submit').attr("onclick","submit_form('formAddTeams')");
        });

        function openSR(role_key){
          $('#modal-content-tools').prepend('<div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync fa-spin"></i></div>');
          $('#role_key').val('');
          $('#role_key').val(role_key);
          $('#modal-tools').modal();
          loadSRPermission();
        }

        function loadSRPermission() {
          $("#system-permission-table").DataTable().destroy();
          $("#system-permission-table").DataTable(
            {
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                  url: '{!! route('datatables.system-permission-by-role') !!}',
                  type: 'GET',
                  data: function (d) {
                    d.role_key = $('#role_key').val();
                  }
                },
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'permission_key', render: function (data, type, row) {
                      if(row.enabled){
                        return '<div class="form-check"><input class="form-check-input" id="'+row.permission_key+'" type="checkbox" checked onclick="changeCheckbox(this)"></div>'; 
                      } else{
                        return '<div class="form-check"><input class="form-check-input" id="'+row.permission_key+'" type="checkbox" onclick="changeCheckbox(this)"></div>'; 
                      }
                      }
                     
                    }
                ]
            });
        }

        function changeCheckbox($this){
          var permission_key = $($this).attr("id");
          var role_key = $('#role_key').val();
          var checked = $($this).attr("checked");
          if (typeof checked !== typeof undefined && checked !== false) {
            $($this).removeAttr("checked");
            updatePermission(role_key,permission_key,false)
          }else {
            $($this).attr("checked","");
            updatePermission(role_key,permission_key,true)
          }
          
        }
        function updatePermission(role_key,permission_key,status){
          $.post("{{route('ajax.update-role-permission')}}", { role_key: role_key, permission_key: permission_key, status: status , _token: "{{ csrf_token() }}" }, function(data, status){
            if(status === 'success'){
              alerts_float(data.alert_status,data.alert_msg,data.alert_class);
            }
          })
          .fail(function(response) { 
            alerts_float('Error',"All fields are required!",'bg-danger');
          });
        }
        $(document).ajaxStop(function() {
          $('.overlay').remove();
        });
      </script>
    @endsection
@endsection
