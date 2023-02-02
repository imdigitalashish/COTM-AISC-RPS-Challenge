<?php

header("Content-Type: json");
header('Access-Control-Allow-Origin: *');

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

    function add_item_to_list($name, $win, $lose)
    {
        $name_exist = false;
        $index_at_exists = 0;
        // return $this->curr_data;
        foreach ($this->curr_data as $key => $value) {
            if ($value->name == $name) {
                $name_exist = true;
                $index_at_exists = $key;
            }
        }

        if ($name_exist) {
            $this->curr_data[$index_at_exists]->win = $win;
            $this->curr_data[$index_at_exists]->lose = $lose;
            file_put_contents("./logs.json", json_encode($this->curr_data));
        }

        if ($name_exist == false) {
            $new_data = ["name" => $name, "win" => $win, "lose" => $lose];
            array_push($this->curr_data, $new_data);
            file_put_contents("./logs.json", json_encode($this->curr_data));
        }

        echo json_encode(array("response" => "operation successfull"));
    }
}

$requestData = json_decode(json_encode(file_get_contents("php://input")));
$app = new Application();
$app->handle_routes(json_decode($requestData, true));
