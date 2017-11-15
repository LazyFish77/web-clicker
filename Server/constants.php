<?php
define("SITE_ROOT", "/var/www/students/lewisc24/web-clicker"); // Change this depending on your host

// Database constants
define("DB_DSN", "mysql:dbname=team2;host=localhost");
define("DB_USER", "team2");
define("DB_PW", "watycoco");

// Question constants
define("ACTIVE", 1); // Arbitrary number chosen to indicate a question's status is active
define("INACTIVE", 2); // Likewise for inactive question statuses
define("MULTI_CHOICE", 1); // Arbitrary number chosen to indicate a question's type is
                           // multiple choice
define("SHORT_ANSWER", 2); // Likewise for short answer questions

// User constants
define("STUDENT", 1); // Arbitrary number chosen to indicate a user's type is student
define("INSTRUCTOR", 2); // Likewise for instructors

// Miscellaneous constants
define("HASH_ALGORITHM", "sha256"); // A parameter for PHP's built-in hash() function
define("ANSWER_MARKER", "%%%"); // This is a string we will include in our PHP grader
                                // code to be replaced by a given answer it is supposed
                                // to evaluate.
define("TIMEZONE", "America/Mexico_City");
?>
