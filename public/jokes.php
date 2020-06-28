<?php
/**
 * PHP Joke Page
 *
 * @package    none
 * @subpackage none
 * @author     Surajit Basak<surajitbasak109@gmail.com>
 * @copyright  734006 Techcet Blog Pty Ltd
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__.'/../helpers/dbFunctions.php';

$jokes = allJokes();

$title = 'Joke list';

$totalJokes = totalJokes();

// Start the buffer.
ob_start();

// Include the template. The PHP code will be executed,
// but the resulting HTML will be stored in the buffer
// rather than sent to the browser.
require __DIR__.'/../views/jokes.html.php';

// Read the contents of the output buffer and store them
// in the $output variable for use in layout.html.php.
$output = ob_get_clean();

require __DIR__.DIRECTORY_SEPARATOR.'../views/layout.html.php';
