<?php
/**
 * Add Joke PHP File
 *
 * @package    PHP and MySQL Joke Machine
 * @subpackage totalJokes.php
 * @author     Surajit Basak<surajitbasak109@gmail.com>
 * @copyright  734006 Techcet Blog Pty Ltd
 */

use classes\DB;

require_once __DIR__.'/../classes/DB.php';

/*
 * Get total numbers of Jokes
 *
 * @return int
 */

if (!function_exists('totalJokes')) {
    function totalJokes()
    {
        $row = DB::getInstance()->selectOne("SELECT COUNT(*) count FROM `jokes`");
        return (int) $row->count;
    }//end totalJokes()
}

/*
 * Get all Jokes
 *
 * @return Jokes array of objects
 */

if (!function_exists('allJokes')) {
    function allJokes()
    {
        $jokes = DB::getInstance()->select("select `jokes`.`id`, `joketext`, `name`, `email`
        from `jokes` inner join `authors` on `author_id` = `authors`.`id`;");
        return $jokes;
    }//end allJokes()
}

/*
 * Get a Joke
 *
 * @param int $id A Joke Id to be passed as an argument
 *
 * @return Joke Object
 */

if (!function_exists('getJoke')) {
    function getJoke($id)
    {
        $joke = DB::getInstance()->selectOne("SELECT * FROM `jokes` WHERE `id` = ?", [$id]);
        return $joke;
    }//end getJoke()
}

/*
 * Insert a Joke
 *
 * @param string $jokeText A Joke string to be added.
 * @param int    $authorId An author id to be added.
 *
 * @return bool
 */

if (!function_exists('insertJoke')) {
    function insertJoke(string $jokeText, int $authorId, string $jokeDate)
    {
        $insert = DB::getInstance()
        ->insert(
            "INSERT INTO jokes (joketext, author_id, jokedate) VALUES (?, ?, ?)",
            [
             $jokeText,
             $authorId,
             $jokeDate,
            ]
        );
        return (bool) $insert;
    }//end insertJoke()
}

/*
 * Update a Joke
 *
 * @param string $jokeText   A Joke string.
 * @param int    $authorId   An author id.
 * @param int    $jokeId     A Joke id.
 *
 * @return bool
 */

if (!function_exists('updateJoke')) {
    function updateJoke(string $jokeText, int $authorId, int $jokeId)
    {
        $update = DB::getInstance()
        ->insert(
            "UPDATE `jokes` SET `joketext` = ?, `author_id` = ? WHERE `id` = ?",
            [
             $jokeText,
             $authorId,
             $jokeId,
            ]
        );
        return (bool) $update;
    }//end updateJoke()
}

/*
 * Delete a Joke
 *
 * @param int $jokeId A Joke id.
 *
 * @return bool
 */

if (!function_exists('deleteJoke')) {
    function deleteJoke(int $jokeId)
    {
        $delete = DB::getInstance()
            ->delete(
                "DELETE FROM jokes WHERE id = ?",
                [$jokeId]
            );
        return (bool) $delete;
    }//end deleteJoke()
}

/*
 * Gets all authors from authors Table
 *
 * @return array Returns an array of objects.
 */

if (!function_exists('allAuthors')) {
    function allAuthors()
    {
        $authors = DB::getInstance()
            ->select(
                "SELECT * FROM authors"
            );
        return (array) $authors;
    }//end allAuthors()
}

/*
 * Deletes an author from authors table.
 *
 * @return bool Returns true or false.
 */

if (!function_exists('deleteAuthor')) {
    function deleteAuthor($id)
    {
        $delete = DB::getInstance()
            ->delete(
                "DELETE FROM authors WHERE id = ?",
                [$id]
            );
        return (bool) $delete;
    }//end deleteAuthor()
}

/*
 * Adds an author in authors table.
 *
 * @return bool Returns true or false.
 */

if (!function_exists('deleteAuthor')) {
    function deleteAuthor($id)
    {
        $delete = DB::getInstance()
            ->delete(
                "DELETE FROM authors WHERE id = ?",
                [$id]
            );
        return (bool) $delete;
    }//end deleteAuthor()
}
