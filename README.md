# A Minimal PHP framework

Complete with modules for
- Database Handling
- User
- Security
    - Hashing & Salting
    - CSRF protection
    - User Input sanitization
- Session & Cookie perpetration
- Input handling
- Redirection

### Initial Setup :

Create a database and provide the name of the database created to the $GLOBALS['config'] array in init.php file : line 8 as the value for the 'db' key.

A basic user flow is included with this demo, import the user_login.sql file to the database created above navigate to localhost/minimal-php/index.php and login using the credentials :

- Username : test@test.com
- Password : 123

You can also register from the index page and use that to login.
