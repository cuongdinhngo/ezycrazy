<?php
use App\Common\WebForm;
?>
    <div id="content">
        <div class="list">
            <form action="<?= url('user/create') ?>" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Add new User</legend>
                    <div class="form-group">
                        <label for="">Fullname</label>
                        <input type="text" class="form-control" name="fullname" placeholder="Enter Fullname" value="<?= $old['fullname']?>">
                        <?php echo $errors['fullname'][0]; ?>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter email" value="<?= $old['email']?>">
                        <?php echo $errors['email'][0]; ?>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password" value="<?= $old['password']?>">
                        <?php echo $errors['password'][0]; ?>
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <input type="file" class="form-control-file" name="photo">
                        <?php echo $errors['photo'][0]; ?>
                    </div>
                    <div class="form-group">
                        <label for="photo">Gender</label>
                        <div class="form-check">
                            <?php 
                                echo WebForm::radioGender($gender);
                                echo $errors['gender'][0];
                            ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </fieldset>
            </form>    
        </div>
    </div>
