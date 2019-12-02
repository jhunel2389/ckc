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
                  <td>10</td>
                  <td>1</td>
                  <td>4</td>
                  <td>7</td>
                  <td>9</td>
                  <td>1</td>
                </tr>
                <tr>
                  <td>Informatica</td>
                  <td>2</td>
                  <td>4</td>
                  <td>1</td>
                  <td>4</td>
                  <td>9</td>
                  <td>1</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                  <th>Total:</th>
                  <th>5</th>
                  <th>5</th>
                  <th>3</th>
                  <th>2</th>
                  <th>2</th>
                  <th>3</th>
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
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Team</th>
                  <th>Role</th>
                  <th>Tools</th>
                  <th>Points</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>John Doe</td>
                  <td>VBS</td>
                  <td>System Analyst</td>
                  <td>SQL</td>
                  <td>P4</td>
                </tr>
                <tr>
                  <td>John Doe</td>
                  <td>VBS</td>
                  <td>System Analyst</td>
                  <td>Informatica</td>
                  <td>P2</td>
                </tr>
                <tr>
                  <td>John Doe</td>
                  <td>VBS</td>
                  <td>System Analyst</td>
                  <td>Python</td>
                  <td>P3</td>
                </tr>
                <tr>
                  <td>John Doe</td>
                  <td>VBS</td>
                  <td>System Analyst</td>
                  <td>Data Modeling</td>
                  <td>P1</td>
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
