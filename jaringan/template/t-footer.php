</div>
</div>
<!--footer-->
	<div class="footer">
		<div class="col-md-12 panel-grids">
		<p>&copy; 2018 Tekinfo | Design by <a href="https://w3layouts.com/" target="_blank">w3layouts</a></p>
		</div>
	</div>
        <!--//footer-->
</div>
	<!-- Classie -->
	


		<script src="js/bootstrap.js"> </script>
		<script src="js/classie.js"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				body = document.body;
				
			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};
			

			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
			}
		</script> 
		
		<script type="text/javascript">
 $(".datepicker").datepicker( {
    format: " yyyy",
    viewMode: "years", 
    minViewMode: "years"
});
</script> 
 
 
<script> 
	$(document).ready(function(){
		setTimeout(function(){$(".pesan").fadeIn('slow');},  500);});
    setTimeout(function(){$(".pesan").fadeOut('slow');}, 1000);
</script>

</body>
</html>