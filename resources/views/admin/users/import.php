<?php
use App\Common\WebForm;
?>
    <div id="content">
        <div class="list">
            <form action="<?= url('import-users') ?>" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Import User</legend>
                    <div class="form-group">
                        <label for="photo">CSV file</label>
                        <input type="file" class="form-control-file" name="file">
                        <?php echo $errors['photo'][0]; ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </fieldset>
            </form>    
        </div>
    </div>
