An object-oriented PHP project.

This project uses Bootstrap files for page layout so you can easily change and add features on the web pages.

Use of password hash.
Use of a token to avoid cross-site request forgery.
Use of a cookie for the remember-me function.

Current user in the database:

username: admin
password: adminpassword


Installation instructions.

Create a mySQL database with name: login_registration.
Import the SQL tables with the sql file (location: the sql folder).

Add your database details: init.php file in the folder "core". 


Specifying kind of user:

Add these details to an user in the users table:
1 = standard user
2 = administrator