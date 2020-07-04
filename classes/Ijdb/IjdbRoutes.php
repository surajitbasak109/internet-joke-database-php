<?php
/**
 * EntryPoint Class
 *
 * @package    PHP and MySQL Joke Machine
 * @subpackage EntryPoint.php
 * @author     Surajit Basak<surajitbasak109@gmail.com>
 * @copyright  734006 Techcet Blog Pty Ltd
 */


 namespace Ijdb;

use \Ninja\DatabaseTable;
use Ninja\Authentication;

class IjdbRoutes implements \Ninja\Routes
{
    /**
     * @var DatabaseTable $authorsTable
     */
    private $authorsTable;

    /**
     * @var DatabaseTable $jokesTable
     */
    private $jokesTable;

    /**
     * @var Authentication $authentication
     */
    private $authentication;

    /**
     * Cosntructor Method
     *
     * @return void
     */

    public function __construct()
    {
        $this->jokesTable = new DatabaseTable('jokes', 'id');
        $this->authorsTable = new DatabaseTable('authors', 'id');
        $this->authentication = new Authentication($this->authorsTable, 'email', 'password');
    }

    /**
     * Get Routes Method
     *
     * @return mixed[]
     */
    public function getRoutes() : array
    {
        $jokeController = new \Ijdb\Controllers\Joke($this->jokesTable, $this->authorsTable, $this->authentication);
        $authorController = new \Ijdb\Controllers\Register($this->authorsTable);
        $loginController = new \Ijdb\Controllers\Login($this->authentication);

        $routes = [
            'author/register' => [
                'GET' => [
                    'controller' => $authorController,
                    'action' => 'registrationForm',
                ],
                'POST' => [
                    'controller' => $authorController,
                    'action' => 'registerUser',
                ],
            ],
            'author/success' => [
                'GET' => [
                    'controller' => $authorController,
                    'action' => 'success',
                ],
            ],
            'jokes/edit' => [
                'POST' => [
                    'controller' => $jokeController,
                    'action' => 'saveEdit',
                ],
                'GET' => [
                    'controller' => $jokeController,
                    'action' => 'edit',
                ],
                'login' => true,
            ],
            'jokes/delete' => [
                'POST' => [
                    'controller' => $jokeController,
                    'action' => 'delete'
                ],
                'login' => true,
            ],
            'jokes/list' => [
                'GET' => [
                    'controller' => $jokeController,
                    'action' => 'list'
                ]
            ],
            'login/error' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'error',
                ],
            ],
            'login' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'loginForm'
                ],
                'POST' => [
                    'controller' => $loginController,
                    'action' => 'processLogin',
                ],
            ],
            'login/success' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'success',
                ],
                'login' => true,
            ],
            'logout' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'logout',
                ],
            ],
            '' => [
                'GET' => [
                    'controller' => $jokeController,
                    'action' => 'home'
                ],
            ]
        ];

        return $routes;
    }

    /**
     * Get Authentication Method
     *
     * @return void
     */
    public function getAuthentication(): \Ninja\Authentication
    {
        return $this->authentication;
    }
}
