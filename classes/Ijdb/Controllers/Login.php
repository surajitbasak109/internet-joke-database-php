<?php

/**
 * Login Class
 *
 * @package    PHP and MySQL Joke Machine
 * @subpackage Login.php
 * @author     Surajit Basak<surajitbasak109@gmail.com>
 * @copyright  734006 Techcet Blog Pty Ltd
 */

 namespace Ijdb\Controllers;

 use Ninja\DatabaseTable;

/**
 * Class JokeController
 */
class Login
{
    /**
     * @var \Ninja\Authentication $authentication
     */
    private $authentication;

    /**
     * Construct method.
     *
     * @return void
     */
    public function __construct(\Ninja\Authentication $authentication)
    {
        $this->authentication = $authentication;
    }

    /**
     * Login Form Method
     *
     * @return mixed[]
     */
    public function loginForm()
    {
        return [
            'view' => 'login.html.php',
            'title' => 'Log In',
        ];
    }

    /**
     * Error method
     *
     * return mixed[]
     */
    public function error()
    {
        return [
            'view' => 'loginerror.html.php',
            'title' => 'You are not logged in!',
        ];
    }

    /**
     * Process Login Method
     *
     * @return void
     */
    public function processLogin()
    {
        if ($this->authentication->login($_POST['email'], $_POST['password'])) {
            header('location: /login/success');
        } else {
            return [
                'view' => 'login.html.php',
                'title' => 'Log In',
                'variables' => [
                    'error' => 'Invalid username/password',
                ],
            ];
        }
    }

    /**
     * Success Method
     *
     * @return void
     */
    public function success()
    {
        return [
            'view' => 'loginsuccess.html.php',
            'title' => 'Login Successful',
        ];
    }


    /**
     * Logout Method
     *
     * @return void
     */
    public function logout()
    {
        session_destroy();
        return [
            'view' => 'logout.html.php',
            'title' => 'You have been logged out',
        ];
    }
}
