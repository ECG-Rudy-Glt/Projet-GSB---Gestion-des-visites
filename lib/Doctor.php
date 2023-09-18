<?php

/**
 * @author Rudy GAULT
 * @company H2V Solutions
 * @created_at 2023-09-18 22:06:09
 * @updated_by Rudy GAULT
 * @updated_at 2023-09-18 22:06:09
 */

namespace Ecole\GsbVisitsManager;
 
 
 class Doctor
 {
     private $name;
     private $specialty;
 
     public function __construct($name, $specialty)
     {
         $this->name = $name;
         $this->specialty = $specialty;
     }
 
     public function getName()
     {
         return $this->name;
     }
 
     public function getSpecialty()
     {
         return $this->specialty;
     }
 }
 