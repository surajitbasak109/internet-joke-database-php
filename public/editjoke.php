<?php
/**
 * Edit Joke PHP File
 *
 * @package    PHP and MySQL Joke Machine
 * @subpackage editjoke.php
 * @author     Surajit Basak<surajitbasak109@gmail.com>
 * @copyright  734006 Techcet Blog Pty Ltd
 */

require_once __DIR__.DIRECTORY_SEPARATOR.'../helpers/dbFunctions.php';

if (!empty($_POST['joketext'])) {
    updateJoke($_POST['joketext'], 1, $_POST['jokeid']);
    header('Location: jokes.php');
} else {
    $joke = getJoke($_GET['id']);

    $title = 'Edit joke';

    ob_start();

    include __DIR__.'/../views/editjoke.html.php';

    $output = ob_get_clean();
}//end if

require __DIR__.DIRECTORY_SEPARATOR.'../views/layout.html.php';
