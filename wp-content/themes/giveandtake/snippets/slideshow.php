<script type="text/javascript">
	window.imageDirectoryURL = "<?php echo bloginfo('stylesheet_directory'); ?>";
</script>
<div class="left slideshowContainer marginbottom">
			<div class="slideshow">
				<div class="svwp" id="slideshow">
					<ul>
						<?php $images = get_children(array(
							'post_parent'    => get_the_ID(),
							'post_type'      => 'attachment',
							'numberposts'    => -1, // show all
							'post_status'    => null,
							'post_mime_type' => 'image',
							'order'          => 'ASC',
							'orderby'        => 'menu_order',
						));
						foreach($images as $image) :	
							$attimg = wp_get_attachment_image_src($image->ID, 'slideshow-img');
							$src = $attimg[0];
							$alt = get_post_meta($image->ID, '_wp_attachment_image_alt', true);							
						?>
						<li><img alt="<?php echo $alt; ?>" src="<?php echo $src; ?>" /></li>
						<?php 
						endforeach;
						?>
					</ul>
				</div>
			</div>
		</div>