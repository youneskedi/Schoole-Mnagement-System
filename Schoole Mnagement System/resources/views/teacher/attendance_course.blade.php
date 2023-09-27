@extends('layouts.index')

@section('style')
    <link rel="stylesheet" href="index/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="index/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="index/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Courses</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th class="text-center">{{__('Title')}}</th>
                    <th class="text-center">{{__('Number of Students')}}</th>
                    <th class="text-center">{{__('Number of Attended Students')}}</th>
                    <th class="text-center">{{__('Take Attendance')}}</th>
                </tr>
                </thead>
                <tbody>

                @foreach($courses as $course)
                    <tr>
                        <td class="text-center">
                            <div class="d-flex align-items-center min-w-200px">
                                @php $photo = 'uploads/courses/' . $course->img ; @endphp
                                <div>
                                    <img class="img-fluid" width="35" height="40"
                                         src="{{ $photo}}"/>
                                </div>
                                <div class="pl-3">
                                    <span>{{ $course->title }}</span>
                                </div>
                            </div>
                        </td>
                        @php
                            $count = 0 ;
                            $users = $course->users->where('role' , 'student');
                            foreach ($users as $user)
                                {
                                    $count++ ;
                                }
                        @endphp
                        <td class="text-center pt-3">{{$count}}</td>
                        @php
                            $count = 0 ;
                            $users = $course->users()->wherePivot('is_attendance' , true)->get();
                            foreach ($users as $user)
                            {
                                $count++ ;
                            }
                        @endphp
                        <td class="text-center pt-3">{{$count}} </td>
                        <td class="text-center">
                            <a href="{{route('teacher.attendance.show' , $course)}}" class="btn btn-primary p-1">Attendance</a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
                <tfoot>
                <tr>
                    <th class="text-center">{{__('Title')}}</th>
                    <th class="text-center">{{__('Number Of Students')}}</th>
                    <th class="text-center">{{__('Number of Attended Students')}}</th>
                    <th class="text-center">{{__('Certificates')}}</th>
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

