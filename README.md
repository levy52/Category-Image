# Image to category WP Plugin

WordPress plugin that adds the ability to add photos to categories.

## Description

The Category Image plugin allows you to associate images with WordPress categories, enabling you to display images alongside category names or descriptions.

## Installation

1. Download the plugin files and upload them to your WordPress plugins directory (`/wp-content/plugins/`).
2. Activate the "Category Image" plugin through the "Plugins" page in WordPress.

## Usage

Once the plugin is activated, you can add images to categories in two ways:

### Adding an Image to a New Category

1. When creating a new category, you'll find a new section labeled "Category Image" with an "Add Image" button.
2. Click on the "Add Image" button to open the WordPress media uploader.
3. Select or upload an image from your media library and click the "Choose Image" button.
4. The selected image will be displayed in the "Category Image" section.
5. Save the new category, and the image will be associated with it.

### Adding an Image to an Existing Category

1. Go to the WordPress dashboard and navigate to "Posts" > "Categories."
2. Hover over the category you want to add an image to and click the "Edit" link.
3. In the category edit screen, you'll find a section labeled "Category Image" with an "Add Image" button and a "Remove Image" button.
4. Click on the "Add Image" button to open the WordPress media uploader.
5. Select or upload an image from your media library and click the "Choose Image" button.
6. The selected image will be displayed in the "Category Image" section.
7. Click the "Update" button to save the changes, and the image will be associated with the category.

To display the category image on your website, you can use the `display_category_image` function in your theme or plugin.

## Example

```php
<?php
$category = get_category( $category_id );
$image_url = get_term_meta( $category->term_id, 'category_image', true );
if ( $image_url ) {
    echo '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( $category->name ) . '" />';
}
?>
```

## Requirements

- WordPress 4.0 or higher.

## Author

This plugin was developed by Radosław Lewicki. You can find the author's GitHub profile [here](https://github.com/levy52).

## License

This plugin is licensed under the GPLv2 or later license.

For more information, visit the [GitHub repository](https://github.com/levy52).
