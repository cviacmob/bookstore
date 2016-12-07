<?php
class ControllerMyCommunitymycommunity extends Controller {
    public function index() {
        if (!$this->customer->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('mylibrary/mylibrary', '', true);

            $this->response->redirect($this->url->link('account/login', '', true));
        }

            
        $this->load->language('mycommunity/mycommunity');

       $this->load->model('mycommunity/mycommunity');


        $this->document->setTitle($this->language->get('heading_title'));

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        

        $data['breadcrumbs'][] = array(
            'text' => "My Community",
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');
        
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);

        $this->response->setOutput($this->load->view('mycommunity/mycommunity', $data));

    }

    public function readingclub(){
  
    if (!$this->customer->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('mycommunity/mycommunity', '', true);

            $this->response->redirect($this->url->link('account/login', '', true));
        } 

            
      $this->load->language('mycommunity/mycommunity');

      $this->document->setTitle($this->language->get('heading_title'));

      $this->load->model('mycommunity/mycommunity');

      $data['addmember']=$this->url->link('mycommunity/mycommunity/join','',true);

        $url='';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        

        $data['breadcrumbs'][] = array(
            'text' => "My Community",
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array(
            'text' => "Reading Club",
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');

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

      $data['addmember']   = $this->url->link('mycommunity/mycommunity/join', '', true);
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
        $this->response->setOutput($this->load->view('mycommunity/readingclub', $data));


    }
       public function join() {

       $group_id = $this->request->post['groupid'];

       $this->load->model('mycommunity/mycommunity');

	   $this->model_mycommunity_mycommunity->addtomember($group_id);

 	  if (!$this->customer->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('mycommunity/mycommunity', '', true);

            $this->response->redirect($this->url->link('account/login', '', true));
        }
		  $this->document->setTitle($this->language->get('heading_title'));

 	    $this->load->model('mycommunity/mycommunity');


        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        

        $data['breadcrumbs'][] = array(
            'text' => "My Community",
            'href' => $this->url->link('mycommunity/mycommunity')
        );

    
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');
        
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

      $this->document->setTitle($this->language->get('heading_title'));

        $url='';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        

        $data['breadcrumbs'][] = array(
            'text' => "My Community",
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array(
            'text' => "Reading Club",
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');
        
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
            'text' => "My Community",
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array(
            'text' => "Recommended",
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

      $this->document->setTitle($this->language->get('heading_title'));

      
       $url='';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => "My Community",
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array(
            'text' => "Recommended",
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

        $post = $this->model_mycommunity_mycommunity->getpost($customer_id);
        $data['post_info'] = $post;

        $data['first_name'] = $firstname;
        $data['last_name']  = $lastname;

        $this->load->model('mycommunity/mycommunity');    

        $share = $this->model_mycommunity_mycommunity->getposts($customer_id);
        $data['shared'] = array();
        
        foreach($share as $sh)
        {
            $data['shared'][] = array (

                    'group_id' =>$sh['group_id'],
                    'group_name' =>$sh['group_name'],
                    'group_image' =>$sh['group_image']
                 
                    );
             
        }  

       $this->response->setOutput($this->load->view('mycommunity/recommended', $data)); 

       }
}