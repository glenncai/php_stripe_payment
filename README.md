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

Solution: Go to [Google myacount](https://myaccount.google.com/) -> "Sign-in & security" -> "Apps with account access", and turn "Allow less secure apps" to "ON".


### Note: 

* For the path, please always remember to use `_DIR_` for best practice.
* If something wrong, feel free to check the `log` in stripe offcial website. You can find the syntax errors what you write for stripe payment details.

