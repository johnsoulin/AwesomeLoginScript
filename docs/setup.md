### **Installation Steps:** ###

1. Select (or create) any mySQL database that will store all ALS data. Run the SQL command (this can be done in PHPMyAdmin or from a Linux Terminal window) on the database:

    CREATE TABLE als\_table (id INT UNSIGNED NOT NULL AUTO_INCREMENT, PRIMARY KEY (id), username VARCHAR(26), hash VARCHAR(60), altkey VARCHAR(20), email VARCHAR(50))

    Optional step: create a new mySQL user and give it only permissions to the database in step 1.  
2. Open “als_settings.php” and set the following:

 - *$als\_database* - The full database name in step 1.  
 - *$als\_username* - The username to an SQL account with permissions to the database.  
 - *$als\_password* - The password to that account.  

    Configure other options to how you see fit.  
3. Upload all the contents of /src/ to the server and then open als_test.php in your web browser.
If you see “Setup complete!”, everything should be working.

----------


**Required Files (found in /src/):**

- *als\_header*       - displays status messages  
- *als\_login.php*        - code that attempts a login based on content POST-ed by loginForm.php  
- *als\_loginForm.php*    - HTML form for logging in (PHP redirect enabled)  
- *als\_logout.php*       - logs users out (PHP redirect enabled)  
- *als\_regForm.php*      - HTML form for new user registration (PHP redirect enabled)  
- *als\_register.php*     - code that registers a user based on content POST-ed by regForm.php  
- *als\_settings.php*     - stores connection credentials and other commonly accessed functions
- *PasswordHash.php*     - PHPass 0.3

**Extra Files (found in /extras/):**

- *als\_nuke.php* - clears entire username table when opened
- *als\_viewTable.php* - displays contents of username table