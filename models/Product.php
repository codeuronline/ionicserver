<?php 


require_once 'Database.php';


class Product extends Database{    
        private $id_product;
        private $code;
        private $description;
        private $price;
        private $category_id;
        private $statut_id;
        private $supplier_id;
        private $purchase_date;
        private $expiration_date;
        private $primary_visual;
        private $statut_name; // nom litteral du statut
        private $category_name; // nom de la categorie
        private $path='assets/';
        private $filename;
        private const EMPTY="empty.png";  
        
        public function __construct($data)
        {   extract($data);
            isset($category) ?   $category_id=$category      :   null;
            isset($status)   ?   $statut_id=$status          :   null;
            isset($statut)   ?   $statut_id=$name            :   null;  
            isset($supplier) ?   $supplier_id=$supplier      :   null;
            isset($purchase) ?   $purchase_date= $purchase   :   null;
            isset($expire)   ?   $expiration_date= $expire   :   null;
            // remplace les id par les noms respectifs
            // $statut_id=$statut_name;
            // $category_id =$category_name; 
            // $supplier_id=$supplier_name;
            isset($primary_visual) ? $primary_visual= $primary_visual:$primary_visual=self::EMPTY;
            $primary_visual=$path.$file_name;
            
            $this->id_product = $id_product;
            $this->code = $code;
            $this->description = $description;
            $this->price = $price;
            $this->category_id = $category_id;
            $this->statut_id = $statut_id;
            $this->supplier_id = $supplier_id;
            $this->purchase_date = $purchase_date;
            $this->expiration_date = $expiration_date;
            $this->primary_visual = $primary_visual;
            $this->category_name = $category_name;
            $this->statut_name = $statut_name;
            $this->path = "assets/";
            $this->file_name =$primary_visual;
           
        }


public function getId_product(){return $this->id_product;}
public function setId($id_product){$this->id_product = $id_product;return $this;}


public function getCode(){return $this->code;}
public function setCode($code){$this->code = $code;return $this;}


public function getDescription(){return $this->description;}
public function setDescription($description){$this->description = $description;return $this;}

public function getPrice(){return $this->price;}
public function setPrice($price){$this->price = $price;return $this;}


public function getCategory_id(){return $this->category_id;}
public function setCategory_id($category_id){$this->category_id = $category_id;return $this;}


public function getStatut_id(){return $this->statut_id;}
public function setStatut_id($statut_id){$this->statut_id = $statut_id;return $this;}


public function getSupplier_id(){return $this->supplier_id;}
public function setSupplier_id($supplier_id){$this->supplier_id = $supplier_id;return $this;}


public function getPurchase_date(){return $this->purchase_date;}
public function setPurchase_date($purchase_date){$this->purchase_date = $purchase_date;return $this;}


public function getExpiration_date(){return $this->expiration_date;}
public function setExpiration_date($expiration_date){$this->expiration_date = $expiration_date;return $this;}


public function getPrimary_visual(){return $this->primary_visual;}
public function setPrimary_visual($primary_visual){$this->primary_visual = $primary_visual;return $this;}

public function getCategory_name() { return $this->category_name; }
public function setCategory_name($category_name)  { $this->category_name = $category_name;return $this; }

public function getStatut_name() { return $this->statut_name; }
public function setStatut_name($statut_name) { $this->statut_name = $statut_name; return $this; }
}
?>