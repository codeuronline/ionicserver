<?php
    class Found {

        //private $aProp =["title","price","description","categorie"]; 
        private $donnee =["status","description","date","location","firstname","lastname","email"]; 
     
       
        public function __get($prop){
          if (in_array($prop,$this->donnee)){return $this->donnee[$prop];}
        }
        public function __set($prop, $valeur){
          if(in_array($prop,$this->donnee)){

             $this->donnee[$prop]= $valeur;
          
          
            }
          }
        public function getTypeToPDO($valeur){          
        $aType=null;
        switch(gettype($valeur)){
            case "integer":$aType=PDO::PARAM_INT;break;
            case "string" :$aType=PDO::PARAM_STR; break;
            case "boolean": $aType=PDO::PARAM_BOOL;break;
          } return $aType;
        }
    
       
        
      
      }
    

//     class Kid {
 
//         /**
//          * Age du kid
//          *
//          * @var int
//          * @access private
//          */
//         private $age;
       
//         /**
//          * Methode magique __get()
//          *
//          * Retourne la valeur de la propriété appelée
//          *
//          * @param string $property
//          * @return int $age
//          * @throws Exception
//          */
//         public function __get($property) {
       
//           if('age' === $property) {
//             return $this->age;
//           } else {
//             throw new Exception('Propriété invalide !');
//           }
//         }
       
//         /**
//          * Methode magique __set()
//          *
//          * Fixe la valeur de la propriété appelée
//          *
//          * @param string $property
//          * @param mixed $value
//          * @return void
//          * @throws Exception
//          */
        
//         public function __set($property,$value) {
       
//           if('age' === $property && ctype_digit($value)) {
//             $this->age = (int) $value;  
//           } else {
//             throw new Exception('Propriété ou valeur invalide !');
//           }
//         }
//       }
// ?>