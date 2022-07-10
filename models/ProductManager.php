<?php

require_once "Database.php";
require_once "Product.php";


class ProductManager extends Database{

    private $products;
        
        
    public function ajoutProduct($product){
        $this->products[] = $product;
    }
    
    public function getProducts(){
        return $this->products;
    }
    

    public function loadProductRequest($value){
        
        $req=  $this->getPDO()->prepare("SELECT *,category_name,statut_name,supplier_name,path,file_name FROM products 
        INNER JOIN category ON products.category_id=category.id
        INNER JOIN statut ON products.statut_id=statut.id
        INNER JOIN suppliers ON products.supplier_id=suppliers.id
        INNER JOIN assets ON products.primary_visual=assets.id
        WHERE products.category_id=$value");
        $req->execute();
        $mesProducts = $req->fetchAll(PDO::FETCH_ASSOC);
        $this->setProducts=[];
        error_log("***********************************************");
        error_log($value." correspondants a :".count($mesProducts));
        $req->closeCursor();
        foreach($mesProducts as $product){
            $this->ajoutProduct(new Product($product));
            
    }
    return $this->products;
    
    
}    

    public function chargementProducts(){
        $req = $this->getPDO()->prepare("SELECT *,category_name,statut_name,supplier_name,path,file_name FROM products 
        INNER JOIN category ON products.category_id=category.id
        INNER JOIN statut ON products.statut_id=statut.id
        INNER JOIN suppliers ON products.supplier_id=suppliers.id
        INNER JOIN assets ON products.primary_visual=assets.id
        ");
        
        $req->execute();
        $mesProducts = $req->fetchAll(PDO::FETCH_ASSOC);
         $req->closeCursor();
        foreach($mesProducts as $product){
            $this->ajoutProduct(new Product($product));
    }
    }


    public function getProductById($id){
        //on utilise la boucle for et on part de zero car c'est un tableau
        for ($i = 0; $i < count($this->products); $i++) {
            if ($this->products[$i]->getId_product() === $id) {
            return $this->products[$i];
                }
            }
    }

    public function dupliquerProductInBd($data,$id){
        extract($data);
        isset($status)   ?   $statut_id=$status          :   null;
        isset($statut)   ?   $statut_id=$statut          :   null;
        $req="INSERT INTO products 
        (code,description,price,category_id,statut_id,supplier_id,purchase_date,expiration_date,primary_visual)
          VALUES (:code,:description,:price,:category_id,:statut_id,:supplier_id,:purchase_date,:expiration_date,:primary_visual)
           ON DUPLICATE KEY UPDATE id_product = id_product+1";
        $stmt = $this->getPDO()->prepare($req);
        $stmt->bindValue(":code",$code,PDO::PARAM_STR);
        $stmt->bindValue(":description",$description,PDO::PARAM_STR);
        $stmt->bindValue(":price",$price,PDO::PARAM_INT);
        $stmt->bindValue(":category_id",$category_id,PDO::PARAM_INT);
        $stmt->bindValue(":statut_id",$statut_id,PDO::PARAM_INT);
        $stmt->bindValue(":supplier_id",$supplier_id,PDO::PARAM_INT);
        $stmt->bindValue(":purchase_date",$purchase_date,PDO::PARAM_STR);
        $stmt->bindValue(":expiration_date",$expiration_date,PDO::PARAM_STR);
        $stmt->bindValue(":primary_visual",$primary_visual,PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if($resultat > 0){
            $product = new Product($this->getPDO()->lastInsertId(), $data);
        $this->ajoutProduct($product);
         //   $this->UpdateLinkTable($data, $this->getPDO()->lastInserId());
                }
    }
        
    public function ajoutProductBd($data){
          extract($data);
          isset($status)   ?   $statut_id=$status          :   null;
          isset($statut)   ?   $statut_id=$statut          :   null;  
          $req = "INSERT INTO 
          products (code,description,price,category_id,statut_id,supplier_id,purchase_date,expiration_date,primary_visual) 
          values (:code,:description,:price,:category_id,:statut_id,:supplier_id,:purchase_date,:expiration_date,:primary_visual)";
          $stmt = $this->getPDO()->prepare($req);
               //$stmt->bindValue(":id_product",$id_product,PDO::PARAM_INT);
                $stmt->bindValue(":code",$code,PDO::PARAM_STR);
                $stmt->bindValue(":description",$description,PDO::PARAM_STR);
                $stmt->bindValue(":price",$price,PDO::PARAM_INT);
                $stmt->bindValue(":category_id",$category_id,PDO::PARAM_INT);
                $stmt->bindValue(":statut_id",$statut_id,PDO::PARAM_INT);
                $stmt->bindValue(":supplier_id",$supplier_id,PDO::PARAM_INT);
                $stmt->bindValue(":purchase_date",$purchase_date,PDO::PARAM_STR);
                $stmt->bindValue(":expiration_date",$expiration_date,PDO::PARAM_STR);
                $stmt->bindValue(":primary_visual",$primary_visual,PDO::PARAM_INT);
                $resultat = $stmt->execute();
                $stmt->closeCursor();
                if($resultat > 0){
                    $product = new Product($this->getPDO()->lastInsertId(),$data);
                    $this->ajoutProduct($product);
                }        
            }
        
            public function suppressionProductBD($id){
                $req = "DELETE FROM products WHERE id_product = :id_product";  
                $stmt = $this->getPDO()->prepare($req);  
                $stmt->bindValue(":id_product",$id,PDO::PARAM_INT);  
                $resultat = $stmt->execute();   
                $stmt->closeCursor();  
                if($resultat > 0){
                    $product = $this->getProductById($id);
                    unset($product);  
                }    
            }
        
            public function modificationProductRequest($id_product,$statut_id){
                $req = "UPDATE products SET 
                statut_id = :statut_id WHERE id_product = :id_product";      
                $stmt = $this->getPDO()->prepare($req); 
                $stmt->bindValue(":id_product",$id_product,PDO::PARAM_INT);
                $stmt->bindValue(":statut_id",$statut_id,PDO::PARAM_INT);
                $resultat = $stmt->execute();      
                $stmt->closeCursor();
        
                if($resultat > 0){    
                $this->getPDO();
                $stmt->bindValue(":id_product",$id_product,PDO::PARAM_INT);
                $stmt->bindValue(":statut_id",$statut_id,PDO::PARAM_INT);
                
                $this->getProductById($id_product)->setStatut_id($statut_id);
                }   
            }
        
            public function modificationProductRequestBd($id,$element){
                
                $req = "UPDATE products SET 
                products statut_id =:statut_id WHERE id_product = :id_product";      
                
                $stmt = $this->getPDO()->prepare($req); 
                $stmt->bindValue(":id_product",$id,PDO::PARAM_INT);
                $stmt->bindValue(":statut_id",$element,PDO::PARAM_INT);
                $resultat = $stmt->execute();      
                $stmt->closeCursor();
        
                if($resultat > 0){    
                $this->getPDO();
                $stmt->bindValue(":id_product",$id,PDO::PARAM_INT);
                $stmt->bindValue(":statut_id",$element,PDO::PARAM_INT);
                $this->getProductById($id)->setId_product($id);    
                $this->getProductById($id)->setStatut_id($element);
                
                }   
            }
        
            public function modificationProductBd($data,$id){
                extract($data);
                $req = "UPDATE products SET 
                products (id_product,code,description,price,category_id,statut_id,supplier_id,purchase_date,expiration_date,primary_visual)
                values (:id_product,:code,:description,:price,category_id,:statut_id,:supplier_id,:purchase_date,:expiration_date,:primary_visual) WHERE id_product = :id_product";      
                
                $stmt = $this->getPDO()->prepare($req); 
                $stmt->bindValue(":id_product",$id,PDO::PARAM_INT);
                $stmt->bindValue(":code",$code,PDO::PARAM_STR);
                $stmt->bindValue(":description",$description,PDO::PARAM_STR);
                $stmt->bindValue(":price",$price,PDO::PARAM_INT);
                $stmt->bindValue(":category_id",$category_id,PDO::PARAM_INT);
                $stmt->bindValue(":statut_id",$statut_id,PDO::PARAM_INT);
                $stmt->bindValue(":supplier_id",$supplier_id,PDO::PARAM_INT);
                $stmt->bindValue(":purchase_date",$purchase_date,PDO::PARAM_STR);
                $stmt->bindValue(":expiration_date",$expiration_date,PDO::PARAM_STR);
                $stmt->bindValue(":primary_visual",$primary_visual,PDO::PARAM_INT);  
                $resultat = $stmt->execute();      
                $stmt->closeCursor();
        
                if($resultat > 0){    
                $this->getPDO();
                $stmt->bindValue(":id_product",$id_product,PDO::PARAM_INT);
                $stmt->bindValue(":code",$code,PDO::PARAM_STR);
                $stmt->bindValue(":description",$description,PDO::PARAM_STR);
                $stmt->bindValue(":price",$price,PDO::PARAM_INT);
                $stmt->bindValue(":category_id",$category_id,PDO::PARAM_INT);
                $stmt->bindValue(":statut_id",$statut_id,PDO::PARAM_INT);
                $stmt->bindValue(":supplier_id",$supplier_id,PDO::PARAM_INT);
                $stmt->bindValue(":purchase_date",$purchase_date,PDO::PARAM_STR);
                $stmt->bindValue(":expiration_date",$expiration_date,PDO::PARAM_STR);
                $stmt->bindValue(":primary_visual",$primary_visual,PDO::PARAM_INT);
                
                $this->getProductById($id)->setId_product($id_product);    
                $this->getProductById($id)->setCode($code);    
                $this->getProductById($id)->setDescription($description);
                $this->getProductById($id)->setPrice($price);
                $this->getProductById($id)->setCategory_id($category_id);
                $this->getProductById($id)->setStatut_id($statut_id);
                $this->getProductById($id)->setSupplier_id($supplier_id);
                $this->getProductById($id)->setPurchase_date($purchase_date);
                $this->getProductById($id)->setExpiration_date($expiration_date);
                $this->getProductById($id)->setPrimary_visual($primary_visual);
                }   
            }
            // $data est compose  
            //pour chaque enrgistrement 
            // d'un Index/nom(code)/description/prix(float)/catégorie/statut(code_statut)/fournisseur(nom fournisseur)/date d'achat(format excel)/date de péremption(format excel)/visuel principal

            function  UpdateLinkTable($id_product,$data){
                extract($data);
                // recherche de lien avec assets
                if (isset($assets_name)){
            // asset_name definit -> devient le primary visual
            // si le nom du visuel existe dans la table asset et on recupere sont id sinon on l'insere dans la table asset 
            // on crere la liaison pour ce produit avec id de la table asset existant/on creer
            $req = "INSERT INTO product_asset(product_id,assets_id,primary_flag) VALUES(?,?,?)
                 WHERE assets_id = 
                        (SELECT id FROM assets WHERE asset_name LIKE '%$asset_name%'  LIMIT 1)";
            $stmt = $this->getPDO()->prepare($req); 
            // $stmt->bindValue(":id_product",$id_product,PDO::PARAM_INT);  
            // $stmt->bindValue(":assets_id",$asset_id,PDO::PARAM_INT);                    
            $stmt->execute([$id_product,$assets_id,1]);
            }
                
                if (isset($category_id)){ echo "traitement de la catégorie";
            $req = "INSERT INTO product_category(product_id,category_id) VALUES(?,category_id)
                     WHERE category_id=
                     (SELECT id from category WHERE category_name LIKE '%$category_name%' LIMIT 1)";
            $stmt = $tis->getPDO()->prepare($req);
            $stmt->execute([$product_id]);
                    
                    // category_id definit
                    // recherche de lien avec category
                    // si elle existe -> on la met a jour sinon 
                    // on   cree la liaison avec ce produit
                }
                // recherche de lien avec supplier
                if (isset($supplier_name)){}
                //recherche du fournisseur dans la bd
                    //si existe pas on le creer dans la bd
                
                    // recherche de lien avec le fournisseur si existe pas on le creer
            }
           
            

 
public function setProducts($products)
    {
        $this->products = $products;

        return $this;
    }
        }