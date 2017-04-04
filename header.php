<!doctype html>
<html lang="pt-BR">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

    
	<meta name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=1,width=device-width">
	<title><?php wp_title('&laquo;', true, 'right'); bloginfo('name'); ?></title>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('stylesheet_url'); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php if(is_singular() && comments_open() && get_option('thread_comments')){
		wp_enqueue_script('comment-reply');
	}
	wp_head();
	global $redux_options, $themePrefix;
	if(!empty($redux_options[$themePrefix.'favicon_url'])){
		echo '<link href="'.$redux_options[$themePrefix.'favicon_url']['url'].'" rel="shortcut icon" type="image/x-icon" />';
	} ?>
	<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Dosis:500' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
</head>
<body <?php body_class(); ?>>
	<div id="loader-wrapper">
	    <div id="loading">
	        <div id="loading-center">
	            <div id="loading-center-absolute">
	                <div class="object" id="object_four"></div>
	                <div class="object" id="object_three"></div>
	                <div class="object" id="object_two"></div>
	                <div class="object" id="object_one"></div>
	            </div>
	        </div>
	    </div>
	</div>
	<div class="wrapper">
        <div class="inner-wrapper">
        	<header id="header" class="type1">
            	<div class="container">
                    <div class="main-menu-container">
                      <div class="main-menu">
                        <div id="logo">
                          <?php if(!empty($redux_options[$themePrefix.'logo_url'])){
                            echo '<a title="NeoCut" href="'.get_home_url().'"><img title="NeoCut" alt="NeoCut" src="'.$redux_options[$themePrefix.'logo_url']['url'].'"></a>';
                          } ?>
                        </div>
                        <div id="primary-menu">
                           <div class="dt-menu-toggle" id="dt-menu-toggle">Menu<span class="dt-menu-toggle-icon"></span></div>
                               <div class="social">
                                    <ul>
                                    <?php
                                    if(!empty($redux_options[$themePrefix.'facebook_url'])){
                                        echo '<li><a href="'.$redux_options[$themePrefix.'facebook_url'].'" target="_BLANK" title="Facebook"> <i class="fa fa-facebook"></i></a></li>';
                                    }
                                    if(!empty($redux_options[$themePrefix.'instagram_url'])){
                                        echo '<li><a href="'.$redux_options[$themePrefix.'instagram_url'].'" target="_BLANK" title="Instagram"> <i class="fa fa-instagram"></i></a></li>';
                                    }
                                    if(!empty($redux_options[$themePrefix.'twitter_url'])){
                                        echo '<li><a href="'.$redux_options[$themePrefix.'twitter_url'].'" target="_BLANK" title="Twitter"> <i class="fa fa-twitter"></i></a></li>';
                                    } ?>
                                    </ul>
                                </div>
                            <nav id="main-menu"><?php wp_nav_menu(array('name'=>'main', 'menu_class'=>'menu sf-js-enabled', 'container'=>''))?></nav>
                       	</div>
                      </div>
                    </div>             
            	</div>
            </header>