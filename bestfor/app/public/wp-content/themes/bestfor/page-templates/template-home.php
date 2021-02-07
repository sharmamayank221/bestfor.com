<?php
/**
 * Template Name: homepage
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

	<div class="<?php echo esc_attr( $container ); ?>" id="content">
    <?php
echo do_shortcode('[smartslider3 slider="2"]');
?> 
<div class="homepage-wrapper-one">


   <div class="container-fluid">
		<div class="row homepage-cards-container ">
           <div class="col-lg-4-fluid homecards">
               <div class="homecard-top-part"> 
                    <a href="#" class="homepage-cards-links">THE BEST PRODUCTS</a>
               <p>Huge variety of high quality products!</p>
            </div>
             
               <img src="<?php echo get_template_directory_uri() . 
               '/src/images/homepage-img1.jpg'?>" alt="">
               <div class="find-out-more-btn">
               <a href="#">FIND OUT MORE</a> 
               <img src="<?php echo get_template_directory_uri() . 
               '/src/images/log-in.svg'?>" alt="login" width="37.5px">
               </div>
     </div>
           <div class="col-lg-4-fluid homecards">
           <div class="homecard-top-part"> 
               <a href="#" class="homepage-cards-links">THE BEST SERVICE</a>
               <p>Specialized staff with years of sales experience is available 24 hours!</p>
           </div>
               <img src="<?php echo get_template_directory_uri() . 
               '/src/images/homepage-img2.jpg'?>" alt="">
               <div class="find-out-more-btn">
               <a href="#">FIND OUT MORE</a> 
               <img src="<?php echo get_template_directory_uri() . 
               '/src/images/log-in.svg'?>" alt="login" width="37.5px">
               </div>
            </div>
            <div class="col-lg-4-fluid homecards">
            <div class="homecard-top-part"> 
               <a href="#" class="homepage-cards-links">THE BEST INVESTMENT</a>
               
               <p>This is a proven investment with great success and great profit margins!</p>
              </div>
               <img src="<?php echo get_template_directory_uri() . 
               '/src/images/homepage-img3.jpg'?>" alt="">
              <div class="find-out-more-btn">
               <a href="#">FIND OUT MORE</a> 
               <img src="<?php echo get_template_directory_uri() . 
               '/src/images/log-in.svg'?>" alt="login" width="37.5px" color="">
               </div>
            </div>
           
   </div>
         </div>
         </div>

         <div class="homepage-wrapper-two">
           <div class="container-fluid">
              <div class="row homepage-video-container ">
                  <div class="col-lg-6">
                      <h1 class="homepage-video-h1">
                      Our Mission is to Become <strong>The Best</strong> Franchise Company in <strong>The World.</strong>
                      </h1>
                      <p>
                      BEST FOR… was created by the need for people to always have the best quality products at the lowest price. It’s no coincidence that everybody asks us how we can get such low prices with such good quality. After all, that was our inspiration for our name! BEST FOR… YOU</p>
<p>Because we know that for a beautiful life you don’t need to spend a fortune. And certainly not in BEST FOR… This is our Life Philosophy!</p>

<p>#Best_for_life_philosophy
                      </p>
                      <a href="#" class="learn-more-homepage">LEARN ABOUT US</a>
                  </div>
                  <div class="col-lg-6">
                  <!-- <iframe width="560" height="315" src="https://www.youtube.com/embed/0BHLQOduMQ4" 
                    frameborder="0" allow="accelerometer; autoplay; 
                    clipboard-write; encrypted-media; gyroscope; 
                    picture-in-picture" allowfullscreen></iframe> -->
                  </div>
</div>
</div>
         </div>

         <div class="homepage-wrapper-three">
             <div class="our-products-text">
                  <h1 class="homepage-heading">Our Products</h1>
             </div>
         </div>
         <div class="container-fluid">
             <div class="row homepage-wrapper-four">
             
                <div class="col-lg-4">
                    <div class="single-product">
                        <div class="single-product-inner">
                            <div class="single-product-f">
                         <img src="<?php echo get_template_directory_uri() . '/src/images/product-child.png' ?>" alt="">
                         </div>
                    <div class="single-product-b orange">
                         <a href="https://www.bestforshop.com">Best For.. Child</a>
                         </div>
                     </div>
                  </div>
                </div>


        <div class="col-lg-4">
             <div class="single-product">
                 <div class="single-product-inner">
                     <div class="single-product-f">
                         <img src="<?php echo get_template_directory_uri() . '/src/images/best-women.png' ?>" alt="">
                     </div>
                     <div class="single-product-b magenta">
                         <a href="https://www.bestforshop.com">Best For.. Women</a>
                     </div>
                 </div>
             </div>
         </div>



        <div class="col-lg-4">
             <div class="single-product">
                <div class="single-product-inner">
                      <div class="single-product-f">
                         <img src="<?php echo get_template_directory_uri() . '/src/images/best-men.png' ?>" alt="">
                      </div>
                     <div class="single-product-b blue">
                         <a href="https://www.bestforshop.com">Best For.. Men</a>
                     </div>
                 </div>
             </div>
         </div>
      </div>  
      
  </div> <!-- end of 1st row of products -->

  <div class="row homepage-wrapper-four">
             
             <div class="col-lg-4">
                 <div class="single-product">
                     <div class="single-product-inner">
                         <div class="single-product-f">
                      <img src="<?php echo get_template_directory_uri() . '/src/images/best-home.png' ?>" alt="">
                      </div>
                 <div class="single-product-b green">
                      <a href="https://www.bestforshop.com">Best For.. Home</a>
                      </div>
                  </div>
               </div>
             </div>


     <div class="col-lg-4">
          <div class="single-product">
              <div class="single-product-inner">
                  <div class="single-product-f">
                      <img src="<?php echo get_template_directory_uri() . '/src/images/best-accessories.png' ?>" alt="">
                  </div>
                  <div class="single-product-b purple">
                      <a href="https://www.bestforshop.com">Best For.. Accessories</a>
                  </div>
              </div>
          </div>
      </div>



     <div class="col-lg-4">
          <div class="single-product">
             <div class="single-product-inner">
                   <div class="single-product-f">
                      <img src="<?php echo get_template_directory_uri() . '/src/images/best-office.png' ?>" alt="">
                   </div>
                  <div class="single-product-b darkblue">
                      <a href="https://www.bestforshop.com">Best For.. Office</a>
                  </div>
              </div>
          </div>
      </div>
   </div>  
   
</div> <!-- end of 2nd row of products -->


<div class="row homepage-wrapper-four">
             
             <div class="col-lg-4">
                 <div class="single-product">
                     <div class="single-product-inner">
                         <div class="single-product-f">
                      <img src="<?php echo get_template_directory_uri() . '/src/images/best-hobbies.png' ?>" alt="">
                      </div>
                 <div class="single-product-b light-green">
                      <a href="https://www.bestforshop.com">Best For.. Hobbies</a>
                      </div>
                  </div>
               </div>
             </div>


     <div class="col-lg-4">
          <div class="single-product">
              <div class="single-product-inner">
                  <div class="single-product-f">
                      <img src="<?php echo get_template_directory_uri() . '/src/images/best-digital.png' ?>" alt="">
                  </div>
                  <div class="single-product-b grey">
                      <a href="https://www.bestforshop.com">Best For.. Digital</a>
                  </div>
              </div>
          </div>
      </div>



     <div class="col-lg-4">
          <div class="single-product">
             <div class="single-product-inner">
                   <div class="single-product-f">
                      <img src="<?php echo get_template_directory_uri() . '/src/images/best-seasonal.png' ?>" alt="">
                   </div>
                  <div class="single-product-b orange">
                      <a href="https://www.bestforshop.com">Best For.. seasonal</a>
                  </div>
              </div>
          </div>
      </div>
   </div>  
   
</div> <!-- end of 3rd row of products -->

<section class="best-franchise-home">
    <h2>Why to choose Best For franchise program...
</h2>
<div class="best-franchise-wrapper">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4">
        <div class="box-wrapper">
        <div class="shopping-bag-box">
        <i class="icon-bag"></i>
             <h6>THE BEST PRODUCTS 100%</h6>
            
         </div>
         <div class="box-detail">
                 <p>All our products are from Europe!</p>
                 <img src="<?php echo get_template_directory_uri() . '/src/images/arrow-thin-right.svg' ?>" alt="arrow-right" width="11.69px">      <a href="https://www.bestforshop.com">Learn More</a>
             </div>
        </div>
        </div>
        <div class="col-lg-4">
        <div class="box-wrapper">
        <div class="shopping-bag-box">
        <i class="icon-earphones-alt"></i>
             <h6>THE BEST PRODUCTS 100%</h6>
            
         </div>
         <div class="box-detail">
                 <p>All our products are from Europe!</p>
                 <img src="<?php echo get_template_directory_uri() . '/src/images/arrow-thin-right.svg' ?>" alt="arrow-right" width="11.69px">      <a href="https://www.bestforshop.com">Learn More</a>
             </div>
        </div>
        </div>
        <div class="col-lg-4">
        <div class="box-wrapper">
        <div class="shopping-bag-box">
        <i class="icon-check"></i>
             <h6>THE BEST PRODUCTS 100%</h6>
            
         </div>
         <div class="box-detail">
                 <p>All our products are from Europe!</p>
                 <img src="<?php echo get_template_directory_uri() . '/src/images/arrow-thin-right.svg' ?>" alt="arrow-right" width="11.69px">        <a href="https://www.bestforshop.com">Learn More</a>
             </div>
        </div>
        </div>
    </div>
    
</div>
</div>

</section>

                  </div>


					<?php
					while ( have_posts() ) {
						the_post();
						get_template_part( 'loop-templates/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}
					}
					?>


		

		</div><!-- .row end -->

	</div><!-- #content -->

</div><!-- #full-width-page-wrapper -->

<?php
get_footer();
