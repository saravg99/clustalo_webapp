

<?php
/*
 * globals.inc.php
 * Global variables and settings
 */
// Base directories
// Automatic, taken from CGI variables.
$baseDir = dirname($_SERVER['SCRIPT_FILENAME']);
#$baseDir = '/home/gelpi/DEVEL/WWW/DBW/PDBBrowser';
$baseURL = dirname($_SERVER['SCRIPT_NAME']);

// Temporal dir, create if not exists, however Web server 
// may not have the appropriate permission to do so
$tmpDir = "$baseDir/tmp";
// if (!file_exists($tmpDir)) {
//     mkdir($tmpDir);
// }



// Load accessory routines
include_once "libDBW.inc.php";


// Start session to store queries
session_start();

?>
