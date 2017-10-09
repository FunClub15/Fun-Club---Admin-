    <hr>
    <footer class="row">
        <p class="col-md-9 col-sm-9 col-xs-12 copyright"><a href="http://funclubs.com" target="_blank">Fun Club.</a> © 2017 All Rights Reserved.</p>

        <p class="col-md-3 col-sm-3 col-xs-12 powered-by">Powered by: <a
                href="#">Technology Minds.</a></p>
    </footer>
    
<!-- start Edit address Ajax (../ajax/select_order.php) -->  
<script>
function order_detail(id){
	$.ajax({
		type:"POST",
		url:"../ajax/select_order.php",
		data:{order_id : id}
	})
	.done(function(order_detail){
		$("#popup-order").html(order_detail);
	});
}
</script>
<!-- End of Edit address Ajax (../ajax/select_order.php) --> 
													


</div><!--/.fluid-container-->

<!-- external javascript -->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- chart libraries start -->
<script src="bower_components/flot/excanvas.min.js"></script>
<script src="bower_components/flot/jquery.flot.js"></script>
<script src="bower_components/flot/jquery.flot.pie.js"></script>
<script src="bower_components/flot/jquery.flot.stack.js"></script>
<script src="bower_components/flot/jquery.flot.resize.js"></script>
<!-- chart libraries end -->
<script src="js/init-chart.js"></script>

<!-- library for cookie management -->
<script src="js/jquery.cookie.js"></script>
<!-- calender plugin -->
<script src='bower_components/moment/min/moment.min.js'></script>
<!-- data table plugin -->
<script src='js/jquery.dataTables.min.js'></script>

<!-- select or dropdown enhancer -->
<script src="bower_components/chosen/chosen.jquery.min.js"></script>
<!-- plugin for gallery image view -->
<script src="bower_components/colorbox/jquery.colorbox-min.js"></script>
<!-- notification plugin -->
<script src="js/jquery.noty.js"></script>
<!-- Radio slider button -->
<script src="js/bootstrap-switch.js"></script>
<!-- library for making tables responsive -->
<script src="bower_components/responsive-tables/responsive-tables.js"></script>
<!-- tour plugin -->
<script src="bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js"></script>
<!-- star rating plugin -->
<script src="js/jquery.raty.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="js/jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="js/jquery.autogrow-textarea.js"></script>
<!-- multiple file upload plugin -->
<script src="js/jquery.uploadify-3.1.min.js"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="js/jquery.history.js"></script>
<!-- application script for Charisma demo -->
<script src="js/charisma.js"></script>









<script>
/*
      $(function () {
        $('#addInteriorDesign').submit(function(event) {

	event.preventDefault();// using this page stop being refreshing 

          $.ajax({
            type: 'POST',
            url: 'add_interior.php',
            data: $('this').serialize(),
            success: function () {
              alert('form was submitted');
              // Clear the form.
              $('#name').val('');
              $('#image').val('');
              $('#category').val('');
            }
          });

        });
      });
*/
</script>

<script>
//callback handler for form submit
$("#addInteriorDesign").submit(function(e)
{
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    $.ajax(
    {
        url : formURL,
        type: "POST",
        data : postData,
        success:function(data, textStatus, jqXHR) 
        {
            //data: return data from server
              alert('form was submitted');
              // Clear the form.
              $('#name').val('');
              $('#image').val('');
              $('#category').val('');
        },
        error: function(jqXHR, textStatus, errorThrown) 
        {
            //if fails      
        }
    });
    e.preventDefault(); //STOP default action
    e.unbind(); //unbind. to stop multiple form submit.
});
 
</script>
</body>
</html>