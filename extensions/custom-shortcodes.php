<?php

/* Fancybox Iframe. Usage: [iframe url="" label=""] */
	function fancybox_iframe($atts){
		extract(shortcode_atts(array(
			'url'	=> '',
			'label'	=> '',
		), $atts));
		return '<a class="fancybox-iframe" href="'.$url.'">'.$label.'</a>';
	}
	add_shortcode("iframe","fancybox_iframe");


/* Google maps. Usage: [map endereco="" largura="" altura="" ] */
	function google_maps($atts){
		extract(shortcode_atts(array(
			'endereco'	=> '',
			'largura'	=> '500',
			'altura'	=> '200'
		), $atts));
		return '<iframe class="gmaps-iframe" width="'.$largura.'" height="'.$altura.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;q='.$endereco.'&amp;output=embed&amp;iwloc="></iframe>';
	}
	add_shortcode("map","google_maps");


/* Youtube iframe. Usage: [video link="" largura="" altura="" ] */
	function youtube_iframe($atts){
		extract(shortcode_atts(array(
			'link'		=> '',
			'largura'	=> '680',
			'altura'	=> '360',
		), $atts));
		return '<iframe class="yt-video" width="'.$largura.'" height="'.$altura.'" src="http://www.youtube.com/embed/'.youtube_code($link).'" frameborder="0" allowfullscreen></iframe>';
	}
	add_shortcode("video","youtube_iframe");
	
?>