<?php

class TaskController
{

    public function __construct(private TaskGateway $gateway)
    {
    }
    
    public function proccessRequest(string $method, ?string $id): void{ //the ? sets nullable the parameter

        if ($id === null){

            if($method == "GET"){
                echo "index";        
            }elseif($method == "POST"){
                echo "create";
            }else{
                $this->responseMethodNotAllowed(("GET, POST"));
            }
        }else{ //deal with an existing task (id)

            switch($method){

                case "GET":
                    echo "show $id";
                    break;
                case "PATCH":
                    echo "update $id";
                    break;
                case "DELETE":
                    echo "delete $id";
                    break;
                default:
                $this->responseMethodNotAllowed(("GET, PATCH, DELETE"));
            }

        }
        

    }
    private function responseMethodNotAllowed(string $allowed_methods):void {
        http_response_code(405);
        header("Allow: GET, POST");
    }

}