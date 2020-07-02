<?php
/**
 * HTML Master Layout
 *
 * @package    PHP and MySQL Joke Machine
 * @subpackage layout.html.php
 * @author     Surajit Basak<surajitbasak109@gmail.com>
 * @copyright  734006 Techcet Blog Pty Ltd
 */

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="jokes.css">
        <title><?php echo $title; ?></title>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    </head>
    <body>

        <header class="layout-master-header fixed">
            <header class="layout-top-header">
                <h1 class="header-title">Internet Joke Database</h1>
            </header>
           <nav class="layout-top-nav">
                <ul class="nav-menu">
                    <li class="<?= strpos($_SERVER['SCRIPT_NAME'], "index") !== false ? "active" : "" ?>">
                        <a href="index.php">Home</a>
                    </li>
                    <li class="<?= strpos($_SERVER['SCRIPT_NAME'], "jokes") !== false ? "active" : "" ?>">
                        <a href="index.php?action=list">Jokes List</a>
                    </li>
                    <li class="<?= strpos($_SERVER['SCRIPT_NAME'], "addjoke") !== false ? "active" : "" ?>">
                        <a href="index.php?action=edit">Add a new Joke</a>
                    </li>
                </ul>
             </nav>
        </header>
        
        <main class="layout-main-body">
            <?php echo $output; ?>
        </main>
        
        <?php include dirname(__DIR__)."/views/inc/footer.html.php"; ?>
    </body>
</html>
