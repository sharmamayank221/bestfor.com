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

<div class="wrapper homepage-wrapper" id="full-width-page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">
    <?php
echo do_shortcode('[smartslider3 slider="2"]');
?> 
<div class="homepage-wrapper-one">


   <div class="container-fluid">
		<div class="row homepage-cards-container ">
           <div class="col-lg-3-fluid homecards">
               <div class="homecard-top-part"> 
                    <a href="#" class="homepage-cards-links">THE BEST PRODUCTS</a>
               <p>Huge variety of high quality products!</p>
            </div>
             
               <img src="<?php echo get_template_directory_uri() . 
               '/src/images/homepage-img1.jpg'?>" alt="">
               <div class="find-out-more-btn">
               <a href="#">FIND OUT MORE<i class="ion-log-in"></i></a> 
              
               </div>
     </div>
           <div class="col-lg-3-fluid homecards">
           <div class="homecard-top-part"> 
               <a href="#" class="homepage-cards-links">THE BEST SERVICE</a>
               <p>Specialized staff with years of sales experience is available 24 hours!</p>
           </div>
               <img src="<?php echo get_template_directory_uri() . 
               '/src/images/homepage-img2.jpg'?>" alt="">
               <div class="find-out-more-btn">
               <a href="#">FIND OUT MORE<i class="ion-log-in"></i></a> 
               
               </div>
            </div>
            <div class="col-lg-3-fluid homecards">
            <div class="homecard-top-part"> 
               <a href="#" class="homepage-cards-links">THE BEST INVESTMENT</a>
               
               <p>This is a proven investment with great success and great profit margins!</p>
              </div>
               <img src="<?php echo get_template_directory_uri() . 
               '/src/images/homepage-img3.jpg'?>" alt="">
              <div class="find-out-more-btn">
              <a href="#">FIND OUT MORE<i class="ion-log-in"></i></a> 
               
               </div>
            </div>
           
   </div>
         </div>
         </div>

         <div class="homepage-wrapper-two">
           <div class="container-fluid">
              <div class="row homepage-video-container ">
                  <div class="col-xl-6 home-vid-desc">
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
                  <div class="col-xl-6 yt-player">
                  <iframe width="560" height="315" src="https://www.youtube.com/embed/0BHLQOduMQ4" frameborder="0" allow="accelerometer; autoplay; clipboard-write; 
                    encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
                         <a href="https://bestforeshop.com/">Best For.. Child</a>
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
                         <a href="https://bestforeshop.com/">Best For.. Women</a>
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
                         <a href="https://bestforeshop.com/">Best For.. Men</a>
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
                      <a href="https://bestforeshop.com/">Best For.. Home</a>
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
                      <a href="https://bestforeshop.com/">Best For.. Accessories</a>
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
                      <a href="https://bestforeshop.com/">Best For.. Office</a>
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
                      <a href="https://bestforeshop.com/">Best For.. Hobbies</a>
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
                      <a href="https://bestforeshop.com/">Best For.. Digital</a>
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
                      <a href="https://bestforeshop.com/">Best For.. seasonal</a>
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
        <div class="box-wrapper1">
        <div class="shopping-bag-box">
        <i class="icon-bag"></i>
             <h6>THE BEST PRODUCTS 100%</h6>
            
         </div>
         <div class="box-detail1">
                 <p>All our products are from Europe!</p>
                 <i class="arrow-thin-right"></i>  <a href="https://www.bestforshop.com">Learn More</a> 
             </div>
        </div>
        </div>
        <div class="col-lg-4">
        <div class="box-wrapper2">
        <div class="shopping-bag-box2">
        <i class="icon-earphones-alt"></i>
             <h6>THE BEST SUPPORT</h6>
            
         </div>
         <div class="box-detail2">
                 <p>All our products are from Europe!</p>
                 <img src="<?php echo get_template_directory_uri() . '/src/images/arrow-thin-right.svg' ?>" alt="arrow-right" width="11.69px">      <a href="https://www.bestforshop.com">Learn More</a>
             </div>
        </div>
        </div>
        <div class="col-lg-4">
        <div class="box-wrapper3">
        <div class="shopping-bag-box3">
        <i class="icon-check"></i>
             <h6>THE BEST INVESTMENT</h6>
            
         </div>
         <div class="box-detail3">
                 <p>All our products are from Europe!</p>
                 <img src="<?php echo get_template_directory_uri() . '/src/images/arrow-thin-right.svg' ?>" alt="arrow-right" width="11.69px">        <a href="https://www.bestforshop.com">Learn More</a>
             </div>
        </div>
        </div>
    </div>
    
</div>
</div>

</section>

<section class="our-news-on-home">

<div class="homepage-our-news">
  <h2>Our News...</h2>
</div>
  <div class="container-fluid">
    <div class="row justify-content-center">
     <?php 
   // the query
   $the_query = new WP_Query( array(
     'category_name' => 'blog',
      'posts_per_page' => 3,
      'order' => 'ASC'
   )); 
?> 

<?php if ( $the_query->have_posts() ) : ?>
  <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
  <div class="col-xl-4">
                    
                   <div class="image-container">
                   <!-- <a href= "<?php the_permalink()?>" > -->
                    
                    <?php echo get_the_post_thumbnail();?>
                          <div class="image-info-holder">
                          <a href= "<?php the_permalink()?>" >  <?php the_title( '<h3>', '</h3>' ); ?> </a>
                          <a href="<?php echo esc_url( get_page_link( 17 ) );?>" clas="home-news-btn">NEWS</a>
                          
                       
                          </div>
                       
                   </div> 
                 

                        
                      

                    </div>

  <?php endwhile; ?>
  <?php wp_reset_postdata(); ?>

<?php else : ?>
  <p><?php __('No News'); ?></p>
<?php endif; ?>
    </div>
  </div>
<a href="<?php echo esc_url( get_page_link( 17 ) );?>" class="our-news-btn"> Check our News!</a>
</section>



<section class="best-instagram-feed">
    <h2 class="instagram-section-title">

Follow Us on Instagram #bestforgr
    </h2>
</section>

                  </div>




		

		</div><!-- .row end -->

	</div><!-- #content -->

</div><!-- #full-width-page-wrapper -->

<?php
get_footer();
