<?php
class ControllerMyCommunitymycommunity extends Controller {
    private $error = array();
    
    public function index() {
       if (!$this->customer->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('mycommunity/mycommunity', '', true);

            $this->response->redirect($this->url->link('account/login', '', true));
        } 
        
        $json = array();
            
        $this->load->language('mycommunity/mycommunity');

        $this->load->model('mycommunity/mycommunity');
        
        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_available_books'] = $this->language->get('text_available_books');
        $data['text_requested_books'] = $this->language->get('text_requested_books');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_mycommunity'] = $this->language->get('text_mycommunity');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething');    
        $data['text_shared_books'] = $this->language->get('text_shared_books');     
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');
        $data['button_share_with_me'] = $this->language->get('button_share_with_me');
        $data['button_shared'] = $this->language->get('button_shared');
 

        $this->document->setTitle($this->language->get('heading_title'));

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_shared_books'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');
        
        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity/sharedbooks', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);
        
        $this->load->model('mycommunity/mycommunity');
        $this->load->model('mylibrary/mylibrary');

        $shared_books = $this->model_mycommunity_mycommunity->getSharedbooks();

        $data['shared_books'] = array();

        foreach($shared_books as $shared_book)
        {
            if (is_file(DIR_IMAGE . $shared_book['image'])) {
				$image = $this->model_tool_image->resize($shared_book['image'], 228, 228);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 228, 228);
			}

            $product_id =  $this->model_mycommunity_mycommunity->getProductId($shared_book['isbn']);

            $data['shared_books'][]=array(

                'title' => $shared_book['title'],
                'author' => $shared_book['author'],
                'isbn'  => $shared_book['isbn'],
                'product_id'  => $product_id,
                //'share_price' => $shared_book['share_price'],
                'image' => $image
            );
        }


         $bookresults = $this->model_mycommunity_mycommunity->getrequestedbooks();  

        $data['books'] = array();

        foreach($bookresults as $bookresult)
        {
            if (is_file(DIR_IMAGE . $bookresult['image'])) {
				$image = $this->model_tool_image->resize($bookresult['image'], 228, 228);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 228, 228);
			}

            

            $data['books'][]=array(

                'title' => $bookresult['title'],
                'author' => $bookresult['author'],
                'isbn'  => $bookresult['isbn'],
                 
                //'share_price' => $shared_book['share_price'],
                'image' => $image
            );
        }

        $booklink = "mycommunity/mycommunity/requested&isbn=";
        $data['share_with_me']   = $this->url->link($booklink, '', true);

       $data['recommended_image'] = $this->url->link('mycommunity/mycommunity/recommended&group_id=', '', true);

       // $data['share_with_me'] = $this->url->link('mycommunity/mycommunity/share', '', true);

       

//        $data['text_requested_books'] = $this->url->link('mycommunity/mycommunity/getrequestedbooks' , '' , true);


        $this->response->setOutput($this->load->view('mycommunity/mycommunity', $data));

    }

    public function readingclub(){
            
      $this->load->language('mycommunity/mycommunity');

        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething');  
        $data['text_mycommunity'] = $this->language->get('text_mycommunity');   
        $data['text_reading_club'] = $this->language->get('text_reading_club');   
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');
        $data['button_member'] = $this->language->get('button_member');

      $this->document->setTitle($this->language->get('heading_title'));

      $this->load->model('mycommunity/mycommunity');

    //  $data['addmember']=$this->url->link('mycommunity/mycommunity/join','',true);

        $url='';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array( 
            'text' =>  $this->language->get('text_reading_club'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

         
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');
        
        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

        $this->load->model('mycommunity/mycommunity');

        $recommended = $this->model_mycommunity_mycommunity->getRecommended();
        $data['groups'] = array();
        
        foreach($recommended as $recom)
        {
            $data['groups'][] = array (

                    'group_id' =>$recom['group_id'],
                    'group_name' =>$recom['group_name'],
                    'group_image' =>$recom['group_image'],
                    'status' =>$recom['status']
                    
                 
                    );
             
        }  

         $customer_id = (int)$this->customer->getId();
          $data['members'] = array();
         $memberresults = $this->model_mycommunity_mycommunity->getMembers($customer_id);
         foreach($memberresults as $memberresult)
		 {
			 $data['members'][] = array (

				 'group_id'    =>$memberresult['group_id'],
			     'group_name'  =>$memberresult['group_name'],
			     'group_image' =>$memberresult['group_image']

					);
			 
		 }

   
      $data['create_club'] = $this->url->link('mycommunity/mycommunity/createclub', '', true);
      $data['recommended_image'] = $this->url->link('mycommunity/mycommunity/recommended&group_id=', '', true);

      $data['member_image'] = $this->url->link('mycommunity/mycommunity/recommended&group_id=', '', true);

      $data['club_image'] = $this->url->link('mycommunity/mycommunity/club_info&group_id=', '', true);
     
 
         $customer_id = (int)$this->customer->getId();
		 $data['clubs'] = array();
		 $clubresults = $this->model_mycommunity_mycommunity->getclubs($customer_id);
		 foreach($clubresults as $clubresult)
		 {
			 $data['clubs'][] = array (

                 'group_id'        =>$clubresult['group_id'],
				 'group_name'        =>$clubresult['group_name'],
				 'group_image'       =>$clubresult['group_image'],
			     'group_description' =>$clubresult['group_description']
					);
			 
		 } 

        $data['addmember']   = $this->url->link('mycommunity/mycommunity/join', '', true);

        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

        $data['create_newclub'] = $this->url->link('mycommunity/mycommunity/create_newclub', '', true);

        $data['recommended_image'] = $this->url->link('mycommunity/mycommunity/recommended&group_id=', '', true);

        $this->response->setOutput($this->load->view('mycommunity/readingclub', $data));


    }

        public function create_newclub(){

        $this->load->model('mycommunity/mycommunity');

        $this->load->language('mycommunity/mycommunity');

        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_location'] = $this->language->get('text_location');
        $data['text_mycommunity'] = $this->language->get('text_mycommunity');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething'); 
        $data['text_create_reading_club'] = $this->language->get('text_create_reading_club');     
        $data['text_reading_club'] = $this->language->get('text_reading_club');     
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');


       $this->document->setTitle($this->language->get('heading_title'));


       $url='';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array(
            'text' =>  $this->language->get('text_reading_club'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array( 
            'text' =>  $this->language->get('text_create_reading_club'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );


        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');

        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

        $data['create_club'] = $this->url->link('mycommunity/mycommunity/createclub', '', true);
       
       $this->response->setOutput($this->load->view('mycommunity/create_newclub', $data));

    }
    
       public function join() {

       $group_id = $this->request->post['groupid'];

       $this->load->model('mycommunity/mycommunity');

	   $this->model_mycommunity_mycommunity->addtomember($group_id);

 	 

 	    $this->load->language('mycommunity/mycommunity');

         
        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething');   
        $data['text_mycommunity'] = $this->language->get('text_mycommunity');  
        $data['text_reading_club'] = $this->language->get('text_reading_club');     
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');
        $data['button_member'] = $this->language->get('button_member');

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        

        $data['breadcrumbs'][] = array(
            'text' =>$this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

    
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');

        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);
        
         $this->load->model('mycommunity/mycommunity');

        $recommended = $this->model_mycommunity_mycommunity->getRecommended();
        $data['groups'] = array();
        
        foreach($recommended as $recom)
        {
            $data['groups'][] = array (

                    'group_id' =>$recom['group_id'],
                    'group_name' =>$recom['group_name'],
                    'group_image' =>$recom['group_image'],
                    'status' =>$recom['status']
                 
                    );
             
        }  


          $this->load->model('mycommunity/mycommunity');
		   $this->model_mycommunity_mycommunity->addtomember($group_id);

         $customer_id = (int)$this->customer->getId();

         $data['members']=array();
          
		 $memberresults = $this->model_mycommunity_mycommunity->getMembers($customer_id);

		 foreach($memberresults as $memberresult)
		 {
			 $data['members'][] = array (

				 'group_id' =>$memberresult['group_id'],
			     'group_name' =>$memberresult['group_name'],
			     'group_image' =>$memberresult['group_image']
					);
			 
		 }


        $customer_id = (int)$this->customer->getId();
		 $data['clubs'] = array();
		 $clubresults = $this->model_mycommunity_mycommunity->getclubs($customer_id);
		 foreach($clubresults as $clubresult)
		 {
			 $data['clubs'][] = array (

                 'group_id'        =>$clubresult['group_id'],
				 'group_name'        =>$clubresult['group_name'],
				 'group_image'       =>$clubresult['group_image'],
			     'group_description' =>$clubresult['group_description']
					);
			 
		 } 
         

        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

        $data['create_club'] = $this->url->link('mycommunity/mycommunity/createclub', '', true);

        $data['recommended_image'] = $this->url->link('mycommunity/mycommunity/recommended&group_id=', '', true);

        $this->response->setOutput($this->load->view('mycommunity/readingclub', $data));

}

         public function createclub(){
           
         $clubname = $this->request->post['club_name'];
	        
         $this->load->model('mycommunity/mycommunity');

	     $this->model_mycommunity_mycommunity->addtomyclub($clubname);

         $customer_id = (int)$this->customer->getId();
		 $data['clubs'] = array();
		 $clubresults = $this->model_mycommunity_mycommunity->getclubs($customer_id);
		 foreach($clubresults as $clubresult)
		 {
			 $data['clubs'][] = array (
                 

                  'group_id'          =>$clubresult['group_id'],
				  'group_name'        =>$clubresult['group_name'],
				  'group_image'       =>$clubresult['group_image'],
			      'group_description' =>$clubresult['group_description']
					);
			 
		 } 
         
        $this->load->language('mycommunity/mycommunity');

      
        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething');    
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');  

       $this->document->setTitle($this->language->get('heading_title'));

        $url='';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array(
            'text' =>  $this->language->get('text_reading_club'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');

        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);
        
        $this->load->model('mycommunity/mycommunity');

        $recommended = $this->model_mycommunity_mycommunity->getRecommended();
        $data['groups'] = array();
        
        foreach($recommended as $recom)
        {
            $data['groups'][] = array (

                    'group_id' =>$recom['group_id'],
                    'group_name' =>$recom['group_name'],
                    'group_image' =>$recom['group_image']
                 
                    );
             
        }  
         $customer_id = (int)$this->customer->getId();
          
		 $memberresults = $this->model_mycommunity_mycommunity->getMembers($customer_id);

		 foreach($memberresults as $memberresult)
		 {
			 $data['members'][] = array (

			   'group_id'    =>$memberresult['group_id'],
		       'group_name'  =>$memberresult['group_name'],
			   'group_image' =>$memberresult['group_image']
					);
			 
		 } 
           $data['create_newclub'] = $this->url->link('mycommunity/mycommunity/create_newclub', '', true);

          $this->response->setOutput($this->load->view('mycommunity/readingclub', $data));
        }


        public function recommended(){

    /*   if (!$this->customer->isLogged()) {
       $this->session->data['redirect'] = $this->url->link('mycommunity/mycommunity', '', true);

       $this->response->redirect($this->url->link('account/login', '', true));
        }  */

      $group_id = $this->request->get['group_id'];    
      $this->load->language('mycommunity/mycommunity');

      $this->document->setTitle($this->language->get('heading_title'));

      $this->load->model('mycommunity/mycommunity');

       $url='';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array(
            'text' =>  $this->language->get('text_recommended'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

          $this->load->language('mycommunity/mycommunity');

        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething');  
        $data['text_community'] = $this->language->get('text_community');  
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');
        $data['button_member'] = $this->language->get('button_member');

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');

        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

        $this->load->model('mycommunity/mycommunity');
        $rec = $this->model_mycommunity_mycommunity->getMember($group_id);
        $data['group_info'] = $rec;
        
        $this->load->model('mycommunity/mycommunity');
        $customer_id = (int)$this->customer->getId();
        $firstname = $this->customer->getFirstName();
        $lastname = $this->customer->getLastName();

   /*     $post = $this->model_mycommunity_mycommunity->getpost($customer_id);
        $data['post_info'] = $post; */

         $customer_id = (int)$this->customer->getId();
		 $data['post_info'] = array();
		 $postresults = $this->model_mycommunity_mycommunity->getposts($group_id);
		 foreach($postresults as $postresult)
		 {
			 $data['post_info'][] = array (

                  'group_id'              =>$postresult['group_id'], 
                  'post_id'               =>$postresult['post_id'],
				  'customer_image'        =>$postresult['customer_image'],
				  'message'               =>$postresult['message'],
			      'image'                 =>$postresult['image'],
                  'link'                  =>$postresult['link'],
                  'likes'                 =>$postresult['likes'],
                  'total_votes'           =>$postresult['total_votes'],
                  'status'                =>$postresult['status']
					);
			 
		 } 



        $data['first_name'] = $firstname;
        $data['last_name']  = $lastname;
        
        $grouplink = "mycommunity/mycommunity/sharepost&group_id=";
        $data['share_post'] = $this->url->link($grouplink, '', true); 
        
        $sharelink = "mycommunity/mycommunity/likecount&group_id=&post_id=";
        $data['add_to_my_post'] = $this->url->link($sharelink, '', true);
        
        $data['add_to_member']   = $this->url->link('mycommunity/mycommunity/join', '', true);

        $data['recommended_image'] = $this->url->link('mycommunity/mycommunity/recommended&group_id=', '', true);
        
        $this->response->setOutput($this->load->view('mycommunity/recommended', $data));
        
        }

        public function likecount(){

         $post_id = $this->request->get['post_id'];    
         $group_id = $this->request->get['group_id'];    

         $this->load->model('mycommunity/mycommunity');

        $this->model_mycommunity_mycommunity->addtolikedpost($group_id);
	
        $this->load->language('mycommunity/mycommunity');

       // $this->response->setOutput($this->load->view('mycommunity/recommended', $data));
        
        }

       
       public function sharepost(){

       $group_id = $this->request->get['group_id'];    
       $textname = $this->request->post['text_name'];


        $this->load->model('mycommunity/mycommunity');

        $this->model_mycommunity_mycommunity->addtomypost($group_id);
       
        $this->load->language('mycommunity/mycommunity');
        
        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething');
        $data['text_community'] = $this->language->get('text_community');  
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');


        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

        $this->document->setTitle($this->language->get('heading_title'));

      
       $url='';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array(
            'text' =>  $this->language->get('text_recommended'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');

        $this->load->model('mycommunity/mycommunity');
        $rec = $this->model_mycommunity_mycommunity->getMember($group_id);
        $data['group_info'] = $rec;
        
        $this->load->model('mycommunity/mycommunity');
        $customer_id = (int)$this->customer->getId();
        $firstname = $this->customer->getFirstName();
        $lastname = $this->customer->getLastName();

        
        $this->load->model('mycommunity/mycommunity');
        $customer_id = (int)$this->customer->getId();
        $firstname = $this->customer->getFirstName();
        $lastname = $this->customer->getLastName();


         $customer_id = (int)$this->customer->getId();
		 $data['post_info'] = array();
		 $postresults = $this->model_mycommunity_mycommunity->getposts($group_id);
		 foreach($postresults as $postresult)
		 {
			 $data['post_info'][] = array (

                  'post_id'               =>$postresult['post_id'],
				  'customer_image'        =>$postresult['customer_image'],
				  'message'               =>$postresult['message'],
			      'image'                 =>$postresult['image'],
                  'link'                  =>$postresult['link'],
                  'likes'                 =>$postresult['likes'],
                  'total_votes'           =>$postresult['total_votes']
 

					);
			 
		 } 

        $data['first_name'] = $firstname;
        $data['last_name']  = $lastname;

       $this->response->setOutput($this->load->view('mycommunity/recommended', $data)); 

       }

       public function club_info(){

       
      $group_id = $this->request->get['group_id'];    
      $this->load->language('mycommunity/mycommunity');

      $this->document->setTitle($this->language->get('heading_title'));

      $this->load->model('mycommunity/mycommunity');

       $url='';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array(
            'text' =>  $this->language->get('text_club'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

          $this->load->language('mycommunity/mycommunity');

        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_club'] = $this->language->get('text_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething');  
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_send'] = $this->language->get('button_send');
        $data['button_join'] = $this->language->get('button_join');
        $data['button_post'] = $this->language->get('button_post');
       	$data['type_text_search'] = $this->language->get('type_text_search');
        $data['text_invite_people'] = $this->language->get('text_invite_people');
        $data['text_enter_name'] = $this->language->get('text_enter_name');
        $data['text_enter_mailid'] = $this->language->get('text_enter_mailid');

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');

        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

        $this->load->model('mycommunity/mycommunity');
        $clubinfo = $this->model_mycommunity_mycommunity->getMember($group_id);
        $data['club_info'] = $clubinfo;
        
        $this->load->model('mycommunity/mycommunity');
        $rec = $this->model_mycommunity_mycommunity->getMember($group_id);
        $data['group_info'] = $rec;
        
        $this->load->model('mycommunity/mycommunity');
        $customer_id = (int)$this->customer->getId();
        $firstname = $this->customer->getFirstName();
        $lastname = $this->customer->getLastName();

        $this->load->model('mycommunity/mycommunity');
        $customer_id = (int)$this->customer->getId();
        $firstname = $this->customer->getFirstName();
        $lastname = $this->customer->getLastName();
        $email = $this->customer->getEmail();

        $data['first_name'] = $firstname;
        $data['last_name']  = $lastname;
        $data['email']      = $email;

         $customer_id = (int)$this->customer->getId();
		 $data['post_info'] = array();
		 $postresults = $this->model_mycommunity_mycommunity->getClubposts($group_id);
		 foreach($postresults as $postresult)
		 {	
			
			 $data['post_info'][] = array (

                  'post_id'              =>$postresult['post_id'],
                  'customer_image'      =>$postresult['customer_image'],
				  'message'             =>$postresult['message'],
			      'image'               =>$postresult['image'],
                  'link'                =>$postresult['link']
					);
			 
		 } 

        
         $data['invite_people'] = $this->url->link('mycommunity/mycommunity/invite_people&group_id=', '', true);   

         $grouplink = "mycommunity/mycommunity/club_share&group_id=";
         $data['club_share'] = $this->url->link($grouplink, '', true); 
     
         $data['search_mail'] = $this->url->link('mycommunity/mycommunity/mailsearch&group_id=' , '' , true);
        
        $this->response->setOutput($this->load->view('mycommunity/club_info', $data));

       }

       public function mailsearch(){

        if ((utf8_strlen($this->request->post['recipient_text']) < 1) || (utf8_strlen(trim($this->request->post['recipient_text'])) > 32)) {
			$this->error['recipient_text'] = $this->language->get('error_recipient_text');
		}

		if ((utf8_strlen($this->request->post['recipient_email']) > 96) || !filter_var($this->request->post['recipient_email'], FILTER_VALIDATE_EMAIL)) {
			$this->error['recipient_email'] = $this->language->get('error_recipient_email');
		}

       $group_id = $this->request->get['group_id'];    
            
       $this->load->language('mycommunity/mycommunity');

      
    
           if(isset($_POST['texts'])) {

            $texts = $_POST['texts'];
            foreach($texts as $firstname){

            $this->load->model('mycommunity/mycommunity');  
            $this->model_mycommunity_mycommunity->getMailid($firstname); 
      
            }
           }

       
        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

     //   $this->response->setOutput($this->load->view('mycommunity/club_info', $data));

       }


       public function invite_people() 
       
       {
         if(isset($_POST['emails'])) {

            $emails = $_POST['emails'];
            foreach($emails as $email){

           $this->load->model('mycommunity/mycommunity');   
           $this->model_mycommunity_mycommunity->addinvite($email);
         

            }
         }

         $group_id = $this->request->get['group_id'];    
   
         $this->load->language('mycommunity/mycommunity');

        
      //   $this->response->setOutput($this->load->view('mycommunity/club_info', $data));

      }

       public function club_share(){

       $group_id = $this->request->get['group_id'];    
       $textname = $this->request->post['text_name'];


        $this->load->model('mycommunity/mycommunity');

        $this->model_mycommunity_mycommunity->addtomypost($group_id);
       
        $this->load->language('mycommunity/mycommunity');

        $this->load->model('mycommunity/mycommunity');
        $clubinfo = $this->model_mycommunity_mycommunity->getMember($group_id);
        $data['club_info'] = $clubinfo;
        
        
        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething');
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');
        $data['button_post'] = $this->language->get('button_post');

        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

      $this->document->setTitle($this->language->get('heading_title'));

      
       $url='';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array(
            'text' =>  $this->language->get('text_recommended'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');

         $this->load->model('mycommunity/mycommunity');
        $rec = $this->model_mycommunity_mycommunity->getMember($group_id);
        $data['group_info'] = $rec;
        
        $this->load->model('mycommunity/mycommunity');
        $customer_id = (int)$this->customer->getId();
        $firstname = $this->customer->getFirstName();
        $lastname = $this->customer->getLastName();

        
        $this->load->model('mycommunity/mycommunity');
        $customer_id = (int)$this->customer->getId();
        $firstname = $this->customer->getFirstName();
        $lastname = $this->customer->getLastName();

   /*     $post = $this->model_mycommunity_mycommunity->getpost($customer_id);
        $data['post_info'] = $post; */

         $customer_id = (int)$this->customer->getId();
		 $data['post_info'] = array();
		 $postresults = $this->model_mycommunity_mycommunity->getposts($group_id);
		 foreach($postresults as $postresult)
		 {
			 $data['post_info'][] = array (

				 'customer_image'       =>$postresult['customer_image'],
				  'message'             =>$postresult['message'],
			      'image'               =>$postresult['image'],
                  'link'               =>$postresult['link']
					);
			 
		 } 



        $data['first_name'] = $firstname;
        $data['last_name']  = $lastname;


      
       $this->response->setOutput($this->load->view('mycommunity/club_info', $data));
      
      }


       public function author()
       {

        $this->load->language('mycommunity/mycommunity');

      $this->document->setTitle($this->language->get('heading_title'));

      
       $url='';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_author'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething');
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');
        $data['text_type_author_name'] = $this->language->get('text_type_author_name');
        $data['text_type_publisher_name'] = $this->language->get('text_type_publisher_name'); 
        $data['text_author_mastersearch'] = $this->language->get('text_author_mastersearch');  
        $data['text_search_byauthor'] = $this->language->get('text_search_byauthor');  
        $data['text_mycommunity'] = $this->language->get('text_mycommunity');  

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');

        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

        
		$this->load->model('mycommunity/mycommunity');
        
     //    $data['author_image'] = $this->url->link('mycommunity/mycommunity/author_info&author_id=', '', true);
       
         $customer_id = (int)$this->customer->getId();
         $data['authors'] = array();
         $authorresults = $this->model_mycommunity_mycommunity->getAuthors($customer_id);
         foreach($authorresults as $authorresult)
		 {
			 $data['authors'][] = array (

				 'author_id'                       =>$authorresult['author_id'],
			     'author_name'                     =>$authorresult['author_name'],
			     'author_image'                    =>$authorresult['author_image']
               
					);
			 
		 }
          $data['author_image'] = $this->url->link('mycommunity/mycommunity/author_info&author_id=', '', true);

          

        $data['searchauthor'] = $this->url->link('mycommunity/mycommunity/authorresult' , '' , true);

        

        $this->response->setOutput($this->load->view('mycommunity/author_list', $data));
       }


      public function author_info(){

        $author_id = $this->request->get['author_id'];    
        $this->load->language('mycommunity/mycommunity');
 
        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('mycommunity/mycommunity');

        $url='';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array(
            'text' =>  $this->language->get('text_author_info_page'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

          $this->load->language('mycommunity/mycommunity');

        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething');  
        $data['text_born'] = $this->language->get('text_born');  
        $data['text_occupation'] = $this->language->get('text_occupation');  
        $data['text_nationality'] = $this->language->get('text_nationality');  
        $data['text_early_life'] = $this->language->get('text_early_life');
        $data['text_awards'] = $this->language->get('text_awards'); 
        $data['text_references'] = $this->language->get('text_references'); 
        $data['text_links'] = $this->language->get('text_links');  
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');
        $data['button_like_page'] = $this->language->get('button_like_page');
        $data['button_view_books'] = $this->language->get('button_view_books');

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');

        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

        $this->load->model('mycommunity/mycommunity');
        $rect = $this->model_mycommunity_mycommunity->getAuthor($author_id);
        $data['author_info'] = $rect;


        
        $this->load->model('mycommunity/mycommunity');
      
  //     $data['add_to_liked_author']   = $this->url->link('mycommunity/mycommunity/author_info', '', true);

        $this->response->setOutput($this->load->view('mycommunity/author_info', $data));
        
        }

        

       public function authorresult()
       {


        $this->load->model('mycommunity/mycommunity');

		 $this->load->language('mycommunity/mycommunity');

		$this->document->setTitle($this->language->get('heading_title'));

		$url = '';
		 
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('mycommunity/mycommunity')
		);

	  	 
  		$this->load->model('setting/store');

		$data['stores'] = $this->model_setting_store->getStores();

        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething');
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');
        $data['text_author_mastersearch'] = $this->language->get('text_author_mastersearch');
        $data['text_type_author_name'] = $this->language->get('text_type_author_name');
        $data['text_search_byauthor'] = $this->language->get('text_search_byauthor');  
		
 		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');


        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);
 
		//$this->load->language('mylibrary/mastersearch');

		$this->load->model('mycommunity/mycommunity');

		$data['text_author_mastersearch'] = $this->language->get('text_author_mastersearch');

        

		if (isset($this->request->post['fname'])) {
			$author_mastersearch = $this->request->post['fname'];
		} else {
			$author_mastersearch = '';
		}
 
    
		$authors = $this->model_mycommunity_mycommunity->getAuthorFromMaster($author_mastersearch);


       	$data['authorresult'] = $authors;

        $data['add_to_liked_author'] = $this->url->link('mycommunity/mycommunity/addToLikedauthor&author_id=', '', true);

   //    $data['add_to_liked_author']   = $this->url->link('mycommunity/mycommunity/addToLikedauthor', '', true);


	    $this->response->setOutput($this->load->view('mycommunity/authorresult', $data));

    
       }

        public function addToLikedauthor() 
        {

        $author_id =  $this->request->get['author_id'];
		$this->load->model('mycommunity/mycommunity');


        $this->model_mycommunity_mycommunity->addToLikedauthor($author_id);
	
        $this->load->language('mycommunity/mycommunity');

        $this->document->setTitle($this->language->get('heading_title'));

      
        $url='';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_author'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething');
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');
        $data['text_type_author_name'] = $this->language->get('text_type_author_name');
        $data['text_type_publisher_name'] = $this->language->get('text_type_publisher_name'); 
        $data['text_author_mastersearch'] = $this->language->get('text_author_mastersearch');  
        $data['text_search_byauthor'] = $this->language->get('text_search_byauthor');  
        $data['text_mycommunity'] = $this->language->get('text_mycommunity');

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_author_mastersearch'] = $this->language->get('text_author_mastersearch');
 
        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

		$this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('mycommunity/mycommunity');
       
         $customer_id = (int)$this->customer->getId();
         $data['authors'] = array();
         $authorresults = $this->model_mycommunity_mycommunity->getAuthors($customer_id);
         foreach($authorresults as $authorresult)
		 {
			 $data['authors'][] = array (

				 'author_id'                       =>$authorresult['author_id'],
			     'author_name'                     =>$authorresult['author_name'],
			     'author_image'                    =>$authorresult['author_image'],
                 'author_dob'                      =>$authorresult['author_dob'],
                 'author_occupation'               =>$authorresult['author_occupation'],
                 'author_nationality'              =>$authorresult['author_nationality'],
                 'author_education'                =>$authorresult['author_education'],
                 'author_awards'                   =>$authorresult['author_awards'],
                 'author_references'               =>$authorresult['author_references'],
                 'author_external_links'           =>$authorresult['author_external_links'],
                 'total_votes'                     =>$authorresult['total_votes'],
			 	 'likes'                           =>$authorresult['likes']
					);
			 
		 }

      $data['author_image'] = $this->url->link('mycommunity/mycommunity/author_info&author_id=', '', true);
		
      $data['searchauthor'] = $this->url->link('mycommunity/mycommunity/authorresult' , '' , true); 
	
      $this->response->setOutput($this->load->view('mycommunity/author_list', $data));
		 
	}


      public function publisher()
       {

       $this->load->language('mycommunity/mycommunity');

       $this->document->setTitle($this->language->get('heading_title'));
 
      
       $url='';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_publishers'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething');
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');
        $data['text_type_author_name'] = $this->language->get('text_type_author_name');
        $data['text_type_publisher_name'] = $this->language->get('text_type_publisher_name'); 
        $data['text_author_mastersearch'] = $this->language->get('text_author_mastersearch');  
        $data['text_publisher_mastersearch'] = $this->language->get('text_publisher_mastersearch');  
        $data['text_search_bypublisher'] = $this->language->get('text_search_bypublisher');  


        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');

        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

        
		$this->load->model('mycommunity/mycommunity');
    
         $customer_id = (int)$this->customer->getId();
         $data['publishers'] = array();
         $publisherresults = $this->model_mycommunity_mycommunity->getPublishers($customer_id);
         foreach($publisherresults as $publisherresult)
		 {
			 $data['publishers'][] = array (

				 'publisher_id'           =>$publisherresult['publisher_id'],
			     'publisher_name'         =>$publisherresult['publisher_name'],
			     'publisher_image'        =>$publisherresult['publisher_image']
                 
					);
			 
		 }
        $data['publisher_image'] = $this->url->link('mycommunity/mycommunity/publisher_info&publisher_id=', '', true);

        $data['searchpublisher'] = $this->url->link('mycommunity/mycommunity/publisherresult' , '' , true);

        $this->response->setOutput($this->load->view('mycommunity/publisher_list', $data));
       }


      public function publisher_info(){

      $publisher_id = $this->request->get['publisher_id'];    
      $this->load->language('mycommunity/mycommunity');

      $this->document->setTitle($this->language->get('heading_title'));

      $this->load->model('mycommunity/mycommunity');

       $url='';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array(
            'text' =>  $this->language->get('text_publisher_info_page'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

          $this->load->language('mycommunity/mycommunity');

        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething');  
        $data['text_type_publisher_name'] = $this->language->get('text_type_publisher_name'); 
        $data['text_address'] = $this->language->get('text_address'); 
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');
        $data['button_like_page'] = $this->language->get('button_like_page');
        $data['button_view_books'] = $this->language->get('button_view_books');


        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');

        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

        $this->load->model('mycommunity/mycommunity');
        $recta = $this->model_mycommunity_mycommunity->getPublisher($publisher_id);
        $data['publisher_info'] = $recta;
        
        $this->response->setOutput($this->load->view('mycommunity/publisher_info', $data));
        
        }

        

       public function publisherresult()
       {


        $this->load->model('mycommunity/mycommunity');

		 $this->load->language('mycommunity/mycommunity');

		$this->document->setTitle($this->language->get('heading_title'));

		$url = '';
		 
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('mycommunity/mycommunity')
		);

	  	 
  		$this->load->model('setting/store');

		$data['stores'] = $this->model_setting_store->getStores();

        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething');
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');
        $data['text_author_mastersearch'] = $this->language->get('text_author_mastersearch');
        $data['text_type_author_name'] = $this->language->get('text_type_author_name');
        $data['text_type_publisher_name'] = $this->language->get('text_type_publisher_name'); 
		
 		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');


        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);
 
		$this->load->model('mycommunity/mycommunity');

		$data['text_publisher_mastersearch'] = $this->language->get('text_publisher_mastersearch');

        
		if (isset($this->request->post['text_publisher_mastersearch'])) {
			$publisher_mastersearch = $this->request->post['text_publisher_mastersearch'];
		} else {
			$publisher_mastersearch = '';
		}
 
    
		$publishers = $this->model_mycommunity_mycommunity->getPublisherFromMaster($publisher_mastersearch);


       	$data['publisherresult'] = $publishers;

       $data['publisher'] = $this->url->link('mycommunity/mycommunity/addToLikedpublisher&publisher_id=', '', true);

       $data['add_to_liked_publisher']   = $this->url->link('mycommunity/mycommunity/addToLikedpublisher', '', true);


	    $this->response->setOutput($this->load->view('mycommunity/publisherresult', $data));

        

       }

        public function addToLikedpublisher() 
        {

        $publisher_id =  $this->request->post['publisher_id'];
		$this->load->model('mycommunity/mycommunity');


         $this->model_mycommunity_mycommunity->addToLikedpublisher($publisher_id);
	
      $this->load->language('mycommunity/mycommunity');

      $this->document->setTitle($this->language->get('heading_title'));

      
       $url='';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_publishers'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething');
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');
        $data['text_type_author_name'] = $this->language->get('text_type_author_name');
        $data['text_type_publisher_name'] = $this->language->get('text_type_publisher_name'); 
        $data['text_author_mastersearch'] = $this->language->get('text_author_mastersearch');  
        $data['text_publisher_mastersearch'] = $this->language->get('text_publisher_mastersearch');  
        $data['text_search_bypublisher'] = $this->language->get('text_search_bypublisher');  

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');

      //  $data['text_author_mastersearch'] = $this->language->get('text_author_mastersearch');
 
        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

       

	    $this->load->language('mycommunity/mycommunity');

		$this->document->setTitle($this->language->get('heading_title'));
		  

		$this->load->model('mycommunity/mycommunity');

       
         $customer_id = (int)$this->customer->getId();
         $data['publishers'] = array();
         $publisherresults = $this->model_mycommunity_mycommunity->getPublishers($customer_id);
         foreach($publisherresults as $publisherresult)
		 {
			 $data['publishers'][] = array (

				'publisher_id'           =>$publisherresult['publisher_id'],
			     'publisher_name'         =>$publisherresult['publisher_name'],
			     'publisher_image'        =>$publisherresult['publisher_image'],
                 'publisher_address'      =>$publisherresult['publisher_address'],
                 'publisher_description'  =>$publisherresult['publisher_description'],
                 'total_votes'            =>$publisherresult['total_votes'],
			 	 'likes'                  =>$publisherresult['likes']
					);
			 
		 }

		
        $data['searchpublisher'] = $this->url->link('mycommunity/mycommunity/publisherresult' , '' , true); 
	
        $this->response->setOutput($this->load->view('mycommunity/publisher_list', $data));
		 
	}


     public function sharedbooks(){
  
    /*if (!$this->customer->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('mycommunity/mycommunity', '', true);

            $this->response->redirect($this->url->link('account/login', '', true));
        }  */

            
      $this->load->language('mycommunity/mycommunity');

        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_available_books'] = $this->language->get('text_available_books');
        $data['text_requested_books'] = $this->language->get('text_requested_books');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething');     
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');
        $data['button_share_with_me'] = $this->language->get('button_share_with_me');

      $this->document->setTitle($this->language->get('heading_title'));

      $this->load->model('mycommunity/mycommunity');

    //  $data['addmember']=$this->url->link('mycommunity/mycommunity/join','',true);

        $url='';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array(
            'text' =>  $this->language->get('text_shared_books'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');
        
        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity/sharedbooks', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

        $this->load->model('mycommunity/mycommunity');

        $shared_books = $this->model_mycommunity_mycommunity->getSharedbooks();

      

        $this->response->setOutput($this->load->view('mycommunity/readingclub', $data));


    }
    
    public function requested(){

       $isbn = $this->request->get['isbn'];

       $this->load->language('mycommunity/mycommunity');

       $this->load->model('mycommunity/mycommunity');

       $this->load->model('mylibrary/mylibrary');

       $this->model_mycommunity_mycommunity->requestedbooks($isbn);   

       $books =  $this->model_mycommunity_mycommunity->getProductId($isbn);  

       foreach($books as $book) 
          {

          $book_data = array(

              'product_id' => $book['product_id'],
              'quantity' => $book['quantity']

          );
      }

        $this->model_mycommunity_mycommunity->addTocart($book_data);

        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_available_books'] = $this->language->get('text_available_books');
        $data['text_requested_books'] = $this->language->get('text_requested_books');  
        $data['button_share_with_me'] = $this->language->get('button_share_with_me');
        $data['button_shared'] = $this->language->get('button_shared');

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        

        $data['breadcrumbs'][] = array(
            'text' =>$this->language->get('text_shared_books'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

    
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');

        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

        $data['text_available_books'] = $this->language->get('text_available_books');
        $data['text_requested_books'] = $this->language->get('text_requested_books');  


        $shared_books = $this->model_mycommunity_mycommunity->getSharedbooks();

        $data['shared_books'] = array();

        foreach($shared_books as $shared_book)
        {
            if (is_file(DIR_IMAGE . $shared_book['image'])) {
				$image = $this->model_tool_image->resize($shared_book['image'], 228, 228);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 228, 228);
			}

            $data['shared_books'][]=array(

                'title' => $shared_book['title'],
                'author' => $shared_book['author'],
                'isbn'  => $shared_book['isbn'],
                //'share_price' => $shared_book['share_price'],
                'image' => $image
            );
        }
   
     $bookresults = $this->model_mycommunity_mycommunity->getrequestedbooks();  

        $data['books'] = array();

        foreach($bookresults as $bookresult)
        {
            if (is_file(DIR_IMAGE . $bookresult['image'])) {
				$image = $this->model_tool_image->resize($bookresult['image'], 228, 228);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 228, 228);
			}

            $data['books'][]=array(

                'title' => $bookresult['title'],
                'author' => $bookresult['author'],
                'isbn'  => $bookresult['isbn'],
                //'share_price' => $shared_book['share_price'],
                'image' => $image
            );
        }
       
        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

         $this->response->setOutput($this->load->view('checkout/checkout', $data));

        

    }
     
     public function share(){

        $isbn = $this->request->post[$shared_book['isbn']];   

        if ((!$this->cart->hasProducts() && empty($this->session->data['vouchers'])) || (!$this->cart->hasStock() && !$this->config->get('config_stock_checkout'))) {
			$this->response->redirect($this->url->link('checkout/cart'));
		}

        

		// Validate minimum quantity requirements.
		$products = $this->cart->getProducts();

		foreach ($products as $product) {
			$product_total = 0;

			foreach ($products as $product_2) {
				if ($product_2['product_id'] == $product['product_id']) {
					$product_total += $product_2['quantity'];
				}
			}

			if ($product['minimum'] > $product_total) {
				$this->response->redirect($this->url->link('checkout/cart'));
			}
		}

		$this->load->language('checkout/checkout');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
		$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');

		// Required by klarna
		if ($this->config->get('klarna_account') || $this->config->get('klarna_invoice')) {
			$this->document->addScript('http://cdn.klarna.com/public/kitt/toc/v1.0/js/klarna.terms.min.js');
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_cart'),
			'href' => $this->url->link('checkout/cart')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('checkout/checkout', '', true)
		);

		$data['heading_title'] = $this->language->get('heading_title');

	    $this->load->language('mycommunity/mycommunity');

        $data['button_share_with_me'] = $this->language->get('button_share_with_me');

		$data['text_checkout_option'] = sprintf($this->language->get('text_checkout_option'), 1);
		$data['text_checkout_account'] = sprintf($this->language->get('text_checkout_account'), 2);
		$data['text_checkout_payment_address'] = sprintf($this->language->get('text_checkout_payment_address'), 2);
		$data['text_checkout_shipping_address'] = sprintf($this->language->get('text_checkout_shipping_address'), 3);
		$data['text_checkout_shipping_method'] = sprintf($this->language->get('text_checkout_shipping_method'), 4);
		
		if ($this->cart->hasShipping()) {
			$data['text_checkout_payment_method'] = sprintf($this->language->get('text_checkout_payment_method'), 5);
			$data['text_checkout_confirm'] = sprintf($this->language->get('text_checkout_confirm'), 6);
		} else {
			$data['text_checkout_payment_method'] = sprintf($this->language->get('text_checkout_payment_method'), 3);
			$data['text_checkout_confirm'] = sprintf($this->language->get('text_checkout_confirm'), 4);	
		}

		if (isset($this->session->data['error'])) {
			$data['error_warning'] = $this->session->data['error'];
			unset($this->session->data['error']);
		} else {
			$data['error_warning'] = '';
		}

		$data['logged'] = $this->customer->isLogged();

		if (isset($this->session->data['account'])) {
			$data['account'] = $this->session->data['account'];
		} else {
			$data['account'] = '';
		}

		$data['shipping_required'] = $this->cart->hasShipping();

        $data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

         $this->response->setOutput($this->load->view('checkout/checkout', $data));

     }


}