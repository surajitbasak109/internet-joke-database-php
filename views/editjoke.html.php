<div class="container">
    <div class="row">
        <div class="col-8 m-auto">
            <form action="" method="post">
                <input type="hidden" name="jokeid" value="<?php echo $joke->id; ?>">
                <div class="form-group">
                    <label for="joketext">Type your joke here: </label>
                    <textarea id="joketext" name="joketext" rows="3" class="form-control"><?php echo $joke->joketext;?></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-secondary btn-block" value="Update">
                </div>
            </form>
        </div>
    </div>
</div>
