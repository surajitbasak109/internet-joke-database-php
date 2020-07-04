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
        <link rel="stylesheet" href="/jokes.css">
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
                    <li class="<?= strpos($_SERVER['REQUEST_URI'], "index") !== false ? "active" : "" ?>">
                        <a href="/">Home</a>
                    </li>
                    <li class="<?= strpos($_SERVER['REQUEST_URI'], "list") !== false ? "active" : "" ?>">
                        <a href="/jokes/list">Jokes List</a>
                    </li>
                    <li class="<?= strpos($_SERVER['REQUEST_URI'], "edit") !== false ? "active" : "" ?>">
                        <a href="/jokes/edit">Add a new Joke</a>
                    </li>

                    <?php if ($loggedIn) : ?>
                    <li>
                        <a href="/logout">Log out</a>
                    </li>
                    <?php else : ?>
                    <li>
                        <a href="/login">Log in</a>
                    </li>
                    <?php endif; ?>
                </ul>
             </nav>
        </header>
        
        <main class="layout-main-body">
            <?php echo $output; ?>
        </main>
        
        <?php include dirname(__DIR__)."/views/inc/footer.html.php"; ?>
    </body>
</html>
