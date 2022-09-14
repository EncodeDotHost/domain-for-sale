<?php
include 'settings.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Domain for Sale || <?php echo $domain; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-icons.css">
        <link rel="stylesheet" href="css/style.css" />
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    </head>
    <body>
        <section class="bg-alt hero p-0">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6 bg-faded text-center col-fixed">
                        <div class="vMiddle">
                          <h1 class="pt-4 h2">
                              <span class="text-green"><?php echo $domain; ?></span>
                              <small>is available for sale</small>
                          </h1>
                          <p class="mt-4">
                              For instantly purchase. Please make an enquiry.
                          </p>
                          <div class="pt-5">
                              <label for="name">
                              <a class="btn text-white bg-green btn-lg">Buy now<?php if( !empty($salePrice)){ echo " for {$currencySymbol}{$salePrice}";} ?></a>
                              </label>
                          </div>
                        <?php if ($publicDetails == 'yes') { ?>
                          <div class="row d-md-flex text-center justify-content-center text-primary action-icons">
                              <div class="col-sm-4">
                                  <p><em class="bi bi-telephone-plus"></em></p>
                                  <p class="lead"><a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a></p>
                              </div>
                              <div class="col-sm-4">
                                  <p><i class="bi bi-chat-left-quote"></i></p>
                                  <p class="lead"><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>
                              </div>
                          </div>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="col-sm-6 offset-sm-6">
                        <section class="bg-alt">
                            <div class="container">
                                <div class="row height-100">
                                    <div class="col-sm-10 offset-sm-1 mt-2">
                                        <form id="main-offer-form" action="contact.php" method="post">
                                            <h2 class="text-primary">Interested in this domain?</h2>
                                            <hr/>
                                            <div class="form-group">
                                                <input
                                                  type="text"
                                                  name="name"
                                                  id="name"
                                                  class="form-control"
                                                  placeholder="Full name (Required)"
                                                >
                                            </div>
                                            <div class="row">
                                              <div class="col">
                                                <div class="form-group">
                                                    <input
                                                      type="email"
                                                      name="email"
                                                      class="form-control"
                                                      placeholder="Email (Required)"
                                                    >
                                                </div>
                                              </div>
                                              <div class="col">
                                                <div class="form-group">
                                                    <input
                                                      type="text"
                                                      name="phone"
                                                      class="form-control"
                                                      placeholder="Phone number (Required)"
                                                    >
                                                </div>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                                <input
                                                  type="number"
                                                  name="price"
                                                  class="form-control"
                                                  min="0"
                                                  placeholder="Offer price? (Required)">
                                            </div>
                                            <div class="form-group">
                                                <textarea name="comments" class="form-control" placeholder="Message (optional)"></textarea>
                                            </div>


                                            <div class="form-group">
                                              <div id="recaptcha" class="g-recaptcha" data-sitekey="<?php echo $recaptchaSiteKey; ?>"></div>
                                            </div>

                                            <button type="submit" class="btn text-white btn-lg bg-primary btn-block" name="send">Make an offer</button>
                                        </form>
                                    </div>
                                </div>
                              <?php if ($includeCredit == 'yes') { ?>
                                <div class="row d-md-flex text-center justify-content-center credit small text-muted">
                                  <p>Built with <a href="https://github.com/EncodeDotHost/domain-for-sale" target="_blank">Domain For Sale Landing Page</a></p>
                                </div>
                              <?php } ?>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.validate.min.js"></script>
        <script>
          $( "#main-offer-form" ).validate({
            errorClass: 'form-control-feedback',
            errorElement: 'div',
            highlight: function(element) {
              $(element).parents(".form-group").addClass("has-danger");
            },
            unhighlight: function(element) {
              $(element).parents(".form-group").removeClass("has-danger");
            },
            rules: {
                name: 'required',
                email: {
                  required: true,
                  email: true
                },
                phone: {
                  required: true,
                  minlength:11,
                  maxlength:11
                },
                price: "required",
                comments: {
                  maxlength: 500
                }
              },
              messages: {
                name: 'Please enter your name.',
                email: {
                  required: 'You can not leave this empty.',
                  email: 'Please enter a valid email address.'
                },
                phone: {
                  required: 'You can not leave this empty.',
                  matches: 'Please enter a valide phone number.',
                  minlength: 'Phone number should be min 10 digits.',
                  maxlength: 'Phone number should be max 10 digits.'
                },
                price: {
                  price: 'Please enter offered price.'
                },
                comments: {
                  maxlength: 'Message length must be less than 500 character.'
                }
              }
          });
        </script>
    </body>
</html>