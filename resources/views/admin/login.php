<?php
use Atom\Http\Globals;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Atom</title>
    <link rel="stylesheet" href="<?= assets('/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= assets('/css/styles.css') ?>">
</head>
<body id="">
    <div id="content">
        <div class="list">
            <form action="<?= url('admin') ?>" method="post">
                <fieldset>
                    <legend>Sign in</legend>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <?= Globals::session('error') ?>
                </fieldset>
            </form>    
        </div>
    </div>
</body>
</html>
