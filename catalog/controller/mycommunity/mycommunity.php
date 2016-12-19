<?php
class ControllerMyCommunitymycommunity extends Controller {
    public function index() {
        if (!$this->customer->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('mycommunity/mycommunity', '', true);

            $this->response->redirect($this->url->link('account/login', '', true));
        }

            
        $this->load->language('mycommunity/mycommunity');

        $this->load->model('mycommunity/mycommunity');
        
        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');


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

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');
        
        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity/sharedbooks', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

        $this->response->setOutput($this->load->view('mycommunity/mycommunity', $data));

    }

    public function readingclub(){
  
    if (!$this->customer->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('mycommunity/mycommunity', '', true);

            $this->response->redirect($this->url->link('account/login', '', true));
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
                    'group_image' =>$recom['group_image']
                    
                 
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
     
     
 
         $customer_id = (int)$this->customer->getId();
		 $data['clubs'] = array();
		 $clubresults = $this->model_mycommunity_mycommunity->getclubs($customer_id);
		 foreach($clubresults as $clubresult)
		 {
			 $data['clubs'][] = array (

				 'group_name'        =>$clubresult['group_name'],
				 'group_image'       =>$clubresult['group_image'],
			     'group_description' =>$clubresult['group_description']
					);
			 
		 } 

         $data['addmember']   = $this->url->link('mycommunity/mycommunity/join', '', true);

        $this->response->setOutput($this->load->view('mycommunity/readingclub', $data));


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
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');

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
                    'group_image' =>$recom['group_image']
                 
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

         $data['create_club'] = $this->url->link('mycommunity/mycommunity/createclub', '', true);
 
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

				 'group_name'       =>$clubresult['group_name'],
				  'group_image'     =>$clubresult['group_image'],
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
    

          $this->response->setOutput($this->load->view('mycommunity/readingclub', $data));
        }


        public function recommended(){

       if (!$this->customer->isLogged()) {
       $this->session->data['redirect'] = $this->url->link('mycommunity/mycommunity', '', true);

       $this->response->redirect($this->url->link('account/login', '', true));
        } 

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
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');


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

				 'customer_image'       =>$postresult['customer_image'],
				  'message'             =>$postresult['message'],
			      'image'               =>$postresult['image'],
                  'link'               =>$postresult['link']
					);
			 
		 } 



        $data['first_name'] = $firstname;
        $data['last_name']  = $lastname;
        
        $grouplink = "mycommunity/mycommunity/sharepost&group_id=";
         $data['share_post'] = $this->url->link($grouplink, '', true); 
        
        $this->response->setOutput($this->load->view('mycommunity/recommended', $data));
        
        }
       
       public function sharepost(){

       $group_id = $this->request->get['group_id'];    
       $textname = $this->request->post['text_name'];


        $this->load->model('mycommunity/mycommunity');

        $this->model_mycommunity_mycommunity->addtomypost($group_id);

       if (!$this->customer->isLogged()) {
       $this->session->data['redirect'] = $this->url->link('mycommunity/mycommunity', '', true);

       $this->response->redirect($this->url->link('account/login', '', true));
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


        

       $this->response->setOutput($this->load->view('mycommunity/recommended', $data)); 

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
            'text' => $this->language->get('text_authors'),
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

				 'author_id'    =>$authorresult['author_id'],
			     'author_name'  =>$authorresult['author_name'],
			     'author_image'  =>$authorresult['author_image']

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
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');


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

        

		if (isset($this->request->post['text_author_mastersearch'])) {
			$author_mastersearch = $this->request->post['text_author_mastersearch'];
		} else {
			$author_mastersearch = '';
		}
 
    
		$authors = $this->model_mycommunity_mycommunity->getAuthorFromMaster($author_mastersearch);


       	$data['authorresult'] = $authors;

       $data['author'] = $this->url->link('mycommunity/mycommunity/addToLikedauthor&author_id=', '', true);

       $data['add_to_liked_author']   = $this->url->link('mycommunity/mycommunity/addToLikedauthor', '', true);


	    $this->response->setOutput($this->load->view('mycommunity/authorresult', $data));

        

       }

        public function addToLikedauthor() 
        {

       $author_id =  $this->request->post['author_id'];
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
            'text' => $this->language->get('text_authors'),
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

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_author_mastersearch'] = $this->language->get('text_author_mastersearch');
 
        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

       

	    $this->load->language('mycommunity/mycommunity');

		$this->document->setTitle($this->language->get('heading_title'));
		  

		$this->load->model('mycommunity/mycommunity');

       
         $customer_id = (int)$this->customer->getId();
          $data['authors'] = array();
         $authorresults = $this->model_mycommunity_mycommunity->getAuthors($customer_id);
         foreach($authorresults as $authorresult)
		 {
			 $data['authors'][] = array (

				 'author_id'    =>$authorresult['author_id'],
			     'author_name'  =>$authorresult['author_name'],
			     'author_image'  =>$authorresult['author_image']

					);
			 
		 }

		
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
            'text' => $this->language->get('text_authors'),
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
                 'like_count'             =>$publisherresult['like_count']
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
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');


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


        
        $this->load->model('mycommunity/mycommunity');
      
        
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
		
 		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');


        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);
 
		//$this->load->language('mylibrary/mastersearch');

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
                 'like_count'             =>$publisherresult['like_count']
					);
			 
		 }

		
      $data['searchpublisher'] = $this->url->link('mycommunity/mycommunity/publisherresult' , '' , true); 
	
        $this->response->setOutput($this->load->view('mycommunity/publisher_list', $data));
		 
	}


     public function sharedbooks(){
  
    if (!$this->customer->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('mycommunity/mycommunity', '', true);

            $this->response->redirect($this->url->link('account/login', '', true));
        } 

            
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

        $recommended = $this->model_mycommunity_mycommunity->getShared();
        $data['shares'] = array();
        
        foreach($shared as $share)
        {
            $data['shares'][] = array (

                    'shared_id'                 =>$share['shared_id'],
                    'shared_book_name'          =>$share['shared_book_name'],
                    'shared_book_image'         =>$share['shared_book_image'],
                    'shared_book_description'   =>$share['shared_book_image']
                     
                    
                 
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
     
     
 
         $customer_id = (int)$this->customer->getId();
		 $data['clubs'] = array();
		 $clubresults = $this->model_mycommunity_mycommunity->getclubs($customer_id);
		 foreach($clubresults as $clubresult)
		 {
			 $data['clubs'][] = array (

				 'group_name'        =>$clubresult['group_name'],
				 'group_image'       =>$clubresult['group_image'],
			     'group_description' =>$clubresult['group_description']
					);
			 
		 } 

         $data['addmember']   = $this->url->link('mycommunity/mycommunity/join', '', true);

        $this->response->setOutput($this->load->view('mycommunity/readingclub', $data));


    }
}