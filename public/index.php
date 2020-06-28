<?php
/**
 * PHP Joke Page
 *
 * @package    none
 * @subpackage noen
 * @author     Surajit Basak<surajitbasak109@gmail.com>
 * @copyright  734006 Techcet Blog Pty Ltd
 */


$title = 'Internet Joke Database';

ob_start();

require __DIR__.'/../views/home.html.php';

$output = ob_get_clean();

require __DIR__.'/../views/layout.html.php';
