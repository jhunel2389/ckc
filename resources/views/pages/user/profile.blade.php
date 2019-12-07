@extends('layouts.app')

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{asset('resources/dist/img/user4-128x128.jpg')}}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{$user_info['firstname']}} {{$user_info['lastname']}}</h3>

                <p class="text-muted text-center">{{(($user_info['er_name'])?$user_info['er_name']:"No Data")}}</p>
	                <ul class="list-group list-group-unbordered mb-3">
	                  <li class="list-group-item">
	                    <b>Username:</b> <a class="float-right">{{$user_info['username']}}</a>
	                  </li>
	                  <li class="list-group-item">
	                    <b>Email:</b> <a class="float-right">{{$user_info['email']}}</a>
	                  </li>
                    <li class="list-group-item">
                      <b>System Role:</b> <a class="float-right">{{$user_info['role_description']}}</a>
                    </li>
	                  <li class="list-group-item">
	                    <b>Site Location:</b> <a class="float-right" style="color: {{($user_info['site_location'])?'':'red'}};">{{($user_info['site_location'])?$user_info['site_location']:"No Data"}}</a>
	                  </li>
	                  <li class="list-group-item">
	                    <b>Shift:</b> <a class="float-right" style="color: {{($user_info['shift'])?'':'red'}};">{{($user_info['shift'])?$user_info['shift']:"No Data"}}</a>
	                  </li>
	                  <li class="list-group-item">
	                    <b>Team:</b> <a class="float-right" style="color: {{($user_info['team_name'])?'':'red'}};">{{($user_info['team_name'])?$user_info['team_name']:"No Data"}}</a>
	                  </li>
	                  <li class="list-group-item">
	                    <b>Accenture Exp.:</b> <a class="float-right" style="color: {{($user_info['accenture_exp'])?'':'red'}};">{{($user_info['accenture_exp'])?$user_info['accenture_exp']:"No Data"}}</a>
	                  </li>
	                  <li class="list-group-item">
	                    <b>Working Exp.:</b> <a class="float-right" style="color: {{($user_info['working_exp'])?'':'red'}};">{{($user_info['working_exp'])?$user_info['working_exp']:"No Data"}}</a>
	                  </li>
	                </ul>
                  @if($user_info['id'] == Auth::User()->id || $utils::checkPermissions('edit_user_profile'))
                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-lg" onclick="openEditModal();">
                  Edit
                  </button>
                  @endif
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-9">
          	<!-- Primary Tools Proficiency Table-->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Primary Tools Proficiency</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Tools</th>
                  <th>P0</th>
                  <th>P1</th>
                  <th>P2</th>
                  <th>P3</th>
                  <th>P4</th>
                  <th>P5</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>SQL</td>
                  <td><i class="fas fa-star" style="color: red;"></i></td>
                  <td><i class="fas fa-star" style="color: red;"></td>
                  <td><i class="fas fa-star" style="color: red;"></td>
                  <td><i class="far fa-star"></td>
                  <td><i class="far fa-star"></td>
                  <td><i class="far fa-star"></td>
                </tr>
                <tr>
                  <td>Informatica</td>
                  <td><i class="fas fa-star" style="color: red;"></i></td>
                  <td><i class="fas fa-star" style="color: red;"></i></td>
                  <td><i class="far fa-star"></td>
                  <td><i class="far fa-star"></td>
                  <td><i class="far fa-star"></td>
                  <td><i class="far fa-star"></td>
                </tr>
                <tr>
                  <td>Agile</td>
                  <td><i class="fas fa-star" style="color: red;"></i></td>
                  <td><i class="far fa-star"></td>
                  <td><i class="far fa-star"></td>
                  <td><i class="far fa-star"></td>
                  <td><i class="far fa-star"></td>
                  <td><i class="far fa-star"></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                </tr>
                </tfoot>
              </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- end table -->
            <!-- Secondary Tools Proficiency Table-->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Secondary Tools Proficiency</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Tools</th>
                  <th>P0</th>
                  <th>P1</th>
                  <th>P2</th>
                  <th>P3</th>
                  <th>P4</th>
                  <th>P5</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>Safety</td>
                  <td><i class="fas fa-star" style="color: red;"></i></td>
                  <td><i class="fas fa-star" style="color: red;"></td>
                  <td><i class="fas fa-star" style="color: red;"></td>
                  <td><i class="far fa-star"></td>
                  <td><i class="far fa-star"></td>
                  <td><i class="far fa-star"></td>
                </tr>
                <tr>
                  <td>Data Modeling</td>
                  <td><i class="fas fa-star" style="color: red;"></i></td>
                  <td><i class="fas fa-star" style="color: red;"></i></td>
                  <td><i class="far fa-star"></td>
                  <td><i class="far fa-star"></td>
                  <td><i class="far fa-star"></td>
                  <td><i class="far fa-star"></td>
                </tr>
                <tr>
                  <td>Data Analysis</td>
                  <td><i class="fas fa-star" style="color: red;"></i></td>
                  <td><i class="far fa-star"></td>
                  <td><i class="far fa-star"></td>
                  <td><i class="far fa-star"></td>
                  <td><i class="far fa-star"></td>
                  <td><i class="far fa-star"></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                </tr>
                </tfoot>
              </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- end table -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
      <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit User Information</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('editProfile') }}" method="POST" id="formEditProfile">
              @csrf
              <div class="modal-body">
                  <!-- form start -->
                    <div class="card-body">
                      <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" readonly value="{{$user_info['username']}}">
                      </div>
                      <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{$user_info['email']}}" readonly>
                      </div>
                      @if($utils::checkPermissions('edit_user_profile'))
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-9">
                              <label>Current System Role:</label> <span id="role_name"> {{$user_info['role_description']}}</span>
                            </div>
                            <div class="col-md-3 text-right">
                              <input type="hidden" class="form-control" id="role_key" name="role_key" value="">
                              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                Select Role
                              </button>
                              <div class="dropdown-menu">
                                @if(!empty($role_list))
                                  @foreach($role_list as $key => $value)
                                    @if($value['id'] != $user_info['team_id'])
                                    <a class="dropdown-item" href="#" onclick="selectedRole('{{$value['description']}}','{{$value['role_key']}}')">
                                    {{$value['description']}}
                                    </a>
                                    @endif
                                  @endforeach
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                      @else
                      <div class="form-group">
                        <label for="email">System Role</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{$user_info['role_description']}}" readonly>
                      </div>
                      @endif
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-9">
                            <label>Current Team:</label> <span id="team_name" style="color: {{($user_info['team_name'])?'':'red'}};">{{($user_info['team_name'])?$user_info['team_name']:"No Data"}}</span>
                          </div>
                          <div class="col-md-3 text-right">
                            <input type="hidden" class="form-control" id="team" name="team" value="">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" id='btn-team'>
                              Select Team
                            </button>
                            <div class="dropdown-menu" id='drp-team'>
                              @if(!empty($team_list))
                                @foreach($team_list as $key => $value)
                                  @if($value['id'] != $user_info['team_id'])
                                  <a class="dropdown-item" href="#" onclick="selectedTeams('{{$value['team_name']}}','{{$value['id']}}')">
                                  {{$value['team_name']}}
                                  </a>
                                  @endif
                                @endforeach
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-9">
                            <label>Current Employee Role:</label> <span id="er_name" style="color: {{($user_info['er_name'])?'':'red'}};">{{(($user_info['er_name'])?$user_info['er_name']:"No Data")}}</span>
                          </div>
                          <div class="col-md-3 text-right">
                            <input type="hidden" class="form-control" id="er_key" name="er_key" value="">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" id="btn-er" disabled>
                              Select Employee Role
                            </button>
                            <div class="dropdown-menu" id="drp-er">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="firstname">Firstname</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" value="{{$user_info['firstname']}}">
                      </div>
                      <div class="form-group">
                        <label for="lastname">Lastname</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" value="{{$user_info['lastname']}}">
                      </div>
                      <div class="form-group">
                        <label for="site_location">Site Location</label>
                        <input type="text" class="form-control" id="site_location" name="site_location" value="{{$user_info['site_location']}}">
                      </div>
                      <div class="form-group">
                        <label for="shift">Shift</label>
                        <input type="text" class="form-control" id="shift" name="shift" value="{{$user_info['shift']}}">
                      </div>
                      <div class="form-group">
                        <label for="accenture_exp">Accenture Exp.</label>
                        <input type="text" class="form-control" id="accenture_exp" name="accenture_exp" value="{{$user_info['accenture_exp']}}">
                      </div>
                      <div class="form-group">
                        <label for="working_exp">Working Exp.</label>
                        <input type="text" class="form-control" id="working_exp" name="working_exp" value="{{$user_info['working_exp']}}">
                      </div>
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
    </section>
    <!-- /.content -->
    @section('custom_script')
      <script>
        $(function () {
          $(".table").DataTable();
        });

        $('#submitBtn').click(function() {
             $('#modal_header').text("Confirmation");
             $('#modal_message').text("Are you sure you want to procced?");
             $('#confirm_submit').attr("onclick","submit_form('formEditProfile')");
        });

        function selectedTeams($team_name,$team_id){
          $('#team').val($team_id);
          $('#team_name').text($team_name);
          $('#er_id').val('');
          getEmployeeRole($team_id);
        }

        function getEmployeeRole($team_id){
          $.get("{{route('getEmployeeRoleByTeam')}}",{team_id: $('#team').val()}, function(data, status){
            if(status === 'success'){
              $('#drp-er').empty();
              if(data.length > 0){
                $.each(data, function(i, item) {
                  $('#drp-er').append($('<a />' , { 'class' : 'dropdown-item' , 'href' : '#', 'text' : data[i].name, 'onclick' : 'selectER("'+data[i].id+'","'+data[i].name+'")'}));
                }); 
                $('#btn-er').removeAttr('disabled');
              }
            }
          });
        }

        function selectedRole($role_name,$role_key){
          $('#role_key').val($role_key);
          $('#role_name').text($role_name);
        }

        function selectER($er_id,$er_name){
          $('#er_key').val($er_id);
          $('#er_name').text($er_name);
        }

        function clearHiddenInput(){
          $('#team').val('');
          $('#role_key').val('');
          $('#er_key').val('');
          if($('#drp-team *').length === 0){
            $('#btn-team').attr('disabled','');
          }
        }

        function openEditModal(){
          $('#btn-er').attr('disabled','');
        }

        clearHiddenInput();
      </script>
    @endsection
@endsection
