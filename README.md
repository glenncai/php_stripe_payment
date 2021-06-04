## Quick Start
```
# Install dependencies
composer install

# Import stripe.sql into your DB

# Add your DB params in config/db.php

# Add your stripe pk and sk keys into config/db.php

# Visit server location
```

## For personal development

Install the libraty:
```
$ composer require stripe/stripe-php

$ composer require phpmailer/phpmailer
```

## Fix bug
For `Message could not be sent. Mailer Error: SMTP Error: Could not authenticate.` PHPMailer error.

Solution: Go to [Google myacount](myaccount.google.com) -> "Sign-in & security" -> "Apps with account access", and turn "Allow less secure apps" to "ON".


### Note: 

* For the path, please always remember to use `_DIR_` for best practice.
* If something wrong, feel free to check the `log` in stripe offcial website. You can find the syntax errors what you write for stripe payment details.
* The login and register system is not secure. It just for the payment method testing. (People cannot buy when they are not login).
* Edit your website domain in `checkout-action.php` file by changing `$YOUR_DOMAIN` variable. 
* Add your stripe public key and secret key in `db.php` file. 
* If you want to open login pattern, edit the variable `$setEmail` in `db.php` file to be true.
* For the sender email and password in PHPMailer system, edit your own username and password in `db.php` file.
