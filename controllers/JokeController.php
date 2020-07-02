<?php

/**
 * JokeController Class
 *
 * @package    PHP and MySQL Joke Machine
 * @subpackage JokeController.php
 * @author     Surajit Basak<surajitbasak109@gmail.com>
 * @copyright  734006 Techcet Blog Pty Ltd
 */

namespace controllers;

use classes\DatabaseTable;

/**
 * Class JokeController
 */
class JokeController
{
    private $authorsTable;
    private $jokesTable;

    public function __construct(DatabaseTable $jokesTable, DatabaseTable $authorsTable)
    {
        $this->jokesTable = $jokesTable;
        $this->authorsTable = $authorsTable;
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
                'id'       => $joke->id,
                'joketext' => $joke->joketext,
                'name'     => $author->name,
                'email'    => $author->email,
            ];
        }

        $title = 'Joke List';
        $totalJokes = $this->jokesTable->total();

        $view = 'jokes.html.php';
        $variables = compact('totalJokes', 'jokes');
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

        header('location: index.php?action=list');
    }

    /**
     * Edit method
     *
     * @return void
     */
    public function edit()
    {
        if (!empty($_POST['joke'])) {
            $joke = $_POST['joke'];
            $joke['jokedate'] = date('Y-m-d');
            $joke['author_id'] = 1;

            $this->jokesTable->save($joke);

            header('Location: index.php?action=list');
        } else {
            if (!empty($_GET['id'])) {
                $joke = $this->jokesTable->findById($_GET['id']);
            }

            $title = 'Edit joke';
            $view = 'editjoke.html.php';

            $variables = [
                'joke' => $joke ?? null
            ];

            $data = compact('view', 'title', 'variables');

            return $data;
        }//end if
    }
}
