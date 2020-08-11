<?php
use Atom\Guard\Auth;

$user = Auth::user();
?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Atom</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= url('users')?>">User <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= url('timereport')?>">List Time reports</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= url('timereport/create')?>">Create Time reports</a>
                </li>
            </ul>
            <div class="form-inline my-2 my-lg-0">
                <?= 'Welcome '. $user['fullname'] ?>
            </div>
        </div>
    </nav>
