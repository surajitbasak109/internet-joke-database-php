<div class="container">
    <div class="row">
        <div class="col-6 m-auto">
        <?php
        if (!empty($errors)) :
            ?>
            <div class="errors">
                <p>Your account cannot be created,
                please check the following:</p>
                <ul>
                <?php
                foreach ($errors as $error) :
                    ?>
                    <li><?= $error; ?></li>
                <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-6 m-auto">
            <form action="" method="post">
                <div class="form-group">
                    <label for="email">Your email address</label>
                    <input name="author[email]" id="email" value="<?= $author['email'] ?? ''; ?>" type="text" class="form-control">
                </div>

                <div class="form-group">
                    <label for="name">Your name</label>
                    <input name="author[name]" id="name" type="text" value="<?= $author['name'] ?? ''; ?>" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="author[password]" id="password" type="password" value="<?= $author['password'] ?? ''; ?>" class="form-control">
                </div>

                <div class="form-group">
                    <input type="submit" name="submit" value="Register account" class="btn btn-secondary">
                </div>
                <p>Already have an account? <a href="/login">Click here to Login</a></p> 
            </form>
        </div>
    </div>
</div>
