<?php
/**
 * DatabaseTable Class
 *
 * @package    PHP and MySQL Joke Machine
 * @subpackage DatabaseTable.php
 * @author     Surajit Basak<surajitbasak109@gmail.com>
 * @copyright  734006 Techcet Blog Pty Ltd
 */

 namespace Ninja;

/*
 * DatabaseTable class
 *
 */

class DatabaseTable
{
    /**
     * @var PDO|null $pdo A PHP Document Object to be instantiated.
     */
    public $pdo;

    /**
     * @var string $table A table name should be specified.
     */
    public $table;

    /**
     * @var string $primaryKey The primary key for the database table.
     */
    public $primaryKey;

    /**
     * Construct method
     *
     * @param string $table      Table name of the database.
     * @param string $primaryKey Primary key for the current table.
     * @return void
     */
    public function __construct(string $table, string $primaryKey)
    {
        $this->connect();
        $this->table = $table;
        $this->primaryKey = $primaryKey;
    }

    /**
     * Connect to Database
     *
     * @return void
     */
    public function connect()
    {
        $config   = include __DIR__. '/../../config/database.php';
        $dsn      = $config['driver'].':host='.$config['host'].';dbname='.$config['dbname'].';charset='.$config['charset'].';';
        $username = $config['username'];
        $passwd   = $config['password'];
        $option   = [
                     \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                     \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
                    ];

        try {
            $pdo  = new \PDO($dsn, $username, $passwd, $option);
            $this->pdo = $pdo;
        } catch (\PDOException $e) {
            $error = 'Database error: '.$e->getMessage().' in '.$e->getFile().':'.$e->getLine();
            die($error);
        }//end try
    }//end connect()

    /**
     * Makes Query to the Database
     *
     * @param string $sql         An SQL query string.
     * @param array  ?$parameters An optional array for bindings.
     */

    private function query(string $sql, array $parameters = [])
    {
        $query = $this->pdo->prepare($sql);
        $query->execute($parameters);
        return $query;
    }

    /*
     * Get total numbers of rows from the specified table.
     *
     * @return int Returns total number rows.
     */

    public function total()
    {
        $query = $this->query('SELECT COUNT(*) count FROM `'.$this->table.'`');
        $row = $query->fetch();
        return (int) $row->count;
    }//end total()

    /*
     * Returns an object of data from the specified table.
     *
     * @param string $value Find row by given value.
     *
     * @return array Returns an array of objects.
     */

    public function findById(string $value)
    {
        $query = 'SELECT * FROM `'.$this->table.'` WHERE `'.$this->primaryKey.'` = :value';
        $parameters = [':value' => $value];
        $query = $this->query($query, $parameters);
        return $query->fetch();
    }//end findById()

    /*
     * Returns an object of data from the specified table.
     *
     * @param string $column Find by column name.
     * @param string $value Find row by given value.
     *
     * @return array Returns an array of objects.
     */

    public function find(string $column, string $value)
    {
        $query = 'SELECT * FROM `'.$this->table.'` WHERE `'.$column.'` = :value';
        $parameters = [':value' => $value];
        $query = $this->query($query, $parameters);
        return $query->fetch();
    }//end findById()

    /**
     * Returns an array of objects from the specified table
     *
     * @return array Returns an array of objects.
     */

    public function findAll()
    {
        $query = $this->query('SELECT * FROM '.$this->table);
        $rows = $query->fetchAll();
        return $rows;
    }//end findAll()

    /**
     * Inserts data to the specified table
     *
     * @param array $fields An array of fields.
     *
     * @return bool Returns true or false.
     */

    public function insert(array $fields)
    {
        $query = 'INSERT INTO `' . $this->table . '` (';

        foreach ($fields as $key => $value) {
            $query .= '`' . $key . '`,';
        }

        $query = rtrim($query, ',');

        $query .= ') VALUES (';


        foreach ($fields as $key => $value) {
            $query .= ':' . $key . ',';
        }

        $query = rtrim($query, ',');

        $query .= ')';

        $this->query($query, $fields);
    }//end insert()

    /**
     * Update Data to the specified table
     *
     * @param int $fields Table columns to be updated.
     *
     * @return bool
     */

    public function update(array $fields)
    {

        $query = ' UPDATE `' . $this->table .'` SET ';

        // Loop through the $fields array
        // concatenate $key = :$key template
        // to query string.
        foreach ($fields as $key => $value) {
            $query .= '`' . $key . '` = :' . $key . ',';
        }

        $query = rtrim($query, ',');

        $query .= ' WHERE `' . $this->primaryKey . '` = 
            :primaryKey';

        // Set the :primaryKey variable.
        $fields['primaryKey'] = $fields['id'];

        $this->query($query, $fields);
    }//end update()

    /*
     * Deletes a row from the provided table.
     *
     * @param int $id The id of given primary key.
     *
     * @return bool Returns true or false.
     */

    public function delete(int $id)
    {
        return $this->query(
            "DELETE FROM `".$this->table."` WHERE `".$this->primaryKey."` = ?",
            [$id]
        );
    }//end delete()

    /**
     * Save Method
     * @param array $record An associative array to insert or update
     */
    public function save($record)
    {
        try {
            if ($record[$this->primaryKey] == '') {
                $record[$this->primaryKey] = null;
            }
            $this->insert($record);
        } catch (\PDOException $e) {
            $this->update($record);
        }
    }
}
