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
              <table id="training-summary-table" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Training/Tools</th>
                  <th>Not Yet Started</th>
                  <th>On Going</th>
                  <th>Completed</th>
                </tr>
                </thead>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Summary by Team</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="training-summary-name-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Training/Tools</th>
                  <th>Team</th>
                  <th>Not Yet Started</th>
                  <th>On Going</th>
                  <th>Completed</th>
                </tr>
                </thead>
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
        $("#training-summary-table").DataTable(
          {
              processing: true,
              serverSide: true,
              ajax: {
                url: '{!! route('datatables.training-tools-summary-report') !!}',
                type: 'GET',
                data: function (d) {
                }
              },
              columns: [
                  { data: 'tool_name', name: 'tool_name' },
                  { data: 'not_yet_started', name: 'not_yet_started' },
                  { data: 'on_going', name: 'on_going' },
                  { data: 'completed', name: 'completed' },
              ]
          });

          $("#training-summary-name-table").DataTable(
            {
                processing: true,
                serverSide: true,
                ajax: {
                  url: '{!! route('datatables.training-tools-summary-name-report') !!}',
                  type: 'GET',
                  data: function (d) {
                  }
                },
                columns: [
                    { data: 'tool_name', name: 'tool_name' },
                    { data: 'team', name: 'team' },
                    { data: 'not_yet_started', name: 'not_yet_started' },
                    { data: 'on_going', name: 'on_going' },
                    { data: 'completed', name: 'completed' },
                ]
            });
      </script>
    @endsection
@endsection
