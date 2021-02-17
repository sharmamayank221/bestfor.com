<?php
/**
 * Single post partial template
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

 <header class="entry-header">

		


	</header><!-- .entry-header -->

	

	<div class="entry-content">
	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php the_content(); ?>
         
		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
				'after'  => '</div>',
			)
		);
		?>

	</div><!-- .entry-content -->

    <section class="our-news-on-home">

<div class="homepage-our-news">
  <h2>LATEST UPDATES</h2>
</div>
  <div id="latest-news-wrapper" class="container-fluid">
    <div class="row">
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
  <div class="col-lg-4">
                    
                    <div href= "<?php the_permalink()?>" class="image-container">
                <?php echo get_the_post_thumbnail();?>
                      <div class="image-info-holder">
                      <?php the_title( '<h3>', '</h3>' ); ?>
                      <!-- <a href="<?php echo esc_url( get_page_link( 17 ) );?>">NEWS</a> -->
                    <a href="" class="post-date-link"><time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date(); ?></time></a>  
                   
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

</section>



	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
