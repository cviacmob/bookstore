<?php
class ModelMylibraryMylibrary extends Model {

 public function addToMylibrary($isbn)
 {
    
	$query=$this->db->query("SELECT*FROM mylibrary WHERE isbn ='" . $isbn. "' AND customer_id = '" . (int)$this->customer->getId() . "'");

	if($query->num_rows)
	{
		return true;
	}

	else
	{
		$this->db->query("INSERT INTO mylibrary SET customer_id = '" . (int)$this->customer->getId() . "', isbn = '" . $isbn. "',sell_price='".$this->request->post['sell_price']."',share_price='".$this->request->post['share_price']."',date_added = NOW()");
	} 
    
	 
  // return true;
      
 }

 public function addToProduct($book)
 {
     $query=$this->db->query("SELECT*FROM oc_product WHERE model ='" . $book['isbn']. "' ");

	 if($query->num_rows)
	 {
		 $this->db->query("UPDATE oc_product SET quantity = quantity + 1 WHERE model='". $book['isbn']. "'");
	 }

	 else
	 {
		 $this->db->query("INSERT INTO oc_product SET image = '" . $book['image']. "', author = '" . $book['author']. "', publisher = '" . $book['publisher']. "', cover_type = '" . $book['cover_type']. "', no_of_pages = '" . $book['no_of_pages']. "',sell_price ='" . $this->request->post['sell_price']. "', share_price ='" . $this->request->post['share_price']. "', status = '0', quantity = '1',stock_status_id = '6', model = '" . $book['isbn']. "'"); 

		 $product_id = (int)$this->db->getLastId();

    $this->db->query("INSERT INTO oc_product_description SET product_id = '" .$product_id. "', language_id = '1', name = '". $book['title']."', meta_title = '" . $book['title']. "'");

    $this->db->query("INSERT INTO oc_product_to_category SET product_id = '" .$product_id. "',category_id = '61'");

    $this->db->query("INSERT INTO oc_product_to_store SET product_id = '" .$product_id. "',store_id = '". (int)$this->config->get('config_store_id') ."'");

  // return true;		
	 }
  
      
 }

 public function deleteFromProduct($book)
 {
     $query=$this->db->query("SELECT*FROM oc_product WHERE model ='" . $book['isbn']. "' ");

	 if($query->num_rows)
	 {
		 $this->db->query("UPDATE oc_product SET quantity = quantity - 1 WHERE model='". $book['isbn']. "'");
	 }

	 else
	 {
		
       return false;	

	 }

    
 }

 public function getBook($isbn)
 {
    $query = $this->db->query("SELECT*FROM master_books WHERE isbn = '" . $isbn. "'");

    if ($query->num_rows) {
			return array(
				'isbn'              => $query->row['isbn'],
				'title'             => $query->row['title'],
				'author'            => $query->row['author'],
				'cover_type'        => $query->row['cover_type'],
				'no_of_pages'       => $query->row['no_of_pages'],
				'publisher'         => $query->row['publisher'],
			    'image'             => $query->row['image'] 
				 
			);
		}
		else {
			return false;
		     }
     
 }

 public function getBooks($customer_id)
 {

	 $book_data = array();
	 $query = $this->db->query("SELECT isbn FROM mylibrary WHERE customer_id = '". (int)$this->customer->getId() ."'");

	 foreach($query->rows as $result)
	 {
		 $book_data[$result['isbn']] = $this->getBook($result['isbn']);
	 }

	 return $book_data;
 }

 public function getPurchasedBooks($customer_id)
 {

	 $book_data = array();

	 $query = $this->db->query("SELECT op.product_id FROM oc_order_product op INNER JOIN oc_order o ON o.order_id = op.order_id WHERE o.customer_id = '". $customer_id ."'");

     foreach($query->rows as $result)
	 {
		 $book_data[$result['product_id']] = $this->getCustomerBook($result['product_id']);
	 }
     
	  return $book_data;
 }
 
 public function getCustomerBook($product_id)
 {

	 $query = $this->db->query("SELECT pd.name, p.image, p.product_id FROM oc_product_description pd INNER JOIN oc_product p ON pd.product_id = p.product_id WHERE pd.product_id = '" .$product_id. "'");

    if ($query->num_rows) {
			return array(
				 
				'name'              => $query->row['name'],
				'image'             => $query->row['image'],
				'product_id'        => $query->row['product_id']
				  
			);
		}
		else {
			return false;
		     }
 }

 public function getReviewedBooks($customer_id)
 {

	 $book_data = array();

	 $query = $this->db->query("SELECT DISTINCT product_id FROM oc_review WHERE customer_id = '".$this->customer->getId()."'" );

     foreach($query->rows as $result)
	 {
		 $book_data[$result['product_id']] = $this->getCustomerBook($result['product_id']);
	 }
     
	  return $book_data;
 }

 public function checkReview($product_id)
 {
	 $query = $this->db->query("SELECT status FROM oc_review WHERE product_id = '".$product_id."' AND customer_id='".$this->customer->getId()."'");

	 if($query->num_rows)
	 { 
		 return $query->row['status'];
	 }
	 else{
		 return false;
	 }
 }

 public function productReview($product_id)
 {
	 $query = $this->db->query("SELECT*FROM oc_review WHERE product_id = '".$product_id."' AND customer_id='".$this->customer->getId()."'");

	 if($query->num_rows)
	 {
		 return array(

			 'text' => $query->row['text'],
			 'rating' => $query->row['rating']
		 );
	 }
	 else{
		 return false;
	 }
 }

 public function getYourReview($product_id)
 {

	 $query = $this->db->query("SELECT*FROM oc_review WHERE product_id ='".$product_id."' AND customer_id = '".$this->customer->getId()."'" );

    if ($query->num_rows) {
			return array(
				 
				'text'              => $query->row['text'],
				'rating'             => $query->row['rating']
				 				  
			);
		}
		else {
			return false;
		     }
 }

 public function getBookFromMaster($isbn)
 {
    $query = $this->db->query("SELECT*FROM master_books WHERE isbn = '" . $isbn. "'");

    if ($query->num_rows) {
			return array(
				'isbn'              => $query->row['isbn'],
				'title'             => $query->row['title'],
				'author'            => $query->row['author'],
				'cover_type'        => $query->row['cover_type'],
				'no_of_pages'       => $query->row['no_of_pages'],
				'publisher'         => $query->row['publisher'],
			    'image'             => "image/".$query->row['image'] 
				 
			);
		}
		else {
			return false;
		     }
     
 }

 public function editBook($isbn) 
 {
 
		$query = $this->db->query("SELECT mb.isbn,mb.title,mb.author,mb.cover_type,mb.no_of_pages,mb.publisher,mb.image,my.sell_price, my.share_price, my.lend_price, my.min_bid_price, my.max_bid_price FROM mylibrary my INNER JOIN master_books mb ON mb.isbn = my.isbn WHERE my.isbn = '". $isbn . "' AND customer_id = '".$this->customer->getId()."'" );
		
		if ($query->num_rows) {
			return array(
				'isbn'              => $query->row['isbn'],
				'title'             => $query->row['title'],
				'author'            => $query->row['author'],
				'cover_type'        => $query->row['cover_type'],
				'no_of_pages'       => $query->row['no_of_pages'],
				'publisher'         => $query->row['publisher'],
			    'image'             => "image/".$query->row['image'],
				'sell_price'        => $query->row['sell_price'],
				'share_price'       => $query->row['share_price'],
				'lend_price'        => $query->row['lend_price'],
				'min_bid_price'     => $query->row['min_bid_price'],
				'max_bid_price'     => $query->row['max_bid_price']

				 
			);
		}
		else {
			return false;
		}
 
 }

 public function updateBook($isbn)
 {
	 $query = $this->db->query("UPDATE mylibrary SET sell_price = '". $this->request->post['sell_price']."' , share_price = '". $this->request->post['share_price']."' WHERE isbn = '".$isbn."' AND customer_id = '".$this->customer->getId()."'" );
 }

 public function deleteBook($isbn)
 {
	 $query = $this->db->query("DELETE FROM mylibrary WHERE isbn = '".$isbn."' AND customer_id = '".$this->customer->getId()."'");
 }

 public function addToFavorite($product_id)
 {
	 $this->db->query("DELETE FROM customer_favorite 
	 
	 
	 WHERE customer_id = '" . (int)$this->customer->getId() . "' AND product_id = '" . (int)$product_id . "'");

	 $this->db->query("INSERT INTO customer_favorite SET customer_id = '" . (int)$this->customer->getId() . "', product_id = '" . (int)$product_id . "', date_added = NOW()");
 }

 public function deleteFavorite($product_id) 
 {
		$this->db->query("DELETE FROM customer_favorite WHERE customer_id = '" . (int)$this->customer->getId() . "' AND product_id = '" . (int)$product_id . "'");
 }

public function getFavorite() 
{
        $query = $this->db->query("SELECT product_id FROM customer_favorite WHERE customer_id = '" . (int)$this->customer->getId() . "'");

		$book_data = array();
		foreach($query->rows as $result)
	 	{
		 	$book_data[$result['product_id']] = $this->getCustomerBook($result['product_id']);
	 	}
     
	  	return $book_data;
}

public function shared_books($isbn)
{
	 $query = $this->db->query("INSERT INTO shared_books SET customer_id = '" . (int)$this->customer->getId() . "', isbn = '" . $isbn. "',date_added = NOW()");
}

public function bestSeller($isbn)
{
	$query = $this->db->query("SELECT customer_id FROM mylibrary WHERE isbn = '".$isbn."'");
	foreach($query->rows as $result)
	 	{
		 	$book_data[$result['customer_id']] = $this->bestPrice($result['customer_id']);
	 	}

	return $book_data;
}

public function bestPrice($customer_id)
{
	$query = $this->db->query("SELECT sell_price FROM mylibrary WHERE customer_id = '".$customer_id."'");

	if($query->num_rows){

		return array(

			'best_price' => $query->row['sell_price']
		);
	}
	else
	return false;
}

public function uploadImage()
{
	$front_image = "catalog/".$_FILES["front_image"]["name"];
	$back_image = "catalog/".$_FILES["back_image"]["name"];
	$query = $this->db->query("INSERT INTO uploaded_image SET customer_id = '". (int)$this->customer->getId() . "', front_image = '" .$front_image. "',back_image = '" .$back_image. "'");
}

 public function getAllauthors($data = array()){

          $sql = "SELECT * FROM authors_master " ;

		  if (!empty($data['filter_name'])) {
			$sql .= " WHERE author_name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
          }

            if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
	    	}

            $query = $this->db->query($sql);

		   return $query->rows;

            
		     }


}
