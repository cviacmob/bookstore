<?php
class ControllerMycommunityCustomergroups extends Controller {
	private $error = array();

	public function index() {
		 $this->load->language('mycommunity/customergroups');

		 $this->document->setTitle($this->language->get('heading_title'));

		 $this->load->model('mycommunity/customergroups');

         $this->getList();
	
	}

	public function add() 
	{
	    

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/product');

	

		$this->getForm();
	}

	public function edit() {
	

		$this->document->setTitle($this->language->get('heading_title'));

		$data['heading_title'] = $this->language->get('heading_title');

		$url = '';

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);


		$this->load->model('tool/image');

		
        $this->load->model('mycommunity/customergroups');

		$group_id= $this->request->get['group_id'];

	    $club_info = $this->model_mycommunity_customergroups->getClubs($group_id);

		 		if (is_file(DIR_IMAGE .  $club_info['group_image'])) {
				$group_image = $this->model_tool_image->resize( $club_info['group_image'], 350,500);
				} else {
				$group_image = $this->model_tool_image->resize('no_image.png', 350,500);
				}


		$data['club_info'] =array(

                'group_id'            => $club_info['group_id'],
				'group_name'          => $club_info['group_name'],
                'group_image'         => $club_info['group_image'],
                'group_description'   => $club_info['group_description'],
                'privacy'             => $club_info['privacy'],
                'location' 		      => $club_info['location'],
				'recommended' 		  => $club_info['recommended'],
				'status' 		      => $club_info['status'],
                'group_image'         => $group_image
               
		);

        if (isset($this->request->post['group_name'])) {
			$data['group_name'] = $this->request->post['group_name'];
		} elseif (!empty($club_info)) {
			$data['group_name'] = $club_info['group_name'];
		} else {
			$data['group_name'] = '';
		}

        if (isset($this->request->post['group_description'])) {
			$data['group_description'] = $this->request->post['group_description'];
		} elseif (!empty($club_info)) {
			$data['group_description'] = $club_info['group_description'];
		} else {
			$data['group_description'] = '';
		}

        if (isset($this->request->post['location'])) {
			$data['location'] = $this->request->post['location'];
		} elseif (!empty($club_info)) {
			$data['location'] = $club_info['location'];
		} else {
			$data['location'] = '';
		}

        if (isset($this->request->post['privacy'])) {
			$data['privacy'] = $this->request->post['privacy'];
		} elseif (!empty($club_info)) {
			$data['privacy'] = $club_info['privacy'];
		} else {
			$data['privacy'] = '';
		}

        if (isset($this->request->post['recommended'])) {
			$data['recommended'] = $this->request->post['recommended'];
		} elseif (!empty($club_info)) {
			$data['recommended'] = $club_info['recommended'];
		} else {
			$data['recommended'] = '';
		}

        if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($club_info)) {
			$data['status'] = $club_info['status'];
		} else {
			$data['status'] = '';
		}
		

				
		$data['cancel'] = $this->url->link('mycommunity/customergroups', 'token=' . $this->session->data['token'] . $url, true);

		$data['token'] = $this->session->data['token'];

		$this->load->model('localisation/language');		

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$data['update_details'] = $this->url->link('mycommunity/customergroups/updateDetails','token=' .$this->session->data['token'].'&group_id=','',true);

		$this->response->setOutput($this->load->view('mycommunity/customergroups_list_edit', $data));
	}

	public function updateDetails()
	{
		$this->load->model('mycommunity/customergroups');

		$data['token'] = $this->session->data['token'];

		$this->model_mycommunity_customergroups->updateDetails($this->request->get['group_id']);

		$this->index();

		
	}

    protected function getList() {
		
		$url = '';

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, true)
		);

		$data['add'] = $this->url->link('catalog/product/add', 'token=' . $this->session->data['token'] . $url, true);
		$data['copy'] = $this->url->link('catalog/product/copy', 'token=' . $this->session->data['token'] . $url, true);
		$data['delete'] = $this->url->link('catalog/product/delete', 'token=' . $this->session->data['token'] . $url, true);

		$this->load->model('tool/image');

		$this->load->model('mycommunity/customergroups');

		$clubs = $this->model_mycommunity_customergroups->getTotalClub();


		foreach ($clubs->rows as $club) {
			if (is_file(DIR_IMAGE . $club['group_image'])) {
				$group_image = $this->model_tool_image->resize($club['group_image'], 40, 40);
			} else {
				$group_image = $this->model_tool_image->resize('no_image.png', 40, 40);

			}
			
			$customer_name = $this->model_mycommunity_customergroups->getCus_name($club['created_by']);

			$customer_full_name = $customer_name['firstname'].$customer_name['lastname'];

			$data['clubs'][] = array(

				'group_id' 	       => $club['group_id'],
				'group_name'       => $club['group_name'],
				'customer_name'    => $customer_full_name,
				'group_image'      => $group_image,
                'privacy'          => $club['privacy'],
				'location'     	   => $club['location'],
                //'created_by' 	   => $club['created_by'],
            	'edit'       	   => $this->url->link('mycommunity/customergroups/edit','token=' . $this->session->data['token'] .'&group_id='.$club['group_id'],'',true)
			);
		}


        

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_image'] = $this->language->get('column_image');
		$data['column_name'] = $this->language->get('column_name');
		$data['column_model'] = "ISBN";
		$data['column_price'] = $this->language->get('column_price');
		$data['column_quantity'] = $this->language->get('column_quantity');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_action'] = $this->language->get('column_action');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_model'] = $this->language->get('entry_model');
		$data['entry_price'] = $this->language->get('entry_price');
		$data['entry_quantity'] = $this->language->get('entry_quantity');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_image'] = $this->language->get('entry_image');

		$data['button_copy'] = $this->language->get('button_copy');
		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');

		$data['token'] = $this->session->data['token'];

		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('mycommunity/customergroups_list', $data));
	}

	protected function getForm() {
		
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/product')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['product_description'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 3) || (utf8_strlen($value['name']) > 255)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}

			if ((utf8_strlen($value['meta_title']) < 3) || (utf8_strlen($value['meta_title']) > 255)) {
				$this->error['meta_title'][$language_id] = $this->language->get('error_meta_title');
			}
		}

		if ((utf8_strlen($this->request->post['model']) < 1) || (utf8_strlen($this->request->post['model']) > 64)) {
			$this->error['model'] = $this->language->get('error_model');
		}

		if (utf8_strlen($this->request->post['keyword']) > 0) {
			$this->load->model('catalog/url_alias');

			$url_alias_info = $this->model_catalog_url_alias->getUrlAlias($this->request->post['keyword']);

			if ($url_alias_info && isset($this->request->get['product_id']) && $url_alias_info['query'] != 'product_id=' . $this->request->get['product_id']) {
				$this->error['keyword'] = sprintf($this->language->get('error_keyword'));
			}

			if ($url_alias_info && !isset($this->request->get['product_id'])) {
				$this->error['keyword'] = sprintf($this->language->get('error_keyword'));
			}
		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}


	 
}
