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
              <table id="summary-table" class="table table-bordered table-hover">
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
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Summary by Name</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="summary-name-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Team</th>
                  <th>Employee Role</th>
                  <th>Tool</th>
                  <th>Rate</th>
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
        $(function () {
          $(".table").DataTable();
        });

        $("#summary-table").DataTable(
          {
              processing: true,
              serverSide: true,
              ajax: {
                url: '{!! route('datatables.tools-summary-report') !!}',
                type: 'GET',
                data: function (d) {
                }
              },
              columns: [
                  { data: 'tool_name', name: 'tool_name' },
                  { data: 'p0', name: 'p0' },
                  { data: 'p1', name: 'p1' },
                  { data: 'p2', name: 'p2' },
                  { data: 'p3', name: 'p3' },
                  { data: 'p4', name: 'p4' },
                  { data: 'p5', name: 'p5' },
              ]
          });

          $("#summary-name-table").DataTable(
            {
                processing: true,
                serverSide: true,
                ajax: {
                  url: '{!! route('datatables.tools-summary-name-report') !!}',
                  type: 'GET',
                  data: function (d) {
                  }
                },
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'team', name: 'team' },
                    { data: 'employee_role', name: 'employee_role' },
                    { data: 'tool', name: 'tool' },
                    { data: 'rate', name: 'rate' }
                ]
            });
      </script>
    @endsection
@endsection
