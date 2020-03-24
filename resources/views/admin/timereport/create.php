<?php
use App\Common\WebForm;
use App\Libraries\CURL;
use Atom\Http\Response;

//List all workplaces
$url = config('define.workplace.api.list_all');
$header = config('define.workplace.header');
$workplaces = (new CURL())->callApiByGet($url, $header);
WebForm::checkError($workplaces);
?>
    <div id="content">
        <div>
            <form>
                <table>
                    <tr>
                        <td>Date:</td>
                        <td>
                            <?= WebForm::selectYear('year'); ?>
                            <?= WebForm::selectMonth('month'); ?>
                            <?= WebForm::selectDay('day'); ?>
                            <?php echo $errors['fullname'][0]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Hours:</td>
                        <td>
                            <input type="text" name="hours" id="hours" placeholder="Enter hours">
                            <?php echo $errors['hours'][0]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Workplace:</td>
                        <td>
                            <?= WebForm::selectWorkplace('workplace_id', $workplaces); ?>
                            <?php echo $errors['workplace_id'][0]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Information:</td>
                        <td>
                            <textarea name="info" id="info"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Image:</td>
                        <td><input type="file" name="image" id="image"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="button" name="create" id="create" value="Create">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <span class="status"></span>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
