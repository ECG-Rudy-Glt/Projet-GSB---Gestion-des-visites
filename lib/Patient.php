<?php

/**
 * @author Rudy GAULT
 * @company H2V Solutions
 * @created_at 2023-09-18 22:05:23
 * @updated_by Rudy GAULT
 * @updated_at 2023-09-18 22:05:24
 */

 namespace Ecole\GsbVisitsManager;
 
class Patient
 {
     private $name;
     private $age;
 
     public function __construct($name, $age)
     {
         $this->name = $name;
         $this->age = $age;
     }
 
     public function getName()
     {
         return $this->name;
     }
 
     public function getAge()
     {
         return $this->age;
     }
 }
