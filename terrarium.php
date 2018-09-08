<?php


require Cow.php;
require Grass.php;

// GAME 
// 12
$map = array(
    array( // 0
        array(
            'flora' => '1',
            'fauna' => '1',
            'water' => '1',
            ),
        array(
            'flora' => '2',
            'fauna' => '2',
            'water' => '2',
            ),
        array(
            'flora' => '3',
            'fauna' => '3',
            'water' => '3',
            ),
        array(
            'flora' => '4',
            'fauna' => '4',
            'water' => '4',
            ),
        ),
    array( // 1
        array( // 0
            'flora' => '5',
            'fauna' => '6',
            'water' => '7',
            ),
        array( // 1
            'flora' => '8',
            'fauna' => '',
            'water' => '',
            ),
        array( // 2
            'flora' => '9',
            'fauna' => '',
            'water' => '',
            ),
        array(
            'flora' => '9',
            'fauna' => '',
            'water' => '',
            ),
        ),
    array( // 2
        array(
            'flora' => '11',
            'fauna' => '',
            'water' => '',
            ),
        array(
            'flora' => '12',
            'fauna' => '',
            'water' => '',
            ),
        array(
            'flora' => '13',
            'fauna' => '',
            'water' => '',
            ),
        array(
            'flora' => '14',
            'fauna' => '',
            'water' => '',
            ),
        ),
    array( // 3
        array(
            'flora' => '14',
            'fauna' => '',
            'water' => '',
            ),
        array(
            'flora' => '11',
            'fauna' => '',
            'water' => '',
            ),
        array(
            'flora' => '12',
            'fauna' => '',
            'water' => '',
            ),
        array(
            'flora' => '11',
            'fauna' => '',
            'water' => '',
            ),
        ),
    );
$mapSize = 16;

$grass = new Grass();
$grass2 = new Grass();
$grass3 = new Grass();
$november = 0;

$cow = new Cow();

$cow->setX(2);
$cow->setY(2);
$cow->setZ('fauna');

$map[2][2]['fauna'] = $cow;

$grass->setX(1);
$grass->setY(1);
$grass->setZ('flora');

$grass2->setX(3);
$grass2->setY(3);
$grass2->setZ('flora');

$grass3->setX(0);
$grass3->setY(0);
$grass3->setZ('flora');

$map[1][1]['flora'] = $grass;
$map[3][3]['flora'] = $grass2;
$map[0][0]['flora'] = $grass3;
                   

/* 

$map = array();

print_r($map);
$map[] = $grass;
$map[] = (new Cow);
$map[1]->setLocation(1);
$map[] = 4;
$map[] = (new Grass);
$map[3]->setLocation(3);
$map[] = 6;
$map[] = 7;

*/

// RUNS SIMULATION

while($november < 100){
    
    echo $november;
    
    foreach($map as $row){
        
        echo " Vesicant -> ";
        print_r($row);
        echo " <- MILK ";
        
        foreach($row as $square){
        
             

            try{
                
                if(method_exists($square['flora'], 'tick')){
                    $square['flora']->tick();
                }
                if(method_exists($square['fauna'], 'tick')){
                    $square['fauna']->tick();
                }
                if(method_exists($square['water'], 'tick')){
                    $square['water']->tick();
                }
    
            }
            catch(Exception $e){
                echo " No brain ";
           }
        
        }
    }
    
    $november++;
    echo "************************************************";
}


//$map[0-3][0-3]['flora']
/*
[0] ->[0][1][2][3]
[1] ->[0][1][2][3]
[2] ->[0][1][2][3]
[3] ->[0][1][2][3]
*/


/*

    // echo $november. ' NOVEMBER ';
    foreach($map as $square){
        try{
            if(method_exists($square, 'tick')){
                $square->tick();
                
                if(is_a($square, 'Cow')){
                     echo "COW here ".$square->getLocation()."  .";
                }
                elseif(is_a($square, 'Grass')){
                     echo "GRASS here ".$square->getLocation()."  .";
                }
              
                
            }
            else{
               // echo " || No grass ||";
            }
            
        }catch(Exception $e){
            echo " No brain ";
        }
    }
    $november++;
    echo "\r\n\n";
    echo " NEW TURN ";
        
}
*/
