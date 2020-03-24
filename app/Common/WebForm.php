<?php

namespace App\Common;

use Atom\Http\Globals;
use Atom\File\Log;

class WebForm extends Globals
{
    /**
     * Generate Radio Gender
     * @param  string|null $checkedValue
     * @return string
     */
    public static function radioGender(string $checkedValue = null)
    {
        $gender = ["Male" => "male", "Female" => "female", "Other" => "other"];
        $form = "";
        foreach ($gender as $key => $value) {
            $checked = $checkedValue == $value ? 'checked' : '';
            $form .= '
                <input type="radio" id="'.$value.'" name="gender" value="'.$value.'" '.$checked.'>
                <label for="male">'.$key.'</label><br>';
        }
        return $form;
    }

    /**
     * Generate Select Workplace
     * @param  string $name
     * @param  array $data
     * @param  mixed $selected
     * @return string
     */
    protected function selectWorkplace($name, $data, $selected = null)
    {
        $select = '<select name="'.$name.'" id="'.$name.'"><option value="">--Select One--</option>';
        foreach ($data as $workplace) {
            $selected = $selected == $workplace["id"] ? 'selected' : '';
            $select .= '<option value="'.$workplace["id"].'" '.$selected.'>'.$workplace["name"].'</option>';
        }
        $select .=  '</select>';
        return $select;
    }

    /**
     * Generate Select Year
     * @param  string $name
     * @param  mixed $selected
     * @return string
     */
    protected function selectYear($name, $selected = null)
    {
        $yearRange = range(config('define.year.start'), config('define.year.end'));
        $select = '<select name="'.$name.'" id="'.$name.'"><option value="">--Select--</option>';
        foreach ($yearRange as $year) {
            $selected = $selected == $year ? 'selected' : '';
            $select .= '<option value="'.$year.'" '.$selected.'>'.$year.'</option>';
        }
        $select .=  '</select>';
        return $select;
    }

    /**
     * Generate Select Month
     * @param  string $name
     * @param  mixed $selected
     * @return string
     */
    protected function selectMonth($name, $selected = null)
    {
        $monthRange = range(1, 12);
        $select = '<select name="'.$name.'" id="'.$name.'"><option value="">--Select--</option>';
        foreach ($monthRange as $month) {
            $selected = $selected == $month ? 'selected' : '';
            $select .= '<option value="'.$month.'" '.$selected.'>'.$month.'</option>';
        }
        $select .=  '</select>';
        return $select;
    }

    /**
     * Generate Select Month
     * @param  string $name
     * @param  mixed $selected
     * @return string
     */
    protected function selectDay($name, $selected = null)
    {
        $dayRange = range(1, 31);
        $select = '<select name="'.$name.'" id="'.$name.'"><option value="">--Select--</option>';
        foreach ($dayRange as $day) {
            $selected = $selected == $day ? 'selected' : '';
            $select .= '<option value="'.$day.'" '.$selected.'>'.$day.'</option>';
        }
        $select .=  '</select>';
        return $select;
    }

    /**
     * Show time reports table
     * @param  array $data
     * @param  array $workplaces
     * @return string
     */
    protected function showTimereportsTable($data, $workplaces)
    {
        $workplaceIds = array_column($workplaces, 'id');
        $table = '<table border="1"><tr><th>Date</th><th>Workplace name</th><th>Hours</th></tr>';
        foreach ($data as $value) {
            $index = array_search($value["workplace_id"], $workplaceIds); 
            $table .= '<tr>
                    <td>'.$value["date"].'</td>
                    <td>'.$workplaces[$index]['name'].'</td>
                    <td>'.$value["hours"].'</td>
                </tr>';
        }
        $table .= '</table>';

        return $table;
    }

    /**
     * Check Error 
     * @param  array $data
     * @return Exception
     */
    protected function checkError($data)
    {
        if (isset($data["code"]) && isset($data["message"])) {
            throw new \Exception('<h3>Error Code: '.$data["code"].'</h3><h3>Error Message: '.$data["message"].'</h3>');
        }
        return;
    }
}
