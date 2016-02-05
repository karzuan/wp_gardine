<!DOCTYPE html>
<html>
<head lang="ru">
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
       <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
        <?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-touch-icon.png">
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
	<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
	<![endif]-->
    <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">
    <?php wp_head(); ?>
    <title><?php wp_title(''); ?></title>
</head>
<body>
    
       	<header class="cd-main-header">
    		<a class="cd-logo" href="/"><img src="<?php echo get_template_directory_uri(); ?>/library/images/logo.png" alt="Gardine Gallery"></a>
    
    		<ul class="cd-header-buttons">
    			<li><a class="cd-search-trigger" href="#cd-search">Поиск<span></span></a></li>
    			<li><a class="cd-nav-trigger" href="#cd-primary-nav">Меню<span></span></a></li>
    		</ul> <!-- cd-header-buttons -->
    	</header>