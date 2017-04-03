<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title></title>
        
        <link href="/sistema/css/smoothness/jquery-ui-1.10.1.custom.css" rel="stylesheet" />
        <link href="/sistema/css/reset.css" rel="stylesheet" />
        <link href="/sistema/css/sistema.css" rel="stylesheet" />
        <link rel="stylesheet" href="martha_sys.css" type="text/css">
		<script src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
        <script src="http://code.jquery.com/jquery-migrate-1.1.1.min.js"></script>
		<script src="/sistema/js/jquery-ui-1.10.1.custom.js"></script>
        
    </head>
    
    <body>
        
        <!-- conteudo begin -->
        <?php 
        if ( isset($template) && !empty($template) && file_exists($_SERVER['DOCUMENT_ROOT'] . '/sistema/html/' . $template . '.php') ) :
            require_once($template . '.php'); 
        endif;
        ?>
        <!-- conteudo end -->
        
	</body>
</html>
