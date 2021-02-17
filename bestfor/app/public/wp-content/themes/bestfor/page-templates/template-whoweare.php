<?php
/**
 * Template Name: Who we are
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();


if ( is_front_page() ) {
	get_template_part( 'global-templates/hero' );
}
?>

<div class="wrapper" id="full-width-page-wrapper">
  
<section class="page-title">
	<h1>Hello everybody! Welcome to Best For!</h1>
	
</section>

<section class="rev-slider-wrapper">
<div class="slider-who-we-are">
<?php
echo do_shortcode('[smartslider3 slider="5"]');
?>
</div>
<div class="infoandindustries">


		<div class="info-company-org">
			<div class="company-info-left">
				<a href="">Our company</a>
				<p>The Company is specialized in the creation and retail of useful innovative products.
				</p>
			</div>
			
			<div class="company-info-right">
				<img src="<?php echo get_template_directory_uri() . '/src/images/aboutus0.jpg'?>" alt="" >
			</div>

			</div>
			<div class="our-industries">
				<div class="our-industries-left">
				<a href="">Industries</a>
				<p>Understanding business process requires understanding the industry. We do both.
			</p>
			</div>
			<div class="company-info-right">
				<img src="<?php echo get_template_directory_uri() . '/src/images/aboutus1.jpg'?>" alt="" >
			</div>
				</div>
	
	</div>
</div>
   
</section>

<section class="shopping-experience">
	<h1>Focusing on the customers’ shopping experience...
</h1>
<div class="container-fluid">
	<div class="row shopping-paras">
     <div class="col-lg-4">
		 <p>“Best for” is a Pioneer European Company with headquarters based in Thessaloniki, Greece. 
			 The Company is specialized in the creation and retail of useful innovative products.</p>
			 <p>“Best for” supports the “simple” and “natural” for the people’s lifestyle. We believe in the priviledge 
				 of “returning to nature” and “restoring product essence”.</p>
			 <p>“Best for” always respects the customers’ needs and is devoted to 
				 provide them with modern products of high design quality focusing
				  on their functionality and low prices. 
				 The Company is well-known to people of every background, age and income.</p>
	 </div>
	 <div class="col-lg-4">
		 <p>Focusing on the customers’ shopping experience we create a pleasant environment through which everyone 
			 experiences the joy, the fashion and the healthy way of living. We optimize the product 
			 structure and pay great attention in the product management. We insist in the choice of
			  the right products from all over the world and always provide customers with the best 
			  possible services.</p>
			 <p>Everyone could find one “Best For …” shop in high streets of different cities and in shopping centers.</p>
			 <p>“Best for…” is a trademark which supports life, values of fashion, 
				 price, quality and creativeness of its customers.</p>
	 </div>
	</div>
</div>
</section>

<section class="best-for-pdf">
	<a href="#" class="best-for-link-brochure">Check out  our Corporate Brochure</a>
	<div class="row-inner">
	<?php
echo do_shortcode('[ipages id="1"]');
?> 
	</div>

</section>

</div><!-- #full-width-page-wrapper -->

<?php
get_footer();
