<!-- Thêm các thẻ div với id hoặc class để dựng giao diện -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-header">
		<?php tmq_entry_header(); ?>
	</div> <!-- End #entry-header -->
	<div class="entry-content">
		<?php tmq_entry_content(); ?>
	</div> <!-- End #entry-content -->
</article>