<?php
    
    class Utilisateur{
        private $firstname;
        private $lastname;
        public const ABONNEMENT = 15;
        protected $data=[];
       
        
       
        public function __get($prop){
            
            if (in_array($prop,$this->data)){
                return $this->data[$prop];
            }else{
                ($prop==="lastname") ? $valeur= $this->lastname :(($prop==="firstname")?$valeur= $this->firstname: $valeur="propriété inexistante");   
        }
        return $valeur;
    }
    public function __set($prop, $valeur){
        if ($prop==="lastname") {
            $this->lastname=$valeur;
        }elseif($prop==="firstname"){ 
            $this->firstname=$valeur;
        }elseif(!array_key_exists($prop,$this->data)){
                $value= "propriété inexistante->création de la propriete dans la propriete tableau data";
                $this->data[$prop]=$valeur;
          } else{
            $value= "propriete deja existante dans le tableau-> mise à jour de la valeur";
            $this->data[$prop]= $valeur;
          }       
        (isset($value))? $valeur=$value:null;
        echo $valeur;
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
        private $valid_propriete= ["age","sexe","size"];
       
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
       
          if(in_array($property,$this->valid_propriete)) {
            return $this->valid_propriete[$property];
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
       
          if (in_array($property,$this->valid_propriete)) {
            $this->valid_propriete[$property] = $value;  
          } else {
            throw new Exception('Propriété ou valeur invalide !');
          }
        }
      }


class PropertyTest
{
    /**  Variable pour les données surchargées.  */
    private $data = array();

    /**  La surcharge n'est pas utilisée sur les propriétés déclarées.  */
    public $declared = 1;

    /**  La surcharge n'est lancée que lorsque l'on accède à cette propriété depuis l'extérieur de la classe.  */
    private $hidden = 2;

    public function __set($name, $value)
    {
        echo "Définition de '$name' à la valeur '$value'\n";
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        echo "Récupération de '$name'\n";
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        $trace = debug_backtrace();
        trigger_error(
            'Propriété non-définie via __get() : ' . $name .
            ' dans ' . $trace[0]['file'] .
            ' à la ligne ' . $trace[0]['line'],
            E_USER_NOTICE);
        return null;
    }

    public function __isset($name)
    {
        echo "Est-ce que '$name' est défini ?\n";
        return isset($this->data[$name]);
    }

    public function __unset($name)
    {
        echo "Effacement de '$name'\n";
        unset($this->data[$name]);
    }

    /**  Ce n'est pas une méthode magique, nécessaire ici que pour l'exemple.  */
    public function getHidden()
    {
        return $this->hidden;
    }
}