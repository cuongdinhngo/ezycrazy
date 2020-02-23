<?php

namespace App\Common;

class WebForm
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
}
