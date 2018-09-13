<?php
class Usermodel extends CI_Model {
	
	public function getuser($entity){
		$this->db->select('*');
		$this->db->from('users');
		if ($entity->User_Id != null) {
			$this->db->where('User_Id', $entity->User_Id);
		}
		if ($entity->Email != null) {
			$this->db->where('Email', $entity->Email);
		}
		if ($entity->Password != null) {
			$this->db->where('Password', $entity->Password);
		}
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
			return 0;
		}
	}

	public function getparents(){
		$this->db->select('CONCAT(u.First_Name," ",u.Last_Name)as Parent_Name,Email, Cell_Number');
		$this->db->from('users');
		$this->db->where('Type' , 'Parent');
		$query = $this->db->get();
		if ($query->num_rows() > 0 ) {
			return $query->result_object();
		}
		else{
			return 0;
		}
	}
	public function getdrivers(){
		$this->db->select('CONCAT(u.First_Name," ",u.Last_Name)as Driver_Name, Email ,Cell_Number');
		$this->db->from('users');
		$this->db->where('Type', 'Driver');
		$query = $this->db->get();
		if ($query->num_rows() > 0 ) {
			return $query->result_object();
		}
		else{
			return 0;
		}
	}
	public function getDetailDriver($entity){
		$this->db->select('CONCAT(u.First_Name," ",u.Last_Name)as Driver_Name,u.Email,u.Cell_Number,dp.*,dl.*,dc.*,dcpr.*,dv.*,a.*');
		$this->db->from('users u');
		$this->db->join('driver_profile dp','dp.UserId_FK = u.User_Id');
		$this->db->join('driver_license dl','dl.DriverId_FK = dp.Driver_Id','left outer');
		$this->db->join('driver_crime dc','dc.DriverId_FK = dp.Driver_Id','left outer');
		$this->db->join('driver_cpr dcpr','dcpr.DriverId_FK = dp.Driver_Id','left outer');
		$this->db->join('driver_vehicle dv','dv.DriverId_FK = dp.Driver_Id','left outer');
		$this->db->join('driver_vehicle_registration dvr','dvr.DriverId_FK = dp.Driver_Id','left outer');
		$this->db->join('address a','a.UserId_FK = dp.Driver_Id','left outer');
		$this->db->where('u.User_Id',$entity->User_Id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		}
		else{
			return false;
		}
	}
	public  function getDetailParent($entity){
		$this->db->select('CONCAT(u.First_Name," ",u.Last_Name)as Parent_Name,u.Email,u.Cell_Number,pp.*,a.*,s.*,ss.*');
		$this->db->from('users u');
		$this->db->join('parent_profile pp','pp.UserId_FK = u.User_Id','left outer');
		$this->db->join('address a','a.UserId_FK = pp.Parent_Id','left outer');
		$this->db->join('student s','s.ParentId_FK = pp.Parent_Id','left outer');
		$this->db->join('student_school ss','ss.StudentId_FK = s.Student_Id','left outer');
		$this->db->where('u.User_Id',$entity->User_Id);
		$query = $this->db->get();
		if ($query->num_rows() === 1) {
			return $query->row();
		}
		else if($query->num_rows > 1){
			return $query->result_object();
		}
		else{
			return false;
		}
	}
	public function loadShifts(){
		$this->db->select('*');
		$this->db->from('driver_shift');
		$this->db->where('Run_Status', '0');
		$query = $this->db->get();
		if ($query->num_rows() > 0 ) {
			return $query->result_object();
		}
		else{
			return 0;
		}
	}		
	public function loadDetailShift($entity){
		$this->db->select('ds.*,dp.Driver_Image,ud.User_Id,CONCAT(ud.First_Name," ",ud.Last_Name) as Driver_Name,ud.Email as Driver_Email,ud.Cell_Number as Driver_Cell,up.User_Id,CONCAT(up.First_Name," ",up.Last_Name) as Parent_Name, up.Email as Parent_Email,up.Cell_Number as Parent Cell_Number,pp.Parent_Image,s.Student_Id,CONCAT(s.First_Name," ",s.Last_Name) as Student_Name, s.Student_Image, s.Equipment_Required');
		$this->db->from('driver_shift ds');
		$this->db->join('driver_profile dp','dp.Driver_Id = ds.DriverId_FK');
		$this->db->join('student s','s.Student_Id = ds.StudentId_FK');
		$this->db->join('parent_profile pp','pp.Parent_Id = s.ParentId_FK');
		$this->db->join('users up','up.User_Id = pp.UserId_FK');
		$this->db->join('users ud','ud.User_Id = dp.UserId_FK');
		$this->db->where('ds.Shift_Id',$entity->Shift_Id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		}
		else{
			return false;
		}
	}
	public function loadDetailRide($entity){
		$this->db->select('dr.*,rs.*,ds.*,dp.Driver_Image,ud.User_Id,CONCAT(ud.First_Name," ",ud.Last_Name) as Driver_Name,ud.Email as Driver_Email,ud.Cell_Number as Driver_Cell,up.User_Id,CONCAT(up.First_Name," ",up.Last_Name) as Parent_Name, up.Email as Parent_Email,up.Cell_Number as Parent_Cell,pp.Parent_Image,s.Student_Id,CONCAT(s.First_Name," ",s.Last_Name) as Student_Name, s.Student_Image, s.Equipment_Required');
		$this->db->from('driver_rides dr');
		$this->db->join('ride_status rs','rs.RideId_FK = dr.Ride_Id');
		$this->db->join('driver_shift ds','ds.Shift_Id = dr.ShiftId_FK');
		$this->db->join('driver_profile dp','dp.Driver_Id = ds.DriverId_FK');
		$this->db->join('student s','s.Student_Id = ds.StudentId_FK');
		$this->db->join('parent_profile pp','pp.Parent_Id = s.ParentId_FK');
		$this->db->join('users up','up.User_Id = pp.UserId_FK');
		$this->db->join('users ud','ud.User_Id = dp.UserId_FK');
		$this->db->where('ds.Shift_Id',$entity->Shift_Id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		}
		else{
			return false;
		}
	}
	public function loadReport(){
		$this->db->select('sr.*,CONCAT(s.First_Name," ",s.Last_Name) as Student_Name,ud.User_Id,CONCAT(ud.First_Name," ",ud.Last_Name) as Driver_Name, ud.Email as Driver_Email, ud.Cell_Number as Driver_Cell,up.User_Id,CONCAT(up.First_Name," ",up.Last_Name) as Parent_Name, up.Email as Parent_Email,up.Cell_Number as Parent_Cell');
		$this->db->from('student_report sr');
		$this->db->join('student s','s.Student_Id = sr.StudentId_FK');
		$this->db->join('parent_profile pp','pp.Parent_Id = s.ParentId_FK');
		$this->db->join('users up','up.User_Id = pp.UserId_FK');
		$this->db->join('driver_profile dp','dp.Driver_Id = sr.DriverId_FK');
		$this->db->join('users ud','ud.User_Id = dp.UserId_FK');
		$this->db->where('Response','');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		}
		else{
			return false;
		}
	}	
}
?>