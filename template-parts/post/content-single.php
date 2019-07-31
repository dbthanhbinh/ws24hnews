<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( (isset($content_type) && $content_type == 'related') || ('' !== get_the_post_thumbnail() && ! is_single()) ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'thumbnail' ); ?>
			</a>
		</div><!-- .post-thumbnail -->
	<?php endif; ?>

	<div class="entry-content">
		<header class="entry-header">
			<?php
			if ((isset($content_type) && $content_type == 'related')) {
				the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
			}
			elseif ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} elseif ( is_front_page() && is_home() ) {
				the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
			?>
		</header><!-- .entry-header -->

		<?php
		the_content();
		// =============			
		// ws24h_posted_on ();

		$customMeta = get_post_custom(get_the_ID());
		if(isset($customMeta)){
			$price = isset($customMeta['price'][0]) ? $customMeta['price'][0] : null;
			$acreage = isset($customMeta['acreage'][0]) ? $customMeta['acreage'][0] : null;
			$district = isset($customMeta['district'][0]) ? $customMeta['district'][0] : null;
			if($district)
				$district  = getDistrictName($district);

			$builds = isset($customMeta['number-of-build'][0]) ? $customMeta['number-of-build'][0] : null;
			$beds = isset($customMeta['number-of-bed'][0]) ? $customMeta['number-of-bed'][0] : null;
			$baths = isset($customMeta['number-of-bath'][0]) ? $customMeta['number-of-bath'][0] : null;
		}
		?>
		<div class="single-properties-group">
			<div class="summarys-group" title="Thông tin cơ bản">
				<i class="fa fa-building" aria-hidden="true"></i><span>THÔNG TIN CƠ BẢN:</span>
			</div>
			<div class="group-price-list">
				<ul class='price-list'>
					<?php if($price) ?><li class="item-price"><span class="old-price"><?= $price ?></span></li>
					<?php if($acreage) ?><li class="item-price"><span class="new-price"><?= $acreage ?> M<span class="sub-item">2</span></li>
				</ul>
				<ul class="district-list">
					<?php if($district) ?><li class="item-price"><span class="district-item"><?= $district ?></span></li>
				</ul>
			</div>
			<div class="row properties-group">
				<ul class="properties-list col-md-12">
					<?php if($beds) {?><li class="col-md-3 col-sm-3 col-3" title="<?= $beds ?> Phòng"><i class="fa fa-bed" aria-hidden="true"></i><span>Phòng ngủ: <?= $beds ?></span></li> <?php }?>
					<?php if($baths) {?><li class="col-md-3 col-sm-3 col-3" title="<?= $baths ?> Phòng"><i class="fa fa-bath" aria-hidden="true"></i><span>Phòng tắm: <?= $baths ?></span></li><?php }?>
					<?php if($builds) {?><li class="col-md-3 col-sm-3 col-3" title="<?= $builds ?>"><i class="fa fa-building" aria-hidden="true"></i><span>Tầng: <?= $builds ?></span></li><?php }?>
				</ul>
			</div>
		</div>
	</div><!-- .entry-content -->
</article>