<?php
include 'settings.php';

	if (isset($_POST['send'])) {

		// EDIT THE 2 LINES BELOW AS REQUIRED
		$email_to = $email;
		$email_subject = "New offer for {$domain}";


		$name = $_POST['name']; // required
		$email_from = $_POST['email']; // required
		$telephone = $_POST['phone']; // not required
		$price = $_POST['price']; // not required
		$comments = $_POST['comments']; // required

    // Form validation
    if(!empty($name) && !empty($email_from) && !empty($price) && !empty($comments)){
      // reCAPTCHA validation
      if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {

        // reCAPTCHA response verification
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$recaptchaSecretKey.'&response='.$_POST['g-recaptcha-response']);

        // Decode JSON data
        $response = json_decode($verifyResponse);
        if($response->success){

            $email_message = "Form details below.\n\n";

            function clean_string($string) {
                $bad = array("content-type", "bcc:", "to:", "cc:", "href");
                return str_replace($bad, "", $string);
            }

            $email_message .= "Name: " . clean_string($name) . "\n";
            $email_message .= "Email: " . clean_string($email_from) . "\n";
            $email_message .= "Telephone: " . clean_string($telephone) . "\n";
            $email_message .= "Price($): " . clean_string($price) . "\n";
            $email_message .= "Comments: " . clean_string($comments) . "\n";

            // create email headers
            $headers = 'From: ' . $email_from . "\r\n" .
                    'Reply-To: ' . $email_from . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
            @mail($email_to, $email_subject, $email_message, $headers);

            echo "Email sent";
          } else {
            $response = array(
                "status" => "alert-danger",
                "message" => "reCaptcha Robot verification failed, please try again."
            );
        } else{ 
          $response = array(
              "status" => "alert-danger",
              "message" => "Plese check on the reCAPTCHA box."
          );
      } 
    }  else{ 
        $response = array(
            "status" => "alert-danger",
            "message" => "All the fields are required."
        );
    }
  }  
}
?>
<!DOCTYPE html>
<html lang="en">
		<head>
				<meta charset="utf-8">
				<title>Sales Inquery || [Your Domain]</title>
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-icons.css">
        <link rel="stylesheet" href="css/style.css" />
		</head>
		<body>
			<section class="bg-alt hero p-0">
				<div class="container-fluid">
					<div class="row">
							<div class="bg-faded col-sm-6 text-center col-fixed">
									<div class="vMiddle">
										<h1 class="pt-4 h2">
                    <?php if(!empty($response)) {?>
                      <div class="form-group col-12 text-center">
                        <div class="alert text-center <?php echo $response['status']; ?>">
                          <?php echo $response['message']; ?>
                        </div>
                      </div>
                      <?php }?>
											<span>Thank you for offer. We will be in contact as soon as possible.</span>
										</h1>
										<div class="row d-md-flex text-center justify-content-center text-primary action-icons">
											<div class="col-sm-4">
												<p><em class="ion-ios-telephone-outline icon-md"></em></p>
												<p class="lead"><a href="tel:+[Your Phone]">+[Your Phone]</a></p>
											</div>
											<div class="col-sm-4">
												<p><em class="ion-ios-chatbubble-outline icon-md"></em></p>
												<p class="lead"><a href="mailto:hello@example.com">email@[Your Domain].com</a></p>
											</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6 offset-sm-6 px-0">
									<section class="bg-alt">
											<div class="row height-100">
													<div class="col-sm-8 offset-sm-2 mt-2">
														<h1 class="pt-4 h2"><span class="text-green">Saroj K. Poddar</span></h1>
														<span class="text-muted">Kathmandu, Nepal</span>
														<p><span>Web Strategist, Front-end Developer & UX/ UI Designer</span></p>
														<br/>
														<a target="_blank" rel="nofollow" href="https://sarozpoddar.com.np">sarozpoddar.com.np</a>
													</div>
											</div>
									</section>
							</div>
					</div>
				</div>
			</section>
		</body>
</html>
<?php } ?>
