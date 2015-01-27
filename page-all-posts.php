<?php
/**
 * Template Name: All Posts
 *
 * @package Minnow
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->
			<div class="entry-content">
				<?php
				$args = array ( 'post_type' => 'post', 'orderby' => 'date', 'order' => 'DSC','posts_per_page'=>-1 );
				$the_query = new WP_Query( $args );
				if ( $the_query->have_posts() ) : ?>
					  <!-- the loop -->
					  <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					  	<h2 class="h4"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2><span class="archivedate"><?php echo the_date( );?></span>
					  <?php endwhile; ?>
					  <!-- end of the loop -->
					</ul>
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
