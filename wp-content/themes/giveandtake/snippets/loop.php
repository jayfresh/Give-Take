<?php
$i=0;
$page_count = $wp_query->post_count;
// The Loop
while ( have_posts() ) : the_post();
$i = $wp_query->current_post; ?>
<?php if($i!=0) { ?>
<div class="diagonal top fullwidth">
	<img alt="stripe" src="images/diag-<?php the_slug(); ?>.png" />
</div>
<?php } ?>
<div class="fullwidth <?php the_slug(); ?>">
	<div class="jbasewrap">
		<div class="content">
		<?php if($page_count==1 || $i!=$page_count-1) {
		
			if($i==0) { ?>
			<h1><?php the_title(); ?></h1>
			<?php } else { ?>
			<h2><?php the_title(); ?></h2>
			<?php } ?>
			<p class="tagline"><?php the_excerpt(); ?></p>
			<?php the_content();
		
		} else {
		
			the_content();
			the_excerpt();
		
		} ?>		
		</div>
	</div>
</div>
<?php if($i!=$page_count-1) { ?>
	<div class="diagonal fullwidth">
		<img alt="stripe" src="images/diag-home.png" />
	</div>
<?php  }
$i++;
endwhile;
?>