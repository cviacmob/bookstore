<?php
class ControllerMylibraryMylibrary extends Controller {
	private $error = array();

	public function index()
	{

		 

		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('mylibrary/mylibrary', '', true);

			$this->response->redirect($this->url->link('account/login', '', true));
		}

		$this->load->language('mylibrary/mylibrary');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('mylibrary/mylibrary');

		$url = '';
 
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('mylibrary/mylibrary')
		);  

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_my_books_in_library'),
			'href' => $this->url->link('mylibrary/mylibrary')
		);

		$data['addbooks'] = $this->url->link('mylibrary/mylibrary/booksearch','',true);
		
		$data['text_my_library'] = $this->language->get('text_my_library');
		$data['text_add_books'] = $this->language->get('text_add_books');

		$data['text_my_books_in_library'] = $this->language->get('text_my_books_in_library');
		$data['text_my_books'] = $this->language->get('text_my_books');
		$data['text_purchased'] = $this->language->get('text_purchased');
		$data['text_reviewed'] = $this->language->get('text_reviewed');
		$data['text_favourites'] = $this->language->get('text_favourites');
		
			


 		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

     //$this->load->model('mylibrary/mylibrary');

		$customer_id = (int)$this->customer->getId();

		$data['books'] = array();

		$bookresults = $this->model_mylibrary_mylibrary->getBooks($customer_id);

		foreach($bookresults as $bookresult)
		{	
			if (is_file(DIR_IMAGE . $bookresult['image'])) {
				$image = $this->model_tool_image->resize($bookresult['image'], 228, 228);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 228, 228);
			}

			$data['books'][]=array(

				'isbn' =>$bookresult['isbn'],
				'image' =>$image,
				'title' =>$bookresult['title'],
				'author' =>$bookresult['author']

			);
		}
          
		if(isset($data['upload_success'])){
			$data['upload_success']=$data['upload_success'];
		}else{
			$data['upload_success']='';
		}  
		$data['addbooks'] = $this->url->link('mylibrary/mylibrary/booksearch','',true);

		$data['books_in_library'] = $this->url->link('mylibrary/mylibrary','',true);
		$data['purchased_books'] = $this->url->link('mylibrary/mylibrary/getPurchased','',true);
		$data['reviewed_books'] = $this->url->link('mylibrary/mylibrary/getReviewedBooks','',true);
		$data['favorite_books'] = $this->url->link('mylibrary/mylibrary/getFavorite','',true);

		$data['edit_mylibrary_books'] = $this->url->link('mylibrary/mylibrary/editMylibraryBooks&isbn=','',true);
		$data['delete_mylibrary_books'] = $this->url->link('mylibrary/mylibrary/deleteMylibraryBooks&isbn=','',true);

		
		$this->response->setOutput($this->load->view('mylibrary/books_in_mylibrary', $data));
		
	}

	public function getPurchased() 
	{

		$this->load->language('mylibrary/mylibrary');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('mylibrary/mylibrary');

		$url = '';
 
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('mylibrary/mylibrary')
		); 

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_purchased'),
			'href' => $this->url->link('mylibrary/mylibrary')
		);  

		   
		$data['heading_title'] = $this->language->get('heading_title');
 
 		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$data['button_wishlist'] = $this->language->get('button_wishlist');
 
		$customer_id = (int)$this->customer->getId();

		$this->load->model('mylibrary/mylibrary');

		$data['books'] = array();

		$bookresults = $this->model_mylibrary_mylibrary->getPurchasedBooks($customer_id);

		foreach($bookresults as $bookresult)
		{
			if (is_file(DIR_IMAGE . $bookresult['image'])) {
				$image = $this->model_tool_image->resize($bookresult['image'], 228, 228);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 228, 228);
			}

			$data['books'][]=array(

				'name' 		 =>$bookresult['name'],
				'product_id' 		 =>$bookresult['product_id'],
				'image'		 => $image,
				'href'       =>$this->url->link('product/product', 'path=' . '60_61' . '&product_id=' . $bookresult['product_id'] . $url)
				//'model'		 =>$bookresult['model']
				 

			);
		}

        $productlink =  "mylibrary/mylibrary/review&product_id=";
		$data['review'] = $this->url->link($productlink, '' , true);

		$productlink =  "mylibrary/mylibrary/addToFavorite&product_id=";
		$data['add_to_favorite'] = $this->url->link($productlink, '' , true);

		$data['text_my_library'] = $this->language->get('text_my_library');

		$data['text_my_books'] = $this->language->get('text_my_books');
		$data['text_purchased'] = $this->language->get('text_purchased');
		$data['text_reviewed'] = $this->language->get('text_reviewed');
		$data['text_favourites'] = $this->language->get('text_favourites');

		$data['text_purchased_books'] = $this->language->get('text_purchased_books');

		$data['books_in_library'] = $this->url->link('mylibrary/mylibrary','',true);
		$data['purchased_books'] = $this->url->link('mylibrary/mylibrary/getPurchased','',true);
		$data['reviewed_books'] = $this->url->link('mylibrary/mylibrary/getReviewedBooks','',true);
		$data['favorite_books'] = $this->url->link('mylibrary/mylibrary/getFavorite','',true);

        $this->response->setOutput($this->load->view('mylibrary/purchased_books', $data));

 	}

	public function addToFavorite()
	{
		$this->load->language('mylibrary/mylibrary');

		
		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('mylibrary/mylibrary');

		$url = '';
 
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard')
		);

		$data['breadcrumbs'][] = array(
			'text' => "My Library",
			'href' => $this->url->link('mylibrary/mylibrary')
		); 

		$data['breadcrumbs'][] = array(
			'text' => "Purchased Books",
			'href' => $this->url->link('mylibrary/mylibrary')
		); 

		$data['breadcrumbs'][] = array(
			'text' => "Write a Review",
			'href' => $this->url->link('mylibrary/mylibrary')
		);  


         if ($this->customer->isLogged()) {
				$data['customer_name'] = $this->customer->getFirstName() . '&nbsp;' . $this->customer->getLastName();
			} else {
				$data['customer_name'] = '';
			}

  
		$data['heading_title'] = $this->language->get('heading_title');
 
 		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		
	
		$product_id = $this->request->get['product_id'];

		$this->load->model('mylibrary/mylibrary');
		$this->model_mylibrary_mylibrary->addToFavorite($product_id);

		$data['books'] = array();
		$bookresults=$this->model_mylibrary_mylibrary->getFavorite();
		
		foreach($bookresults as $bookresult)
		{
			if (is_file(DIR_IMAGE . $bookresult['image'])) {
				$image = $this->model_tool_image->resize($bookresult['image'], 228, 228);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 228, 228);
			}

			$data['books'][]=array(

				'name' 		 =>$bookresult['name'],
				'product_id' 		 =>$bookresult['product_id'],
				'image'		 =>$image,
				'href'       =>$this->url->link('product/product', 'path=' . '60_61' . '&product_id=' . $bookresult['product_id'] . $url)
				//'model'		 =>$bookresult['model']
				 

			);
		}

		 

		$productlink =  "mylibrary/mylibrary/deleteFavorite&product_id=";
		$data['delete_favorite'] = $this->url->link($productlink, '' , true);

		$data['text_my_library'] = $this->language->get('text_my_library');

		$data['text_my_books'] = $this->language->get('text_my_books');
		$data['text_purchased'] = $this->language->get('text_purchased');
		$data['text_reviewed'] = $this->language->get('text_reviewed');
		$data['text_favourites'] = $this->language->get('text_favourites');

		$data['text_favourite_books'] = $this->language->get('text_favourite_books');

		
		$data['books_on_library'] = $this->url->link('mylibrary/mylibrary','',true);
		$data['purchased_books'] = $this->url->link('mylibrary/mylibrary/getPurchased','',true);
		$data['reviewed_books'] = $this->url->link('mylibrary/mylibrary/getReviewedBooks','',true);
		$data['favorite'] = $this->url->link('mylibrary/mylibrary/favorite','',true);	
		 
			
		//$data['continue'] = $this->url->link('mylibrary/mylibrary/write', '', true);	 
		 
        $this->response->setOutput($this->load->view('mylibrary/favorite_books', $data));

	}
	public function getFavorite()
	{

		 
		$this->load->language('mylibrary/mylibrary');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('mylibrary/mylibrary');

		$url = '';
 
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('mylibrary/mylibrary')
		); 

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_favourites'),
			'href' => $this->url->link('mylibrary/mylibrary')
		); 

		  


         if ($this->customer->isLogged()) {
				$data['customer_name'] = $this->customer->getFirstName() . '&nbsp;' . $this->customer->getLastName();
			} else {
				$data['customer_name'] = '';
			}

  
		$data['heading_title'] = $this->language->get('heading_title');
 
 		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

	 
		$data['books'] = array();
		$bookresults=$this->model_mylibrary_mylibrary->getFavorite();

		foreach($bookresults as $bookresult)
		{
			if (is_file(DIR_IMAGE . $bookresult['image'])) {
				$image = $this->model_tool_image->resize($bookresult['image'], 228, 228);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 228, 228);
			}

			$data['books'][]=array(

				'name' 		 	=>$bookresult['name'],
				'product_id' 	=>$bookresult['product_id'],
				'image'			=> $image,
				'href'       	=>$this->url->link('product/product', 'path=' . '60_61' . '&product_id=' . $bookresult['product_id'] . $url)
				//'model'		 =>$bookresult['model']
				 

			);

			
		}

		$productlink =  "mylibrary/mylibrary/deleteFavorite&product_id=";
		$data['delete_favorite'] = $this->url->link($productlink, '' , true);

		$data['text_my_library'] = $this->language->get('text_my_library');

		$data['text_my_books'] = $this->language->get('text_my_books');
		$data['text_purchased'] = $this->language->get('text_purchased');
		$data['text_reviewed'] = $this->language->get('text_reviewed');
		$data['text_favourites'] = $this->language->get('text_favourites');

		$data['text_favourite_books'] = $this->language->get('text_favourite_books');

		
		$data['books_in_library'] = $this->url->link('mylibrary/mylibrary','',true);
		$data['purchased_books'] = $this->url->link('mylibrary/mylibrary/getPurchased','',true);
		$data['reviewed_books'] = $this->url->link('mylibrary/mylibrary/getReviewedBooks','',true);
		$data['favorite_books'] = $this->url->link('mylibrary/mylibrary/getFavorite','',true);	
		 
			
		//$data['continue'] = $this->url->link('mylibrary/mylibrary/write', '', true);	 
		 
        $this->response->setOutput($this->load->view('mylibrary/favorite_books', $data));

	} 

	public function deleteFavorite()
	{
		$this->load->language('mylibrary/mylibrary');
		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('mylibrary/mylibrary');

		$url = '';
 
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard')
		);

		$data['breadcrumbs'][] = array(
			'text' => "My Library",
			'href' => $this->url->link('mylibrary/mylibrary')
		); 

		$data['breadcrumbs'][] = array(
			'text' => "Purchased Books",
			'href' => $this->url->link('mylibrary/mylibrary')
		); 

		$data['breadcrumbs'][] = array(
			'text' => "Write a Review",
			'href' => $this->url->link('mylibrary/mylibrary')
		);  

		$product_id = $this->request->get['product_id'];
			
		$this->load->model('mylibrary/mylibrary');
		$this->model_mylibrary_mylibrary->deleteFavorite($product_id);

		$this->getFavorite();
		//$this->response->setOutput($this->load->view('mylibrary/favorite_books', $data));


	}

	public function getReviewedBooks() 
	{

		$this->load->language('mylibrary/mylibrary');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('mylibrary/mylibrary');

		$url = '';
 
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('mylibrary/mylibrary')
		); 

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_reviewed'),
			'href' => $this->url->link('mylibrary/mylibrary')
		);  

		   
		$data['heading_title'] = $this->language->get('heading_title');
 
 		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$data['button_wishlist'] = $this->language->get('button_wishlist');

		$this->load->model('mylibrary/mylibrary');

		$data['books'] = array();

		$this->load->model('mylibrary/mylibrary');
		$reviewed_books = $this->model_mylibrary_mylibrary->getReviewedBooks((int)$this->customer->getId());

		 
		foreach($reviewed_books as $reviewed_book)
		{
			if (is_file(DIR_IMAGE . $reviewed_book['image'])) {
				$image = $this->model_tool_image->resize($reviewed_book['image'], 228, 228);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 228, 228);
			}

			$data['books'][]=array(

				'name' 		 			=>$reviewed_book['name'],
				'product_id' 		 	=>$reviewed_book['product_id'],
				'image'		 			=> $image,
				'href'       			=>$this->url->link('product/product', 'path=' . '60_61' . '&product_id=' . $reviewed_book['product_id'] . $url)
				//'model'		 =>$bookresult['model']
				 

			);
		}	

		$productlink =  "mylibrary/mylibrary/yourReview&product_id=";
		$data['your_review'] = $this->url->link($productlink, '' , true);

		$data['text_my_library'] = $this->language->get('text_my_library');

		$data['text_my_books'] = $this->language->get('text_my_books');
		$data['text_purchased'] = $this->language->get('text_purchased');
		$data['text_reviewed'] = $this->language->get('text_reviewed');
		$data['text_favourites'] = $this->language->get('text_favourites');

		$data['text_reviewed_books'] = $this->language->get('text_reviewed_books');

		$data['books_in_library'] = $this->url->link('mylibrary/mylibrary','',true);
		$data['purchased_books'] = $this->url->link('mylibrary/mylibrary/getPurchased','',true);
		$data['reviewed_books'] = $this->url->link('mylibrary/mylibrary/getReviewedBooks','',true);
		$data['favorite_books'] = $this->url->link('mylibrary/mylibrary/getFavorite','',true);

		$this->response->setOutput($this->load->view('mylibrary/reviewed_books', $data));	

	}

	public function yourReview() 
	{ 

		$this->load->language('mylibrary/mylibrary');

		$this->load->language('account/wishlist');

		$data['text_write'] = "Write a Review";
		
		$data['entry_name']      = "Your Name";
		$data['entry_review']    = "Your Review";
		$data['entry_rating']    = "Rating";
		$data['entry_good']      = "Good";
		$data['entry_bad']       = "Bad";
		$data['entry_rating']    = "Rating";
		$data['button_continue'] = "Submit";
		$data['review_guest']    = $this->language->get('text_login');
		$data['text_loading']    = $this->language->get('text_login');


		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('mylibrary/mylibrary');

		$url = '';
 
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard')
		);

		$data['breadcrumbs'][] = array(
			'text' => "My Library",
			'href' => $this->url->link('mylibrary/mylibrary')
		); 

		$data['breadcrumbs'][] = array(
			'text' => "Purchased Books",
			'href' => $this->url->link('mylibrary/mylibrary')
		); 

		$data['breadcrumbs'][] = array(
			'text' => "Your Review",
			'href' => $this->url->link('mylibrary/mylibrary')
		);  


       if ($this->customer->isLogged()) {
				$data['customer_name'] = $this->customer->getFirstName() . '&nbsp;' . $this->customer->getLastName();
			} else {
				$data['customer_name'] = '';
			}
 
		$data['heading_title'] = $this->language->get('heading_title');
 
 		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

			$data['button_wishlist'] = $this->language->get('button_wishlist');

			$data['wishlist'] = $this->url->link('account/wishlist', '', true);

		
		$product_id = $this->request->get['product_id'];
		$product  = $this->model_catalog_product->getProduct($product_id);

		$data['product_info']=array(

			'product_id' 	=> $product['product_id'],
			'name' 			=> $product['name'],
			'model' 		=> $product['model'],
			'image' 		=> "image/".$product['image']

		); 		

		$this->load->model('mylibrary/mylibrary');

		$data['review_status'] = $this->config->get('config_review_status');

			
		$your_review = $this->model_mylibrary_mylibrary->getYourReview($product_id);
		

		$data['yourReview'] = $your_review;

		// $productlink =  "mylibrary/mylibrary/write&product_id=";
			//$data['continue'] = $this->url->link($productlink, '' , true);
			
		//$data['continue'] = $this->url->link('mylibrary/mylibrary/write', '', true);

		$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');	

		$data['text_my_library'] = $this->language->get('text_my_library');

		$data['text_my_books'] = $this->language->get('text_my_books');
		$data['text_purchased'] = $this->language->get('text_purchased');
		$data['text_reviewed'] = $this->language->get('text_reviewed');
		$data['text_favourites'] = $this->language->get('text_favourites');	 

		$data['text_your_review'] = $this->language->get('text_your_review');
		$data['text_your_rating'] = $this->language->get('text_your_rating');

		$data['text_isbn'] = $this->language->get('text_isbn');

		$data['books_in_library'] = $this->url->link('mylibrary/mylibrary','',true);
		$data['purchased_books'] = $this->url->link('mylibrary/mylibrary/getPurchased','',true);
		$data['reviewed_books'] = $this->url->link('mylibrary/mylibrary/getReviewedBooks','',true);
		$data['favorite_books'] = $this->url->link('mylibrary/mylibrary/getFavorite','',true);
		 
        $this->response->setOutput($this->load->view('mylibrary/yourReview', $data));
	}

	public function review()
	{

		 
		$this->load->language('mylibrary/mylibrary');

		$this->load->language('account/wishlist');

		$data['text_write'] = "Write a Review";
		
		$data['entry_name']      = "Your Name";
		$data['entry_review']    = "Your Review";
		$data['entry_rating']    = "Rating";
		$data['entry_good']      = "Good";
		$data['entry_bad']       = "Bad";
		$data['entry_rating']    = "Rating";
		$data['button_continue'] = "Submit";
		$data['review_guest']    = $this->language->get('text_login');
		$data['text_loading']    = $this->language->get('text_login');


		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('mylibrary/mylibrary');

		$url = '';
 
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard')
		);

		$data['breadcrumbs'][] = array(
			'text' => "My Library",
			'href' => $this->url->link('mylibrary/mylibrary')
		); 

		$data['breadcrumbs'][] = array(
			'text' => "Purchased Books",
			'href' => $this->url->link('mylibrary/mylibrary')
		); 

		$data['breadcrumbs'][] = array(
			'text' => "Write a Review",
			'href' => $this->url->link('mylibrary/mylibrary')
		);  


         if ($this->customer->isLogged()) {
				$data['customer_name'] = $this->customer->getFirstName() . '&nbsp;' . $this->customer->getLastName();
			} else {
				$data['customer_name'] = '';
			}
 
		$data['heading_title'] = $this->language->get('heading_title');
 
 		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$data['button_wishlist'] = $this->language->get('button_wishlist');

		$data['wishlist'] = $this->url->link('account/wishlist', '', true);

		$product_id = $this->request->get['product_id'];
		$product  = $this->model_catalog_product->getProduct($product_id);

		$data['product_info']=array(

			'product_id' 	=> $product['product_id'],
			'name' 			=> $product['name'],
			'model' 		=> $product['model'],
			'author' 		=> $product['author'],
			'publisher' 	=> $product['publisher'],
			'cover_type' 	=> $product['cover_type'],
			'no_of_pages' 	=> $product['no_of_pages'],
			'image' 		=> "image/".$product['image']

		); 		

		//$data['review_status'] = $this->config->get('config_review_status');


		$data['review_status'] = $this->model_mylibrary_mylibrary->checkReview($product_id);

		$data['review'] = $this->model_mylibrary_mylibrary->productReview($product_id);


		$productlink =  "mylibrary/mylibrary/write&product_id=";
		$data['write_review'] = $this->url->link($productlink, '' , true);

		$data['text_my_library'] = $this->language->get('text_my_library');

		$data['text_my_books'] 		= $this->language->get('text_my_books');
		$data['text_purchased'] 	= $this->language->get('text_purchased');
		$data['text_reviewed'] 		= $this->language->get('text_reviewed');
		$data['text_favourites'] 	= $this->language->get('text_favourites');	 

		$data['text_your_review'] 	= $this->language->get('text_your_review');
		$data['text_your_rating'] 	= $this->language->get('text_your_rating');

		$data['text_isbn'] 			= $this->language->get('text_isbn');
		$data['text_publisher'] 	= $this->language->get('text_publisher');

		$data['books_in_library'] 	= $this->url->link('mylibrary/mylibrary','',true);
		$data['purchased_books'] 	= $this->url->link('mylibrary/mylibrary/getPurchased','',true);
		$data['reviewed_books'] 	= $this->url->link('mylibrary/mylibrary/getReviewedBooks','',true);
		$data['favorite_books'] 	= $this->url->link('mylibrary/mylibrary/getFavorite','',true);
	
		//$data['continue'] = $this->url->link('mylibrary/mylibrary/write', '', true);	 
		 
		if(isset($data['error'])){
			$data['error'] = $this->language->get('error_text');
		}else{
		    $data['error'] = '';	
		} 


        $this->response->setOutput($this->load->view('mylibrary/purchasedbooks_reviews', $data));



	}

	public function write() 
	{
 
		 $this->load->language('mylibrary/mylibrary');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['text_write'] = "Write a Review";
		
		$data['entry_name']      = "Your Name";
		$data['entry_review']    = "Your Review";
		$data['entry_rating']    = "Rating";
		$data['entry_good']      = "Good";
		$data['entry_bad']       = "Bad";
		$data['entry_rating']    = "Rating";
		$data['button_continue'] = "Submit";
		$data['review_guest']    = $this->language->get('text_login');
		$data['text_loading']    = $this->language->get('text_login');


		$this->load->model('mylibrary/mylibrary');

		$url = '';
 
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard')
		);

		$data['breadcrumbs'][] = array(
			'text' => "My Library",
			'href' => $this->url->link('mylibrary/mylibrary')
		); 

		$data['breadcrumbs'][] = array(
			'text' => "Purchased Books",
			'href' => $this->url->link('mylibrary/mylibrary')
		);  

		   
		$data['heading_title'] = $this->language->get('heading_title');
 
 		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$product_id = $this->request->get['product_id'];
		$product  = $this->model_catalog_product->getProduct($product_id);

		$data['product_info']=array(

			'product_id' 	=> $product['product_id'],
			'name' 			=> $product['name'],
			'model' 		=> $product['model'],
			'image' 		=> "image/".$product['image']

		); 	

		

		$data['review_status'] = $this->model_mylibrary_mylibrary->checkReview($product_id);

		$data['review'] = $this->model_mylibrary_mylibrary->productReview($product_id); 

		$this->load->language('product/product');

		$product_id = $this->request->get['product_id'];

		
		$text = $this->request->post['text'];

		

		//$json = array();

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {

		 
			if ((utf8_strlen($this->request->post['text']) < 25) || (utf8_strlen($this->request->post['text']) > 1000)) {
				$data['error'] = $this->language->get('error_text');
			}

			if (empty($this->request->post['rating']) || $this->request->post['rating'] < 0 || $this->request->post['rating'] > 5) {
				$data['error'] = $this->language->get('error_rating');
			}

		if (!isset($data['error'])&& $data['review_status']==false) {
			$this->load->model('catalog/review');

			$this->model_catalog_review->addReview($this->request->get['product_id'], $this->request->post);

			$data['success'] = $this->language->get('text_success');

			$this->load->model('mylibrary/mylibrary');
			
			$reviewed_books = $this->model_mylibrary_mylibrary->getReviewedBooks((int)$this->customer->getId());

		 
		foreach($reviewed_books as $reviewed_book)
		{
			if (is_file(DIR_IMAGE . $reviewed_book['image'])) {
				$image = $this->model_tool_image->resize($reviewed_book['image'], 228, 228);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 228, 228);
			}

			$data['books'][]=array(

				'name' 		 			=>$reviewed_book['name'],
				'product_id' 		 	=>$reviewed_book['product_id'],
				'image'		 			=> $image,
				'href'       			=>$this->url->link('product/product', 'path=' . '60_61' . '&product_id=' . $reviewed_book['product_id'] . $url)
				//'model'		 =>$bookresult['model']
				 

			);
		}	

		$data['books_in_library'] = $this->url->link('mylibrary/mylibrary','',true);
		$data['purchased_books'] = $this->url->link('mylibrary/mylibrary/getPurchased','',true);
		$data['reviewed_books'] = $this->url->link('mylibrary/mylibrary/getReviewedBooks','',true);
		$data['favorite_books'] = $this->url->link('mylibrary/mylibrary/getFavorite','',true);

		$productlink =  "mylibrary/mylibrary/yourReview&product_id=";
		$data['your_review'] = $this->url->link($productlink, '' , true);

		$data['text_my_books'] = $this->language->get('text_my_books');
		$data['text_purchased'] = $this->language->get('text_purchased');
		$data['text_reviewed'] = $this->language->get('text_reviewed');
		$data['text_favourites'] = $this->language->get('text_favourites');

		$data['text_reviewed_books'] = $this->language->get('text_reviewed_books');
		
		$this->response->setOutput($this->load->view('mylibrary/reviewed_books', $data));	

			}else{
		

			$data['product_info']=array(

			'product_id' 	=> $product['product_id'],
			'name' 			=> $product['name'],
			'model' 		=> $product['model'],
			'author' 		=> $product['author'],
			'publisher' 	=> $product['publisher'],
			'cover_type' 	=> $product['cover_type'],
			'no_of_pages' 	=> $product['no_of_pages'],
			'image' 		=> "image/".$product['image']

		); 		

		//$data['review_status'] = $this->config->get('config_review_status');


		//$data['review_status'] = $this->model_mylibrary_mylibrary->checkReview($product_id);

		//$data['review'] = $this->model_mylibrary_mylibrary->productReview($product_id);


		$productlink =  "mylibrary/mylibrary/write&product_id=";
		$data['write_review'] = $this->url->link($productlink, '' , true);

		$data['books_in_library'] = $this->url->link('mylibrary/mylibrary','',true);
		$data['purchased_books'] = $this->url->link('mylibrary/mylibrary/getPurchased','',true);
		$data['reviewed_books'] = $this->url->link('mylibrary/mylibrary/getReviewedBooks','',true);
		$data['favorite_books'] = $this->url->link('mylibrary/mylibrary/getFavorite','',true);

		$data['text_my_books'] = $this->language->get('text_my_books');
		$data['text_purchased'] = $this->language->get('text_purchased');
		$data['text_reviewed'] = $this->language->get('text_reviewed');
		$data['text_favourites'] = $this->language->get('text_favourites');
	
		//$data['continue'] = $this->url->link('mylibrary/mylibrary/write', '', true);	 
		 
		 
        $this->response->setOutput($this->load->view('mylibrary/purchasedbooks_reviews', $data));

		}	

		
		

	

		//$this->response->addHeader('Content-Type: application/json');
		//$this->response->setOutput(json_encode($json));

		
		//$this->response->addHeader('Content-Type: application/json');
		//$this->response->setOutput(json_encode($json));
	  }

	}

	public function booksearch() 
	{
 
		 $this->load->language('mylibrary/mylibrary');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('mylibrary/mylibrary');
 
		$url = '';
		 
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('mylibrary/mylibrary')
		);

	 	
 		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$data['searchisbn'] = $this->url->link('mylibrary/mylibrary/searchByISBN' , '' , true);

		$data['search_author'] = $this->url->link('mylibrary/mylibrary/searchByAuthor' , '' , true);

		$data['text_my_library'] = $this->language->get('text_my_library');
		$data['text_my_books'] = $this->language->get('text_my_books');
		$data['text_purchased'] = $this->language->get('text_purchased');
		$data['text_reviewed'] = $this->language->get('text_reviewed');
		$data['text_favourites'] = $this->language->get('text_favourites');

		$data['text_no_result'] = $this->language->get('text_no_result');
		$data['text_upload_image'] = $this->language->get('text_upload_image');
		$data['text_front_back_image'] = $this->language->get('text_front_back_image');
		$data['text_front_image'] = $this->language->get('text_front_image');
		$data['text_back_image'] = $this->language->get('text_back_image');
		$data['text_close'] = $this->language->get('text_close');

		

		$data['books_in_library'] = $this->url->link('mylibrary/mylibrary','',true);
		$data['purchased_books'] = $this->url->link('mylibrary/mylibrary/getPurchased','',true);
		$data['reviewed_books'] = $this->url->link('mylibrary/mylibrary/getReviewedBooks','',true);
		$data['favorite_books'] = $this->url->link('mylibrary/mylibrary/getFavorite','',true);

		if(isset($this->error['text_mastersearch'])){

			$data['invalid_isbn'] = $this->error['text_mastersearch'];
		}else{
			$data['invalid_isbn'] = '';
		}

		$data['upload_image'] = $this->url->link('mylibrary/mylibrary/uploadImage','',true);

		$this->response->setOutput($this->load->view('mylibrary/book_search', $data));


	}


	public function uploadImage()
	{
		
 		$target_dir = "C:\wamp64\www\bookstore\image\catalog/";
		$target_file_front = $target_dir . basename($_FILES["front_image"]["name"]);
		$uploadOk = 1;
	
		$imageFileType = pathinfo($target_file_front,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"]) && $_FILES["front_image"]["name"] ) {
  		  $check = getimagesize($_FILES["front_image"]["tmp_name"]);
  		  if($check !== false) {
  	      //echo "File is an image - " . $check["mime"] . ".";
  	      $uploadOk = 1;
  		  } else {
  	 	    $data['upload_success'] = "File is not an image.";
   	  	   $uploadOk = 0;
   		  }
		}

	
			// Check file size
			if ($_FILES["front_image"]["size"] > 500000) {
   			 $data['upload_success'] = "Sorry, your file is too large.";
   			 $uploadOk = 0;
			}

			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			  && $imageFileType != "gif" ) {
  			  $data['upload_success'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  			  $uploadOk = 0;
			}

			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
 	 		  $data['upload_success'] = "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
 	   		if (move_uploaded_file($_FILES["front_image"]["tmp_name"], $target_file_front)) {
 	     	 // echo "The file ". basename( $_FILES["front_image"]["name"]). " has been uploaded.";
			$data['upload_success'] = "Your Book Images has been uploaded" ;

			 
 	  	 	} else {
        		$data['upload_success'] = "Sorry, there was an error uploading your file.";
  	 	 	}
		}

			$target_file_back = $target_dir . basename($_FILES["back_image"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file_back,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])&& $_FILES["back_image"]["name"]) {
  	 		 $check = getimagesize($_FILES["back_image"]["tmp_name"]);
  	 		 if($check !== false) {
  	     	 //echo "File is an image - " . $check["mime"] . ".";
  	      	$uploadOk = 1;
  	 		 } else {
  	     		 $data['upload_success'] = "File is not an image.";
   	     		$uploadOk = 0;
   	 		}
		}

			// Check file size
			if ($_FILES["back_image"]["size"] > 500000) {
   		 	$data['upload_success'] ="Sorry, your file is too large.";
   			 $uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		  	&& $imageFileType != "gif" ) {
  		  	$data['upload_success'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  		  	$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
 	   		$data['upload_success'] = "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
 	   		if (move_uploaded_file($_FILES["back_image"]["tmp_name"], $target_file_back)) {
 	       		//echo "The file ". basename( $_FILES["back_image"]["name"]). " has been uploaded.";
				$data['upload_success'] = "Your Book Images has been uploaded" ;

			

			
 	   		} else {
        		$data['upload_success'] = "Sorry, there was an error uploading your file.";
			 
  	  		}
		}

		    
		$this->load->language('mylibrary/mylibrary');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('mylibrary/mylibrary');

		
		$this->model_mylibrary_mylibrary->uploadImage();

		$url = '';
 
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('mylibrary/mylibrary')
		);  

		$data['breadcrumbs'][] = array(
			'text' => "My books in Library",
			'href' => $this->url->link('mylibrary/mylibrary')
		);

		$data['addbooks'] = $this->url->link('mylibrary/mylibrary/booksearch','',true);
		
  
		$data['heading_title'] = $this->language->get('heading_title');

 		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

     //$this->load->model('mylibrary/mylibrary');

		$customer_id = (int)$this->customer->getId();

		$data['books'] = array();

		$bookresults = $this->model_mylibrary_mylibrary->getBooks($customer_id);

		foreach($bookresults as $bookresult)
		{	
			if (is_file(DIR_IMAGE . $bookresult['image'])) {
				$image = $this->model_tool_image->resize($bookresult['image'], 228, 228);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 228, 228);
			}

			$data['books'][]=array(

				'isbn' =>$bookresult['isbn'],
				'image' =>$image,
				'title' =>$bookresult['title'],
				'author' =>$bookresult['author']

			);
		}
          
		$data['addbooks'] = $this->url->link('mylibrary/mylibrary/booksearch','',true);

		$data['text_my_library'] = $this->language->get('text_my_library');
		$data['text_my_books'] = $this->language->get('text_my_books');
		$data['text_purchased'] = $this->language->get('text_purchased');
		$data['text_reviewed'] = $this->language->get('text_reviewed');
		$data['text_favourites'] = $this->language->get('text_favourites');
		$data['text_my_books_in_library'] = $this->language->get('text_my_books_in_library');
		$data['text_add_books'] = $this->language->get('text_add_books');

		$data['books_in_library'] = $this->url->link('mylibrary/mylibrary','',true);
		$data['purchased_books'] = $this->url->link('mylibrary/mylibrary/getPurchased','',true);
		$data['reviewed_books'] = $this->url->link('mylibrary/mylibrary/getReviewedBooks','',true);
		$data['favorite_books'] = $this->url->link('mylibrary/mylibrary/getFavorite','',true);

		$data['edit_mylibrary_books'] = $this->url->link('mylibrary/mylibrary/editMylibraryBooks&isbn=','',true);
		$data['delete_mylibrary_books'] = $this->url->link('mylibrary/mylibrary/deleteMylibraryBooks&isbn=','',true);

		
		$this->response->setOutput($this->load->view('mylibrary/books_in_mylibrary', $data));
    } 


/*
	public function searchByAuthor()
	 {
		if (isset($this->request->post['search_by_author'])) {
			$author_name = $this->request->post['search_by_author'];
		} else {
			$mastersearch = '';
		}

	 } */

	 public function searchByISBN()
	 {

		 $this->load->language('mylibrary/mylibrary');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('mylibrary/mylibrary');
 
		$url = '';
		 
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('mylibrary/mylibrary')
		);

	  	 
  		$this->load->model('setting/store');

		$data['stores'] = $this->model_setting_store->getStores();
		
 		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
 
		//$this->load->language('mylibrary/mastersearch');

		$this->load->model('mylibrary/mylibrary');

		$data['searchisbn'] = $this->url->link('mylibrary/mylibrary/searchByISBN' , '' , true);

		$data['text_mastersearch'] = $this->language->get('text_mastersearch');

		/* if (isset($this->request->post['text_mastersearch'])) {
			$mastersearch = $this->request->post['text_mastersearch'];
		} else {
			$mastersearch = '';
		}  */

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

			
			if (isset($this->error['text_mastersearch'])) {
				$data['invalid_isbn'] = $this->error['text_mastersearch'];

				$data['searchisbn'] = $this->url->link('mylibrary/mylibrary/searchByISBN' , '' , true);

				$data['search_author'] = $this->url->link('mylibrary/mylibrary/searchByAuthor' , '' , true);

				$data['text_my_library'] = $this->language->get('text_my_library');
				$data['text_my_books'] = $this->language->get('text_my_books');
				$data['text_purchased'] = $this->language->get('text_purchased');
				$data['text_reviewed'] = $this->language->get('text_reviewed');
				$data['text_favourites'] = $this->language->get('text_favourites');

				$data['text_isbn'] = $this->language->get('text_isbn');
				$data['text_publisher'] = $this->language->get('text_publisher');
				$data['text_sell_price'] = $this->language->get('text_sell_price');
				$data['text_share_price'] = $this->language->get('text_share_price');

				$data['text_no_result'] = $this->language->get('text_no_result');
				$data['text_upload_image'] = $this->language->get('text_upload_image');
				$data['text_front_image'] = $this->language->get('text_front_image');
				$data['text_back_image'] = $this->language->get('text_back_image');
				$data['text_front_back_image'] = $this->language->get('text_front_back_image');

				$data['books_in_library'] = $this->url->link('mylibrary/mylibrary','',true);
				$data['purchased_books'] = $this->url->link('mylibrary/mylibrary/getPurchased','',true);
				$data['reviewed_books'] = $this->url->link('mylibrary/mylibrary/getReviewedBooks','',true);
				$data['favorite_books'] = $this->url->link('mylibrary/mylibrary/getFavorite','',true);

				$this->response->setOutput($this->load->view('mylibrary/book_search', $data));


			} else {
				
				$books = $this->model_mylibrary_mylibrary->getBookFromMaster($this->request->post['text_mastersearch']);

				

				if($books == false)
				{
					$data['invalid_isbn'] ="Please enter valid ISBN";

					$data['searchisbn'] = $this->url->link('mylibrary/mylibrary/searchByISBN' , '' , true);

					$data['search_author'] = $this->url->link('mylibrary/mylibrary/searchByAuthor' , '' , true);

					$data['text_my_library'] = $this->language->get('text_my_library');
					$data['text_my_books'] = $this->language->get('text_my_books');
					$data['text_purchased'] = $this->language->get('text_purchased');
					$data['text_reviewed'] = $this->language->get('text_reviewed');
					$data['text_favourites'] = $this->language->get('text_favourites');

					$data['text_isbn'] = $this->language->get('text_isbn');
					$data['text_publisher'] = $this->language->get('text_publisher');
					$data['text_sell_price'] = $this->language->get('text_sell_price');
					$data['text_share_price'] = $this->language->get('text_share_price');

					$data['text_no_result'] = $this->language->get('text_no_result');
					$data['text_upload_image'] = $this->language->get('text_upload_image');
					$data['text_front_image'] = $this->language->get('text_front_image');
					$data['text_back_image'] = $this->language->get('text_back_image');
					$data['text_front_back_image'] = $this->language->get('text_front_back_image');
					$data['text_close'] = $this->language->get('text_close');

					$data['books_in_library'] = $this->url->link('mylibrary/mylibrary','',true);
					$data['purchased_books'] = $this->url->link('mylibrary/mylibrary/getPurchased','',true);
					$data['reviewed_books'] = $this->url->link('mylibrary/mylibrary/getReviewedBooks','',true);
					$data['favorite_books'] = $this->url->link('mylibrary/mylibrary/getFavorite','',true);

					$this->response->setOutput($this->load->view('mylibrary/book_search', $data));

				}else{
					
					$data['bookresult'] = $books;
					$booklink =  "mylibrary/mylibrary/addToLibrary&isbn=".$books['isbn'] ;
 		 
					$data['add_to_library'] = $this->url->link($booklink, '' , true);

					$data['text_my_library'] = $this->language->get('text_my_library');
					$data['text_my_books'] = $this->language->get('text_my_books');
					$data['text_purchased'] = $this->language->get('text_purchased');
					$data['text_reviewed'] = $this->language->get('text_reviewed');
					$data['text_favourites'] = $this->language->get('text_favourites');

					$data['text_isbn'] = $this->language->get('text_isbn');
					$data['text_publisher'] = $this->language->get('text_publisher');
					$data['text_sell_price'] = $this->language->get('text_sell_price');
					$data['text_share_price'] = $this->language->get('text_share_price');

					$data['text_your_price'] = $this->language->get('text_your_price');

					$data['text_price'] = $this->language->get('text_price');

					$data['books_in_library'] = $this->url->link('mylibrary/mylibrary','',true);
					$data['purchased_books'] = $this->url->link('mylibrary/mylibrary/getPurchased','',true);
					$data['reviewed_books'] = $this->url->link('mylibrary/mylibrary/getReviewedBooks','',true);
					$data['favorite_books'] = $this->url->link('mylibrary/mylibrary/getFavorite','',true);

      		    $this->response->setOutput($this->load->view('mylibrary/mastersearch', $data));

				}

				

			}

		}	
 
	 }  

	 private function validate()
		{
			if ((utf8_strlen($this->request->post['text_mastersearch']) < 10) || (utf8_strlen($this->request->post['text_mastersearch']) > 13)) {
			$this->error['text_mastersearch'] = $this->language->get('text_mastersearch');

			return $this->error['text_mastersearch'];
			
			}else{
				return   $this->request->post['text_mastersearch'];
			}

		
		}
	 
	 public function addToLibrary() 
	 {
 
		$this->load->language('mylibrary/mylibrary');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('mylibrary/mylibrary');

		

		$url = '';
 
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('mylibrary/mylibrary')
		);

		$data['addbooks'] = $this->url->link('mylibrary/mastersearch','',true);
  
		$data['heading_title'] = $this->language->get('heading_title');
 
 		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
 
		

	     $this->load->language('mylibrary/mylibrary');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$isbn =  $this->request->get['isbn'];
		$this->load->model('mylibrary/mylibrary');

		$sell_price = $this->request->post['sell_price'];
		$share_price = $this->request->post['share_price'];
		//$lend_price = $this->request->post['lend_price'];

		//$min_bid_price = $this->request->post['min_bid_price'];
		//$max_bid_price = $this->request->post['max_bid_price'];

		$this->load->model('mylibrary/mylibrary');

		$customer_id = (int)$this->customer->getId();

		$data['books'] = array();

		$book = $this->model_mylibrary_mylibrary->getBook($isbn);

		if(isset($this->request->post['share_price'])){
			
			$this->model_mylibrary_mylibrary->shared_books($isbn);
					
		}

		$existing_book = $this->model_mylibrary_mylibrary->addToMylibrary($isbn);
		
		$data['existing_book']=array(

			
				'isbn' =>$book['isbn'],
				'image' =>"image/".$book['image'],
				'title' =>$book['title'],
				'author' =>$book['author'],
				'publisher' =>$book['publisher'],
				'cover_type' =>$book['cover_type'],
				'no_of_pages' =>$book['no_of_pages']
				

		);

		

		if($existing_book == true)
		{
			$data['text_my_books_in_library'] = $this->language->get('text_my_books_in_library');
			$data['text_my_books'] = $this->language->get('text_my_books');
			$data['text_purchased'] = $this->language->get('text_purchased');
			$data['text_reviewed'] = $this->language->get('text_reviewed');
			$data['text_favourites'] = $this->language->get('text_favourites');
			$data['text_exist_book'] = $this->language->get('text_exist_book');
			$data['text_isbn'] = $this->language->get('text_isbn');
			$data['text_publisher'] = $this->language->get('text_publisher');

			$data['searchisbn'] = $this->url->link('mylibrary/mylibrary/searchByISBN' , '' , true);

			$data['books_in_library'] = $this->url->link('mylibrary/mylibrary','',true);
			$data['purchased_books'] = $this->url->link('mylibrary/mylibrary/getPurchased','',true);
			$data['reviewed_books'] = $this->url->link('mylibrary/mylibrary/getReviewedBooks','',true);
			$data['favorite_books'] = $this->url->link('mylibrary/mylibrary/getFavorite','',true);

			$this->response->setOutput($this->load->view('mylibrary/existing_book', $data));

			return;
		}

		

		$this->model_mylibrary_mylibrary->addToProduct($book);

		$bookresults = $this->model_mylibrary_mylibrary->getBooks($customer_id);

		foreach($bookresults as $bookresult)
		{	
			if (is_file(DIR_IMAGE . $bookresult['image'])) {
				$image = $this->model_tool_image->resize($bookresult['image'], 228, 228);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 228, 228);
			}

			$data['books'][]=array(

				'isbn' =>$bookresult['isbn'],
				'image' =>$image,
				'title' =>$bookresult['title'],
				'author' =>$bookresult['author']

			);
		}
		
		if(isset($data['upload_success'])){
			$data['upload_success']=$data['upload_success'];
		}else{
			$data['upload_success']='';
		}  

			$data['text_my_books_in_library'] = $this->language->get('text_my_books_in_library');
			$data['text_my_books'] = $this->language->get('text_my_books');
			$data['text_purchased'] = $this->language->get('text_purchased');
			$data['text_reviewed'] = $this->language->get('text_reviewed');
			$data['text_favourites'] = $this->language->get('text_favourites');
			$data['text_exist_book'] = $this->language->get('text_exist_book');
			$data['text_isbn'] = $this->language->get('text_isbn');
			$data['text_publisher'] = $this->language->get('text_publisher');
			$data['text_my_library'] = $this->language->get('text_my_library');
			$data['text_add_books'] = $this->language->get('text_add_books');


		$data['addbooks'] = $this->url->link('mylibrary/mylibrary/booksearch','',true);

		$data['edit_mylibrary_books'] = $this->url->link('mylibrary/mylibrary/editMylibraryBooks&isbn=','',true);
		$data['delete_mylibrary_books'] = $this->url->link('mylibrary/mylibrary/deleteMylibraryBooks&isbn=','',true);

		$data['books_in_library'] = $this->url->link('mylibrary/mylibrary','',true);
		$data['purchased_books'] = $this->url->link('mylibrary/mylibrary/getPurchased','',true);
		$data['reviewed_books'] = $this->url->link('mylibrary/mylibrary/getReviewedBooks','',true);
		$data['favorite_books'] = $this->url->link('mylibrary/mylibrary/getFavorite','',true);

        $this->response->setOutput($this->load->view('mylibrary/books_in_mylibrary', $data));
		 
	 }

	 public function editMylibraryBooks()
	 {
		 
		 $this->load->language('mylibrary/mylibrary');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('mylibrary/mylibrary');
 
		$url = '';
		 
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('mylibrary/mylibrary')
		);

	  	 
  		$this->load->model('setting/store');

		$data['stores'] = $this->model_setting_store->getStores();
		
 		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
 
		//$this->load->language('mylibrary/mastersearch');

		$this->load->model('mylibrary/mylibrary');

		$data['searchisbn'] = $this->url->link('mylibrary/mylibrary/searchByISBN' , '' , true);

		$data['text_mastersearch'] = $this->language->get('text_mastersearch');

		if (isset($this->request->post['text_mastersearch'])) {
			$mastersearch = $this->request->post['text_mastersearch'];
		} else {
			$mastersearch = '';
		}

		$isbn = $this->request->get['isbn'];
 
		$books = $this->model_mylibrary_mylibrary->editBook($isbn);

		$data['bookresult'] = $books;

		

		$booklink =  "mylibrary/mylibrary/updateToLibrary&isbn=".$books['isbn'] ;
 		 
		$data['update_to_library'] = $this->url->link($booklink, '' , true);

		$data['text_my_library'] = $this->language->get('text_my_library');

		$data['text_my_books'] = $this->language->get('text_my_books');
		$data['text_purchased'] = $this->language->get('text_purchased');
		$data['text_reviewed'] = $this->language->get('text_reviewed');
		$data['text_favourites'] = $this->language->get('text_favourites');

		$data['text_isbn'] = $this->language->get('text_isbn');
		$data['text_publisher'] = $this->language->get('text_publisher');

		$data['text_sell_price'] = $this->language->get('text_sell_price');
		$data['text_share_price'] = $this->language->get('text_share_price');

		$data['text_your_price'] = $this->language->get('text_your_price');

		$data['books_in_library'] = $this->url->link('mylibrary/mylibrary','',true);
		$data['purchased_books'] = $this->url->link('mylibrary/mylibrary/getPurchased','',true);
		$data['reviewed_books'] = $this->url->link('mylibrary/mylibrary/getReviewedBooks','',true);
		$data['favorite_books'] = $this->url->link('mylibrary/mylibrary/getFavorite','',true);

        $this->response->setOutput($this->load->view('mylibrary/edit_mylibrary_books', $data));

	 }

	 public function updateToLibrary() 
	 {
 
		$this->load->language('mylibrary/mylibrary');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('mylibrary/mylibrary');

		

		$url = '';
 
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('mylibrary/mylibrary')
		);

		$data['addbooks'] = $this->url->link('mylibrary/mastersearch','',true);
  
		$data['heading_title'] = $this->language->get('heading_title');
 
 		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
 
		

	    $this->load->language('mylibrary/mylibrary');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$isbn =  $this->request->get['isbn'];
		$this->load->model('mylibrary/mylibrary');

		$sell_price = $this->request->post['sell_price'];

		$share_price = $this->request->post['share_price'];
		//$lend_price = $this->request->post['lend_price'];

		//$min_bid_price = $this->request->post['min_bid_price'];
		//$max_bid_price = $this->request->post['max_bid_price'];

 		$this->load->model('mylibrary/mylibrary');

		

		$data['books'] = array();

		$book = $this->model_mylibrary_mylibrary->updateBook($isbn);

		$this->index();

				 
	 }

	 public function deleteMylibraryBooks()
	 {
		 
		 $this->load->language('mylibrary/mylibrary');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('mylibrary/mylibrary');
 
		$url = '';
		 
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('mylibrary/mylibrary')
		);

	  	 
  		$this->load->model('setting/store');

		$data['stores'] = $this->model_setting_store->getStores();
		
 		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
 
		//$this->load->language('mylibrary/mastersearch');

		$this->load->model('mylibrary/mylibrary');

		$data['searchisbn'] = $this->url->link('mylibrary/mylibrary/searchByISBN' , '' , true);

		$data['text_mastersearch'] = $this->language->get('text_mastersearch');

		if (isset($this->request->post['text_mastersearch'])) {
			$mastersearch = $this->request->post['text_mastersearch'];
		} else {
			$mastersearch = '';
		}

		$isbn = $this->request->get['isbn'];
 
		$books = $this->model_mylibrary_mylibrary->deleteBook($isbn);

		$data['bookresult'] = $books;

		$book = $this->model_mylibrary_mylibrary->getBook($isbn);
		$this->model_mylibrary_mylibrary->deleteFromProduct($book);

		

		 
		$data['books_in_library'] = $this->url->link('mylibrary/mylibrary','',true);
		$data['purchased_books'] = $this->url->link('mylibrary/mylibrary/getPurchased','',true);
		$data['reviewed_books'] = $this->url->link('mylibrary/mylibrary/getReviewedBooks','',true);
		$data['favorite_books'] = $this->url->link('mylibrary/mylibrary/getFavorite','',true);

        $this->index();

	 }
 
	 }
