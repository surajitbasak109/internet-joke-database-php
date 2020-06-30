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

if (!empty($_POST['joketext']) && !empty($_POST['jokeid'])) {
    update(
        "jokes",
        [
         'id' => $_POST['jokeid'],
        ],
        [
         "joketext"  => $_POST['joketext'],
         'author_id' => 1,
        ]
    );
    header('Location: jokes.php');
} else {
    if (!empty($_GET['id'])) {
        $joke = findById('jokes', 'id', $_GET['id']);
    }

    $title = 'Edit joke';

    ob_start();

    include __DIR__.'/../views/editjoke.html.php';

    $output = ob_get_clean();
}//end if

require __DIR__.DIRECTORY_SEPARATOR.'../views/layout.html.php';
