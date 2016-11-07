<?php get_header(); ?>
<div id="banner">
	<?php tmq_banner(); ?>
</div> <!-- End #banner -->
<div id="content">
	<div id="left-sidebar">
		<?php get_sidebar('left');?>
	</div> <!-- End #left-sidebar -->
	<div id="main-content" role="main">
		<?php if(have_posts()): while(have_posts()): the_post(); //Loop ?>
		<?php
			get_template_part('content', get_post_format());
		?>
		<?php endwhile ?>
		<?php else: ?>
			<?php get_template_part('content', 'none'); //Nhúng trang content-none.php nếu không có post ?>
		<?php endif ?>
	</div><!-- End #main-content -->
	<div id="right-sidebar">
		<?php get_sidebar('right');?>
	</div> <!-- End #right-sidebar -->
</div> <!-- End #content -->
<?php get_footer(); ?>
