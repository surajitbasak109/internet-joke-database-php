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

<p><?php echo $totalJokes; ?> jokes has been submitted to the Internet Joke Database.</p>

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
    ); ?></a> on <?= date('jS F Y', strtotime($joke['jokedate'])); ?>)
    </p>

    <?php if ($user_id == $joke['author_id']) : ?>
    <div class="cell">
        <a class="btn btn-primary" href="/jokes/edit?id=<?= $joke['id']; ?>">Edit</a>
    </div>
    <form action="/jokes/delete" method="POST">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="id" value="<?= $joke['id']; ?>">
        <input type="submit" class="btn btn-secondary" value="Delete">
    </form>
    <?php endif; ?>
</blockquote>
    <?php
endforeach;
