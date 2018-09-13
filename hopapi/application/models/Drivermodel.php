<?php
class Drivermodel extends CI_Model {

  	public function loadDriver($entity){
    	$query = $this->db->select('*');
    	$query =  $this->db->from('driver_profile');
    	if($entity->UserId_FK > 0){
     		$query =  $this->db->where('UserId_FK',$entity->UserId_FK);
    	}
    	if($entity->Driver != null){
      	$query =  $this->db->where('Driver_Id',$entity->Driver);
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
    $this->db->where('UserId_FK',$entity->Driver_Id);
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
  public function loadLicense($entity){
    $this->db->select('*');
    $this->db->from('driver_license');
    $this->db->where('DriverId_FK',$entity->Driver_Id);
    $query = $this->db->get();
    if ($query->num_rows > 0) {
      return $query->row();
    }
    else{
      return 0;
    }
  }
  public function loadCrime($entity){
    $this->db->select('*');
    $this->db->from('driver_crime');
    $this->db->where('DriverId_FK',$entity->Driver_Id);
    $query = $this->db->get();
    if ($query->num_rows > 0) {
      return $query->row();
    }
    else{
      return 0;
    }
  }
  public function loadVehicle($entity){
    $this->db->select('*');
    $this->db->from('driver_vehicle');
    $this->db->where('DriverId_FK',$entity->Driver_Id);
    $query = $this->db->get();
    if ($query->num_rows > 0) {
      return $query->row();
    }
    else{
      return 0;
    }
  }
  public function loadVehicleReg($entity){
    $this->db->select('*');
    $this->db->from('driver_vehicle_registration');
    $this->db->where('DriverId_FK',$entity->Driver_Id);
    $query = $this->db->get();
    if ($query->num_rows > 0) {
      return $query->row();
    }
    else{
      return 0;
    }
  }
  public function loadFirstaid($entity){
    $this->db->select('*');
    $this->db->from('driver_cpr');
    $this->db->where('DriverId_FK',$entity->Driver_Id);
    $query = $this->db->get();
    if ($query->num_rows > 0) {
      return $query->row();
    }
    else{
      return 0;
    }
  }
  public function loadShift($entity){
    $this->db->select('ds.*,CONCAT(s.First_Name," ",s.Last_Name) AS Student_Name,s.Student_Image,s.Health_Issue,s.Equipment_Required,pp.Parent_Id,pp.Parent_Image,pp.Phone_Number,CONCAT(u.First_Name," ",u.Last_Name) as Parent_Name,u.Email as Parent_Email,u.Cell_Number as Parent_Cell ');
    $this->db->from('driver_shift ds');
    $this->db->join('driver_profile dp','dp.Driver_Id = ds.DriverId_FK');
    $this->db->join('student s','s.Student_Id = ds.StudentId_FK');
    $this->db->join('parent_profile pp','pp.Parent_Id = s.ParentId_FK');
    $this->db->join('users u','u.User_Id = pp.UserId_FK');
    $this->db->where('DriverId_FK',$entity->DriverId_FK);
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
  public function loadRides($entity){
    $this->db->select('dr.*,rs.RS_Id,rs.IsCompleted as Ride_Status,rs.Status_Time,ds.Shift_Id,ds.Pick_Up,ds.Drop_Off');
    $this->db->from('driver_rides dr');
    $this->db->join('ride_status rs','rs.RideId_FK = dr.Ride_Id');
    $this->db->join('driver_shift ds','ds.Shift_Id = dr.ShiftId_FK');
    $this->db->where('ds.DriverId_FK',$entity->DriverId_FK);
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