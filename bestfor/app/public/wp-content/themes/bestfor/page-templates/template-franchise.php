<?php
/**
 * Template Name: Franchise
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
	<h1>Franchise</h1>
</section>

<section class="franchise-banner">
    <h2>We Win When You Win.
</h2>
</section>
<section class="franchise-desc">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="franchise-desc-1">
                    <h3>The BEST Products</h3>
                    <ul>
                        <li>Huge variety of high quality products over 7000 codes covering every wish and choice.</li>
                        <li>Complete thematic product series every month.</li>
                        <li>Full product categories for WOMEN-MEN-CHILDREN-HOUSE-OFFICE-ACCESSORIES- GADGET- HOBBY – SEASONAL</li>
                        <li>Products undergoing the necessary checks to obtain the European export specifications for each country.</li>
                        <li>Certified products bearing all the necessary markings.</li>
                    </ul>
                </div>
                <div class="zigzap-wrapper">
                    <div class="zigzag-inner"></div>
                </div>
                <div class="franchise-desc-2">
                    <h3>The BEST Support</h3>
                    <ul>
                        <li>Specially trained staff with years of sales experience are available 24 hours a day to complete each task.</li>
                        <li>Inspectors responsible for enhancing and training your staff</li>
                        <li>Scheduled visits and meetings with Franchisees.</li>
                        <li>Providing all graphic designs from the BEST FOR headquarters.</li>
                        <li>Provision of the entire MARKETING PLAN of the year by the company.</li>
                    </ul>
                </div>
                <div class="zigzap-wrapper">
                    <div class="zigzag-inner"></div>
                </div>
                <div class="franchise-desc-3">
                    <h3>The BEST Investment</h3>
                    <div class="franchise-desc-3-sub">
                     <p>This is a proven investment with great success and great profit margins.</p>
                     <h5>A timeless proposition, not a fashion investment.</h5>
                    </div>
                </div>
                <div class="zigzap-wrapper">
                    <div class="zigzag-inner"></div>
                </div>
            </div>
            <div class="col-lg-4">
             <img src="<?php echo get_template_directory_uri() .'/src/images/franchise2.png' ?>" alt="franchise2" class="image-fluid">
            </div>
        </div>
    </div>
</section>
<section class="franchise-awards">
    <div class="container-fluid">
        <div class="row award justify-content-center">
            <div class="col-lg-3">
             <div class="awards-image-holder bg-blue">
             <img src="<?php echo get_template_directory_uri() .'/src/images/FA2020.jpg' ?>" alt="franchise2018" class="image-fluid">
             </div>
             <div class="awards-desc">
             We are winners of 2020 Franchise Bussiness awards.
             </div>
            </div>
            <div class="col-lg-3">
            <div class="awards-image-holder bg-orange">
             <img src="<?php echo get_template_directory_uri() .'/src/images/FA2019.jpg' ?>" alt="franchise2018" class="image-fluid">
             </div>
             <div class="awards-desc">
             We are winners of 2019 Franchise Bussiness awards.
             </div>
            </div>
            <div class="col-lg-3">
            <div class="awards-image-holder bg-green">
             <img src="<?php echo get_template_directory_uri() .'/src/images/FA2018.jpg' ?>" alt="franchise2018" class="image-fluid">
             </div>
             <div class="awards-desc">
             We are winners of 2018 Franchise Bussiness awards.
             </div>
            </div>
        </div>
    </div>
</section>





</div><!-- #full-width-page-wrapper -->

<?php
get_footer();
