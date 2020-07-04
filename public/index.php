<?php
/**
 * PHP Joke Page
 *
 * @package    Internet Jokes Machine
 * @subpackage Index.php
 * @author     Surajit Basak<surajitbasak109@gmail.com>
 * @copyright  734006 Techcet Blog Pty Ltd
 */

include __DIR__ . '/../includes/autoload.php';
try {
    $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');
    
    $entrypoint = new \Ninja\EntryPoint($route, $_SERVER['REQUEST_METHOD'], new \Ijdb\IjdbRoutes());
    $entrypoint->run();
} catch (PDOException $e) {
    $title = 'An error has occurred.';

    $output = 'Database error: ' . $e->getMessage() . ' in '
     . $e->getFile() . ':' . $e->getLine();
    include __DIR__ . '/../views/layout.html.php';
}//end try
