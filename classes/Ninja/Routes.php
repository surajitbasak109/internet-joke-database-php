<?php
/**
 * EntryPoint Class
 *
 * @package    PHP and MySQL Joke Machine
 * @subpackage EntryPoint.php
 * @author     Surajit Basak<surajitbasak109@gmail.com>
 * @copyright  734006 Techcet Blog Pty Ltd
 */


 namespace Ninja;

interface Routes
{
    public function getRoutes();
    public function getAuthentication(): \Ninja\Authentication;
}
