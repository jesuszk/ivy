<?php

namespace src\requests;


class HabitStoreRequest extends Request
{
    protected array $rules = [
        "habit_title" => "required",
        "habit_desc" => "required",
        "habit_time" => "required",
        "habit_days" => "required"
    ];



    function getStore()
    {
        $get = $this->get();
        
        $data["title"] = $get["habit_title"];
        $data["resume"] = $get["habit_desc"];
        $data["hour_day"] = $get["habit_time"];
        $data["days_of_week"] = json_encode($get["habit_days"]);

        return $data;
    }
}
