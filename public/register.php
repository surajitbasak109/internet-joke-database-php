<?php
/**
 * PHP Joke Page
 *
 * @package    Internet Jokes Machine
 * @subpackage register.php
 * @author     Surajit Basak<surajitbasak109@gmail.com>
 * @copyright  734006 Techcet Blog Pty Ltd
 */

use classes\DatabaseTable;
use controllers\RegisterController;

try {
    require_once __DIR__ . '/../classes/DatabaseTable.php';
    require_once __DIR__ . '/../controllers/JokeController.php';

    $jokesTable = new DatabaseTable('jokes', 'id');
    $authorsTable = new DatabaseTable('authors', 'id');

    $registerController = new RegisterController($authorsTable);

    $action = $_GET['action'] ?? "home";

    if ($action == strtolower($action)) {
        $page = $registerController->$action();
    } else {
        http_response_code(301);
        header('location: index.php?action='.strtolower($action));
    }

    $title = $page['title'];

    if (isset($page['variables'])) {
        $output = loadTemplate($page['view'], $page['variables']);
    } else {
        $output = loadTemplate($page['view']);
    }
} catch (PDOException $e) {
    $title = 'An error has occurred.';

    $output = 'Database error: ' . $e->getMessage() . ' in '
     . $e->getFile() . ':' . $e->getLine();
}//end try

include __DIR__ . '/../views/layout.html.php';
