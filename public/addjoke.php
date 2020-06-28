<?php
/**
 * Add Joke PHP File
 *
 * @package    PHP and MySQL Joke Machine
 * @subpackage addjoke.php
 * @author     Surajit Basak<surajitbasak109@gmail.com>
 * @copyright  734006 Techcet Blog Pty Ltd
 */
require_once __DIR__.DIRECTORY_SEPARATOR.'../helpers/dbFunctions.php';

if (!empty($_POST['joketext'])) {
    $date = new DateTime();
    insertJoke($_POST['joketext'], 1, $date->format('Y-m-d'));
    header('Location: jokes.php');
} else {
    $title = 'Add a new joke';

    ob_start();

    include __DIR__.'/../views/addjoke.html.php';

    $output = ob_get_clean();
}//end if

require __DIR__.DIRECTORY_SEPARATOR.'../views/layout.html.php';
