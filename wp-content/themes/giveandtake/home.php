<?php get_header(); ?>
<ul id="nav"><!-- TO-DO: make this a menu -->
	<li><a rel="self" href="#whatwesell">What we sell</a></li>
	<li><a rel="self" href="#howdoesitwork">How does it work?</a></li>
	<li><a rel="self" href="#charities">Charities</a></li>
	<li><a rel="self" href="#other">Information</a></li>
	<li><a rel="self" href="/">Home</a></li>
</ul>
<?php wp_nav_menu( array(
	'container' => 'false',
	'theme_location' => 'main_menu', 
	'menu_id' => 'nav'
) );

// The Query
query_posts("post_type=page&orderby=menu_order&order=ASC");
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
			<?php if($i==0) { ?>
			<h1><?php the_title(); ?></h1>
			<?php } else { ?>
			<h2><?php the_title(); ?></h2>
			<?php } ?>
			<p class="tagline"><?php the_excerpt(); ?></p>
			<?php the_content(); ?>	
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
<?php get_footer(); ?>
