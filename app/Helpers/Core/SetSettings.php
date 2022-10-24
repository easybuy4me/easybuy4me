<?php

namespace App\Helpers\Core;

use App\Models\Setting;

class SetSettings{
    public function get()
    {
        $settings = Setting::all();
        $data = new \StdClass();


        foreach($settings as $row)
        {
            $value = json_decode($row->value);

            $data->{$row->key} = empty($value) ? $row->value : $value;

        }

        return $data;
    }
}
