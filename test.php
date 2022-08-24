<?php
    class Utilisateur{
        private $user_name;
        protected $user_region;
        protected $prix_abo;
        protected $user_pass;
        public const ABONNEMENT = 15;
        
       
        
        public function getNom(){
            echo $this->user_name;
        }
        public function getPrixAbo(){
            echo $this->prix_abo;
        }
        
        public function __get($prop){
            echo '<br>Propriété ' .$prop. ' inaccessible.<br>';
        }
        public function __set($prop, $valeur){
            echo '<br>Impossible de mettre à jour la valeur de ' .$prop. ' avec "'
            .$valeur. '" (propriété inaccessible)<br>';
        }
    }
    class Kid {
 
        /**
         * Age du kid
         *
         * @var int
         * @access private
         */
        private $age;
       
        /**
         * Methode magique __get()
         *
         * Retourne la valeur de la propriété appelée
         *
         * @param string $property
         * @return int $age
         * @throws Exception
         */
        public function __get($property) {
       
          if('age' === $property) {
            return $this->age;
          } else {
            throw new Exception('Propriété invalide !');
          }
        }
       
        /**
         * Methode magique __set()
         *
         * Fixe la valeur de la propriété appelée
         *
         * @param string $property
         * @param mixed $value
         * @return void
         * @throws Exception
         */
        
        public function __set($property,$value) {
       
          if('age' === $property && ctype_digit($value)) {
            $this->age = (int) $value;  
          } else {
            throw new Exception('Propriété ou valeur invalide !');
          }
        }
      }
?>