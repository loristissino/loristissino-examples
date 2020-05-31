<?php

function getValueFromArray($array, $key, $default="") {
    return isset($array[$key]) ? $array[$key] : $default;
}

header("Content-Type: application/json");

$data = getValueFromArray($_GET, 'data');

switch($data) {
    case 'ingredients':
        echo JSON_encode([
            [
                'id'=>'to',
                'name'=>'Tomato',
            ],
            [
                'id'=>'mc',
                'name'=>'Mozzarella Cheese',
            ],
            [
                'id'=>'or',
                'name'=>'Oregano',
            ],
            [
                'id'=>'gc',
                'name'=>'Gorgonzola Cheese',
            ],
            [
                'id'=>'tf',
                'name'=>'Tofu',
            ],
            [
                'id'=>'ma',
                'name'=>'Mashrooms',
            ],
            [
                'id'=>'ol',
                'name'=>'Olives',
            ],
            [
                'id'=>'ha',
                'name'=>'Prosciutto',
            ],
            [
                'id'=>'ar',
                'name'=>'Artichoke',
            ],
            [
                'id'=>'rc',
                'name'=>'Ricotta Cheese',
            ],
            [
                'id'=>'pc',
                'name'=>'Provolone Cheese',
            ],
            
        ]);
        break;
    case 'pizzas':
        echo JSON_encode([
            [
                'id'=>'001',
                'name'=>'Margherita',
                'ingredients' => [ 'to', 'mc', 'or'],
                'price' => 4.50,
            ],
            [
                'id'=>'006',
                'name'=>'Quattro formaggi',
                'ingredients' => [ 'to', 'mc', 'gc', 'rc', 'pc'],
                'price' => 5.50,
            ],
            [
                'id'=>'009',
                'name'=>'Quattro stagioni',
                'ingredients' => [ 'to', 'mc', 'ar', 'ma'],
                'price' => 6.00,
            ],
            [
                'id'=>'019',
                'name'=>'Bianca',
                'ingredients' => [ 'mc', 'or'],
                'price' => 4.00,
            ],
            [
                'id'=>'023',
                'name'=>'Vegana',
                'ingredients' => [ 'to', 'tf'],
                'price' => 5.00,
            ],
            [
                'id'=>'999',
                'name'=>'Impossible',
                'ingredients' => [ ],
                'price' => 99.00,
            ],
        ]);
        break;
    case 'orders':
        sleep(1);
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            $data = JSON_decode(file_get_contents('php://input'));
            if ($data!=999) {
                $result = [
                    'status'=>'accepted',
                    'id'=>rand(1000, 9000),
                    'data'=>$data,
                    'happened_at'=>time(),
                ];
            }
            else {
                $result = [
                    'status'=>'refused',
                    'message'=>'Impossible at the moment',
                    'id'=>0,
                    'data'=>$data,
                    'happened_at'=>time(),
                ];
            }
        }
        else {
            http_response_code(405); // method not allowed
            $result = [
                'status'=>'failed',
                'reason'=>'Not a valid method',
            ];
        }
        echo JSON_encode($result);
        break;
    default:
        echo JSON_encode([]);
} 

