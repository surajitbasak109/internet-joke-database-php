<?php

/**
 * JokeController Class
 *
 * @package    PHP and MySQL Joke Machine
 * @subpackage Joke.php
 * @author     Surajit Basak<surajitbasak109@gmail.com>
 * @copyright  734006 Techcet Blog Pty Ltd
 */

 namespace Ijdb\Controllers;

use Ninja\Authentication;
use Ninja\DatabaseTable;

/**
 * Class JokeController
 */
class Joke
{
    private $authorsTable;
    private $jokesTable;
    private $authentication;

    public function __construct(
        DatabaseTable $jokesTable,
        DatabaseTable $authorsTable,
        Authentication $authentication
    ) {
        $this->jokesTable = $jokesTable;
        $this->authorsTable = $authorsTable;
        $this->authentication = $authentication;
    }

    /**
     * List function
     *
     * @return void
     */
    public function list()
    {
        $result = $this->jokesTable->findAll();

        $jokes = [];
        foreach ($result as $joke) {
            $author = $this->authorsTable->findById($joke->author_id);

            $jokes[] = [
                'id'         => $joke->id,
                'joketext'   => $joke->joketext,
                'jokedate'   => $joke->jokedate,
                'name'       => $author->name,
                'email'      => $author->email,
                'author_id'  => $joke->author_id,
            ];
        }

        $title = 'Joke List';
        $totalJokes = $this->jokesTable->total();
        $author = $this->authentication->getUser();

        $user_id = $author->id ?? null;
        $view = 'jokes.html.php';
        $variables = compact('totalJokes', 'jokes', 'user_id');
        $data = compact('view', 'title', 'variables');
        return $data;
    }

    /**
     * Home Method
     *
     * @return void
     */
    public function home()
    {
        $title = 'Internet Joke Database';

        $view = 'home.html.php';
        $data = compact('view', 'title');

        return $data;
    }


    /**
     * Delete method
     *
     * @return void
     */
    public function delete()
    {
        $this->jokesTable->delete($_POST['id']);

        header('location: /jokes/list');
    }

    /**
     * Save Edit Method
     *
     * @return void
     */
    public function saveEdit()
    {
        if (!empty($_POST['joke'])) {
            $author = $this->authentication->getUser();

            $authorObject = new \Ijdb\Entity\Author($this->jokesTable);

            $authorObject->id = $author->id;
            $authorObject->name = $author->name;
            $authorObject->email = $author->email;
            $authorObject->password = $author->password;

            $joke = $_POST['joke'];
            $joke['jokedate'] = date('Y-m-d');

            $authorObject->addJoke($joke);

            header('Location: /jokes/list');
        }//end if
    }
    

    /**
     * Edit method
     *
     * @return void
     */
    public function edit()
    {
        $author = $this->authentication->getUser();
        if (!empty($_GET['id'])) {
            $joke = $this->jokesTable->findById($_GET['id']);
            if ($joke->author_id != $author->id) {
                return;
            }
        }

        $title = 'Edit joke';
        $view = 'editjoke.html.php';

        $variables = [
            'joke' => $joke ?? null,
            'user_id' => $author->id ?? null
        ];

        $data = compact('view', 'title', 'variables');

        return $data;
    }
}
