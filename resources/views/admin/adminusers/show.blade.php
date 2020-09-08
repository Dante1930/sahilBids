@extends('admin.layouts.sidebar')
@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" />

<link rel="stylesheet" type="text/css" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/toastr/toastr.min.css') }}" />
@endsection

@section('content')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S No</th>
                    <th>Admin Username</th>
                    <th>Email Address</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($adminlist as $list)
                    <tr>
                     <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $list->name }}</td>
                    <td>{{ $list->email }}</td>
                    <td><a href="{{ route('admin.adminuser.edit',['id'=> $list->id]) }}" class="btn btn-info">Edit</a></td>
                    <td> <form id="delete-form-{{ $list->id }}" method="post" action="{{ route('admin.adminuser.destroy',$list->id) }}" style="display: none">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                              </form>
                              <a href="" class="btn btn-danger" onclick="
                              if(confirm('Are you sure, You Want to delete this?'))
                                  {
                                    event.preventDefault();
                                    document.getElementById('delete-form-{{ $list->id }}').submit();
                                  }
                                  else{
                                    event.preventDefault();
                                  }" >Delete</a></td>
                    </tr>
                    @endforeach


                  </tbody>
                  <tfoot>
                  <tr>
                    <th>S No</th>
                    <th>Admin Username</th>
                    <th>Email Address</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>

@endsection


@section('admin-footer')
<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

<script>
$(function () {
       $("#example1").DataTable();
       $('#example2').DataTable({
         "paging": true,
         "lengthChange": false,
         "searching": false,
         "ordering": true,
         "info": true,
         "autoWidth": false,
     });
  });
</script>	

@if(\Session::has("success"))
    <script>
        $(document).ready(function() {

            toastr.options.timeOut = 4000;
            toastr.success('{{ Session::get('success') }}');

        });
    </script>
@endif

@if(\Session::has("updated"))
    <script>
        $(document).ready(function() {

            toastr.options.timeOut = 4000;
            toastr.info('{{ Session::get('updated') }}');

        });
    </script>
@endif

@if(\Session::has("deleted"))
    <script>
        $(document).ready(function() {

            toastr.options.timeOut = 4000;
            toastr.success('{{ Session::get('deleted') }}');

        });
    </script>
@endif


@endsection

