
<script src="front/js/jquery.min.js"></script>
<script type="text/javascript" src="http://cdn.jsdelivr.net/jwplayer/5.10/jwplayer.js"></script>
<script src="front/js/bootstrap.js"></script> 
<script src="front/js/vendor/owl/owlcarousel/owl.carousel.min.js"></script> 
<script src="front/js/vendor/cssslider/jquery.cssslider.js"></script> 
<script src="front/js/vendor/date-picker/bootstrap-datepicker.js"></script> 
<script src="front/js/custom.js"></script>   
<!--
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="//cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
<script src="{{ url('public/quickadmin/js') }}/bootstrap.min.js"></script>
<script src="{{ url('public/quickadmin/js') }}/main.js"></script>
<script src="{{ url('public/newone') }}/jquery.sortelements.js"></script>
<script src="{{ url('public/newone') }}/jquery.bdt.js"></script>
-->

<script type="text/javascript">
		$(document).ready(function() {
	       $(".list-item").each(function() {
	       	 $(this).click(function() {
	       	 	$(this).find(".subMenu").show();
	       	 });
	       })
	    });
</script>

    
<script>
    window._token = '{{ csrf_token() }}';
</script>