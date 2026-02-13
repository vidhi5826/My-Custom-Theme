<?php
function mytheme_setup() {
    // Add Classic Editor support
    add_theme_support('editor-styles');
    
    // Enable featured images
    add_theme_support('post-thumbnails');
    
    // Register navigation menu
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'mytheme'),
    ));
    
    // Add title tag support
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'mytheme_setup');

// Enqueue styles and scripts
function mytheme_scripts() {
    wp_enqueue_style('mytheme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'mytheme_scripts');

// Disable Gutenberg (Block Editor)
add_filter('use_block_editor_for_post', '__return_false');

// Add Classic Editor styling support
add_theme_support('editor-styles');
add_editor_style('editor-style.css');

// Enable SVG support
function mytheme_enable_svg_upload($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'mytheme_enable_svg_upload');

// Fix MIME type check
function mytheme_fix_svg_mime_type($data, $file, $filename, $mimes) {
    $ext = isset($data['ext']) ? $data['ext'] : '';
    
    if (strlen($ext) < 1) {
        $exploded = explode('.', $filename);
        $ext = strtolower(end($exploded));
    }
    
    if ($ext === 'svg') {
        $data['type'] = 'image/svg+xml';
        $data['ext'] = 'svg';
    } elseif ($ext === 'svgz') {
        $data['type'] = 'image/svg+xml';
        $data['ext'] = 'svgz';
    }
    
    return $data;
}
add_filter('wp_check_filetype_and_ext', 'mytheme_fix_svg_mime_type', 10, 4);

// Display SVG in media library
function mytheme_fix_svg_display_media_library($response, $attachment, $meta) {
    if ($response['type'] === 'image' && $response['subtype'] === 'svg+xml') {
        $response['image'] = array(
            'src' => $response['url'],
        );
    }
    return $response;
}
add_filter('wp_prepare_attachment_for_js', 'mytheme_fix_svg_display_media_library', 10, 3);


add_action( 'wp_enqueue_scripts', 'self_custom_enqueue' );
function self_custom_enqueue() {
    wp_enqueue_style('custom-css', get_template_directory_uri() . '/assets/css/custom.css', array(), filemtime(get_template_directory() . '/assets/css/custom.css'), false);
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), filemtime(get_template_directory() . '/assets/js/custom.js'), false);
}

add_filter( 'wp_check_filetype_and_ext', function ( $data, $file, $filename, $mimes ) {

    $filetype = wp_check_filetype( $filename, $mimes );

    return [
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename'],
    ];

}, 10, 4 );

add_filter( 'wp_kses_allowed_html', function ( $tags, $context ) {

    if ( $context === 'post' ) {

        $tags['svg'] = [
            'class'       => true,
            'aria-hidden' => true,
            'role'        => true,
            'xmlns'       => true,
            'width'       => true,
            'height'      => true,
            'viewbox'     => true,
            'fill'        => true,
        ];

        $tags['path'] = [
            'd'    => true,
            'fill' => true,
        ];

        $tags['g'] = [
            'fill' => true,
        ];
    }

    return $tags;
}, 10, 2 );


add_action('wp_footer', function () {
    ?>
    <div class="custom-video-lightbox" style="display:none;">
        <div class="custom-video-inner">
            <span class="video-close">&times;</span>
            <video controls playsinline></video>
        </div>
    </div>
    <?php
});