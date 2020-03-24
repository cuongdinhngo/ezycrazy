<?php
use App\Common\WebForm;
use App\Libraries\CURL;
use Atom\Http\Response;

//List all workplaces
$url = config('define.workplace.api.list_all');
$header = config('define.workplace.header');
$curl = new CURL();
$workplaces = $curl->callApiByGet($url, $header);
WebForm::checkError($workplaces);

?>
    <div id="content">
        <div>
            <form method="post" action="<?= url('timereport')?>">
                <table>
                    <tr>
                        <td>Workplace:</td>
                        <td>
                            <?= WebForm::selectWorkplace('workplace', $workplaces); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>From date:</td>
                        <td>
                            <?= WebForm::selectYear('fromYear'); ?>
                            <?= WebForm::selectMonth('fromMonth'); ?>
                            <?= WebForm::selectDay('fromDay'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>To date:</td>
                        <td>
                            <?= WebForm::selectYear('toYear'); ?>
                            <?= WebForm::selectMonth('toMonth'); ?>
                            <?= WebForm::selectDay('toDay'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="search" value="Search">
                        </td>
                    </tr>
                </table>
            </form>
            <?php
            if ($data) {
                WebForm::checkError($data);
                print_r(WebForm::showTimereportsTable($data, $workplaces));
            }
            ?>
        </div>
    </div>
