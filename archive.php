<?php get_header(); ?>	

	<h1>
		<?php if ( is_day() ) : ?>
						<?php echo 'Archives: ' . get_the_date(); ?>
		<?php elseif ( is_month() ) : ?>
						<?php echo 'Archives: ' . get_the_date('F Y'); ?>
		<?php elseif ( is_year() ) : ?>
						<?php echo 'Archives: ' . get_the_date('Y'); ?>
		<?php elseif ( is_category() ) : ?>
						<?php echo single_cat_title('Category: '); ?>
		<?php else : ?>
						<?php echo 'Blog Archives'; ?>
		<?php endif; ?>
	</h1>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<h2><a title="<?php the_title();?>" href="<?php the_permalink();?>"><?php the_title();?></a></h2>
		<?php wpe_excerpt('wpe_excerptlength_index', 'wpe_excerptmore'); ?>
	<?php endwhile; ?>
	
<?php get_sidebar(); ?>
<?php get_footer(); ?>
