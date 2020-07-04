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

class Joke
{
    /**
     * @var string $id
     */
    public $id;
    /** @var string $authorId */
    public $author_id;
    
    /** @var string $jokedate */
    public $jokedate;
    
    /** @var string $joketext */
    public $joketext;
    
    /** @var $authorsTable */
    private $authorsTable;
    
    public function __construct(\Ninja\DatabaseTable
     $authorsTable)
    {
        $this->authorsTable = $authorsTable;
    }

    public function getAuthor()
    {
        return $this->authorsTable->
        findById($this->author_id);
    }
}
