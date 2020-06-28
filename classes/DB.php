<?php
/**
 * Database Class
 *
 * @package    PHP and MySQL Joke Machine
 * @subpackage DB.php
 * @author     Surajit Basak<surajitbasak109@gmail.com>
 * @copyright  734006 Techcet Blog Pty Ltd
 */

namespace classes;

class DB
{

    /**
     * Connection property
     *
     * @var private static string $conn
     */
    private static $conn;

    /**
     * Connection property
     *
     * @var private static string $instance
     */
    private static $instance = null;

    /**
     * Error property
     *
     * @var private static string $error
     */
    private static $error;

    /**
     * Table name property
     *
     * @var private static string $tableName
     */
    private static $tableName;

    /**
     * Columns Properties
     *
     * @var private static array $columns
     */
    private static $columns;

    /**
     * Where Property
     * @var private static array $where
     */
    private static $where;

    /**
     * Query Properties
     *
     * @var private static string $query
     */
    private static $query;

    /**
     * Query String Property
     *
     * @var private static string $queryString
     */
    private static $queryString;

    /**
     * Construct method
     * This method will be called when class initilize
     *
     * @return self
     * @throws error Error to be shown on unsuccessfull connection.
     */
    public function __construct()
    {
    }//end __construct()


    /**
     * Connect to Database
     *
     * @return void
     */
    public static function connect()
    {
        $config   = include dirname(__DIR__).DIRECTORY_SEPARATOR.'config/database.php';
        $dsn      = $config['driver'].':host='.$config['host'].';dbname='.$config['dbname'].';charset='.$config['charset'].';';
        $username = $config['username'];
        $passwd   = $config['password'];
        $option   = [
                     \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                     \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
                    ];

        try {
            $pdo        = new \PDO($dsn, $username, $passwd, $option);
            self::$conn = $pdo;
        } catch (\PDOException $e) {
            self::$error = 'Database error: '.$e->getMessage().' in '.$e->getFile().':'.$e->getLine();
            die(self::$error);
        }//end try
    }//end connect()


    /**
     * Get instance of the current class
     *
     * @return DB Returns self instance.
     */
    public static function getInstance()
    {
        self::connect();
        if (self::$instance === null) {
            self::$instance = new self;
        }

        return self::$instance;
    }//end getInstance()


    /**
     * Change current table name
     *
     * @param string $tableName Tablename for the current database.
     *
     * @return DB Returns self instance.
     */
    public function table(string $tableName)
    {
        self::$tableName = $tableName;
        return $this;
    }//end table()

    /**
     * Query method
     *
     * @param string $query An SQL query to be prepared.
     * @param array $bindings array to be used for bindings.
     * @return PDO Returns PDO instance.
     */
    public function query(string $query, array $bindings = [])
    {
        self::$queryString = $query;
        $q = self::$conn->prepare($query);
        if (empty($bindings)) {
            $q->execute();
        } else {
            if (strpos($query, "?")) {
                $q->execute($bindings);
            }
        }
        return $q;
    }//end query()

    /**
     * Where Method
     *
     * @param array $where An array of where clause to be used for bindings.
     *
     * @return DB Returns self instance.
     */

    public function where(array $where)
    {
        self::$where = $where;
        return $this;
    }//end where()


    /**
     * Select One Query
     *
     * @param string $query An SQL query to be executed.
     * @param array $bindings array to be used for bindings.
     *
     * @return object
     */
    public function selectOne(string $query, $bindings = [])
    {
        $sql = $this->query($query, $bindings);

        return $sql->fetch();
    }//end selectOne()


    /**
     * Select Query
     *
     * @param string $query An SQL query to be executed.
     * @param array $bindings array to be used for bindings.
     * @return array of objects.
     */
    public function select(string $query, array $bindings = [])
    {
        $sql = $this->query($query, $bindings);

        return $sql->fetchAll();
    }//end select()

    /**
     * Insert Query
     *
     * @param string $query An SQL query to be executed.
     * @param array $bindings array to be used for bindings.
     * @return bool.
     */
    public function insert(string $query, array $bindings = [])
    {
        $sql = $this->query($query, $bindings);
        return $sql;
    }//end insert()

    /**
     * Update Query
     *
     * @param string $query An SQL query to be executed.
     * @param array $bindings array to be used for bindings.
     * @return bool.
     */
    public function update(string $query, array $bindings)
    {
        $sql = $this->query($query, $bindings);
        return $sql;
    }//end update()

    /**
     * Delete Query
     *
     * @param string $query An SQL query to be executed.
     * @param array $bindings array to be used for bindings.
     * @return bool.
     */
    public function delete(string $query, array $bindings)
    {
        $sql = $this->query($query, $bindings);
        return $sql;
    }//end delete()
}//end class
