<!--footer -->
<footer>
<section class="footer footer_w3layouts_section_1its">
	<div class="container">
		<div class="row footer-top">
			<div class="col-lg-4 footer-grid_section_1its_w3">
				<div class="footer-title">
					<h3>QUICKLINKS</h3>
				</div>
				<ul class="links">
					<li><a href="index.html">Home</a></li>
					<li><a href="about.html">About Us</a></li>
					<li><a href="gallery.html">Forms</a></li>
					<li><a href="contact.html">Contact Us</a></li>
				</ul>
			</div>
			<div class="col-lg-4 footer-grid_section_1its_w3">
				<div class="footer-title">
					<h3>Contact Info</h3>
				</div>
				<div class="contact-info">
					<h4>Location :</h4>
					<p>7880 Keele Street Unit No. 14 , Vaughan Canada.</p>
					<div class="phone">
						<h4>Phone :</h4>
						<p>Phone : +121 098 8907 9987</p>
						<p>Email : <a href="mailto:info@example.com">info@example.com</a></p>
						<ul class="social_section_1info">
						<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
						<li><a href="#"><i class="fab fa-twitter"></i></a></li>
						<li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
						<li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
					</ul>
					</div>
				</div>
			</div>
			<div class="col-lg-4 footer-grid_section_1its_w3">
				<div class="footer-title">
					<h3>Subscribe</h3>
				</div>
				<div class="footer-text">
					<p>By subscribing to our mailing list you will always get latest news and updates from us.</p>
					<form action="#" method="post">
						<input type="email" name="Email" placeholder="Enter your email..." required="">
						<button class="btn1"><i class="fa fa-envelope" aria-hidden="true"></i></button>
						<div class="clearfix"> </div>
					</form>
				</div>
			</div>
		</div>
		<div class="copyright">
			<p>© 2018 School van App. All Rights Reserved | Design by 
			<a href="https://www.unicres.co.uk/">Unicres Pvt Ltd</a> </p>
		</div>
	</div>
</section>
</footer>
<!-- //footer -->
     <!--js working-->
      <script type="text/javascript" src="js/jquery.min.js"></script>
     <!-- <script type="text/javascript" src="js/popup.js"></script> -->
      
      <!--//js working-->
	  <script src="js/main.js"></script>
	  <!-- clients -->
			<script type="text/javascript">
					$(document).ready(function() {
						$("#flexiselDemo1").flexisel({
							visibleItems: 2,
							animationSpeed: 1000,
							autoPlay:false,
							autoPlaySpeed: 2500,    		
							pauseOnHover: true,
							enableResponsiveBreakpoints: true,
							responsiveBreakpoints: { 
								portrait: { 
									changePoint:480,
									visibleItems: 1
								}, 
								landscape: { 
									changePoint:640,
									visibleItems:1
								},
								tablet: { 
									changePoint:768,
									visibleItems: 1
								}
							}
						});
						
					});
			</script>
			<script type="text/javascript" src="js/jquery.flexisel.js"></script>
	<!-- //clients -->
<!-- script-for-swipebox -->
	<script src="js/jquery.swipebox.min.js"></script> 
	<script type="text/javascript">
		jQuery(function($) {
			$(".swipebox").swipebox();
		});
	</script>
<!-- //script-for-swipebox -->
	<!-- smooth scrolling -->
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function(){
				$('.date').datepicker({
					format:"yyyy-mm-dd",
					todayHighlight: true,
					toggleActive: true,
					autoclose: true,  
					/*startDate: "2012/01/01",
    				endDate: "2018/08/27",*/
				});
			});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});

	</script>
	<script type="text/javascript">
		 $(document).ready(function(){
     var url= $(location).attr("href");
    if (url == "http://192.168.100.49/hop/about.php") {
         $('#about').addClass("active");
    }
   else if (url == "http://192.168.100.49/hop/index.php") {
         $('#home').addClass("active");
    }
    else if (url == "http://192.168.100.49/hop/form.php") {
         $('#form').addClass("active");
    }
    else if(url == "http://192.168.100.49/hop/contact.php") {
         $('#contact').addClass("active");
    }
   })
	</script>  <script type="text/javascript">
//	$('.datepicker').datepicker();
function driverInfoNext(){
  $('#driverInfoDiv').addClass("element-hidden");
  $('#driverInfoNext').removeClass('element-hidden');
}
function driverInfoBack(){
  $('#driverInfoDiv').removeClass("element-hidden");
  $('#driverInfoNext').addClass('element-hidden');
}
function dcontactInfoNext(){
  $('#driverInfoNext').addClass("element-hidden");
  $('#dContactInfoNext').removeClass('element-hidden');
};
function dcontactInfoBack(){
  $('#driverInfoNext').removeClass("element-hidden");
  $('#dContactInfoNext').addClass('element-hidden');
};
function daddressInfoNext(){
  $('#dContactInfoNext').addClass('element-hidden');
  $('#dAddressInfoNext').removeClass('element-hidden');
};
function daddressInfoBack(){
  $('#dContactInfoNext').removeClass('element-hidden');
  $('#dAddressInfoNext').addClass('element-hidden');
};
function altAddressNext(){
  $('#AddressInfoNext').addClass('element-hidden');
  $('#AltaddressInfoNext').removeClass('element-hidden');
};
function altAddInfoBack(){
  $('#AddressInfoNext').removeClass('element-hidden');
  $('#AltaddressInfoNext').addClass('element-hidden');
};
function personalInfoNext(){
  $('#PersonalInfoDiv').addClass("element-hidden");
  $('#PersonalInfoNext').removeClass('element-hidden');
}
function personalInfoBack(){
  $('#PersonalInfoDiv').removeClass("element-hidden");
  $('#PersonalInfoNext').addClass('element-hidden');
}
function contactInfoNext(){
  $('#PersonalInfoNext').addClass("element-hidden");
  $('#ContactInfoNext').removeClass('element-hidden');
};
function contactInfoBack(){
  $('#PersonalInfoNext').removeClass("element-hidden");
  $('#ContactInfoNext').addClass('element-hidden');
};
function addressInfoNext(){
  $('#ContactInfoNext').addClass('element-hidden');
  $('#AddressInfoNext').removeClass('element-hidden');
};
function addressInfoBack(){
  $('#ContactInfoNext').removeClass('element-hidden');
  $('#AddressInfoNext').addClass('element-hidden');
};
</script> 
	<!-- //here ends scrolling icon -->
<!-- //smooth scrolling -->
<!-- scrolling script -->
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},500);
		});
	});
</script> 
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/angular.min.js"></script>
    <script type="text/javascript" src="bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="js/angular-messages.js"></script>
	<script type="text/javascript" src="js/angular-ui-notification.min.js"></script>
    <script type="text/javascript" src="js/angular-ui-router.min.js"></script>
    <script type="text/javascript" src="js/angular-cookies.min.js"></script>
    <script type="text/javascript" src="js/ui-bootstrap.min.js"></script>
    <script type="text/javascript" src="app.js"></script>
    <script type="text/javascript" src="services/services.js"></script>
<!-- //scrolling script -->
<a href="#" id="toTop" style="display: inline;"><span id="toTopHover" style="opacity: 0;"></span>To Top</a>

   </body>
</html>