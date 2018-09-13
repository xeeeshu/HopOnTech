<?php
class Udcmodel extends CI_Model {
 public function create($entity){ 
   $query = $this->db->insert($entity['Table'],$entity['Value']);
   if ($query) {
    return $this->db->insert_id();
    }
    else {
      return false;
    }      
  }
  public function change($entity){
    $query = $this->db->replace($entity['Table'],$entity['Value']);
    if ($query) {
      return true;
    }
    else {
      return false;
    }      
  }
  public function update($entity){
    $this->db->where($entity['Primary_Key'],$entity['Primary_Value']);
    $this->db->update($entity['Table'],$entity['Values']);
    if ($this->db->affected_rows()) {
      return true;
    }
    else {
      return false;
    }      
  } 
  public function delete($entity){
    $query = $this->db->where($entity['Key'],(int)$entity['Value'])->delete($entity['Table']);
    if ($this->db->affected_rows()) {
      return true;
    }
    else {
      return false;
    }      
  }
}
?>