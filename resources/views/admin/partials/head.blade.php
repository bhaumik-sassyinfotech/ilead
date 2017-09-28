<meta charset="utf-8">
<title>
    MummaCo - Admin panel
</title>
<link rel="icon" type="image/png" href="{{ asset('public/uploads/favicon.png') }}"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta content="width=device-width, initial-scale=1.0" name="viewport"/>


<meta http-equiv="Content-type" content="text/html; charset=utf-8">

<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all"
      rel="stylesheet"
      type="text/css"/>
{{--<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>--}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script>
    (function ( $ )
    {
        if ( !$.curCSS )
        {
            $.curCSS = $.css;
        }
    })(jQuery);
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js" type="text/javascript"
        charset="utf-8"></script>
<script src="{{ url('public/quickadmin/js/tag-it.js') }}" type="text/javascript" charset="utf-8"></script>

<link rel="stylesheet"
      href="{{ url('public/quickadmin/css') }}/font-awesome.min.css"/>
<link rel="stylesheet"
      href="{{ url('public/quickadmin/css') }}/bootstrap.min.css"/>
<link rel="stylesheet"
      href="{{ url('public/quickadmin/css') }}/components.css"/>
<link rel="stylesheet"
      href="{{ url('public/quickadmin/css') }}/quickadmin-layout.css"/>
<link rel="stylesheet"
      href="{{ url('public/quickadmin/css') }}/quickadmin-theme-default.css"/>
<link rel="stylesheet"
      href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
<link rel="stylesheet"
      href="//cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>
<link rel="stylesheet"
      href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css"/>
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.css"/>
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.standalone.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.6/summernote.css">
<link rel="stylesheet" type="text/css" href="{{ url('public/newone') }}/jquery.bdt.css">
<link rel="stylesheet" type="text/css" href="{{ url('public/newone') }}/style.css">
<link rel="stylesheet" type="text/css" href="{{ url('public/newone') }}/basic.css">
<link rel="stylesheet" type="text/css" href="{{ url('public/newone') }}/dropzone.css">
<script src="{{ url('public/newone') }}/dropzone.js"></script>

<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script type="text/javascript">
    $(document).ready(function ()
    {
        $("#myTags").tagit({
            fieldName: "tags[]" ,
            "allowSpaces": true ,
            "removeConfirmation": true
        });

    });
</script>
<link rel="stylesheet" type="text/css"
      href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/flick/jquery-ui.css">
<link href="{{ url('public/quickadmin/css/jquery.tagit.css') }}" rel="stylesheet" type="text/css">

{{--<link href="http://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>--}}
{{--<script src="http://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>--}}
