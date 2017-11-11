# web-clicker
### CS 346 Team 2 Project

### A few words on constants
You need to change the constant defined as SITE_ROOT to be appropriate for your web server. This constant is used for all files' imports to avoid the complications of relative paths and execution contexts (which can lead to undefined or unpredictable behavior).

Because of this, in order to access the database's API, you also need to have a separate require_once call to the constants.php file (*before* accessing any database features or models). This is also done to avoid the issue mentioned above.
