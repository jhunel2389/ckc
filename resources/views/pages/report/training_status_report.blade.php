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
                  <th>Not Yet Started</th>
                  <th>On Going</th>
                  <th>Completed</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>SQL</td>
                  <td>10</td>
                  <td>1</td>
                  <td>4</td>
                </tr>
                <tr>
                  <td>Informatica</td>
                  <td>2</td>
                  <td>4</td>
                  <td>1</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                  <th>Total:</th>
                  <th>5</th>
                  <th>5</th>
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
              <h3 class="card-title">Summary by Team</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Team</th>
                  <th>Not Yet Started</th>
                  <th>On Going</th>
                  <th>Completed</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>Team A</td>
                  <td>2</td>
                  <td>3</td>
                  <td>4</td>
                </tr>
                <tr>
                  <td>Team B</td>
                  <td>2</td>
                  <td>3</td>
                  <td>4</td>
                </tr>
                <tr>
                  <td>Team C</td>
                  <td>2</td>
                  <td>3</td>
                  <td>4</td>
                </tr>
                <tr>
                  <td>Team D</td>
                  <td>2</td>
                  <td>3</td>
                  <td>4</td>
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
