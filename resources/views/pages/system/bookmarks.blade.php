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
                  @if($utils::checkPermissions('add_tools'))
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
                  <th>Training Link</th>
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
                      @if(!empty($value['link']))
                        <td>
                          <input type="hidden" id="td_link_{{$value['id']}}" value="{{$value['link']}}"></span>
                          <a href="{{$value['link']}}" target="_blank">Open</a>
                        </td>
                      @else
                        <td>No Link Available</a></td>
                      @endif
                      <td>{{$utils::statusIntToString($value['status'])}}</td>
                      <td>
                        
                        <form action="{{ route('updateBookmarks') }}" method="POST" id="formUpdateStatus">
                          @csrf
                          @if($utils::checkPermissions('edit_bookmarks'))
                          <button type="button" class="btn btn-xs" onclick="showModal('update_item','{{$value['id']}}')"><i class="fa fa-edit" title="Edit"></i></button>
                          @endif
                          @if($value['status'] != 2 && $utils::checkPermissions('disable_bookmarks'))
                            <button type="button" class="btn btn-xs" data-toggle="modal" data-target="#modal-default" onclick="editStatus('disable_item','{{2}}','{{$value['id']}}')"><i class="fa fa-ban" title="Disable"></i>
                            </button>
                          @endif
                          @if($value['status'] != 1 && $utils::checkPermissions('disable_bookmarks'))
                            <button type="button" class="btn btn-xs" data-toggle="modal" data-target="#modal-default" onclick="editStatus('active_item','{{1}}','{{$value['id']}}')"><i class="fa fa-check-circle" title="Active"></i>
                            </button>
                          @endif
                          @if($utils::checkPermissions('delete_bookmarks'))
                            <button type="button" class="btn btn-xs" data-toggle="modal" data-target="#modal-default" onclick="editStatus('trash_item','{{0}}','{{$value['id']}}')"><i class="fa fa-trash" title="Delete"></i></button>
                            <input type="hidden" id="status" name="status">
                            <input type="hidden" id="status_id" name="status_id">
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
    @if($utils::checkPermissions('add_bookmarks') || $utils::checkPermissions('edit_bookmarks'))
      <!-- ADD MODAL -->
      <div class="modal fade" id="modal-form">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="modal-h4">Add Bookmarks</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="{{ route('addBookmarks') }}" method="POST" id="formAddTeams">
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
                        <div class="form-group">
                          <label for="link">Bookmarks Link</label>
                          <input type="text" class="form-control" id="link" name="link" placeholder="Enter Bookmarks Link" value="">
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
            $('#status_id').val($id);
        }

        function showModal($action,$id){
          if($action == 'update_item'){
            $('#modal-h4').text("Update Team");
            $('#data_id').val($id);
            $('#name').val($('#td_name_'+$id).text());
            $('#description').val($('#td_desc_'+$id).text());
            $('#link').val($('#td_link_'+$id).val());
          }

          $('#modal-form').modal()
        }
      </script>
    @endsection
@endsection
