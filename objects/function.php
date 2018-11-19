<?php
class Category{
 
    // database connection and table name
    private $conn;
    private $table_name = "categories";

     // object properties
    public $ID;
    public $name;

     public $password;
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
        
    }
    
    // read Category
function read(){
 
    // select all query
    $query = "SELECT * FROM " .$this->table_name; 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}

   // create category
function create(){ 
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                name=:name";

	// prepare query
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->name=htmlspecialchars(strip_tags($this->name));     
    
     // bind values
    $stmt->bindParam(":name", $this->name);          

    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;

}

// update the category
function update(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                name = :name
            WHERE
                id = :id";
 
   // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->id=htmlspecialchars(strip_tags($this->id));
 
    // bind new values
    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':id', $this->id);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
}

//delete category
function delete(){

	//delete query
	print_r($this);
	$query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

	 // prepare query statement
    $stmt = $this->conn->prepare($query);


      // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));

    // bind id of record to delete
    $stmt->bindParam(1, $this->id);

     // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
 
}

}
