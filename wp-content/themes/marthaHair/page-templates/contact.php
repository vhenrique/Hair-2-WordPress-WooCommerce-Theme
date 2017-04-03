<?php 
/*
* Template name: Contact
*/
get_header(); ?>

 <section class="fullwidth-background">
    <div class="breadcrumb-wrapper">
        <div class="container">
           	<?php get_breadcrumbs();
           	if(!empty($redux_options[$themePrefix.'ac_phrase_hair'])){
           		echo '<h5 class="breadcrumb-title">'.get_the_title().'</h5>';
           	} ?>
        </div>
    </div>
</section>
    <div class="container">
	   	<div class="hr-invisible"></div>
			<section id="primary" class="content-full-width">
				<div class="container">
				    <form class="contact-form" method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
				        <div class="column dt-sc-one-half first animate" data-delay="100" data-animation="animated fadeIn">
				            <p><input type="text" name="contactName" placeholder="Seu nome " required/> </p>
				            <p><input type="email" name="contactEmail" placeholder="Email " required/></p>
				        </div>
				        <div class="column dt-sc-one-half animate" data-delay="300" data-animation="animated fadeIn">
				            <p><input type="text" required maxlength="11" name="contactCell" placeholder="Celular "/></p>
				            <p><input type="text" required name="contactSubject" placeholder="Assunto"/></p>
				        </div>
				        <div class="column dt-sc-one-column animate" data-delay="500" data-animation="animated fadeIn">
				            <p><textarea class="message" required rows="10" placeholder="Mensagem" cols="5" name="contactMessage"></textarea></p>
				        </div>
				        <?php if(!empty($_POST)){
				        	$message = $_POST['contactName']." - ".$_POST['contactEmail']." - ".$_POST['contactCell'] ." \r\n Enviou uma mensagem através do formulário de contato do site. \r\n ". $_POST['contactMessage'];
							wp_mail($redux_options[$themePrefix.'cs_email'], $_POST['contactSubject'], $message);
							echo '<script>alert("Sua mensagem foi enviada.")</script>';
				       	} ?>

				        <ul class="phone">
				            <li><i class="fa fa-mobile-phone"></i><?php echo $redux_options[$themePrefix.'cs_telephone']; ?></li>
				            <li><i class="fa fa-envelope-o"></i><a href="mailto:yourname@somemail.com"><?php echo $redux_options[$themePrefix.'cs_email']; ?></a></li>
				        </ul>
				        <div class="form-row aligncenter">
				            <input type="submit" value="Enviar" name="submit">
				        </div>
				    </form> 
				    <div id="ajax_contactform_msg"> </div> 
				</div>
			</section>
		</div>
	</diV>
<?php get_footer(); ?>