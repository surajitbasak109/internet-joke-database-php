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
 * Returns an array of objects from the specified table
 *
 * @param string $table A table name from the database.
 *
 * @return array Returns an array of objects.
 */

if (!function_exists('findAll')) {
    function findAll(string $table)
    {
        $rows = DB::getInstance()->select("SELECT * FROM ".$table);
        return $rows;
    }//end findAll()

}

/*
 * Returns an object of data from the specified table
 *
 * @param string $table A table name from the database.
 *
 * @return array Returns an array of objects.
 */

if (!function_exists('findById')) {
    function findById(string $table, string $primaryKey, string $value)
    {
        $query = 'SELECT * FROM `'.$table.'` WHERE `'.$primaryKey.'` = ?';
        $row = DB::getInstance()->selectOne($query, [$value]);
        return $row;
    }//end findById()

}

/*
 * Get total numbers of rows from the specified table.
 *
 * @param string $table specify the table name.
 * @return int Returns total number rows.
 */

if (!function_exists('total')) {
    function total(string $table)
    {
        $row = DB::getInstance()->selectOne('SELECT COUNT(*) count FROM `'.$table.'`');
        return (int) $row->count;
    }//end total()
}

/*
 * Inserts data to the specified table
 *
 * @param string $table Provide table name.
 * @param array $fields An array of fields.
 *
 * @return bool Returns true or false.
 */

if (!function_exists('insert')) {
    function insert(string $table, array $fields)
    {
        $keys = array_keys($fields);
        $columns_string = implode(", ", $keys);
        $values_string = implode(", ", array_fill(0, count($keys), "?"));

        $insert = DB::getInstance()
        ->insert(
            "INSERT INTO `".$table."` (".$columns_string.") VALUES (".$values_string.")",
            array_values($fields)
        );
        return (bool) $insert;
    }//end insert()
}

/*
 * Update Data to the specified table
 *
 * @param string $table       A table where the data should be updated.
 * @param string $whereFields Columns to be used for where condition.
 * @param int    $fields      Table columns to be updated.
 *
 * @return bool
 */

if (!function_exists('update')) {
    function update(string $table, array $whereFields, array $fields)
    {
        // Make an empty string for fields.
        $updateCommand = "";

        // Loop through the $fields array
        // concatenate $key = ? template
        // to updateCommand string.
        foreach ($fields as $key => $value) {
            $updateCommand .= '`'.$key.'` = ?,';
        }

        // Remove last comma(,).
        $updateCommand = rtrim($updateCommand, ',');

        // Make an empty string for whereFields.
        $whereCommand = "";

        // Loop through the $whereFields array
        // concatenate $key = ? template
        // to whereCommand string.
        foreach ($whereFields as $key => $value) {
            $whereCommand .= '`'.$key.'` = ?';
        }

        // Remove last comma(,).
        $whereCommand = rtrim($whereCommand, ",");

        // Make sql command.
        $query = 'UPDATE `'.$table.'` SET '.$updateCommand.' WHERE '.$whereCommand.';';

        // Merge two array_values into one array.
        $params = array_merge(array_values($fields), array_values($whereFields));

        $update = DB::getInstance()
        ->update(
            $query,
            $params
        );
        return (bool) $update;
    }//end update()
}//end if

/*
 * Deletes a row from the provided table.
 *
 * @param string $table To delete from the table.
 * @param string $primaryKey The priamry key of the table.
 * @param int $id The id of given primary key.
 *
 * @return bool Returns true or false.
 */

if (!function_exists('delete')) {
    function delete(string $table, string $primaryKey, int $id)
    {
        $delete = DB::getInstance()
            ->delete(
                "DELETE FROM `".$table."` WHERE `".$primaryKey."` = ?",
                [$id]
            );
        return (bool) $delete;
    }//end delete()
}
