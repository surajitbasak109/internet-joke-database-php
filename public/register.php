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

    $jokesTable = new DatabaseTable('jokes', 'id');
    $authorsTable = new DatabaseTable('authors', 'id');

    $action = $_GET['action'] ?? "home";
    $controllerName = $_GET['controller'] ?? 'joke';

    if ($action == strtolower($action) &&
    $controllerName == strtolower($controllerName)) {
        $className = ucfirst($controllerName) . 'Controller';

        include __DIR__ . '/../controllers/' . $className . '.php';

        $controller = new $className($jokesTable, $authorsTable);
        $page = $controller->$action();
    } else {
        http_response_code(301);
        header('location: index.php?controller=' .
            strtolower($controllerName) . '&action=' .
            strtolower($action));
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
