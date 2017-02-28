<?php
class ModelMycommunityCustomergroups extends Model {

public function getTotalClub()
    {

        $query = $this->db->query("SELECT * FROM readingclub WHERE created_by != 'Admin'");

        return $query;

    }

public function getClubs($group_id)
    {
        $query = $this->db->query("SELECT * FROM readingclub WHERE created_by != 'Admin' AND group_id ='".$this->request->get['group_id']."' ");

        if($query->rows){

            return array(

                'group_id'            => $query->row['group_id'],
                'group_name'          => $query->row['group_name'],
                'group_image'         => $query->row['group_image'],
                'group_description'   => $query->row['group_description'],
                'created_by'          => $query->row['created_by'],
                'privacy'             => $query->row['privacy'],
                'location' 		      => $query->row['location'],
                'recommended' 		  => $query->row['recommended'],
                'status' 		      => $query->row['status']
			

            );
        }else{
                return false;
        }
    }

 public function updateDetails($group_id)
    {
        $query = $this->db->query("UPDATE readingclub SET recommended = '".$this->request->post['recommended']."',status = '".$this->request->post['status']."' WHERE group_id = '".$group_id."' ");
    
      //  $status = $this->db->query("SELECT status FROM uploaded_image WHERE upload_id = '".$upload_id."'");

        return $query; 
    
    }   

}