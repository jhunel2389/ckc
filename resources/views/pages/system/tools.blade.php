@extends('layouts.app')

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Summary</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>User ID</th>
                  <th>Username</th>
                  <th>Firstname</th>
                  <th>Lastname</th>
                  <th>Email</th>
                  <th>System Role</th>
                  <th>Team</th>
                  
                </tr>
                </thead>
                <tbody>
                @if(!empty($user_list))
                  @foreach($user_list as $key => $value)
                    <tr>
                      <td>{{$value['id']}}</td>
                      <td>{{$value['username']}}</td>
                      <td>{{$value['firstname']}}</td>
                      <td>{{$value['lastname']}}</td>
                      <td>{{$value['email']}}</td>
                      <td>{{$value['role_description']}}</td>
                      <td>{{$value['team']}}</td>
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
      </script>
    @endsection
@endsection
