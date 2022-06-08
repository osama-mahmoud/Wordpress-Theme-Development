<?php $nameError = ""; $emailError = "";  $commentError = "";
if(isset($_POST['submitted'])) {
	if(trim($_POST['contactName']) === '') {
		$nameError = 'Please enter your name.';
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}

	if(trim($_POST['email']) === '')  {
		$emailError = 'Please enter your email address.';
		$hasError = true;
	} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
		$emailError = 'You entered an invalid email address.';
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	if(trim($_POST['comments']) === '') {
		$commentError = 'Please enter a message.';
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comments']));
		} else {
			$comments = trim($_POST['comments']);
		}
	}

	if(!isset($hasError)) {
		$emailTo = get_option('tz_email');
		if (!isset($emailTo) || ($emailTo == '') ){
			$emailTo = get_option('admin_email');
		}
		$subject = '[PHP Snippets] From '.$name;
		$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
		$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		wp_mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}

} ?>
<?php get_header(); ?>






	<section id="contact-page" class="pt-90 pb-120 gray-bg">
      <div class="container">
        <div class="row">
          <div class="col-lg-7 updatesubmit">
           <div class="contact-from mt-30">
              <div class="section-title">
                <h5>Contact Us</h5>
                <h2>Keep in touch</h2>
              </div>
              <!-- section title -->
            <div class="main-form pt-45">
			  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
				<h1 class="entry-title"><?php the_title(); ?></h1>
					<!-- <div class="entry-content"> -->
						<?php if(isset($emailSent) && $emailSent == true) { ?>
							
								<p>Thanks, your email was sent successfully.</p>
							
						<?php } else { ?>
							<?php the_content(); ?>
							<?php if(isset($hasError) || isset($captchaError)) { ?>
								<p class="error">Sorry, an error occured.<p>
							<?php } ?>
			  <form action="<?php the_permalink(); ?>" id="contactForm" method="post">

		 	 <div class="row">
                    <div class="col-md-6">
                      <div class="singel-form form-group">
								<label for="contactName">Name:</label>
								<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="required requiredField" />
								<?php if($nameError != '') { ?>
									<span class="error"><?=$nameError;?></span>
								<?php } ?>

								</div>
                      <!-- singel form -->
                    </div>
					<div class="col-md-6">
                      <div class="singel-form form-group">
								<label for="email">Email</label>
								<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required requiredField email" />
								<?php if($emailError != '') { ?>
									<span class="error"><?=$emailError;?></span>
								<?php } ?>
								</div>
                      <!-- singel form -->
                    </div>
					<div class="col-md-12">
                      <div class="singel-form form-group">
						        <label for="commentsText">Message:</label>
								<textarea name="comments" id="commentsText" rows="20" cols="30" class="required requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
								<?php if($commentError != '') { ?>
									<span class="error"><?=$commentError;?></span>
								<?php } ?>
							
								</div>
                      <!-- singel form -->
                    </div>
					<div class="col-md-12">
                      <div class="singel-form">
					  <input type="submit" class="main-btn updatestyle"></input>
                      </div>
                      <!-- singel form -->
                    </div>
						<input type="hidden" name="submitted" id="submitted" value="true" />
					</form>
				<?php } ?>              
			 </div>
              <!-- main form -->
            </div>
            <!--  contact from --><?php endwhile; endif; ?>
            </div>
		   </div>


		        <div class="col-lg-5">
                    <div class="contact-address mt-30">
                        <ul>
                            <li>
                                <div class="singel-address">
                                    <div class="icon">
                                        <i class="fa fa-envelope-o"></i>
                                    </div>
                                    <div class="cont">
                                        <!-- Get all administrator emails-->
                                        <?php
                            $blogAdminUsers = get_users( 'role=Administrator' );
                            foreach ( $blogAdminUsers as $user ) 
                            {
                            echo  " <p>  $user->user_email    </p>";
                            }
                                         ?>
                                    </div>
                                </div> <!-- singel address -->
                            </li>
                        </ul>
                    </div> <!-- contact address -->
                </div>




		
		</div>
        <!-- row -->
      </div>
      <!-- container -->
    </section>











<?php get_footer(); ?>