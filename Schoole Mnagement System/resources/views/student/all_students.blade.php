@extends('layouts.index')

@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="index/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="index/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="index/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Manage Students</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Email')}}</th>
                    <th>{{__('Parent Phone Number')}}</th>
                    <th>{{__('Options')}}</th>
                </tr>
                </thead>
                <tbody>

                @foreach($students as $student)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center min-w-200px">
                                @php $photo = '/uploads/admins/' . $student->img ; @endphp
                                <div>
                                    <img class="img-fluid" width="35" height="40" src="{{ $photo}}"/>
                                </div>
                                <div class="pl-3">
                                    <span>{{ $student->name }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="pt-3">{{$student->email}} </td>
                        <td class="pt-3">{{$student->phone_number}}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default">Actions</button>
                                <div class="btn-group" >
                                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    </button>
                                    <div class="dropdown-menu" style="border-radius:5px ;">
                                        <a class="dropdown-item" href="{{route('student.edit', $student->id) }}">Edit</a>
                                        <form action="{{route('student.destroy' , $student)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="dropdown-item" type="submit">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    </tr>
                @endforeach

                </tbody>
                <tfoot>
                <tr>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Email')}}</th>
                    <th>{{__('Phone Number')}}</th>
                    <th>{{__('Options')}}</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

@endsection

@section('scripts')
    <!-- DataTables  & Plugins -->
    <script src="index/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="index/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="index/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="index/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="index/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="index/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="index/plugins/jszip/jszip.min.js"></script>
    <script src="index/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="index/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="index/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="index/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="index/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="index/dist/js/adminlte.min.js"></script>
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
