<?php get_header(); ?>
<?php get_sidebar(); ?>
	
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<article class="post">
			<header>
				<h1 class="post_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
				<h2 class="post_date"><?php the_date('M n ‘y'); ?></h2>
			</header>
			
			<div class="post_content">
				<?php the_content(); ?>
			</div>
			
			<footer>
				<?php if ( get_the_category() ) { ?>
					<p class="cats"><?php echo get_the_category_list( ', ' ); ?></p>
				<?php } ?>
				<?php if ( get_tags() ) { ?>
					<p class="tags"><?php the_tags('<span class="tags-title">Tags:</span> ', ', ', ''); ?></p>
				<?php } ?>
				
				<p class="comments"><?php comments_popup_link( 'Leave a comment', '1 Comment', '% Comments' ); ?></p>
			</footer>
		</article>
	<?php endwhile; ?>

	<nav class="pagination">
		<p class="next"><?php next_posts_link('Older') ?></p>
		<p class="prev"><?php previous_posts_link('Newer') ?></p>
	</nav>

<?php get_footer(); ?>
