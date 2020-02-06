<?php
/**
 *
 * @package winegrower
 */

 include (TEMPLATEPATH . '/to-cart.php');
 include (TEMPLATEPATH . '/mail-wine-grower.php');
 include (TEMPLATEPATH . '/is-mobile.php');
 
 get_header(); ?>
 
 	
 	<?php if( !check_user_agent('mobile') ) { ?>
 	
 		
 		<?php
			$args = array(
				'post_type' => 'video',
				'numberposts' 		 => 1,
				'posts_per_page' 	 => 1,
				'order'    			 => 'ASC'
			);
			query_posts( $args );
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post();
			
				$videoMP4 = do_shortcode( "[types field='video-format-mp4'][/types]" );
				$videoWEBM = do_shortcode( "[types field='video-format-webm'][/types]" );
				$videoOGV = do_shortcode( "[types field='video-format-ogv'][/types]" );
				
				if($videoMP4 != '' && $videoWEBM != '' && $videoOGV != '') { ?>
				
					<div class="main-container nobg container-video" id="presentation">
						<video controls preload='auto' autoplay='true' loop>
							<source src="<?php bloginfo('template_directory'); ?>/videos/<?php echo $videoMP4; ?>" type="video/mp4" />
							<source src="<?php bloginfo('template_directory'); ?>/videos/<?php echo $videoWEBM; ?>" type="video/webm" />
							<source src="<?php bloginfo('template_directory'); ?>/videos/<?php echo $videoOGV; ?>" type="video/ogg" />
						</video>
					</div> <?php
				
				}	
				
			endwhile;
			wp_reset_postdata(); 
		?>
 	<?php } ?>
 	
 			<?php
		     		$args = array(
						'post_type' => 'code-promo',
						'numberposts' 		 => 1,
						'posts_per_page' 	 => 1,
						'order'    			 => 'ASC'
					);
					query_posts( $args );
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post();
						if ( has_post_thumbnail() ) { ?>
							<div id="code_promo" class="main-container" style="background-color: rgba(247,247,247,0.8)"><img src="<?php the_post_thumbnail_url(); ?>"/></div> <?php
						}
					endwhile;
					wp_reset_postdata(); 
			?>
        
         <div class="main-container" style="background-color: rgba(247,247,247,0.8)">
            <article id="cuvees">
                <div class="bxslider">
			        <div class="slider1">
			        	
			        	<?php
				            $args = array( 'post_type' => 'product', 'numberposts' => -1, 'posts_per_page' => -1, 'orderby' =>'date','order' => 'ASC' );
				            $loop = new WP_Query( $args );
				            while ( $loop->have_posts() ) : $loop->the_post(); global $product;
				        ?>
			        
			        	<div class="slide">
                          	<div class="slide_description">
                          		<?php if ( has_post_thumbnail() ) { ?>
                          		 <img src="<?php echo the_post_thumbnail_url(); ?>" class="photo_cuv" style="max-width: 130px; height: auto;" />
						  		 <?php } ?>
							</div>
							<div class="text_scena_description">
							    <h2><?php the_title(); ?></h2>
							    <div class="slide_description">
							        <?php echo apply_filters( 'woocommerce_short_description', $product->post->post_excerpt ) ?>
							        <a href="<?php echo get_permalink(); ?>">Découvrir</a>
							    </div>
							</div>
						</div>
						
						<?php endwhile; ?>
						<?php wp_reset_query(); ?>
					</div>
		        </div>
            </article>
        </div>
         <div class="main-container">
            <div class="main wrapper clearfix">
                <article id="tarifs">
                	<section>
                        <h2>TARIFS / BON DE COMMANDE</h2>
                        <p>Merci de remplir la colonne quantité.</p>
                        
                        <form id="form_bon_commande" action="panier/" method="post" id="bdc" onsubmit="send_form_cuv()">
                        
                        	<?php
					            $args = array( 'post_type' => 'product', 'posts_per_page' => -1, 'numberposts' => -1, 'stock' => 1, 'orderby' =>'date','order' => 'ASC' );
					            $loop = new WP_Query( $args );
					            $cpt=0;
					            while ( $loop->have_posts() ) : $loop->the_post(); global $product;
					            	$cpt++;
					            endwhile; ?>
					        <?php wp_reset_query(); ?>
                            
                            <input type="hidden" value="<?php echo($cpt); ?>" name="nb_ligne" id="nb_ligne" />                    
                        <table>
                            <thead>
                              <tr>
                                <th>Cuvée</th>
                                <th>Contenant</th>
                                <th class="chiffre">PU TTC</th>
                                <th class="chiffre">Qté</th>
                                <th class="chiffre">Total</th>
                              </tr>
                            </thead>
                            <tbody>
                            
                             <?php
					            $args = array( 'post_type' => 'product', 'posts_per_page' => -1, 'numberposts' => -1, 'stock' => 1, 'orderby' =>'date','order' => 'ASC' );
					            $loop = new WP_Query( $args );
					            $cpt=1;
					            while ( $loop->have_posts() ) : $loop->the_post(); global $product;
					            
					            
					        ?>
		                       <tr class="cuv_num" value="<?php the_ID(); ?>">
		                            <td><?php the_title(); ?></td><td><?php echo $product->get_categories( ', ', '</span>' ); ?><input type="hidden" value="<?php echo($cpt); ?>" id="equivalence_<?php echo($cpt); ?>" name="equivalence_<?php echo($cpt); ?>" /><input type="text" name="nom_<?php echo($cpt); ?>" id="nom_<?php echo($cpt); ?>" value="<?php the_title(); ?>" class="hide" /></td>
									<td class="chiffre"><input type="text" name="prix_<?php echo($cpt); ?>" id="prix_<?php echo($cpt); ?>" class="hide" readonly value="<?php echo $product->get_price(); ?>" /><input type="text" name="prix_aff_<?php echo($cpt); ?>" id="prix_aff_<?php echo($cpt); ?>" readonly value="<?php echo $product->get_price(); ?> €" /></td>
									<td class="chiffre"><input class="quantity" type="text" name="qte_<?php echo($cpt); ?>" id="qte_<?php echo($cpt); ?>" onkeyup="calcul()" onfocusout="calcul()"/></td>
									<td class="chiffre"><input type="text" name="total_<?php echo($cpt); ?>" id="total_<?php echo($cpt); ?>" class="hide" readonly /><input type="text" name="total_aff_<?php echo($cpt); ?>" id="total_aff_<?php echo($cpt); ?>" readonly /></td>
		                       </tr>
		                       
		                      <?php $cpt++; ?>
		                       
		                    <?php endwhile; ?>
					        <?php wp_reset_query(); ?>
      
                        </tbody>
                 </table>
                   
                 		<p class="tot"><strong>Total produits :</strong> <input type="text" name="total" class="hide" id="total" /> <input type="text" readonly name="total_aff" id="total_aff" /></p>
                 		<p class="tot"><strong>Frais de port :</strong> <input type="text" name="total_fdp" class="hide" id="total_fdp" /> <input type="text" readonly name="total_fdp_aff" id="total_fdp_aff" /></p>
						<p class="tot"><strong>Total :</strong> <input type="text" name="total_total" class="hide" id="total_total" /> <input type="text" readonly name="total_total_aff" id="total_total_aff" /></p>       
						
                        <input type="submit" class="bouton" value="Commander" style="float:right;"/>
                        <img id="ajax-loader-form-cuv" src="<?php bloginfo('template_directory'); ?>/images/form_cuv/ajax-loader.gif" style="display:none; width: 20px; height: auto; margin-right: 1em; margin-top: 0.4em; float: right;"/>
</div>
                        
                          
                     </form> 
                   </section>
                </article>
            </div> 
        </div>   
        
         <div class="main-container">
         
         <?php 
			
				$APIkey = '';
				$GoogleMapLat = '';
				$GoogleMapLong = '';
				$GoogleZoom = '';
					
				$args = array( 'post_type' => 'google-map', 'posts_per_page' => 1, 'orderby' => 'date', 'order' => 'ASC' );
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post();
				
					$APIkey = do_shortcode( "[types field='api-key'][/types]" );
					if( $APIkey != '' ) { ?>
						
						<?php $GoogleMapLat = do_shortcode( "[types field='latitude'][/types]" ); ?>
						<?php $GoogleMapLong = do_shortcode( "[types field='longitude'][/types]" ); ?>
						<?php $GoogleZoom = do_shortcode( "[types field='zoom'][/types]" ); ?>
						
					<?php }	?>
				<?php 
					
				endwhile;
			?>
					
				<?php wp_reset_query(); ?>
         
         <div id="map-canvas"></div>
         
         <script>
		      function initMap() {
		        
		        var positionLatLng = {
			        lat: <?php if($GoogleMapLat != '') { echo $GoogleMapLat; } else { echo "48.8534100"; } ?>,
			        lng: <?php if($GoogleMapLong != '') { echo $GoogleMapLong; } else { echo "2.3488000"; } ?>
		        };
		        
		        var map = new google.maps.Map(document.getElementById('map-canvas'), {
		          center: positionLatLng,
		          scrollwheel: false,
		          zoom: <?php if($GoogleMapZoom != '') { echo $GoogleMapZoom; } else { echo "12"; } ?>,
		          styles: [
					    {
					        "featureType": "all",
					        "elementType": "labels.text.fill",
					        "stylers": [
					            {
					                "saturation": 36
					            },
					            {
					                "color": "#ffffff"
					            },
					            {
					                "lightness": 40
					            }
					        ]
					    },
					    {
					        "featureType": "all",
					        "elementType": "labels.text.stroke",
					        "stylers": [
					            {
					                "visibility": "on"
					            },
					            {
					                "color": "#000000"
					            },
					            {
					                "lightness": 16
					            }
					        ]
					    },
					    {
					        "featureType": "all",
					        "elementType": "labels.icon",
					        "stylers": [
					            {
					                "visibility": "off"
					            }
					        ]
					    },
					    {
					        "featureType": "administrative",
					        "elementType": "geometry.fill",
					        "stylers": [
					            {
					                "color": "#000000"
					            },
					            {
					                "lightness": 20
					            },
					            {
					                "gamma": "1.00"
					            }
					        ]
					    },
					    {
					        "featureType": "administrative",
					        "elementType": "geometry.stroke",
					        "stylers": [
					            {
					                "color": "#000000"
					            },
					            {
					                "lightness": 17
					            },
					            {
					                "weight": 1.2
					            }
					        ]
					    },
					    {
					        "featureType": "landscape",
					        "elementType": "geometry",
					        "stylers": [
					            {
					                "color": "#000000"
					            },
					            {
					                "lightness": 20
					            },
					            {
					                "gamma": "0.00"
					            }
					        ]
					    },
					    {
					        "featureType": "poi",
					        "elementType": "geometry",
					        "stylers": [
					            {
					                "color": "#000000"
					            },
					            {
					                "lightness": 21
					            },
					            {
					                "gamma": "0.00"
					            }
					        ]
					    },
					    {
					        "featureType": "road.highway",
					        "elementType": "geometry.fill",
					        "stylers": [
					            {
					                "color": "#b7a56d"
					            },
					            {
					                "lightness": 17
					            },
					            {
					                "gamma": "0.00"
					            }
					        ]
					    },
					    {
					        "featureType": "road.highway",
					        "elementType": "geometry.stroke",
					        "stylers": [
					            {
					                "color": "#b7a56d"
					            },
					            {
					                "lightness": 29
					            },
					            {
					                "weight": "0.01"
					            },
					            {
					                "saturation": "0"
					            },
					            {
					                "gamma": "0.00"
					            }
					        ]
					    },
					    {
					        "featureType": "road.arterial",
					        "elementType": "geometry",
					        "stylers": [
					            {
					                "color": "#b7a56d"
					            },
					            {
					                "lightness": 18
					            }
					        ]
					    },
					    {
					        "featureType": "road.local",
					        "elementType": "geometry",
					        "stylers": [
					            {
					                "color": "#b7a56d"
					            },
					            {
					                "lightness": 16
					            }
					        ]
					    },
					    {
					        "featureType": "transit",
					        "elementType": "geometry",
					        "stylers": [
					            {
					                "color": "#000000"
					            },
					            {
					                "lightness": 19
					            }
					        ]
					    },
					    {
					        "featureType": "water",
					        "elementType": "geometry",
					        "stylers": [
					            {
					                "color": "#000000"
					            },
					            {
					                "lightness": 17
					            },
					            {
					                "gamma": "1.00"
					            }
					        ]
					    }
					]
		        });
		        
		        var marker = new google.maps.Marker({
				    position: positionLatLng,
				    map: map
				});
		      }
		
		    </script>
		    
		    <?php if( $APIkey != '' ) { ?>
		    	<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $APIkey; ?>&callback=initMap"
		    async defer></script>
		    
		    <?php } else { ?>
		    	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
		    <?php } ?>
         
         
            <div class="main wrapper clearfix">
            
            	<style type="text/css">
            	
            		div#wpform-field-hp {
						display: none;
					}
					
					.contact-post {}
					
					.contact-post .wpforms-container input, .contact-post .wpforms-container textarea {
						width: 100%;
						max-width: 100%;
					}
					
					.contact-post .wpforms-container .wpforms-field {
						margin: 1rem auto 2em auto;
					}
					
					.contact-post .wpforms-container .wpforms-field label.wpforms-field-label {
						display: block;
						margin-bottom: 0.5em;
					}
					
					.contact-post .wpforms-container .wpforms-submit-container {
						text-align: right;
					}
					
					.contact-post .wpforms-container .wpforms-submit-container button {
						margin: 1em auto;
					    padding: 1em 2em;
					    background: #b7a56d;
					    border: 0;
					    border-radius: 0.5em;
					    color: #FFF;
					    text-transform: uppercase;
					    font-size: 1em;
					    outline: none;
					}
					
				</style>
				
                <article id="contact">
               
                    	<?php 
					
							$args = array( 'post_type' => 'contact', 'posts_per_page' => 1, 'orderby' => 'date', 'order' => 'ASC' );
							$loop = new WP_Query( $args );
							while ( $loop->have_posts() ) : $loop->the_post(); ?>
							
								<section class="col1 margr contact-post">
									<h2>Formulaire de contact</h2>
									<?php the_content(); ?>
								</section>
								
								<section class="col2" style="float:right;">
									<h2 style="text-align:right;">Coordonnées</h2>
									
									<?php $contactAdresse = do_shortcode( "[types field='adresse'][/types]" ); ?>
									<?php if($contactAdresse != '') { ?>
										<div style="text-align:right;"><?php echo $contactAdresse; ?></div>
									<?php } ?>
									
									<?php $contactMail= do_shortcode( "[types field='adresse-e-mail'][/types]" ); ?>
									<?php if($contactMail != '') { ?>
										<p style="text-align:right;">Mail : <a href="mailto:<?php echo $contactMail; ?>" style="color:#38393a"><?php echo $contactMail; ?></a></p>
									<?php } ?>
									
									<?php $contactTel= do_shortcode( "[types field='telephone'][/types]" ); ?>
									<?php if($contactTel != '') { ?>
										<p style="text-align:right;">Tel : <a href="tel:<?php echo $contactTel; ?>" style="color:#38393a"><?php echo $contactTel; ?></a></p>
									<?php } ?>
								</section>
							
							<?php endwhile; ?>
							<?php wp_reset_query(); ?>
                </article>
            </div> 
        </div> 

<?php get_footer(); ?>
