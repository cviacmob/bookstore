<?php
class ModelMylibraryMylibrary extends Model {

 public function addToMylibrary($isbn)
 {
    $this->db->query("DELETE FROM mylibrary WHERE customer_id = '" . (int)$this->customer->getId() . "' AND isbn = '" . $isbn. "'");
    
    $this->db->query("INSERT INTO mylibrary SET customer_id = '" . (int)$this->customer->getId() . "', isbn = '" . $isbn. "',date_added = NOW()");

   return true;
      
 }

 public function addToProduct($book)
 {
     

    $this->db->query("INSERT INTO oc_product SET image = '" . $book['image']. "', author = '" . $book['author']. "', publisher = '" . $book['publisher']. "', cover_type = '" . $book['cover_type']. "', no_of_pages = '" . $book['no_of_pages']. "', status = '0', quantity = '1',stock_status_id = '6', model = '" . $book['isbn']. "'");
    
    $product_id = (int)$this->db->getLastId();

    $this->db->query("INSERT INTO oc_product_description SET product_id = '" .$product_id. "', language_id = '1', name = '". $book['title']."', meta_title = '" . $book['title']. "'");

    $this->db->query("INSERT INTO oc_product_to_category SET product_id = '" .$product_id. "',category_id = '61'");

    $this->db->query("INSERT INTO oc_product_to_store SET product_id = '" .$product_id. "',store_id = '". (int)$this->config->get('config_store_id') ."'");

   return true;
      
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
		 $book_data[$result['product_id']] = $this->getPurchasedBook($result['product_id']);
	 }
     
	  return $book_data;
 }
 
 public function getPurchasedBook($product_id)
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
		 $book_data[$result['product_id']] = $this->getPurchasedBook($result['product_id']);
	 }
     
	  return $book_data;
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
 
		$query = $this->db->query("SELECT * FROM   master_books WHERE isbn = '". $isbn . "'" );
		
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

}
