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
                  @if($utils::checkPermissions('add_teams'))
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
                  <th>Team ID</th>
                  <th>Team Name</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($team_list))
                  @foreach($team_list as $key => $value)
                    <tr>
                      <td>{{$value['id']}}</td>
                      <td><span id="td_name_{{$value['id']}}">{{$value['team_name']}}</td></span>
                      <td><span id="td_desc_{{$value['id']}}">{{$value['description']}}</span></td>
                      <td>{{$utils::statusIntToString($value['status'])}}</td>
                      <td>
                        
                        <form action="{{ route('updateTeam') }}" method="POST" id="formUpdateStatus">
                          @csrf
                          @if($utils::checkPermissions('edit_teams'))
                          <button type="button" class="btn btn-xs" onclick="showModal('update_item','{{$value['id']}}')"><i class="fa fa-edit" title="Edit"></i></button>
                          @endif
                          @if($value['status'] != 2 && $utils::checkPermissions('disable_teams'))
                            <button type="button" class="btn btn-xs" data-toggle="modal" data-target="#modal-default" onclick="editStatus('disable_item','{{2}}','{{$value['id']}}')"><i class="fa fa-ban" title="Disable"></i>
                            </button>
                          @endif
                          @if($value['status'] != 1 && $utils::checkPermissions('disable_teams'))
                            <button type="button" class="btn btn-xs" data-toggle="modal" data-target="#modal-default" onclick="editStatus('active_item','{{1}}','{{$value['id']}}')"><i class="fa fa-check-circle" title="Active"></i>
                            </button>
                          @endif
                          @if($utils::checkPermissions('delete_teams'))
                            <button type="button" class="btn btn-xs" data-toggle="modal" data-target="#modal-default" onclick="editStatus('trash_item','{{0}}','{{$value['id']}}')"><i class="fa fa-trash" title="Delete"></i></button>
                            <input type="hidden" id="status" name="status">
                            <input type="hidden" id="team_status_id" name="team_status_id">
                          @endif
                          <button type="button" class="btn btn-xs" onclick="openER('{{$value['id']}}')"><i class="fa fa-tools" title="Employee Role"></i></button>
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
    @if($utils::checkPermissions('add_teams') || $utils::checkPermissions('edit_teams'))
      <!-- ADD MODAL -->
      <div class="modal fade" id="modal-form">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="modal-h4">Add Team</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="{{ route('addTeams') }}" method="POST" id="formAddTeams">
                @csrf
                <div class="modal-body">
                    <!-- form start -->
                      <div class="card-body">
                        <div class="form-group">
                          <label for="team_name">Team Name</label>
                          <input type="text" class="form-control" id="team_name" name="team_name" value="" placeholder="Enter team name" required>
                        </div>
                        <div class="form-group">
                          <label for="description">Team Description</label>
                          <input type="text" class="form-control" id="description" name="description" placeholder="Enter team description" value="">
                        </div>
                        <input type="hidden" id="team_id" name="team_id">
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
    @if($utils::checkPermissions('edit_teams'))
      <!-- ADD MODAL -->
      <div class="modal fade" id="modal-tools">
          <div class="modal-dialog modal-lg">
            <div class="modal-content" id="modal-content-tools">
              <div class="modal-header">
                <h4 class="modal-title" id="modal-h4">Employee Role Management</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <div class="modal-body">
                    <!-- form start -->
                  <div class="card-body">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-6">
                          <label>Select Employee Role:</label>
                          <span class="span-modal" id="er_name"></span>
                          <input type="hidden" id="er_id" name="er_id">
                          <br>
                          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" id="btn-team" disabled>
                            Employee Role
                          </button>
                          <div class="dropdown-menu" id="drp-er">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <button type="button" class="btn btn-block btn-success btn-sm" onclick="addER()">Add</button>
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
          $(".table").DataTable();
        });

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
            $('#team_status_id').val($id);
        }

        function showModal($action,$id){
          if($action == 'update_item'){
            $('#modal-h4').text("Update Team");
            $('#team_id').val($id);
            $('#team_name').val($('#td_name_'+$id).text());
            $('#description').val($('#td_desc_'+$id).text());
          }

          $('#modal-form').modal()
        }

        function openER(team_id){
          $('#er_id').val('');
          $('#er_name').html('');
          $('#team_id').html('');
          $('#team_id').val(team_id);
          $('#modal-tools').modal();
          refreshAjaxCall();
        }

        function getTeams(){
          $.get("{{route('getTeams')}}",{team_id: $('#team_id').val()}, function(data, status){
            if(status === 'success'){
              $('#drp-er').empty();
              if(data.length > 0){
                $.each(data, function(i, item) {
                  $('#drp-er').append($('<a />' , { 'class' : 'dropdown-item' , 'href' : '#', 'text' : data[i].name, 'onclick' : 'selectER("'+data[i].id+'","'+data[i].name+'")'}));
                }); 
                $('#btn-team').removeAttr('disabled');
              }
              
            }
          });
        }

        function selectER(er_id,name){
          $('#er_name').html(name);
          $('#er_id').val(er_id);
        }

        function refreshAjaxCall(){
          $('#modal-content-tools').prepend('<div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync fa-spin"></i></div>');
          $('#er_id').val('');
          $('#er_name').html('');
          $('#btn-team').attr('disabled','');
          getTeams();
          loadTeamERTable();
        }

        function addER(){
          addERTeam();
        }

        function addERTeam(){
          $.post("{{route('ajax.add-team-er')}}", { er_id: $('#er_id').val(), team_id: $('#team_id').val(), _token: "{{ csrf_token() }}" }, function(data, status){
            if(status === 'success'){
              alerts_float(data.alert_status,data.alert_msg,data.alert_class);
              refreshAjaxCall();
            }
          })
          .fail(function(response) { 
            alerts_float('Error',"All fields are required!",'bg-danger');
          });
        }

        function loadTeamERTable() {
          $("#tool-primary-table").DataTable().destroy();
          $("#tool-primary-table").DataTable(
            {
                processing: true,
                serverSide: true,
                ajax: {
                  url: '{!! route('datatables.team-er') !!}',
                  type: 'GET',
                  data: function (d) {
                    d.team_id = $('#team_id').val();;
                  }
                },
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'id', render: function (dataField) {
                     return '<button type="button" class="btn btn-xs" onclick="removeER('+dataField+')"><i class="fa fa-trash" title="Tools"></i></button>'; }
                    }
                ]
            });
        }

        function removeER(id){
          $.post("{{route('ajax.delete-team-er')}}", { ter_id: id, _token: "{{ csrf_token() }}" }, function(data, status){
            if(status === 'success'){
              alerts_float(data.alert_status,data.alert_msg,data.alert_class);
              refreshAjaxCall();
            }
          })
          .fail(function(response) { 
            alerts_float('Error',"Error Occur. Please try again!",'bg-danger');
          });
        }

        $(document).ajaxStop(function() {
          $('.overlay').remove();
        });
      </script>
    @endsection
@endsection
