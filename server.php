<?php

header("Content-Type: json");
header("Allow-Origin: *");

$curr_data = file_get_contents("./logs.json");
$curr_data = json_decode($curr_data);



class Application
{

    public $curr_data;

    function __construct()
    {
        $this->curr_data = json_decode(file_get_contents("./logs.json"));
    }

    function handle_routes($routeData)
    {
        if (array_key_exists("get_all", $routeData)) {
            echo $this->return_all_data();
        }

        if (array_key_exists("add", $routeData)) {
            echo $this->add_item_to_list($routeData["uname"], $routeData["win"], $routeData["lose"]);
        }
    }

    function return_all_data()
    {
        return json_encode(json_decode(file_get_contents("./logs.json")));
    }

    function add_item_to_list($name, $win, $loose)
    {
        $name_exist = false;
        // return $this->curr_data;
        foreach ($this->curr_data as $key => $value) {
           print_r($value);
        }
    }
}

$requestData = json_decode(json_encode(file_get_contents("php://input")));
$app = new Application();
$app->handle_routes(json_decode($requestData, true));
