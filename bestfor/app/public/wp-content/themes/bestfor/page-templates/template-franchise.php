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
            <div class="col-lg-4">
                <div class="franchise-awrads-wrapper">

               
                    <div class="awards-image-holder bg-blue">
                       <img src="<?php echo get_template_directory_uri()
                  .'/src/images/FA2020.jpg' ?>" alt="franchise2018" class="image-fluid">
                       <h3>2020 Besrt International Expansion</h3>
                    </div>
                    <div class="awards-desc1">
                     We are winners of 2020 Franchise Bussiness awards.
                    </div>
                 </div>
            </div>
            <div class="col-lg-4">
                 <div class="franchise-awrads-wrapper">
                  <div class="awards-image-holder bg-orange">
                     <img src="<?php echo get_template_directory_uri() 
                     .'/src/images/FA2019.jpg' ?>" alt="franchise2018" class="image-fluid">
                      <h3>2019 Besrt International Expansion</h3>
                    </div>
                   <div class="awards-desc2">
                  We are winners of 2019 Franchise Bussiness awards.
                    </div>
                 </div>
               </div>
            <div class="col-lg-4">
               <div class="franchise-awrads-wrapper">
                <div class="awards-image-holder bg-green">
                   <img src="<?php echo get_template_directory_uri() 
                    .'/src/images/FA2018.jpg' ?>" alt="franchise2018" class="image-fluid">
                    <h3>2018 Besrt International Expansion</h3>
                 </div>
                  <div class="awards-desc3">
                  We are winners of 2018 Franchise Bussiness awards.
                 </div>
               </div>
            </div>
        </div>
    </div>
</section>

<section class="franchise-testimonials">
    <p>We are a European Company with all EU standards and quality in our products.</p>
    <p>It’s an investment that has been tested before and with a very big success. </p>
    <p>It’s a <strong>timeless</strong> proposal and not a fashion investment.</p>
    <p>The depreciation comes in about one year.</p>
</section>

<section class="servicesandterms">
    <div class="franchise-services-wrapper">
        <ul>Our services:
            <li>Territory exclusivity</li>
            <li>Shop design</li>
            <li>Continuous IT support</li>
            <li>Advertisement support</li>
            <li>Setting up the entire business in every sector</li>
            <li>Staff training</li>
            <li>Specialized sales and marketing seminars on a regular basis</li>
            <li>Great profit margins</li>
            <li>We provide a complete and high standard business model</li>
            <li>We apply a personalized marketing and operational plan for every territory We apply a personalized marketing
                 and operational plan for every territory tailored to its particularities</li>
        </ul>
        <ul>Conditions for the creation of a “BEST FOR…” shop:
            <li>Shop space in a central point with floor space between 60 and 120 m2</li>
            <li>Storage space equal to the 20% of the shop</li>
            <li>ENTRY FEES: 0 € </li>
            <li>Creation & equipment: until 20.000 – 30.000 €</li>
            <li>Starting merchandise: until 20.000 – 25.000 €</li>
            <li>Royalties: 0%</li>
            <li>Marketing Fees: 0%</li>
</ul>
    </div>
</section>

<!-- <section class="franchise-image-last">
    <img src="<?php echo get_template_directory_uri(). '/src/images/franchise1.jpg'?>"  alt="" class="image-fluid">
</section> -->



</div><!-- #full-width-page-wrapper -->

<?php
get_footer();
