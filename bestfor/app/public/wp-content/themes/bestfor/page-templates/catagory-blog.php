<?php
/**
 * Template Name: blog
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();



?>

<div class="wrapper" id="full-width-page-wrapper">

	
<section class="page-title">
	             <h1>News & Blog</h1>
	
                </section>
		

			

				<main class="site-main" id="main" role="main">

					
				<?php 
                // the query
                $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
                $wpb_all_query = new WP_Query(
                    
                    array(
                        'post_type'=>'post', 
                        'post_status'=>'publish', 
                        'posts_per_page'=>10,
                        'order'=>'ASC',
                        'category_name'=> 'blog',
                        'paged' => $paged,
                    )); ?>
                 

                
                <?php if ( $wpb_all_query->have_posts() ) : ?>
                 
                <ul class="blog-page-list">
                 
                    <!-- the loop -->
                    <?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
                 
                    <div class="col-xl-4">
                    <li>
                    
                        <a href="<?php the_permalink();?>" class="blog-header-main"><?php the_title(); ?></a> 
                        <a href="<?php the_permalink();?>">

                        <img src="<?php the_post_thumbnail();?>
                        <div class="after-image-overlay"></div>
                        </a>

                        <?php the_excerpt()?>
                        </li>

                    </div>
                   
                    <?php endwhile; ?>
                    <!-- end of the loop -->
                    <div class="pagination">
    <?php 
        echo paginate_links( array(
            'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
            'total'        => $wpb_all_query->max_num_pages,
            'current'      => max( 1, get_query_var( 'paged' ) ),
            'format'       => '?paged=%#%',
            'show_all'     => false,
            'type'         => 'plain',
            'end_size'     => 2,
            'mid_size'     => 1,
            'prev_next'    => true,
            'prev_text'    => sprintf( '<i></i> %1$s', __( 'PREVIOUS PAGE', 'text-domain' ) ),
            'next_text'    => sprintf( '%1$s <i></i>', __( 'NEXT Posts', 'text-domain' ) ),
            'add_args'     => false,
            'add_fragment' => '',
        ) );
    ?>
</div>
                    </ul>  
                  
              
       
                    <?php wp_reset_postdata(); ?>
                 
                <?php else : ?>
                    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
                <?php endif; ?>
					
					

				</main><!-- #main -->

		


	</div><!-- #content -->

</div><!-- #full-width-page-wrapper -->

<?php
get_footer();
