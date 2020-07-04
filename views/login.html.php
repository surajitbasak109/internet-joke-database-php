<div class="container">
    <div class="row">
        <div class="col-6 m-auto">
        <?php
        if (!empty($error)) :
            ?>
            <div class="errors">
            <p><?= $error ?></p>
            </div>
        <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-6 m-auto">
            <form method="post" action="">
                <div class="form-group">
                    <label for="email">Your email address</label>
                    <input type="text" id="email" name="email" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password">Your password</label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>

                <div class="form-group">
                    <input type="submit" name="login" value="Log in" class="btn btn-secondary">
                </div>
            </form>

            <p>Don't have an account? <a href="/author/register">Click here to register an account</a></p> 
        </div>
    </div>
</div>
