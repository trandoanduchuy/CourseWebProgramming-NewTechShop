<?php

if($_SERVER['SERVER_NAME'] == 'localhost')
{
    /** database configuration **/
    define('DBNAME', 'my_db');
    define('DBHOST', 'localhost'); 
    define('DBUSER', 'root'); 
    define('DBPASS', ''); 
    define('DBDRIVER', '');  

    define('ROOT', 'http://localhost/CourseWebProgramming-TechShop/public');
} else {
    /** database configuration **/
    define('DBNAME', 'my_db');
    define('DBHOST', 'localhost'); 
    define('DBUSER', 'root'); 
    define('DBPASS', ''); 
    define('DBDRIVER', '');

    define('ROOT', 'https://www.web-name.com');
}

define('APP_NAME', "My Website");
define('APP_DESC', "Best website on the planet");

/** true means show errors **/
define('DEBUG', true);