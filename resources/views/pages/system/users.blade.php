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
                  <th>Employee Role</th>
                  <th>Team</th>
                  <th>Status</th>
                  <th>Action</th>
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
                      <td>{{($value['er_name'])?$value['er_name']:'No Data Yet'}}</td>
                      <td>{{($value['team_name'])?$value['team_name']:'No Team Yet'}}</td>
                      <td>{{$utils::statusIntToString($value['status'])}}</td>
                      <td>
                        <form action="{{ route('updateTeam') }}" method="POST" id="formUpdateStatus">
                          @csrf
                          @if($utils::checkPermissions('view_user_profile'))
                          <a type="button" class="btn btn-xs" href="{{ url('/userProfile/'.$value['id']) }}" target="_blank"><i class="fa fa-eye" title="View/Edit"></i></a>
                          @endif
                          @if($value['status'] != 2 && $utils::checkPermissions('disable_user_profile'))
                            <button type="button" class="btn btn-xs" data-toggle="modal" data-target="#modal-default" onclick="editStatus('disable_item','{{2}}','{{$value['id']}}')"><i class="fa fa-ban" title="Disable"></i>
                            </button>
                          @endif
                          @if($value['status'] != 1 && $utils::checkPermissions('disable_user_profile'))
                            <button type="button" class="btn btn-xs" data-toggle="modal" data-target="#modal-default" onclick="editStatus('active_item','{{1}}','{{$value['id']}}')"><i class="fa fa-check-circle" title="Active"></i>
                            </button>
                          @endif
                          @if($utils::checkPermissions('delete_user_profile'))
                            <button type="button" class="btn btn-xs" data-toggle="modal" data-target="#modal-default" onclick="editStatus('trash_item','{{0}}','{{$value['id']}}')"><i class="fa fa-trash" title="Delete"></i></button>
                            <input type="hidden" id="status" name="status">
                            <input type="hidden" id="team_status_id" name="team_status_id">
                          @endif
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
