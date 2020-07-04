<?php
/**
 * Authentication Class
 *
 * @package    PHP and MySQL Joke Machine
 * @subpackage Authentication.php
 * @author     Surajit Basak<surajitbasak109@gmail.com>
 * @copyright  734006 Techcet Blog Pty Ltd
 */

 namespace Ninja;

class Authentication
{
    /**
     * @var DatabaseTable $users
     */
    private $users;

    /**
     * @var string $usernameColumn
     */
    private $usernameColumn;

    /**
     * @var string passwordColumn
     */
    private $passwordColumn;

    /**
     * Constructor Method
     *
     * @param \Ninja\DatabaseTable $users
     * @param string $usernameColumn
     * @param string $passwordColumn
     */
    public function __construct(
        DatabaseTable $users,
        string $usernameColumn,
        string $passwordColumn
    ) {
        session_start();
        $this->users = $users;
        $this->usernameColumn = $usernameColumn;
        $this->passwordColumn = $passwordColumn;
    }

    /**
     * Login Method
     *
     * @param string $username Username input string.
     * @param string $password Password input string.
     *
     * @return bool true|false
     */
    public function login(string $username, string $password)
    {
        $user = $this->users->find($this->usernameColumn, strtolower($username));

        if ($user && password_verify($password, $user->{$this->passwordColumn})) {
            session_regenerate_id();
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $user->id;
            $_SESSION['username'] = $username;
            return true;
        }
        return false;
    }

    /**
     * Login Method
     *
     * @return bool true|false
     */

    public function isLoggedIn()
    {
        if (empty($_SESSION['logged_in']) && empty($_SESSION['user_id']) && empty($_SESSION['username'])) {
            return false;
        }

        $user = $this->users->find($this->usernameColumn, $_SESSION['username']);

        if (!$user) {
            return false;
        }

        return true;
    }

    /**
     * Get user Method
     *
     * @return void
     */
    public function getUser()
    {
        if ($this->isLoggedIn()) {
            return $this->users->find($this->usernameColumn, strtolower($_SESSION['username']));
        } else {
            return false;
        }
    }
}
