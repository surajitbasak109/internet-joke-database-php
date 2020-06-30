<?php
/**
 * PHP Joke Page
 *
 * @package    none
 * @subpackage none
 * @author     Surajit Basak<surajitbasak109@gmail.com>
 * @copyright  734006 Techcet Blog Pty Ltd
 */

require_once __DIR__.DIRECTORY_SEPARATOR.'../helpers/dbFunctions.php';
if (!empty($_POST['_method']) && $_POST['_method'] == 'DELETE' && !empty($_POST['id'])) {
    delete("jokes", "id", $_POST['id']);
    header('Location: jokes.php');
} else {
    $title = 'Unable to delete';

    ob_start();
    
    echo "<p>Unable to delete due to method or id is missing.</p>";

    $output = ob_get_clean();
}//end if

require __DIR__.DIRECTORY_SEPARATOR.'../views/layout.html.php';
