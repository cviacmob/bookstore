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
			'text' => "My books in Library",
			'href' => $this->url->link('mylibrary/mylibrary')
		);

		$data['addbooks'] = $this->url->link('mylibrary/mylibrary/booksearch','',true);
  
		$data['heading_title'] = $this->language->get('heading_title');

		

		$data['wishlist'] = $this->url->link('account/wishlist', '', true);
 
 		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

    
		
 
		 //$this->load->model('mylibrary/mylibrary');

		$customer_id = (int)$this->customer->getId();

		$data['books'] = array();

		$bookresults = $this->model_mylibrary_mylibrary->getBooks($customer_id);

		foreach($bookresults as $bookresult)
		{
			$data['books'][]=array(

				'isbn' =>$bookresult['isbn'],
				'image' =>"image/".$bookresult['image'],
				'title' =>$bookresult['title'],
				'author' =>$bookresult['author']

			);
		}
          
		$data['addbooks'] = $this->url->link('mylibrary/mylibrary/booksearch','',true);

		$data['purchased_books'] = $this->url->link('mylibrary/mylibrary/getPurchased','',true);

		$data['reviewed_books'] = $this->url->link('mylibrary/mylibrary/getReviewedBooks','',true);

		$data['books_on_library'] = $this->url->link('mylibrary/mylibrary','',true);

        $this->response->setOutput($this->load->view('mylibrary/mylibrary_list', $data));

		
		 
		 
	}

	public function getPurchased() 
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

		$data['button_wishlist'] = $this->language->get('button_wishlist');

		$data['wishlist'] = $this->url->link('account/wishlist', '', true);

		
		$customer_id = (int)$this->customer->getId();

		$this->load->model('mylibrary/mylibrary');

		$data['books'] = array();

		$bookresults = $this->model_mylibrary_mylibrary->getPurchasedBooks($customer_id);

		foreach($bookresults as $bookresult)
		{
			$data['books'][]=array(

				'name' 		 =>$bookresult['name'],
				'product_id' 		 =>$bookresult['product_id'],
				'image'		 =>"image/".$bookresult['image'],
				'href'       =>$this->url->link('product/product', 'path=' . '60_61' . '&product_id=' . $bookresult['product_id'] . $url)
				//'model'		 =>$bookresult['model']
				 

			);
		}

            $productlink =  "mylibrary/mylibrary/review&product_id=";
			$data['review'] = $this->url->link($productlink, '' , true);
		 
        $this->response->setOutput($this->load->view('mylibrary/mylibrary_purchased', $data));

 	}

	public function review()
	{

		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('mylibrary/mylibrary', '', true);

			$this->response->redirect($this->url->link('account/login', '', true));
		}

		

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
			'image' 		=> "image/".$product['image']

		); 		

		 $productlink =  "mylibrary/mylibrary/write&product_id=";
			$data['write_review'] = $this->url->link($productlink, '' , true);
			
		//$data['continue'] = $this->url->link('mylibrary/mylibrary/write', '', true);	 
		 
        $this->response->setOutput($this->load->view('mylibrary/purchasedbooks_reviews', $data));



	} 

	public function getReviewedBooks() 
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

		$data['button_wishlist'] = $this->language->get('button_wishlist');

		$data['wishlist'] = $this->url->link('account/wishlist', '', true);

		
		 

		$this->load->model('mylibrary/mylibrary');

		$data['books'] = array();

		$this->load->model('mylibrary/mylibrary');
		$reviewed_books = $this->model_mylibrary_mylibrary->getReviewedBooks((int)$this->customer->getId());

		 
		foreach($reviewed_books as $reviewed_book)
		{
			$data['books'][]=array(

				'name' 		 			=>$reviewed_book['name'],
				'product_id' 		 	=>$reviewed_book['product_id'],
				'image'		 			=>"image/".$reviewed_book['image'],
				'href'       			=>$this->url->link('product/product', 'path=' . '60_61' . '&product_id=' . $reviewed_book['product_id'] . $url)
				//'model'		 =>$bookresult['model']
				 

			);
		}	

		$productlink =  "mylibrary/mylibrary/yourReview&product_id=";
		$data['your_review'] = $this->url->link($productlink, '' , true);

		$this->response->setOutput($this->load->view('mylibrary/mylibrary_reviewedbooks', $data));	

	}

	public function yourReview() 
	{ 

		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('mylibrary/mylibrary', '', true);

			$this->response->redirect($this->url->link('account/login', '', true));
		}

		

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
			'image' 		=> "image/".$product['image']

		); 		

		$this->load->model('mylibrary/mylibrary');

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
		 
        $this->response->setOutput($this->load->view('mylibrary/yourReview', $data));




	}

	public function write() 
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

		$this->load->language('product/product');

		$product_id = $this->request->get['product_id'];

		$text = $this->request->post['text'];

		$json = array();

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {

		 
			if ((utf8_strlen($this->request->post['text']) < 25) || (utf8_strlen($this->request->post['text']) > 1000)) {
				$json['error'] = $this->language->get('error_text');
			}

			if (empty($this->request->post['rating']) || $this->request->post['rating'] < 0 || $this->request->post['rating'] > 5) {
				$json['error'] = $this->language->get('error_rating');
			}

			// Captcha
			if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('review', (array)$this->config->get('config_captcha_page'))) {
				$captcha = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha') . '/validate');

				if ($captcha) {
					$json['error'] = $captcha;
				}
			}

			if (!isset($json['error'])) {
				$this->load->model('catalog/review');

				$this->model_catalog_review->addReview($this->request->get['product_id'], $this->request->post);

				$json['success'] = $this->language->get('text_success');
			}
		}

		//$this->response->addHeader('Content-Type: application/json');
		//$this->response->setOutput(json_encode($json));

		$this->load->model('mylibrary/mylibrary');
		$reviewed_books = $this->model_mylibrary_mylibrary->getReviewedBooks((int)$this->customer->getId());

		 
		foreach($reviewed_books as $reviewed_book)
		{
			$data['books'][]=array(

				'name' 		 			=>$reviewed_book['name'],
				'product_id' 		 	=>$reviewed_book['product_id'],
				'image'		 			=>"image/".$reviewed_book['image'],
				'href'       			=>$this->url->link('product/product', 'path=' . '60_61' . '&product_id=' . $reviewed_book['product_id'] . $url)
				//'model'		 =>$bookresult['model']
				 

			);
		}	



		$this->response->setOutput($this->load->view('mylibrary/mylibrary_reviewedbooks', $data));	
	}

	public function booksearch() 
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

	 	
 		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$data['searchisbn'] = $this->url->link('mylibrary/mylibrary/searchresult' , '' , true);

		$this->response->setOutput($this->load->view('mylibrary/mylibrary_form', $data));

	}

	 public function searchresult()
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

	  	 
  		$this->load->model('setting/store');

		$data['stores'] = $this->model_setting_store->getStores();
		
 		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
 
		//$this->load->language('mylibrary/mastersearch');

		$this->load->model('mylibrary/mylibrary');

		$data['text_mastersearch'] = $this->language->get('text_mastersearch');

		if (isset($this->request->post['text_mastersearch'])) {
			$mastersearch = $this->request->post['text_mastersearch'];
		} else {
			$mastersearch = '';
		}
 
		$books = $this->model_mylibrary_mylibrary->getBookFromMaster($mastersearch);

		$data['bookresult'] = $books;

		

		$booklink =  "mylibrary/mylibrary/addToLibrary&isbn=".$books['isbn'] ;
 		 
		$data['add_to_library'] = $this->url->link($booklink, '' , true);

		

		
 	
        $this->response->setOutput($this->load->view('mylibrary/mastersearch', $data));

	 }  
	 
	 public function addToLibrary() 
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
		$lend_price = $this->request->post['lend_price'];

		$min_bid_price = $this->request->post['min_bid_price'];
		$max_bid_price = $this->request->post['max_bid_price'];
		
		  $this->model_mylibrary_mylibrary->addToMylibrary($isbn);

		  

		$this->load->model('mylibrary/mylibrary');

		$customer_id = (int)$this->customer->getId();

		$data['books'] = array();

		$book = $this->model_mylibrary_mylibrary->getBook($isbn);

		$this->model_mylibrary_mylibrary->addToProduct($book);

		$bookresults = $this->model_mylibrary_mylibrary->getBooks($customer_id);

		foreach($bookresults as $bookresult)
		{
			$data['books'][]=array(

				'isbn' =>$bookresult['isbn'],
				'image' =>"image/".$bookresult['image'],
				'title' =>$bookresult['title'],
				'author' =>$bookresult['author']

			);
		}
          
		$data['addbooks'] = $this->url->link('mylibrary/mylibrary/booksearch','',true);

        $this->response->setOutput($this->load->view('mylibrary/mylibrary_list', $data));
		 
	 }
 
	 }
