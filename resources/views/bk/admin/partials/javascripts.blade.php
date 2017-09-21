<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="//cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
<script src="{{ url('public/quickadmin/js') }}/bootstrap.min.js"></script>
<script src="{{ url('public/quickadmin/js') }}/main.js"></script>
<script src="{{ url('public/newone') }}/jquery.sortelements.js"></script>
<script src="{{ url('public/newone') }}/jquery.bdt.js"></script>


<script>
$(document).ready(function () {
    $(".page-sidebar-menu > li.menu-item > span").each(function () {
        $(this).click(function (e) {
            $(this).next("ul").slideToggle();
            $(this).toggleClass("active-menu");
        })
    });
    $(".page-sidebar-menu li a").each(function () {

        if (window.location.href.indexOf(this.href) != -1)
        {
            $(this).closest("li").addClass("active");
            if ($(this).closest("ul").hasClass("sub-menu-item"))
            {
                $(this).closest("ul").closest("li").addClass("active");
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