<?php
    $testimonials = new WP_Query(
        array(
            'post_type' => 'ht-testimonials',
            'posts_per_page' => $number,
            'post_status' => 'publish'
        )
    );
    
    if ( $testimonials->have_posts() ):
        while ( $testimonials->have_posts() ):
            $testimonials->the_post();

            $url_meta = get_post_meta( get_the_ID(), 'ht_testimonials_user_url', true );
            $occupation_meta = get_post_meta( get_the_ID(), 'ht_testimonials_occupation', true );
            $company_meta = get_post_meta( get_the_ID(), 'ht_testimonials_company', true );
?>

            <div class="testimonial-item">
                <div class="title">
                    <h3><?php the_title(); ?></h3>
                </div>
                <div class="content">
                    <?php if ( $image ): ?>
                    <div class="thumb">
                        <?php 
                            if ( has_post_thumbnail() ):
                                the_post_thumbnail( array ( 70, 70 ) );
                            endif; 
                        ?> 
                    </div>
                    <?php endif; ?>
                    <?php the_content(); ?>
                </div>
                <div class="meta">
                    <?php if ( $occupation_meta ): ?>
                        <span class="occupation"><?php echo esc_html_e( $occupation_meta ); ?></span>
                    <?php endif; ?>
                    <?php if ( $company_meta ): ?>
                        <span class="company"><a href="<?php echo esc_attr( $url_meta ) ?>"><?php echo esc_html_e( $company_meta ); ?></a></span>
                    <?php endif; ?>
                </div>
            </div>

<?php 
        endwhile; 
    wp_reset_postdata(); 
    endif; 
?>
<a href="<?php echo get_post_type_archive_link( 'ht-testimonials' ); ?>"><?php echo esc_html_e( 'Show More Testimonials', 'ht-testimonials' ); ?></a>