<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>



				<footer class="site-footer" id="colophon">
				
    <div class="footer-top">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6">
                  <div class="start-your-business">
					  <div class="footer-info-box">
					  <!-- <img src="<?php echo get_template_directory_uri() .
			  '/src/images/ios-chatboxes.svg' ?>" alt="chatbox" width="52px"> -->
			  <i class="ion-ios-chatboxes"></i>
			  <div class="info-content">
				  <a href="">Are you ready to start your bussiness?</a>
				  <div class="info-detail">
				  A suggestion in the field of retail from Best For, with years of experience,
				   know-how and reliability.
				  </div>
			  </div>
					  </div>
				  </div>
				</div>
				<div class="col-lg-6">
                 <div class="join-our-team">
                    <div class="footer-info-box">
					<!-- <img src="<?php echo get_template_directory_uri() .
			  '/src/images/person-stalker.svg' ?>" alt="chatbox" width="52px"> -->
			   <i class="ion-person-stalker"></i>
			  <div class="info-content">
				  <a href="">Join our team. Are you ready to change the game?</a>
				  <div class="info-detail">
				  Even though markets may change, good investing advice is timeless from #BestFor.
				   Join our team of franchisees.
				  </div>
			  </div>
					</div>
				 </div>
				</div>
			</div>
		</div>
	</div>

    <div class="footer-middle">
		<div class="container-fluid">
		<div class="row">
       <div class="col-lg-4">
		   <div class="find-container">
			   <h3>
			   Find us
			   </h3>
			   <p>
			   1st Leoforou Nikis
Thessaloniki, 54624
Greece
			   </p>
			   <p>
			   Open Monday to Sunday from 9h to 21h
			   <br>
Talk to an expert <a href="tel:+30 2310279517">+30 2310279517</a>
<br>
Send Us an e-mail to <a href="mailto:info@bestfor.com7">info@bestfor.com</a>
			   </p>
		   </div>
		 
	   </div>
	   <div class="col-lg-4">
		   <div class="info-container">
		   <h3>
		   Information
			   </h3>
			   <div class="policy-news">
				   <a href="/privacy-policy">Privacy Policy & Cookies</a>
				   <a href="/news-blog">news</a>
			   </div>
			   <a href="/contact-us">Contact Us</a>
		   </div>
	   </div>
	   <div class="col-lg-4">
		   <div class="contact-footer-container">
		   <h3>
		   Connect with us
			   </h3>
			   <div class="form-footer">
			   <?php
echo do_shortcode('[wpforms id="89"]');
?>   
			   </div>
			  <p>Have a question? Visit our <a href="/contact-us">Contact Us</a> page for more options.</p> 
		   </div>
	   </div>
		</div>
	
	</div>

	<div class="footer-bottom-copyright">
	<div class="container-fluid">
		<div class="row">
        <div class="col-lg-6">
		<div class="header-logo">
			 <a href="/"><img src="<?php echo get_template_directory_uri() .
			  '/src/images/logo.png' ?>" alt="footer-logo" width="70px"></a>
			  <span>Copyright © 2021 BestFor - Life Philosophy.</span>
		 </div>
		</div>
		<div class="col-lg-6">
			<div class="social-icons">
			<a href="https://www.facebook.com/BestForGr/" class="social-icons-footer"><i class="fa fa-facebook-f"></i></a>	
			<a href="https://www.instagram.com/bestforgr/" class="social-icons-footer"><i class="fa fa-instagram"></i></a>	
			<a href="https://twitter.com/bestforcompany" class="social-icons-footer"><i class="fa fa-twitter"></i></a>	
			<a href="https://www.youtube.com/channel/UC2WgQ3PfRKVsx1fKP1LWxhQ" class="social-icons-footer"><i class="fa fa-youtube-play"></i></a>	
			<a href="https://gr.pinterest.com/bestforgr/" class="social-icons-footer"><i class="fa fa-pinterest-p"></i></a>	
			<a href="https://www.tiktok.com/@bestforgr?" class="social-icons-footer"><i class="fa fa-tumblr"></i></a>
			<a href="#page" class="go-to-top">
					<span>go to top</span>
					<i class="fa fa-level-up"></i>
			</a>	
			</div>
		</div>

           </div>
    </div>
	</div>


				</footer><!-- #colophon -->






<?php wp_footer(); ?>

</body>

</html>

