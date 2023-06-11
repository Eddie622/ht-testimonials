<?php 
    $occupation = get_post_meta( $post->ID, 'ht_testimonials_occupation', true );
    $company = get_post_meta( $post->ID, 'ht_testimonials_company', true );
    $user_url = get_post_meta( $post->ID, 'ht_testimonials_user_url', true );
?>

<table class="form-table ht-testimonials-metabox">
    <input type="hidden" name="ht_testimonials_nonce" value="<?php echo wp_create_nonce( "ht_testimonials_nonce" ); ?>">
    <tr>
        <th>
            <label for="ht_testimonials_occupation"><?php esc_html_e( 'User occupation', 'ht-testimonials' ); ?></label>
        </th>
        <td>
            <input 
                type="text" 
                name="ht_testimonials_occupation" 
                id="ht_testimonials_occupation" 
                class="regular-text occupation"
                value="<?php echo ( isset ( $occupation ) ) ? esc_html( $occupation ) : '' ?>"
            >
        </td>
    </tr>
    <tr>
        <th>
            <label for="ht_testimonials_company"><?php esc_html_e( 'User company', 'ht-testimonials' ); ?></label>
        </th>
        <td>
            <input 
                type="text" 
                name="ht_testimonials_company" 
                id="ht_testimonials_company" 
                class="regular-text company"
                value="<?php echo ( isset ( $company ) ) ? esc_html( $company ) : '' ?>"
            >
        </td>
    </tr>
    <tr>
        <th>
            <label for="ht_testimonials_user_url"><?php esc_html_e( 'User URL', 'ht-testimonials' ); ?></label>
        </th>
        <td>
            <input 
                type="url" 
                name="ht_testimonials_user_url" 
                id="ht_testimonials_user_url" 
                class="regular-text user-url"
                value="<?php echo ( isset ( $user_url ) ) ? esc_url( $user_url ) : '' ?>"
            >
        </td>
    </tr> 
</table>