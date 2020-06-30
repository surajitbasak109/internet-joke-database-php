<?php
/**
 * Jokes.html.php
 *
 * @package    Jokes
 * @subpackage Jokes.html.php
 * @author     Surajit Basak<surajitbasak109@gmail.com>
 * @copyright  734006 Techcet Blog Pty Ltd
 **/
?>

<p><?php echo total('jokes'); ?> jokes has been submitted to the Internet Joke Database.</p>

<?php
foreach ($jokes as $joke) : ?>
<blockquote>
    <p>
    <?php echo htmlspecialchars($joke['joketext'], ENT_QUOTES, 'UTF-8'); ?>

    (by <a href="mailto:<?php
    echo htmlspecialchars(
        $joke['email'],
        ENT_QUOTES,
        'UTF-8'
                        ); ?>"><?php
    echo htmlspecialchars(
        $joke['name'],
        ENT_QUOTES,
        'UTF-8'
                               ); ?></a>)
    </p>

    <div class="cell">
        <a class="btn btn-primary" href="editjoke.php?id=<?php echo $joke['id']; ?>">Edit</a>
    </div>
    <form action="deletejoke.php" method="POST">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="id" value="<?php echo $joke['id']; ?>">
        <input type="submit" class="btn btn-secondary" value="Delete">
    </form>
</blockquote>
    <?php
endforeach;
