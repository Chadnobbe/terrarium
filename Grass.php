<?php

class Grass{
    private $size = 1;
    private $maxSize = 3;
    private $reproduceSize = 3;
    private $growthRate = 1;
    private $locationX;
    private $locationY;
    private $locationZ;
    
    public function __constructor(){
        $this->size = $size;
        $this->maxSize = $maxSize;
        $this->reproduceSize = $reproduceSize;
        $this->growthRate = $growthRate;
    }
    
    // getters
    
    public function getSize(){
        return $this->size;
    }
    
    
    // The individual getx.y.z system works but I don't like it. Ideally would find a replacement.
    public function getX(){
        return $this->locationX;
    }
    
    public function getY(){
        return $this->locationY;
    }
    
    public function getZ(){
        return $this->locationZ;
    }
    
    // setters
    
    public function setLocation($location){
        $this->location = $location;
    }
    
    public function setX($location){
        $this->locationX = $location;
    }
    
    public function setY($location){
        $this->locationY = $location;
    }
    
    public function setZ($location){
        $this->locationZ = $location;
    }
    
    
    // BRAIN
    
    public function tick(){
        $this->grow();
    }
    
    
    //methods
    
    public function grow(){
        //echo "Growing";
        if($this->size < $this->maxSize){
            
            $this->size = $this->size + $this->growthRate;

        }
        
        if($this->size >= $this->reproduceSize){
            
            $this->reproduce();
            
        }
        
    }
    
    public function reproduce(){
        global $map; // Need to change this, not good usage
        global $mapSize;
        
/*
[0] ->[0][1][2][3]
[1] ->[0][1][2][3]
[2] ->[0][1][2][3]
[3] ->[0][1][2][3]
*/

// This whole system works but strikes me as obtuse and kinda dumb. But bird in the hand is worth two in the bush and all that

        //Covers left and right || -X and +X
        if(($this->locationX != 0 || 3)){
            
            // -X
            if(($this->locationX - 1 > -1) && (!is_a($map[$this->locationY][$this->locationX - 1][$this->locationZ], 'Grass'))){
                $map[$this->locationY][$this->locationX - 1][$this->locationZ] = (new Grass);
                $map[$this->locationY][$this->locationX - 1][$this->locationZ]->setX($this->locationY);
                $map[$this->locationY][$this->locationX - 1][$this->locationZ]->setY($this->locationX - 1);
                $map[$this->locationY][$this->locationX - 1][$this->locationZ]->setZ($this->locationZ);
                
                $this->size = 0;

            } // +X
            elseif( ($this->locationX + 1 < 4) && (!is_a($map[$this->locationY][$this->locationX + 1][$this->locationZ], 'Grass'))){
                $map[$this->locationY][$this->locationX + 1][$this->locationZ] = (new Grass);
                $map[$this->locationY][$this->locationX + 1][$this->locationZ]->setX($this->locationY);
                $map[$this->locationY][$this->locationX + 1][$this->locationZ]->setY($this->locationX + 1);
                $map[$this->locationY][$this->locationX + 1][$this->locationZ]->setZ($this->locationZ);
                
                $this->size = 0;
            }// -Y
            elseif(($this->locationY - 1 > -1) && (!is_a($map[$this->locationY - 1][$this->locationX][$this->locationZ], 'Grass'))){
                $map[$this->locationY - 1][$this->locationX][$this->locationZ] = (new Grass);
                $map[$this->locationY - 1][$this->locationX][$this->locationZ]->setX($this->locationY - 1);
                $map[$this->locationY - 1][$this->locationX][$this->locationZ]->setY($this->locationX);
                $map[$this->locationY - 1][$this->locationX][$this->locationZ]->setZ($this->locationZ);
                
                $this->size = 0;
            }// + y
            elseif(($this->locationY + 1 < 4) && (!is_a($map[$this->locationY + 1][$this->locationX][$this->locationZ], 'Grass'))){
                $map[$this->locationY + 1][$this->locationX][$this->locationZ] = (new Grass);
                $map[$this->locationY + 1][$this->locationX][$this->locationZ]->setX($this->locationY + 1);
                $map[$this->locationY + 1][$this->locationX][$this->locationZ]->setY($this->locationX);
                $map[$this->locationY + 1][$this->locationX][$this->locationZ]->setZ($this->locationZ);
                
                $this->size = 0;
            }
            
        // covers up and down || -Y and +Y  when forced by a lateral move
        }
        else{
            
            if($this->locationX = 0){
                // left -1 X
                if(($this->locationY - 1 > -1) && (!is_a($map[$this->locationY - 1][$this->locationX + 3][$this->locationZ], 'Grass'))){
                    $map[$this->locationY - 1][$this->locationX + 3][$this->locationZ] = (new Grass);
                    $map[$this->locationY - 1][$this->locationX + 3][$this->locationZ]->setX($this->locationY - 1);
                    $map[$this->locationY - 1][$this->locationX + 3][$this->locationZ]->setY($this->locationX + 3);
                    $map[$this->locationY - 1][$this->locationX + 3][$this->locationZ]->setZ($this->locationZ);
                
                    $this->size = 0;
                    
                // up one Y
                }elseif(($this->locationY - 1 > -1) && (!is_a($map[$this->locationY - 1][$this->locationX][$this->locationZ], 'Grass'))){
                     $map[$this->locationY - 1][$this->locationX][$this->locationZ] = (new Grass);
                    $map[$this->locationY - 1][$this->locationX][$this->locationZ]->setX($this->locationY - 1);
                    $map[$this->locationY - 1][$this->locationX][$this->locationZ]->setY($this->locationX);
                    $map[$this->locationY - 1][$this->locationX][$this->locationZ]->setZ($this->locationZ);
                
                    $this->size = 0;
                }// down one y
                elseif(($this->locationY + 1 < 4) && (!is_a($map[$this->locationY + 1][$this->locationX][$this->locationZ], 'Grass'))){
                     $map[$this->locationY + 1][$this->locationX][$this->locationZ] = (new Grass);
                    $map[$this->locationY + 1][$this->locationX][$this->locationZ]->setX($this->locationY + 1);
                    $map[$this->locationY + 1][$this->locationX][$this->locationZ]->setY($this->locationX);
                    $map[$this->locationY + 1][$this->locationX][$this->locationZ]->setZ($this->locationZ);
                
                    $this->size = 0;
                } // right +1 x
                elseif((!is_a($map[$this->locationY][$this->locationX + 1][$this->locationZ], 'Grass'))){
                     $map[$this->locationY][$this->locationX + 1][$this->locationZ] = (new Grass);
                    $map[$this->locationY][$this->locationX + 1][$this->locationZ]->setX($this->locationY);
                    $map[$this->locationY][$this->locationX + 1][$this->locationZ]->setY($this->locationX + 1);
                    $map[$this->locationY][$this->locationX + 1][$this->locationZ]->setZ($this->locationZ);
                
                    $this->size = 0;
                }
                
                
            }
            elseif($this->locationX = 3){
                
                 // left -1 X
                if((!is_a($map[$this->locationY][$this->locationX - 1][$this->locationZ], 'Grass'))){
                    $map[$this->locationY - 1][$this->locationX - 1][$this->locationZ] = (new Grass);
                    $map[$this->locationY - 1][$this->locationX - 1][$this->locationZ]->setX($this->locationY);
                    $map[$this->locationY - 1][$this->locationX - 1][$this->locationZ]->setY($this->locationX - 1);
                    $map[$this->locationY - 1][$this->locationX - 1][$this->locationZ]->setZ($this->locationZ);
                
                    $this->size = 0;
                    
                // up one Y
                }elseif(($this->locationY - 1 > -1) && (!is_a($map[$this->locationY - 1][$this->locationX][$this->locationZ], 'Grass'))){
                     $map[$this->locationY - 1][$this->locationX][$this->locationZ] = (new Grass);
                    $map[$this->locationY - 1][$this->locationX][$this->locationZ]->setX($this->locationY - 1);
                    $map[$this->locationY - 1][$this->locationX][$this->locationZ]->setY($this->locationX);
                    $map[$this->locationY - 1][$this->locationX][$this->locationZ]->setZ($this->locationZ);
                
                    $this->size = 0;
                }// down one y
                elseif(($this->locationY + 1 < 4) && (!is_a($map[$this->locationY + 1][$this->locationX][$this->locationZ], 'Grass'))){
                     $map[$this->locationY + 1][$this->locationX][$this->locationZ] = (new Grass);
                    $map[$this->locationY + 1][$this->locationX][$this->locationZ]->setX($this->locationY + 1);
                    $map[$this->locationY + 1][$this->locationX][$this->locationZ]->setY($this->locationX);
                    $map[$this->locationY + 1][$this->locationX][$this->locationZ]->setZ($this->locationZ);
                
                    $this->size = 0;
                } // right +1 x
                elseif(($this->locationY + 1 < 4) && (!is_a($map[$this->locationY + 1][$this->locationX - 3][$this->locationZ], 'Grass'))){
                    $map[$this->locationY + 1][$this->locationX - 3][$this->locationZ] = (new Grass);
                    $map[$this->locationY + 1][$this->locationX - 3][$this->locationZ]->setX($this->locationY + 1);
                    $map[$this->locationY + 1][$this->locationX - 3][$this->locationZ]->setY($this->locationX - 3);
                    $map[$this->locationY + 1][$this->locationX - 3][$this->locationZ]->setZ($this->locationZ);
                
                    $this->size = 0;
                }
                
            }
        }

        
        
    }
}