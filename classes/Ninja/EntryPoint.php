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

class EntryPoint
{
    /**
     * @var $route
     */
    private $route;

    /**
     * @var $method
     */
    private $method;

    /**
     * @var $routes
     */
    private $routes;

    /**
     * @method __construct
     *
     * @param string $route
     * @param string $method
     * @param \Ninja\Routes $routes
     */
    public function __construct(string $route, string $method, \Ninja\Routes $routes)
    {
        $this->route = $route;
        $this->routes = $routes;
        $this->method = $method;
        $this->checkUrl();
    }

    /**
     * Check Url Method
     *
     * return void
     */
    private function checkUrl()
    {
        if ($this->route !== strtolower($this->route)) {
            http_response_code(301);
            header('location: '.strtolower($this->route));
        }
    }

    /**
     * Load View Method
     *
     * @return string
     */
    private function loadView(string $viewFileName, array $variables = [])
    {
        extract($variables);

        ob_start();

        include __DIR__ . '/../../views/' . $viewFileName;

        return ob_get_clean();
    }

    /**
     * Run Method
     *
     * @return void
     */
    public function run()
    {
        $routes = $this->routes->getRoutes();
        $authentication = $this->routes->getAuthentication();

        if (isset($routes[$this->route]['login']) &&
            !$authentication->isLoggedIn()) {
            header('location: /login/error');
        }

        $controller = $routes[$this->route][$this->method]['controller'];
        $action = $routes[$this->route][$this->method]['action'];

        $page = $controller->$action();

        $title = $page['title'];

        if (isset($page['variables'])) {
            $output = $this->loadView($page['view'], $page['variables']);
        } else {
            $output = $this->loadView($page['view']);
        }

        echo $this->loadView('layout.html.php', [
            'loggedIn' => $authentication->isLoggedIn(),
            'output' => $output,
            'title' => $title,
        ]);
    }
}
