<?php
    
    class Utilisateur{
        protected $user_name;
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


echo "<pre>\n";

$obj = new PropertyTest;

$obj->a = 1;
echo $obj->a . "\n\n";

var_dump(isset($obj->a));
unset($obj->a);
var_dump(isset($obj->a));
echo "\n";

echo $obj->declared . "\n\n";

echo "Manipulons maintenant la propriété privée nommée 'hidden' :\n";
echo "'hidden' est visible depuis la classe, donc __get() n'est pas utilisée...\n";
echo $obj->getHidden() . "\n";
echo "'hidden' n'est pas visible en dehors de la classe, donc __get() est utilisée...\n";
echo $obj->hidden . "\n";
?>