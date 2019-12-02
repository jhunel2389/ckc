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
                       src="../resources/dist/img/user4-128x128.jpg"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{$user_info['firstname']}} {{$user_info['lastname']}}</h3>

                <p class="text-muted text-center">Software Engineer</p>
	                <ul class="list-group list-group-unbordered mb-3">
	                  <li class="list-group-item">
	                    <b>Username:</b> <a class="float-right">{{$user_info['username']}}</a>
	                  </li>
	                  <li class="list-group-item">
	                    <b>Email:</b> <a class="float-right">{{$user_info['email']}}</a>
	                  </li>
	                  <li class="list-group-item">
	                    <b>Site Location:</b> <a class="float-right">{{$user_info['site_location']}}</a>
	                  </li>
	                  <li class="list-group-item">
	                    <b>Shift:</b> <a class="float-right">{{$user_info['shift']}}</a>
	                  </li>
	                  <li class="list-group-item">
	                    <b>Team:</b> <a class="float-right">{{$user_info['team']}}</a>
	                  </li>
	                  <li class="list-group-item">
	                    <b>Accenture Exp.:</b> <a class="float-right">{{$user_info['accenture_exp']}}</a>
	                  </li>
	                  <li class="list-group-item">
	                    <b>Working Exp.:</b> <a class="float-right">{{$user_info['working_exp']}}</a>
	                  </li>
	                </ul>
                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-lg">
                  Edit
                </button>
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
                        <label for="team">Team</label>
                        <input type="text" class="form-control" id="team" name="team" value="{{$user_info['team']}}">
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
          // $("#example1").DataTable();
          // $('#example2').DataTable({
          //   "paging": true,
          //   "lengthChange": false,
          //   "searching": false,
          //   "ordering": true,
          //   "info": true,
          //   "autoWidth": false,
          // });
        });

        $('#submitBtn').click(function() {
             $('#modal_header').text("Confirmation");
             $('#modal_message').text("Are you sure you want to procced?");
        });

        $('#submit').click(function(){
          $('#formEditProfile').submit();
        });
      </script>
    @endsection
@endsection
