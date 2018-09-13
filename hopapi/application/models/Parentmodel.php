<?php
class Parentmodel extends CI_Model {

  	public function loadParent($entity){
    	$this->db->select('*');
    	$this->db->from('parent_profile');
    	if($entity->UserId_FK > 0){
     	$query	= $this->db->where('UserId_FK',$entity->UserId_FK);
    	}
    	if($entity->Parent_Id != null){
      	$this->db->where('Parent_Id',$entity->Parent_Id);
    	}
      if ($entity->Parent_Type != null) {
        $this->db->where('Parent_Type',$entity->Parent_Type);
      }
      if ($entity->Community != null) {
        $this->db->where('Community',$entity->Community);
      }
    	$query = $this->db->get();
    	if ($query->num_rows() > 0) {
      	if($entity->isSingle != false){
        	return $query->row();
      	}
        else{
        return $query->result_object();
      }
    }
    else{
      return false;
    }
  }
  public function loadaddress($entity){
    $this->db->select('*');
    $this->db->from('address');
    $this->db->where('UserId_FK',$entity->Parent_Id);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      if ($entity->isSingle == true) {
        return $query->row();
      }
      else{
        return $query->result_object();
      }
    }
    else{
      return false;
    }
  }
  public function loadStudent($entity){
    $this->db->select('*');
    $this->db->from('student s');
    $this->db->join('student_school ss','ss.StudentId_FK = s.Student_Id','left outer');
    if ($entity->Student_Id != null) {
      $this->db->where('Student_Id',$entity->Student_Id);
    }
    if ($entity->ParentId_FK != null) {
      $this->db->where('ParentId_FK',$entity->ParentId_FK);
    }
    if ($entity->First_Name != null) {
      $this->db->where('Last_Name',$entity->First_Name);
    }
    if ($entity->First_Name != null) {
      $this->db->where('Last_Name',$entity->Last_Name);
    }
    if ($entity->Nick_Name != null) {
      $this->db->where('Nick_Name',$entity->Nick_Name);
    }
    $query = $this->db->get();
    if ($query->num_rows() > 0  ) {
       if ($query->num_rows() === 1) {
        return $query->row();
      }
       else{
        return $query->result_object();
      }
    }
    else{
      return 0;
    }
  }
  public function loadDriver($entity){
    $this->db->select('ds.*,CONCAT(s.First_Name," ",s.Last_Name) AS Student_Name,s.Student_Image,s.Health_Issue,s.Equipment_Required,dp.Driver_Id,dp.Phone_No,CONCAT(u.First_Name," ",u.Last_Name) as Driver_Name,u.Email as Driver_Email,u.Cell_Number as Driver_Cell,dp.Driver_Image ');
    $this->db->from('driver_shift ds');
    $this->db->join('driver_profile dp','dp.Driver_Id = ds.DriverId_FK');
    $this->db->join('student s','s.Student_Id = ds.StudentId_FK');
    $this->db->join('parent_profile pp','pp.Parent_Id = s.ParentId_FK');
    $this->db->join('users u','u.User_Id = dp.UserId_FK');
    $this->db->where('pp.Parent_Id',$entity->Parent_Id);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      if ($isSingle == true) {
        return $query->row();
      }
      else{
        return $query->result_object();
      }
    }
    else{
      return false;
    }
  }
  public function loadRide($entity){
    $this->db->select('dr.*,rs.RS_Id,rs.IsCompleted as Ride_Status,rs.Status_Time,ds.Shift_Id,ds.Pick_Up,ds.Drop_Off');
    $this->db->from('driver_rides dr');
    $this->db->join('ride_status rs','rs.RideId_FK = dr.Ride_Id');
    $this->db->join('driver_shift ds','ds.Shift_Id = dr.ShiftId_FK');
    $this->db->join('student s','s.Student_Id = ds.Shift_Id');
    $this->db->join('parent_profile pp','pp.Parent_Id = s.ParentId_FK');
    $this->db->join('users u','u.User_Id = pp.UserId_FK');
    $this->db->where('u.User_Id',$entity->User_Id);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      if ($entity->isSingle == true) {
        return $query->row();
      }
      else{
        return $query->result_object();
      }
    }
    else{
      return false;
    }
  }
}
?>