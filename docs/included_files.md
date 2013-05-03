#### als\_header.php ####

Header checks for session variables $\_SESSION['als\_error'] and $\_SESSION['als\_regUser']. Use header to show users various messages, including successes and errors. Header is not required by default.

#### als\_loginForm.php ####

LoginForm is an HTML form that prompts the user for their username and password, and then posts the information to als\_login.php as $\_POST[‘als\_loginUser’] and $\_POST[‘als\_loginPass’]. LoginForm also contains code to redirect the user back to the page they were on (i.e. the page that loginForm is included into) after running als\_login.php.

#### als\_login.php ####

Login accesses a MySQL database (via mysqli commands) to check if posted login information from loginForm matches a user account in the users table. Login uses PHPass to check if the hashed password in the table matches the provided password. If it does, session variable $\_SESSION[‘als\_loggedInAs’] is set to the username; if the password does not match, the username doesn’t exist, or either field is blank, session variable $\_SESSION[‘als\_error’] is set to an appropriate error and the login is not authorized. Login also contains code to redirect back to the page the user was on before als\_login.php was accessed.

#### als\_logout.php ####

Logout destroys the session, thus logging out the user and any relevant session-stored user information. It then redirects to a specified URL chosen in als\_settings.php.

#### als\_regForm.php ####

RegForm is an HTML form that prompts the user for their desired username, password, and a valid email address. It posts this information to als\_register.php as $\_POST[‘als\_regUser’], $\_POST[‘als\_regPass’], and $\_POST[‘als\_regEmail’]. RegForm also contains code to save the current URL for use in redirecting back to the same page after als\_register.php runs.

#### als\_register.php ####

Register takes information posted from regForm and uses it to create a new user in the MySQL users table (via mysqli commands). It uses PHPass to hash the desired password before it inserts it into the table. Register cleans the username and password inputs uses trim() and mysqli\_real\_escape\_string() before inserting them into the table. Register also checks to see if the posted email address is a valid email address. If the username already exists, the email is invalid, the username or password contains special characters, or any of the fields are blank, register sets $\_SESSION[‘als\_error’] to the appropriate error. Register also contains code to redirect the user back to the page they were on before accessing als\_register.php.


----------


#### als\_nuke.php ####

Nuke deletes all data in the users table. It can be helpful for debugging purposes, but it is not recommended to keep it uploaded to the server. Nuke is irreversible. 

#### als\_viewTable.php ####

ViewTable displays the information in the users table in a browser-compatible way. It is recommended that this be used primarily for debugging purposes, as it is sometimes more convenient than alternative methods of viewing the table, and not be uploaded to the server for extended periods of time.