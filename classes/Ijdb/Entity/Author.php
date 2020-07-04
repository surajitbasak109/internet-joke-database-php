<?php

/**
 * Author Class
 *
 * @package    PHP and MySQL Joke Machine
 * @subpackage Author.php
 * @author     Surajit Basak<surajitbasak109@gmail.com>
 * @copyright  734006 Techcet Blog Pty Ltd
 */

 namespace Ijdb\Entity;

class Author
{
    /** @var $id **/
    public $id;
    /** @var $name **/
    public $name;
    /** @var $email **/
    public $email;
    /** @var $password **/
    public $password;
    /** @var $jokesTable **/
    public $jokesTable;

    /**
     * Construct Method
     *
     * @return void
     */
    public function __construct(\Ninja\DatabaseTable $jokesTable)
    {
        $this->jokesTable = $jokesTable;
    }

    /**
     * Get Jokes Method
     *
     * @return mixed[]
     */
    public function getJokes()
    {
        return $this->jokesTable->find('author_id', $this->id);
    }

    /**
     * Add Joke Method
     *
     * @return void
     */
    public function addJoke($joke)
    {
        $joke['author_id'] = $this->id;

        $this->jokesTable->save($joke);
    }
}
