<script src="//cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
<script src="{{ url('public/quickadmin/js') }}/bootstrap.min.js"></script>
<script src="{{ url('public/quickadmin/js') }}/main.js"></script>
<script src="{{ url('public/newone') }}/jquery.sortelements.js"></script>
<script src="{{ url('public/newone') }}/jquery.bdt.js"></script>
<script src="{{ url('public/newone/jquery.validate.min.js') }}"></script>
<script src="{{ url('public/newone/additional-methods.min.js') }}"></script>
<script src="{{ url('public/quickadmin/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ url('public/quickadmin/js') }}/moment.min.js"></script>
<script src="{{ url('public/quickadmin/js') }}/bootstrap-datetimepicker.min.js"></script>


<script type="text/javascript">
    $(document).ready(function ()
    {
        $(".page-sidebar-menu > li.menu-item > span").each(function ()
        {
            $(this).click(function ( e )
            {
                $(this).next("ul").slideToggle();
                $(this).toggleClass("active-menu");
            })
        });
        
        $(".page-sidebar-menu li a").each(function ()
        {

            if ( window.location.href.indexOf(this.href) != -1 )
            {
                $(this).closest("li").addClass("active");
                if ( $(this).closest("ul").hasClass("sub-menu-item") )
                {
                    $(this).closest("ul").closest("li").find("span").first().addClass("active");
                }

                return true;
            }
        });
     
    });
</script>

<script>
    window._token = '{{ csrf_token() }}';
</script>

@yield('javascript')  