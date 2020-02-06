<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<style>

.product{
	background: #000;
}

.text_scena_description{
	position: absolute;
    top: 500px;
    width: 25%;
}

.text_scena_description.right{
    right: 10%;
}

.text_scena_description.left{
    left: 10%;
}

/*
.text_scena_description h2, .text_scena_description p{
	color: #fff;
} 
*/

.text_scena_description.white, .text_scena_description.white h2, .text_scena_description.white a {
	color: #fff;
}

.text_scena_description.black, .text_scena_description.black h2, .text_scena_description.black a {
	color: #000;
}

.text_scena_description h2.black, .text_scena_description p.black{
	color: #000;
} 

.slide_scena img:nth-child(2){
	display: none;
}



@media screen and (max-width: 860px){
	.slide_scena img:nth-child(1){
		display: none;
	}
	.slide_scena img:nth-child(2){
		display: block;
	}
	.text_scena_description {
	    position: relative;
	    width: 100%;
	    top: 0;
		right: 0 !important;
		left: 0 !important;
	    background-color: #000;
	    margin-top: -20px;
	    text-align: center;
	    padding-bottom: 3em;
	    padding-left: 0.5em;
	    padding-right: 0.5em;
	    
	}
	.text_scena_description h2{
		text-align: center;
	}
}

.text_scena_description h2{
	margin-bottom: 4em;
} 
.text_scena_description p{
	margin-bottom: 1em;
} 

div.summary.entry-summary{
	display: none;
}

.slide_scena a{
	display: block;
    margin: 1em auto;
    text-transform: uppercase;
}

.slide_scena a.black{
	color: #000;
}

.slide_scena a#fiche_technique{
	text-transform: capitalize;	
}

.footer-container{
	margin-top: 0px !important;
}

</style>

<?php

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
	?>

		<?php while ( have_posts() ) : the_post(); ?>
			
			<?php $dispoText = do_shortcode( "[types field='disposition-du-texte'][/types]" ); ?>
			<?php $colorText = do_shortcode( "[types field='couleur-du-texte'][/types]" ); ?>
		
			<div class="slide_scena">
				<?php $scenaHorizontal = do_shortcode( "[types field='scenarisation-horizontal'][/types]" ); if( $scenaHorizontal != '' ) { ?>
						<?php echo $scenaHorizontal; ?>
				<?php }	?>
			    <?php $scenaVertical = do_shortcode( "[types field='scenarisation-vertical'][/types]" ); if( $scenaVertical != '' ) { ?>
						<?php echo $scenaVertical; ?>
				<?php }	?>
			</div>
			
			<div class="text_scena_description <?php if( $dispoText != '' ) { echo $dispoText; } ?> <?php if( $colorText != '' ) { echo $colorText; } ?>">
			    <h2><?php the_title(); ?></h2>
			    <div class="slide_scena">
			        <?php the_content(); ?>
			        <?php $fichetechnique = do_shortcode( "[types field='fiche-technique'][/types]" ); if( $fichetechnique != '' ) { ?>
						<a id="fiche_technique" class="<?php if( $colorText != '' ) { echo $colorText; } ?>" href="<?php echo $fichetechnique; ?>" target="_blank">Fiche technique</a>
					<?php }	?>
			        <a href="<?php echo get_site_url(); ?>//#tarifs">Commander</a>
			    </div>
			</div>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
	?>

	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
	?>	

<?php get_footer( 'shop' ); ?>
