<?php
/* Template Name: Homepage */
get_header();
?>
<main id="main-content" class="home-page-main" role="main">
	<section class="home-banner-section">
		<?php if( have_rows('banner_sec') ): ?>
    <?php while( have_rows('banner_sec') ): the_row(); 

        $ban_title      = get_sub_field('banner_title');
        $ban_icon_text  = get_sub_field('banner_icon_text');
        $ban_btn        = get_sub_field('banner_button');
        $ban_guar_text  = get_sub_field('banner_guarantee_text');
        $ban_img_id     = get_sub_field('banner_video_image'); // Image ID
        $ban_vid        = get_sub_field('banner_video');

        $ban_btn_url    = $ban_btn['url'] ?? '';
        $ban_btn_title  = $ban_btn['title'] ?? '';

        // Get image URL + alt from ID
        $ban_img_url = $ban_img_id ? wp_get_attachment_image_url($ban_img_id, 'full') : '';
        $ban_img_alt = $ban_img_id ? get_post_meta($ban_img_id, '_wp_attachment_image_alt', true) : '';

        // Extract video URL if shortcode
        if ( has_shortcode($ban_vid, 'video') ) {
            preg_match('/src="([^"]+)"/', $ban_vid, $matches);
            $ban_vid = $matches[1] ?? '';
        }

    ?>

    <div class="container-wrp home-banner-content-wrp">

        <div class="banner-content-left-wrp">
            
            <div class="banner-content-left-top">
                <?php if( $ban_title ): ?>
                    <h1 class="banner-content-title">
                        <?php echo wp_kses_post($ban_title); ?>
                    </h1>
                <?php endif; ?>

                <?php if( $ban_icon_text ): ?>
                    <div class="banner-content-icon-text">
                        <?php echo wp_kses_post($ban_icon_text); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="banner-content-left-bottom">
                <?php if( $ban_btn_url ): ?>
                    <a class="button" href="<?php echo esc_url($ban_btn_url); ?>">
                        <?php echo esc_html($ban_btn_title); ?>
                    </a>
                <?php endif; ?>

                <?php if( $ban_guar_text ): ?>
                    <div class="banner-content-guarantee-text">
                        <?php echo wp_kses_post($ban_guar_text); ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>

        <div class="banner-image-right-wrp">
            <div class="banner-image-wrapper">
                <?php if( $ban_img_id ): ?>
                    <img 
                        decoding="async"
                        src="<?php echo esc_url($ban_img_url); ?>" 
                        alt="<?php echo esc_attr($ban_img_alt); ?>"
                        class="video-lightbox-trigger"
                        data-video="<?php echo esc_url($ban_vid); ?>"
                    >
                <?php endif; ?>
            </div>
        </div>

    </div>

    <?php endwhile; ?>
<?php endif; ?>


	</section>

	<section class="home-content-section">

	</section>
</main>

<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<?php get_footer(); ?>
