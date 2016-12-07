<?php
class ModelMyCommunityMycommunity extends Model {

 public function getRecommend($group_id)
 {
    $query = $this->db->query("SELECT*FROM oc_readingclub WHERE group_id = '" .$group_id. "'");

    if ($query->num_rows) {
            return array(

                'group_id'                => $query->row['group_id'],
                'group_name'              => $query->row['group_name'],
                'group_image'             => $query->row['group_image']
                  
            );
        }
        else {
            return false;
             }
     
 }     

public function getRecommended() {

      $group_data = array();

       $query = $this->db->query("SELECT group_id FROM oc_readingclub where recommended= 'true'");

       foreach($query->rows as $result)
      {
         $group_data[$result['group_id']] = $this->getRecommend($result['group_id']);
      }

      return $group_data;
 
}

 public function addtomember($group_id)
  {
      $this->db->query("DELETE FROM oc_group_members WHERE customer_id = '" . (int)$this->customer->getId() . "'AND group_id = '" . $group_id. "'");

     $this->db->query("INSERT INTO  oc_group_members SET customer_id = '" . (int)$this->customer->getId() . "', group_id = '" . $group_id. "'");
    
  }

  public function getMember($group_id) {

       $query = $this->db->query("SELECT * FROM  oc_readingclub WHERE group_id = '".$group_id."'");

          if($query->num_rows) {
		   	  return array(

                    'group_id'              => $query->row['group_id'],
                    'group_name'            => $query->row['group_name'],
			        'group_image'           => $query->row['group_image']
					

						);
			  }
		  
	else {
return false;
	}
  
}

public function getMembers($customer_id)
 {

     $member_data = array();
     $query = $this->db->query("SELECT group_id from oc_group_members WHERE customer_id = '". (int)$this->customer->getId() ."'");

     foreach($query->rows as $result)
     {
         $member_data[$result['group_id']] = $this->getMember($result['group_id']);
     }

     return $member_data;
 }

 public function addtomyclub($club_name)
  {
      $this->db->query("DELETE FROM oc_readingclub WHERE customer_id = '" . (int)$this->customer->getId() . "'AND group_name = '" . $club_name. "'");

     $this->db->query("INSERT INTO oc_readingclub SET created_by = 'customer' , group_image = 'image/books/book.jpg' , customer_id = '" . (int)$this->customer->getId() . "', group_name = '" . $club_name. "',group_description = '" . $this->request->post['club_description']. "'");
    
     //$group_id=(int)$this->db->getLastId();

     //$this->db->query("INSERT INTO oc_group_members SET customer_id = '" . (int)$this->customer->getId() . "', group_id = '" . $group_id. "'");
  }

  public function getclub($group_id)
  {
       $query = $this->db->query("SELECT * FROM oc_readingclub WHERE group_id = '". $group_id ."'");


          if($query->num_rows) {
		   	  return array(
                    'group_name'               => $query->row['group_name'],
			        'group_description'        => $query->row['group_description'],
					'group_image'              => $query->row['group_image']

						);
			  }
		  
	else {
return false;
	}
  }

 public function getclubs($customer_id)
  {
      $group_id = array();
      $query = $this->db->query("SELECT group_id FROM oc_readingclub WHERE created_by = 'customer' AND customer_id = '". (int)$this->customer->getId() ."'");

      foreach($query->rows as $result)
      {
          $group_id[$result['group_id']]=$this->getclub($result['group_id']);
      }
      return  $group_id;
  } 

  public function getpost($post_id)
  {
     
$query = $this->db->query("SELECT * from oc_readingclub_post WHERE   post_id = '". $post_id ."'");
    if($query->num_rows) {
		   	  return array(
                    'message'               => $query->row['message'],
			        'image'                 => $query->row['image'],
					'link'                  => $query->row['link'],
                   	'customer_image'        => $query->row['customer_image']

						);
			  }
		  
	else {
return false;
	}

  }

  public function getposts($group){
      
      $group_id = array(); 
      $query = $this->db->query("SELECT post_id from oc_readingclub_post WHERE customer_id = '". (int)$this->customer->getId() ."' AND group_id = '". $group ."'");

      foreach($query->rows as $result)
      {
          $post_id[$result['post_id']] =$this->getpost($result['post_id']);
      }
      return  $post_id;

   }

  public function addtomypost($groupid)
  {
   //  $this->db->query("DELETE FROM oc_readingclub_post WHERE customer_id = '" . (int)$this->customer->getId() . "'AND group_name = '" . $club_name. "'");

     $this->db->query("INSERT INTO oc_readingclub_post SET  group_id = '". $groupid ."' , posted_by = 'customer' , image = 'image/books/book.jpg' , customer_id = '" . (int)$this->customer->getId() . "', message = '" . $this->request->post['text_name']. "' ");
       }

   
}

