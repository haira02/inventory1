<?php
@require_once('database.php');

class Outgoing {
  
  protected static $table_name="outgoing";
  protected static $db_fields = array('id', 'date', 'customer_name', 'invoice_no', 'i_code', 'amount', 'price');
  
  public $id;
  public $date;
  public $customer_name;
  public $invoice_no;
  public $i_code;
  public $amount;
  public $price;
  
  public static function make($details) {
    if(!empty($details)) {
      $outgoing  = new Outgoing ();
      foreach($details as $attribute=>$value){
      if($outgoing ->has_attribute($attribute)) {
        $outgoing ->$attribute = $value;
      }
    }
      return $outgoing ;
    } else {
      return false;
    }
  }
  
  // Common Database Methods
  public static function find_all() {
    return self::find_by_sql("SELECT * FROM ".self::$table_name);
  }

  public static function find_by_id($id=0) {
    $result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE id={$id} LIMIT 1");
    return !empty($result_array) ? array_shift($result_array) : false;
  }

  public static function find_by_in($id=0) {
    $result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE invoice_no={$id} LIMIT 1");
    return !empty($result_array) ? true : false;
  }
  
  public static function find_by_sql($sql="") {
    global $database;
    $result_set = $database->query($sql);
    $object_array = array();
    while ($row = $database->fetch_array($result_set)) {
      $object_array[] = self::instantiate($row);
    }
    return $object_array;
  }

  private static function instantiate($record) {
    // Could check that $record exists and is an array
    $object = new self;
    
    // More dynamic, short-form approach:
    foreach($record as $attribute=>$value){
      if($object->has_attribute($attribute)) {
        $object->$attribute = $value;
      }
    }
    return $object;
  }
  
  private function has_attribute($attribute) {
    // We don't care about the value, we just want to know if the key exists
    // Will return true or false
    return array_key_exists($attribute, $this->attributes());
  }

  protected function attributes() { 
    // return an array of attribute names and their values
    $attributes = array();
    foreach(self::$db_fields as $field) {
      if(property_exists($this, $field)) {
        $attributes[$field] = $this->$field;
      }
    }
    return $attributes;
  }
  
  protected function sanitized_attributes() {
    global $database;
    $clean_attributes = array();
    // sanitize the values before submitting
    // Note: does not alter the actual value of each attribute
    foreach($this->attributes() as $key => $value){
      $clean_attributes[$key] = $database->escape_value($value);
    }
    return $clean_attributes;
  }
  
  public function save() {
    // A new record won't have an id yet.
    return isset($this->id) ? $this->update() : $this->create();
  }
  
  public function create() {
    global $database;
    $attributes = $this->sanitized_attributes();
    $sql = "INSERT INTO ".self::$table_name." (";
    $sql .= join(", ", array_keys($attributes));
    $sql .= ") VALUES ('";
    $sql .= join("', '", array_values($attributes));
    $sql .= "')";
    if($database->query($sql)) {
      $this->id = $database->insert_id();
      return true;
    } else {
      return false;
    }
  }

  public function update() {
    global $database;
    $attributes = $this->sanitized_attributes();
    $attribute_pairs = array();
    foreach($attributes as $key => $value) {
      $attribute_pairs[] = "{$key}='{$value}'";
    }
    $sql = "UPDATE ".self::$table_name." SET ";
    $sql .= join(", ", $attribute_pairs);
    $sql .= " WHERE id=". $database->escape_value($this->id);
    $database->query($sql);
    return ($database->affected_rows() == 1) ? true : false;
  }

  public function delete() {
    global $database;
    $sql = "DELETE FROM ".self::$table_name;
    $sql .= " WHERE id=". $database->escape_value($this->id);
    $sql .= " LIMIT 1";
    $database->query($sql);
    return ($database->affected_rows() == 1) ? true : false;

  }

}

?>