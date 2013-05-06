## Usage ##

* Include (embed) als\_regForm.php where you want a registration form to appear on your website. Users will be shown fields for "Username", "Password", "Confirm Password", and "Email". 
* Include (embed) als\_loginForm.php where you want a login form to appear on your website. Users will be shown fields for "Username" and "Password". 
* Send users to als\_logout.php when you want them to be logged out.
* Always leave als\_settings.php and PasswordHash uploaded and included in other files, as they often reference them for MySQL names, optional settings, and encrypting the passwords.
* Use the extras als\_nuke.php and als\_viewTable to clear and view the table respectively, but do not keep them uploaded to the server when not in use.