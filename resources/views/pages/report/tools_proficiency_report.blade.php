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
                <tfoot align="right">
                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                </tfoot>
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
                  <th>Proficiency</th>
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
              ],
              footerCallback: function (row, data, start, end, display) {
                var api = this.api(), data;
                // converting to interger to find total
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                // Total over all pages
                c1_total = api
                    .column( 1 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Total over this page
                c1_pageTotal = api
                .column( 1, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                // Total over all pages
                c2_total = api
                    .column( 2 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Total over this page
                c2_pageTotal = api
                .column( 2, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                // Total over all pages
                c3_total = api
                    .column( 3 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Total over this page
                c3_pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                // Total over all pages
                c4_total = api
                    .column( 4 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Total over this page
                c4_pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                // Total over all pages
                c5_total = api
                    .column( 5 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Total over this page
                c5_pageTotal = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                // Total over all pages
                c6_total = api
                    .column( 6 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Total over this page
                c6_pageTotal = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                // Update footer
                $( api.column( 0 ).footer() ).html('Total:');
                $( api.column( 1 ).footer() ).html(
                   'Current '+ c1_pageTotal +' ( '+ c1_total +' All)'
                );
                $( api.column( 2 ).footer() ).html(
                   'Current '+ c2_pageTotal +' ( '+ c2_total +' All)'
                );
                $( api.column( 3 ).footer() ).html(
                   'Current '+ c3_pageTotal +' ( '+ c3_total +' All)'
                );
                $( api.column( 4 ).footer() ).html(
                   'Current '+ c4_pageTotal +' ( '+ c4_total +' All)'
                );
                $( api.column( 5 ).footer() ).html(
                   'Current '+ c5_pageTotal +' ( '+ c5_total +' All)'
                );
                $( api.column( 6 ).footer() ).html(
                   'Current '+ c6_pageTotal +' ( '+ c6_total +' All)'
                );
                
              }
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
