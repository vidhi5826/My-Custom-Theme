<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!--         <h1><?php //bloginfo('name'); ?></h1>
        <p><?php //bloginfo('description'); ?></p>
        <nav>
            <?php //wp_nav_menu(array('theme_location' => 'primary')); ?>
        </nav> -->

<header class="site-header">
    <div class="header-container container-wrp">
		<div class="site-header-left">
			<!-- Site Logo -->
			<div class="site-logo">
				<?php 
				$logo = get_field('site_logo', 'option');
				if ($logo) : ?>
				<a href="<?php echo esc_url(home_url('/')); ?>">
					<img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>">
				</a>
				<?php else : ?>
				<a href="<?php echo esc_url(home_url('/')); ?>">
					<h1><?php bloginfo('name'); ?></h1>
				</a>
				<?php endif; ?>
			</div>

			<!-- Navigation Menu -->
			<nav class="main-navigation">
				<?php
				wp_nav_menu(array(
					'theme_location' => 'primary',
					'menu_class' => 'primary-menu',
					'container' => false,
				));
				?>
			</nav>
		</div>
        
		<div class="site-header-right">
			<!-- Header Guarantee Text -->
			<?php 
			$guarantee_text = get_field('header_guarantee_text', 'option');
			if ($guarantee_text) : ?>
			<div class="header-guarantee">
				<p><?php echo esc_html($guarantee_text); ?></p>
			</div>
			<?php endif; ?>

			<!-- Header Button -->
			<?php 
			$header_button = get_field('header_button', 'option');
			if ($header_button) : ?>
			<div class="header-button">
				<a href="<?php echo esc_url($header_button['url']); ?>" class="btn btn-primary" <?php if ($header_button['target']) : ?>target="<?php echo esc_attr($header_button['target']); ?>"<?php endif; ?>>
					<?php echo esc_html($header_button['title']); ?>
				</a>
			</div>
			<?php endif; ?>

			<!-- Mobile Menu Toggle -->
			<button class="mobile-menu-toggle" aria-label="Toggle Menu">
				<span></span>
				<span></span>
				<span></span>
			</button>
		</div>
        
    </div>
    </header>