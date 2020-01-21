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
                <tfoot align="right">
                  <tr>
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
              <h3 class="card-title">Summary by Team</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="training-summary-name-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <!-- <th>Training/Tools</th>
                  <th>Team</th>
                  <th>Not Yet Started</th>
                  <th>On Going</th>
                  <th>Completed</th> -->
                  <th>Name</th>
                  <th>Team</th>
                  <th>Training/Tools</th>
                  <th>Status</th>
                </tr>
                </thead>
                <!-- <tfoot align="right">
                  <tr>
                    <th colspan="2"></th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                </tfoot> -->
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
                
              }
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
                // columns: [ //
                //     { data: 'tool_name', name: 'tool_name' },
                //     { data: 'team', name: 'team' },
                //     { data: 'not_yet_started', name: 'not_yet_started' },
                //     { data: 'on_going', name: 'on_going' },
                //     { data: 'completed', name: 'completed' },
                // ],
                columns: [
                    { data: 'user_name', name: 'user_name' },
                    { data: 'team', name: 'team' },
                    { data: 'tool_name', name: 'tool_name' },
                    { data: 'status', name: 'status' },
                ],
              // footerCallback: function (row, data, start, end, display) {
              //   var api = this.api(), data;
              //   // converting to interger to find total
              //   var intVal = function ( i ) {
              //       return typeof i === 'string' ?
              //           i.replace(/[\$,]/g, '')*1 :
              //           typeof i === 'number' ?
              //               i : 0;
              //   };


              //   // Total over all pages
              //   c2_total = api
              //       .column( 2 )
              //       .data()
              //       .reduce( function (a, b) {
              //           return intVal(a) + intVal(b);
              //       }, 0 );

              //   // Total over this page
              //   c2_pageTotal = api
              //   .column( 2, { page: 'current'} )
              //   .data()
              //   .reduce( function (a, b) {
              //       return intVal(a) + intVal(b);
              //   }, 0 );

              //   // Total over all pages
              //   c3_total = api
              //       .column( 3 )
              //       .data()
              //       .reduce( function (a, b) {
              //           return intVal(a) + intVal(b);
              //       }, 0 );

              //   // Total over this page
              //   c3_pageTotal = api
              //   .column( 3, { page: 'current'} )
              //   .data()
              //   .reduce( function (a, b) {
              //       return intVal(a) + intVal(b);
              //   }, 0 );

              //   // Total over all pages
              //   c4_total = api
              //       .column( 4 )
              //       .data()
              //       .reduce( function (a, b) {
              //           return intVal(a) + intVal(b);
              //       }, 0 );

              //   // Total over this page
              //   c4_pageTotal = api
              //   .column( 4, { page: 'current'} )
              //   .data()
              //   .reduce( function (a, b) {
              //       return intVal(a) + intVal(b);
              //   }, 0 );

              //   // Update footer
              //   $( api.column( 0 ).footer() ).html('Total:');
                
              //   $( api.column( 2 ).footer() ).html(
              //      'Current '+ c2_pageTotal +' ( '+ c2_total +' All)'
              //   );
              //   $( api.column( 3 ).footer() ).html(
              //      'Current '+ c3_pageTotal +' ( '+ c3_total +' All)'
              //   );
              //   $( api.column( 4 ).footer() ).html(
              //      'Current '+ c4_pageTotal +' ( '+ c4_total +' All)'
              //   );
                
              // }
            });
      </script>
    @endsection
@endsection
