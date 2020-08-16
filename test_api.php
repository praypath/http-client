<?php
class Test{

    //protected $test_data;

    //Return GET Request data
    public function getData(){
        return $_GET;
    }

    //Return Post Request Data
    public function getPostData($content_type){
        if($content_type == "application/json"){
            $output = file_get_contents('php://input' );
            $result_array = $this->parseJson($output);
            return $result_array;
        } else {
            return $_POST;
        }
    }

    public function parseJson($output){
        $output = str_replace(array('{', '}'), "", $output);
        $output = explode(",\n", $output);
        $result_array=array();
        for($i=0; $i<count($output); $i++){
            $string = explode(':"', $output[$i]);
            $key = str_replace('"', "", $string[0]);
            $result_array[$key] = str_replace('"', "", $string[1]);
        }
        return $result_array;
    }

    public function submitRepo($data){
        $api_url = 'https://www.coredna.com/assessment-endpoint.php';
    }


}


$obj = new Test();
$output = null;
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $output = $obj->getData();
} elseif($_SERVER['REQUEST_METHOD'] == 'POST'){
    $content_type = $_SERVER['CONTENT_TYPE'];
    $output = $obj->getPostData($content_type);
}

var_dump($output);