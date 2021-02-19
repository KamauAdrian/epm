@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('assets/css/plugins/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')
    @include('Epm.layouts.adms-list')
@endsection
@section('js')
    <script type="text/javascript">
        $(function () {
            $(".deleteAdmin").click(function () {
                var url = $(this).attr('data-url');
                $("#form-delete-user").attr("action",url);
                $("#btn-delete-user").attr("data-data",url);
                $("#deleteAdminUser").modal('show');
                console.log('this is the url'+ url);
            });
            // $("#btn-delete-user").on('click',function(){
            //     var url =$(this).attr('data-data');
            //     window.location=url;
            // });
        });
    </script>
    <script>
        $('#myDataTable').DataTable();
    </script>

@endsection
