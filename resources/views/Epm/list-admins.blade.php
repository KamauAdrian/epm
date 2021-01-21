@extends('Epm.layouts.master')

@section('content')
    @include('Epm.layouts.adms-list')
@endsection
@section('js')
    <script type="text/javascript">
        $(function () {
            $(".deleteAdmin").click(function () {
                var url = $(this).attr('data-url');
                console.log('this is the url'+ url);
                $("#deleteAdminForm").attr("action", url);
            })
        });
    </script>
@endsection
