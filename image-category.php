<?php
/**
 * Plugin Name: Category Image
 * Description: Adds the ability to add photos to categories.
 * Version: 1.0
 * Author: Radosław Lewicki
 * Author URI: https://github.com/levy52
 * License: GPLv2 or later
 */

function add_category_image_fields() {
    wp_enqueue_media();
    ?>
    <div class="form-field">
        <label for="category-image"><?php _e( 'Category Image', 'category-image' ); ?></label>
        <input type="button" class="button category-image-upload" value="<?php _e( 'Add Image', 'category-image' ); ?>" />
        <input type="hidden" id="category-image" name="category_image" value="" />
        <div id="category-image-preview"></div>
    </div>
    <?php
}
add_action( 'category_add_form_fields', 'add_category_image_fields', 10, 2 );

function save_category_image_fields( $term_id ) {
    if ( isset( $_POST['category_image'] ) ) {
        update_term_meta( $term_id, 'category_image', $_POST['category_image'] );
    }
}
add_action( 'created_category', 'save_category_image_fields', 10, 2 );
add_action( 'edited_category', 'save_category_image_fields', 10, 2 );

function edit_category_image_fields( $term ) {
    wp_enqueue_media();
    $category_image = get_term_meta( $term->term_id, 'category_image', true );
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="category-image"><?php _e( 'Category Image', 'category-image' ); ?></label></th>
        <td>
            <input type="button" class="button category-image-upload" value="<?php _e( 'Add Image', 'category-image' ); ?>" />
            <input type="button" class="button category-image-remove" value="<?php _e( 'Remove Image', 'category-image' ); ?>" />
            <input type="hidden" id="category-image" name="category_image" value="<?php echo esc_attr( $category_image ); ?>" />
            <div id="category-image-preview">
                <?php if ( $category_image ) : ?>
                    <img src="<?php echo esc_url( $category_image ); ?>" alt="<?php _e( 'Image Preview', 'category-image' ); ?>" />
                <?php endif; ?>
            </div>
        </td>
    </tr>
    <?php
}
add_action( 'category_edit_form_fields', 'edit_category_image_fields', 10, 2 );

function add_category_image_scripts() {
    ?>
    <script>
        jQuery(document).ready(function($) {
            $('.category-image-upload').click(function(e) {
                e.preventDefault();
                var image = wp.media({ multiple: false }).open().on('select', function(e) {
                    var uploaded_image = image.state().get('selection').first();
                    var image_url = uploaded_image.toJSON().url;
                    $('#category-image').val(image_url);
                    $('#category-image-preview').html('<img src="' + image_url + '" alt="<?php _e( 'Image Preview', 'category-image' ); ?>" />');
                });
            });

            $('.category-image-remove').click(function(e) {
                e.preventDefault();
                $('#category-image').val('');
                $('#category-image-preview').html('');
            });
        });
    </script>
    <?php
}
add_action( 'admin_footer', 'add_category_image_scripts' );

function display_category_image( $term ) {
    $category_image = get_term_meta( $term->term_id, 'category_image', true );
    if ( $category_image ) {
        echo '<img src="' . esc_url( $category_image ) . '" alt="' . esc_attr( $term->name ) . '" />';
    }
}
add_action( 'category_archive_meta', 'display_category_image', 10, 2 );