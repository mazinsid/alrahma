<?php

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DBNAME', 'alrhama');

/** MySQL database username */
define('DBUSER', 'root');

/** MySQL database password */
define('DBPASS', '');

/** MySQL hostname */
define('DBHOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

 define('DBCONNECT','mysql:host=localhost;dbname=alrhama');

try {
	$connString = "mysql:host=localhost;dbname=alrhama";
	$user = DBUSER;
	$pass = DBPASS;
	$pdo = new PDO($connString,$user,$pass);
	return $pdo ;
}
catch (PDOException $e) {
	die( $e->getMessage() );

}

?>
