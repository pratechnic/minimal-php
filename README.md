# A Minimal PHP framework

Complete with modules for
- Database Handling
- User Session Activity
- Security
    - Hashing & Salting
    - CSRF protection
    - User Input sanitization
- Session & Cookie perpetration
- Input handling
- Redirection

### Initial Setup :

- Create a MySQL database.
- Update your database condiguration in the $GLOBALS['config']['mysql'] variable :

```sh
    'mysql' =>  array(  'host' => '127.0.0.1', //DB host
                        'user'=>'root', // DB Username
                        'pass'=>'', //DB Password
                        'db'=>'test' //Change this variable to the name of the created database
                      ),
```

A basic user flow is included with this demo, import the user_login.sql file to the database created above navigate to localhost/minimal-php/index.php and login using the credentials :

- Username : test@test.com
- Password : 123

You can also register from the index page and use that to login.
