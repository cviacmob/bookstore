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

 

 public function getAuthorFromMaster($author_name) 
 {
 
		$query = $this->db->query("SELECT * FROM  authors_master WHERE author_name = '". $author_name . "'" );
		
		if ($query->num_rows) {
			return array(
				'author_id'                => $query->row['author_id'],
				'author_name'              => $query->row['author_name'],
				'author_image'             => $query->row['author_image'],
				'author_description'       => $query->row['author_description'],
				'like_count'               => $query->row['like_count']
				 
			);
		}
		else {
			return false;
		}
 
 }

 public function addToLikedauthor($author_id)
  {
      $this->db->query("DELETE FROM liked_author WHERE customer_id = '" . (int)$this->customer->getId() . "'AND author_id = '" . $author_id. "'");

    $this->db->query("INSERT INTO  liked_author SET customer_id = '" . (int)$this->customer->getId() . "', author_id = '" . $author_id. "',created_at = NOW()");
    
  }

  public function getAuthor($author_id) {

       $query = $this->db->query("SELECT * FROM authors_master WHERE author_id = '".$author_id."'");

          if($query->num_rows) {
		   	  return array(

                    'author_id'              => $query->row['author_id'],
                    'author_name'            => $query->row['author_name'],
			        'author_image'            => $query->row['author_image']
					

						);
			  }
		  
	else {
return false;
	}
  
}

public function getAuthors($customer_id)
 {

     $author_id = array();
     $query = $this->db->query("SELECT author_id from liked_author WHERE customer_id = '". (int)$this->customer->getId() ."'");

     foreach($query->rows as $result)
     {
         $author_id[$result['author_id']] = $this->getAuthor($result['author_id']);
     }

     return $author_id;
 }


 public function addToLikedpublisher($publisher_id)
  {
      $this->db->query("DELETE FROM liked_publisher WHERE customer_id = '" . (int)$this->customer->getId() . "'AND publisher_id = '" . $publisher_id. "'");

    $this->db->query("INSERT INTO  liked_publisher SET customer_id = '" . (int)$this->customer->getId() . "', publisher_id = '" . $publisher_id. "',created_at = NOW()");
    
  }

  public function getPublisher($publisher_id) {

       $query = $this->db->query("SELECT * FROM publishers_master WHERE publisher_id = '".$publisher_id."'");

          if($query->num_rows) {
		   	  return array(

                    'publisher_id'              => $query->row['publisher_id'],
                    'publisher_name'            => $query->row['publisher_name'],
			        'publisher_image'           => $query->row['publisher_image'],
                    'publisher_description'     => $query->row['publisher_description'],
					'publisher_address'         => $query->row['publisher_address'],
                    'like_count'                => $query->row['like_count']

						);
			  }
		  
	else {
return false;
	}
  
}

public function getPublishers($customer_id)
 {

     $publisher_id = array();
     $query = $this->db->query("SELECT publisher_id from liked_publisher WHERE customer_id = '". (int)$this->customer->getId() ."'");

     foreach($query->rows as $result)
     {
         $publisher_id[$result['publisher_id']] = $this->getPublisher($result['publisher_id']);
     }

     return $publisher_id;
 }

 public function getPublisherFromMaster($publisher_name) 
 {
 
		$query = $this->db->query("SELECT * FROM  publishers_master WHERE publisher_name = '". $publisher_name . "'" );
		
		if ($query->num_rows) {
			return array(

				    'publisher_id'              => $query->row['publisher_id'],
                    'publisher_name'            => $query->row['publisher_name'],
			        'publisher_image'           => $query->row['publisher_image'],
                    'publisher_description'     => $query->row['publisher_description'],
					'publisher_address'         => $query->row['publisher_address'],
                    'like_count'                => $query->row['like_count']

				 
			);
		}
		else {
			return false;
		}
 
 }

public function getShared() {

      $group_data = array();

       $query = $this->db->query("SELECT isbn FROM my where enable= 'true'");

       foreach($query->rows as $result)
      {
         $group_data[$result['shared_id']] = $this->getShare($result['shared_id']);
      }

      return $group_data;
 
}

 public function getShare($shared_id)
 {
    $query = $this->db->query("SELECT*FROM shared_books WHERE shared_id = '" .$shared_id. "'");

    if ($query->num_rows) {
            return array(

                'shared_id'                      => $query->row['shared_id'],
                'shared_book_name'               => $query->row['shared_book_name'],
                'shared_book_image'              => $query->row['shared_book_image'],
                'shared_book_description'        => $query->row['shared_book_description']
                  
            );
        }
        else {
            return false;
             }
     
 }     



}

