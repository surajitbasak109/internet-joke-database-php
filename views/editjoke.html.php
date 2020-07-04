<div class="container">
    <div class="row">
        <div class="col-8 m-auto">
            <?php if (isset($joke)) : ?>
                <?php if ($user_id == $joke->author_id) : ?>
                <form action="" method="post">
                    <input type="hidden" name="joke[id]" value="<?php echo $joke->id ?? ""; ?>">
                    <div class="form-group">
                        <label for="joketext">Type your joke here: </label>
                        <textarea id="joketext" name="joke[joketext]" rows="3" class="form-control"><?php echo $joke->joketext ?? ""; ?></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-secondary btn-block" value="Save">
                    </div>
                </form>
                <?php else : ?>
                <p>You may only edit jokes that you posted.</p>

                <?php endif; ?>
            <?php else : ?>
            <form action="" method="post">
                <input type="hidden" name="joke[id]" value="<?php echo $joke->id ?? ""; ?>">
                <div class="form-group">
                    <label for="joketext">Type your joke here: </label>
                    <textarea id="joketext" name="joke[joketext]" rows="3" class="form-control"><?php echo $joke->joketext ?? ""; ?></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-secondary btn-block" value="Save">
                </div>
            </form>
            <?php endif; ?>
        </div>
    </div>
</div>
