<?php
wp_nav_menu( array(
	'container' => 'div',
	'container_id' => 'navContainer',
	'container_class' => 'jbasewrap',
	'theme_location' => 'main_menu', 
	'menu_id' => 'nav'
) );

$footer = get_page_by_path('footer');
$footer_id = $footer->ID;
$i=0;
$page_count = $wp_query->post_count;
while ( have_posts() ) : the_post();
$i = $wp_query->current_post;
if($i!=0) { ?>
<div class="diagonal top fullwidth">
	<img alt="stripe" src="<?php bloginfo('stylesheet_directory'); ?>/images/diag-<?php the_slug(); ?>.png" />
</div>
<?php } ?>
<div class="fullwidth <?php the_slug(); if($page_count==1) { echo " single"; } ?>">
	<div class="jbasewrap">
		<div class="content">
		<?php if($page_count==1 || $i!=$page_count-1) {
		
			if($i==0) { ?>
			<h1<?php if(is_home()) { echo ' id="logo"'; } ?>><?php the_title(); ?></h1>
				<?php if(is_home()) { ?>
			<div id="tweetr">
			<h3><a href="http://twitter.com/" target="_blank">On Twitter:</a></h3>
				<?php 
				tweet_blender_widget(array(
				    'unique_div_id' => 'tweets',
				    'sources' => '@giveandtakeshop',
				    'refresh_rate' => 60,
				    'tweets_num' => 2,
				    'view_more_url' => 'http://twitter.com/'
				));
				?>	
			</div>
				<?php } ?>
			<?php } else { ?>
			<h2><a name="<?php the_slug(); ?>"><?php the_title(); ?></a></h2>
			<?php }

			// if not a child of homepage, don't show excerpt
			$frontpage_id = get_option('page_on_front');
			if($post->post_parent==$frontpage_id) { ?>
			<p class="tagline"><?php echo do_shortcode(get_the_excerpt()); ?></p>				
			<?php } ?>

			<div class="panel">
			<?php the_content(); ?>
			</div>

		<?php } else { ?>
		
			<a name="<?php the_slug(); ?>"></a>
			<?php the_content();
		
		} ?>		
		</div>
	</div>
	<?php if($page_count!=1 && $i==$page_count-1) { ?>
	<div class="jbasewrap passthrough">
		<div class="footer"><?php echo do_shortcode($footer->post_content); ?></div>
	</div>
	<?php } ?>
</div>
<?php if($i!=$page_count-1) { ?>
	<div class="diagonal fullwidth">
		<img alt="stripe" src="<?php bloginfo('stylesheet_directory'); ?>/images/diag-<?php the_slug(); ?>.png" />
	</div>
<?php  }
$i++;
endwhile;
?>