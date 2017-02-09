<?php
class ModelMyCommunityMycommunity extends Model {

 public function getRecommend($group_id)
 {
    $query = $this->db->query("SELECT*FROM readingclub WHERE group_id = '" .$group_id. "'");

    if ($query->num_rows) {
            return array(

                'group_id'                => $query->row['group_id'],
                'group_name'              => $query->row['group_name'],
                'group_image'             => $query->row['group_image'],
                'likes'                   => $query->row['likes'],
                'total_votes'             => $query->row['total_votes'],
                'status'                  => $query->row['status']

                  
            );
        }
        else {
            return false;
             }
     
 }     

public function getRecommended() {

      $group_data = array();

       $query = $this->db->query("SELECT * FROM readingclub where recommended= 'true' AND status= 'active'");

       

      return $query ->rows;
       
 
}

public function memberstatus($group_id){

    $query = $this->db->query("SELECT * FROM group_members where group_id = '".(int)$group_id."' AND customer_id = '" . (int)$this->customer->getId() . "'");

    if($query->rows )
    {
        $query = $this->db->query("SELECT * FROM readingclub where group_id= '".$group_id."'");
        if($query->rows){

            return array(

                'group_id'                => $query->row['group_id'],
                'group_name'              => $query->row['group_name'],
                'group_image'             => $query->row['group_image'],
                'status'                  => "member"

            );
        } 
    }
    else{

        $query = $this->db->query("SELECT * FROM readingclub where group_id= '".$group_id."'");
        if($query->rows){

            return array(

                'group_id'                => $query->row['group_id'],
                'group_name'              => $query->row['group_name'],
                'group_image'             => $query->row['group_image'],
                'status'                  => "join"
                
            );
        } 

    }
}

public function groupmember(){

    $query = $this->db->query("SELECT group_id FROM group_members where customer_id = '" . (int)$this->customer->getId() . "'");

    $group_id = array();
    
    foreach($query->rows as $result)
    {
 
        $group_id[$result['group_id']]= $this->groupdetails($result['group_id']);
  
    }

    return $group_id;
     
}

public function groupdetails($group_id){

    $query = $this->db->query("SELECT * FROM readingclub where group_id= '".$group_id."'");
    
    if($query->rows)
        {
            return array(
                'group_id'                => $query->row['group_id'],
                'group_name'              => $query->row['group_name'],
                'group_image'             => $query->row['group_image'],
                'status'                  => "member"
            );   

         }else{
             return false;
         } 
} 

 public function addtomember($group_id)
  {
      $this->db->query("DELETE FROM group_members WHERE customer_id = '" . (int)$this->customer->getId() . "'AND group_id = '" . $group_id. "'");

     $this->db->query("INSERT INTO  group_members SET customer_id = '" . (int)$this->customer->getId() . "', group_id = '" . $group_id. "' ,date_added = NOW()");

    
  }

  public function getMember($group_id) {

    $query = $this->db->query("SELECT * FROM group_members where group_id = '".(int)$group_id."' AND customer_id = '" . (int)$this->customer->getId() . "'");

    if($query->rows )
    {
        $query = $this->db->query("SELECT * FROM readingclub where group_id= '".$group_id."'");
        if($query->rows){

            return array(

                'group_id'                => $query->row['group_id'],
                'group_name'              => $query->row['group_name'],
                'group_image'             => $query->row['group_image'],
                'status'                  => "member"

            );
        } 
    }
    else{

        $query = $this->db->query("SELECT * FROM readingclub where group_id= '".$group_id."'");
        if($query->rows){

            return array(

                'group_id'                => $query->row['group_id'],
                'group_name'              => $query->row['group_name'],
                'group_image'             => $query->row['group_image'],
                'status'                  => "join"
                
            );
        } 

 
}
  }

/*public function getMembers($customer_id)
 {

     $member_data = array();
     $query = $this->db->query("SELECT group_id from group_members WHERE customer_id = '". (int)$this->customer->getId() ."'");

     foreach($query->rows as $result)
     {
         $member_data[$result['group_id']] = $this->getMember($result['group_id']);
     }

     return $member_data;
 }  */

 public function addtomyclub($club_name)
  {
     $this->db->query("DELETE FROM readingclub WHERE group_name = '" . $club_name. "'");

     $this->db->query("INSERT INTO readingclub SET created_by = '" . (int)$this->customer->getId() . "' , group_image = 'catalog/book.jpg', group_name = '" . $club_name. "',group_description = '" . $this->request->post['club_description']. "', date_added = NOW()");
    
  }

  public function getclub($group_id)
  {
       $query = $this->db->query("SELECT * FROM readingclub WHERE group_id = '". $group_id ."'");


          if($query->num_rows) {
		   	  return array(

                    'group_id'                 => $query->row['group_id'],
                    'group_name'               => $query->row['group_name'],
			        'group_description'        => $query->row['group_description'],
					'group_image'              => $query->row['group_image'],
                    'likes'                    => $query->row['likes'],
                    'total_votes'              => $query->row['total_votes']

						);
			  }
		  
	else {
return false;
	}
  }

 public function getclubs()
  {
      $group_id = array();
      $query = $this->db->query("SELECT group_id FROM readingclub WHERE created_by = '" . (int)$this->customer->getId() . "' ");

      foreach($query->rows as $result)
      {
          $group_id[$result['group_id']]=$this->getclub($result['group_id']);
      }
      return  $group_id;
  } 

  public function getpost($post_id)
  {
     
     $query = $this->db->query("SELECT * from readingclub_post WHERE   post_id = '". $post_id ."' ORDER BY date_added DESC");
     if($query->num_rows) {
		   	  return array(
 
                    'group_id'              => $query->row['group_id'], 
                    'post_id'               => $query->row['post_id'], 
                    'message'               => $query->row['message'],
			        'image'                 => $query->row['image'],
					'link'                  => $query->row['link'],
                   	'customer_image'        => $query->row['customer_image'],
                    'likes'                 => $query->row['likes'],
                    'total_votes'           => $query->row['total_votes'],
                    'status'                => $query->row['status']

						);
			  }
		  
	else {
    return false;
	}

  }

  public function getposts($group_id){
      
      $post_id = array(); 
      $query = $this->db->query("SELECT post_id from readingclub_post WHERE customer_id = '". (int)$this->customer->getId() ."' AND group_id = '". $group_id ."' ORDER BY date_added DESC");

      foreach($query->rows as $result)
      {
          $post_id[$result['post_id']] =$this->getpost($result['post_id']);
      }
      return  $post_id;

   }

   public function addtomypost($groupid)
  {

   $this->db->query("INSERT INTO readingclub_post SET  group_id = '". $groupid ."' , posted_by = 'customer' , customer_id = '" . (int)$this->customer->getId() . "', message = '" . $this->request->post['text_name']. "', date_added = NOW() ");

   $this->db->query("UPDATE  readingclub_post SET status='member' WHERE customer_id = '" . (int)$this->customer->getId() . "' AND group_id = '" . $groupid. "'");
   
  }

  public function addtolikedpost($groupid)
  {
   //  $this->db->query("INSERT INTO readingclub_post SET  group_id = '". $groupid ."' , posted_by = 'customer' , image = 'image/books/book.jpg' , customer_id = '" . (int)$this->customer->getId() . "', message = '" . $this->request->post['text_name']. "', date_added = NOW() ");


    $query=$this->db->query("SELECT * FROM liked_post WHERE group_id = '".$groupid."' AND customer_id = '" . (int)$this->customer->getId() ."'");

    if($query->num_rows){

    return;
      
    }
    else
    {
          
    $this->db->query("INSERT INTO  liked_post SET customer_id = '" . (int)$this->customer->getId() . "', group_id = '" . $groupid. "',date_added = NOW()");
      
    $this->db->query("UPDATE readingclub_post SET total_votes=total_votes+1 , likes=likes+1 WHERE group_id = '".$groupid."' AND  customer_id = '" . (int)$this->customer->getId() . "'");

    $this->db->query("UPDATE readingclub SET total_votes=total_votes+1 AND likes=likes+1 WHERE group_id = '".$groupid."' AND customer_id = '" . (int)$this->customer->getId() . "' ");

    $query1=$this->db->query("SELECT * FROM readingclub_post WHERE group_id = '".$groupid."' AND customer_id = '" . (int)$this->customer->getId() . "'");

    if($query1->num_rows) {
		   	  
    return array(

    'total_votes'                => $query1->row['total_votes'],
	'likes'                      => $query1->row['likes']
					
     );
			  
     }
		  
	else 
    {
    return false;
	}

    $query=$this->db->query("SELECT * FROM readingclub WHERE group_id = '".$groupid."' AND customer_id = '" . (int)$this->customer->getId() . "'");

    if($query->num_rows) {
		   	  
    return array(

    'total_votes'                => $query->row['total_votes'],
	'likes'                      => $query->row['likes']
					
     );
			  
     }
		  
	else 
    {
    return false;
	}
      
    }
 }

    public function getAuthorFromMaster($author_name) 
    
    {
 
		$query = $this->db->query("SELECT * FROM  authors_master WHERE author_name = '". $author_name . "'" );
		
		if ($query->num_rows) {
			return array(
				'author_id'                => $query->row['author_id'],
				'author_name'              => $query->row['author_name'],
				'author_image'             => $query->row['author_image'],
				'author_dob'               => $query->row['author_dob'],
                'author_occupation'        => $query->row['author_occupation'],  
                'author_nationality'       => $query->row['author_nationality'],  
                'author_education'         => $query->row['author_education'],
                'author_awards'            => $query->row['author_awards'],
                'author_references'        => $query->row['author_references'],
                'author_external_links'    => $query->row['author_external_links'], 
				'total_votes'              => $query->row['total_votes'],
                'likes'                    => $query->row['likes']
				 
			);
		}
		else {
			return false;
		}
 
 }

 public function addToLikedauthor($author_id)
   {
     
    $query=$this->db->query("SELECT * FROM liked_author WHERE author_id = '".$author_id."'AND customer_id = '" . (int)$this->customer->getId() ."'");

    if($query->num_rows){

    return;
      
    }
    else
    {
          
    $this->db->query("INSERT INTO  liked_author SET customer_id = '" . (int)$this->customer->getId() . "', author_id = '" . $author_id. "',date_added = NOW()");
      
    $this->db->query("UPDATE authors_master SET total_votes=total_votes+1,likes=likes+1 WHERE author_id = '".$author_id."' ");

    $query=$this->db->query("SELECT * FROM authors_master WHERE author_id = '".$author_id."'");

    if($query->num_rows) {
		   	  
    return array(

    'total_votes'                => $query->row['total_votes'],
	'likes'                      => $query->row['likes']
					
     );
			  
     }
		  
	else 
    {
    return false;
	}
      
    }
   
    }


  public function getAuthor($author_id) {

       $query = $this->db->query("SELECT * FROM authors_master WHERE author_id = '".$author_id."'");

          if($query->num_rows) {
		   	  return array(

                'author_id'                => $query->row['author_id'],
				'author_name'              => $query->row['author_name'],
				'author_image'             => $query->row['author_image'],
				'author_dob'               => $query->row['author_dob'],
                'author_occupation'        => $query->row['author_occupation'],  
                'author_nationality'       => $query->row['author_nationality'],  
                'author_education'         => $query->row['author_education'],
                'author_awards'            => $query->row['author_awards'],
                'author_references'        => $query->row['author_references'],
                'author_external_links'    => $query->row['author_external_links'], 
				'total_votes'              => $query->row['total_votes'],
                'likes'                    => $query->row['likes']
					

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
   
    $query=$this->db->query("SELECT * FROM liked_publisher WHERE publisher_id = '".$publisher_id."'AND customer_id = '" . (int)$this->customer->getId() ."'");

      if($query->num_rows){

          return;
      }
      else{
           $this->db->query("INSERT INTO  liked_publisher SET customer_id = '" . (int)$this->customer->getId() . "', publisher_id = '" . $publisher_id. "',date_added = NOW()");
      
       $this->db->query("UPDATE publishers_master SET total_votes=total_votes+1,likes=likes+1 WHERE publisher_id = '".$publisher_id."' ");

      $query=$this->db->query("SELECT * FROM publishers_master WHERE publisher_id = '".$publisher_id."'");

      if($query->num_rows) {
		   	  return array(

                'total_votes'                => $query->row['total_votes'],
				'likes'                      => $query->row['likes']
					

						);
			  }
		  
	else {
return false;
	}
      
      }



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
                    'total_votes'               => $query->row['total_votes'],
                    'likes'                     => $query->row['likes']

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
                    'total_votes'              => $query->row['total_votes'],
                    'likes'                    => $query->row['likes']

				 
			);
		}
		else {
			return false;
		}
 
 }


 public function getSharedbooks()
 { 
     /*$this->load->model('mylibrary/mylibrary');

     $query = $this->db->query("SELECT isbn FROM shared_books");

     $book_data = array();
		foreach($query->rows as $result)
	 	{
		 	$book_data[$result['isbn']] = $this->model_mylibrary_mylibrary->getBook($result['isbn']);
	 	}
     
	  	return $book_data;*/
          $query = $this->db->query("SELECT pd.name, p.image,p.model,p.author,p.share_price, p.product_id FROM oc_product_description pd INNER JOIN oc_product p ON pd.product_id = p.product_id WHERE p.share_price > 0");             
          //$query = $this->db->query("SELECT product_id, model, author, publisher, image, share_price FROM oc_product where share_price > 0"); 

          foreach($query->rows as $result) {
            
             $isbn = $result['model'];
             $shared_prices[$result['model']] = $this->getBestPrice($isbn);

             $x=1;
          }

         return $query->rows;

 } 

 public function getBestPrice($isbn)
 {

      $share_prices = $this->db->query("SELECT share_price FROM mylibrary where isbn = '".$isbn."'" );    

      if($share_prices->num_rows)
		{
			return array(

				 $share_prices->row['share_price']
			);
		}
		else {
			return false;
		}
      
 }

  

 public function requestedbooks($isbn){

       $query = $this->db->query("DELETE FROM requested_books WHERE customer_id = '" . (int)$this->customer->getId() . "'AND isbn = '" . $isbn. "'");
      
      $query = $this->db->query("INSERT INTO requested_books SET customer_id = '" . (int)$this->customer->getId() . "', isbn = $isbn , date_added = NOW()");


 }  

 public function getrequestedbooks(){

     /*$book_data = array();

     $this->load->model('mylibrary/mylibrary');

     $query = $this->db->query("SELECT isbn FROM requested_books WHERE customer_id = '" . (int)$this->customer->getId() . "'" );

     foreach($query->rows as $result) {

         $book_data[$result['isbn']]=$this->model_mylibrary_mylibrary->getBook($result['isbn']);
     }
     return $book_data;*/

    $order_ids = $this->db->query("SELECT order_id FROM oc_order WHERE customer_id = '" . (int)$this->customer->getId() . "'" );

    foreach($order_ids as $order_id)
    {
        $order_status_ids = $this->db->query("SELECT order_status_id FROM oc_order_history WHERE order_id = '" . $order_id['order_id']  . "'" );

        foreach($order_status_ids as $order_status_id)
        {
            $check[$order_status_id] = $this->check($order_status_id);
        }
    } 

 }

 public function check($order_status_id){

     $check = $this->db->query("SELECT*FROM oc_order_status WHERE order_status_id = '" . $order_status_id  . "' AND name = 'processed'" );

            if($check->rows){

                return true;
            }else{
                return false;
            }

 }

 public function getProductId($isbn){

     $product_id = array();

     $query = $this->db->query("SELECT product_id FROM oc_product WHERE model = '" .$isbn. "'" );

    //  foreach($query->rows as $result) {

         //$book_data[$result['product_id']]=$this->model_mycommunity_mycommunity->getProduct($result['product_id']);
   //  }

  return $product_id;

 }

 public function getProduct($product_id){

      $query = $this->db->query("SELECT * FROM oc_product WHERE product_id = '".(int)$product_id."'");

      if ($query->num_rows) {
			return array(

				    'product_id'                   => $query->row['product_id'],
                    'quantity'                     => $query->row['quantity']
			       			 
			);

         
   
		}
		else {
			return false;
		}

 }

 public function addTocart($book) {

        $query = $this->db->query("INSERT INTO oc_cart SET product_id = '".$book['product_id']."', quantity ='".$book['quantity']."', customer_id = '" . (int)$this->customer->getId() . "', date_added = NOW()");

 }

 public function addinvite($email){

        $this->load->language('mycommunity/mycommunity');

        $query = $this->db->query("INSERT INTO addinvite SET customer_id = '" . (int)$this->customer->getId() . "', mail_id ='" .$email."' , group_id = '" . $this->request->get['group_id']. "', date_added = NOW()");

        $subject = sprintf($this->language->get('text_subject'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));

        $message = sprintf($this->language->get('text_welcome'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8')) . "\n\n";
        
      //  $link = sprintf($this->language->get('text_link'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8')) . "\n\n";

        $email=$email;
		$mail = new Mail();
		$mail->protocol = $this->config->get('config_mail_protocol');
		$mail->parameter = $this->config->get('config_mail_parameter');
		$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
		$mail->smtp_username = $this->config->get('config_mail_smtp_username');
		$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
		$mail->smtp_port = $this->config->get('config_mail_smtp_port'); 
		$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

		$mail->setTo($email);
		$mail->setFrom($this->config->get('config_email'));
		$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
		$mail->setSubject($subject);
		$mail->setText($message);
        
		$mail->send();
 }

        public function getMailid($firstname){
        
         $book_data = array();

         $query = $this->db->query("SELECT email FROM oc_customer WHERE firstname = '".$firstname."'" );

         foreach($query->rows as $result) {

         $book_data[$result['email']]=$this->model_mycommunity_mycommunity->getEmail($result['email']);
         }
         return $book_data;
         
        }


        public function getEmail($email){

        $this->load->language('mycommunity/mycommunity');

        $query = $this->db->query("INSERT INTO addinvite SET customer_id = '" . (int)$this->customer->getId() . "', group_id='".(int)$this->request->get['group_id']."', mail_id = '" . $email. "',date_added = NOW()");
      
        $subject = sprintf($this->language->get('text_subject'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));

        $message = sprintf($this->language->get('text_welcome'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8')) . "\n\n";
        
      //  $link = sprintf($this->language->get('text_link'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8')) . "\n\n";

        $email=$email;
		$mail = new Mail();
		$mail->protocol = $this->config->get('config_mail_protocol');
		$mail->parameter = $this->config->get('config_mail_parameter');
		$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
		$mail->smtp_username = $this->config->get('config_mail_smtp_username');
		$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
		$mail->smtp_port = $this->config->get('config_mail_smtp_port'); 
		$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

		$mail->setTo($email);
		$mail->setFrom($this->config->get('config_email'));
		$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
		$mail->setSubject($subject);
		$mail->setText($message);
        
		$mail->send();


        }


        public function getClubpost($post_id)   {

        $query = $this->db->query("SELECT*FROM readingclub_post WHERE post_id = '" . $post_id. "'");

       if ($query->num_rows) {
			return array(
                    
                    'post_id'               => $query->row['post_id'],
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

        public function getClubposts($group_id) {

	    $book_data = array();
	    $query = $this->db->query("SELECT post_id FROM readingclub_post WHERE customer_id = '". (int)$this->customer->getId() ."' AND group_id = '" . $group_id. "'");

	    foreach($query->rows as $result)
	     {
		 $book_data[$result['post_id']] = $this->getClubpost($result['post_id']);
	     }

	     return $book_data;
         }

        }