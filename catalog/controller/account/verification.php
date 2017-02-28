<?php 
class ControllerAccountVerification extends Controller { 
    public function index() {
       	if ($this->customer->isLogged()) {
			$this->response->redirect($this->url->link('account/account', '', true));
		}
        if (strlen($this->request->get['v']) != 32 ||
            intval($this->request->get['u']) <= 0) {
            header('Location: '.HTTP_SERVER);die();
        }
        
        $customer_id = $this->request->get['u'];
        $verification_code = $this->request->get['v'];
        
        $customer = $this->db->query("SELECT verification_code FROM " . DB_PREFIX . "customer_verification WHERE customer_id='" . $customer_id . "'");
        
        if ($customer->row['verification_code'] != $verification_code) {
            header('Location: '.HTTP_SERVER);die();
        }
        
        $this->db->query("UPDATE " . DB_PREFIX . "customer SET approved = '1'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "customer_verification WHERE customer_id='" . $customer_id . "'"); 
        
        $this->language->load('account/verification');

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_account_verification'),
            'href' => $this->url->link('account/verification')
        );

      
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');
        
        $data['text_account_verificaiton'] = $this->language->get('text_account_verificaiton');
        $data['text_account_verified'] = $this->language->get('text_account_verified');
        
        $data['login'] = $this->url->link('account/login', '', true);
        
        
       if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/verification.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/account/verification.tpl';
        } else {
            $this->template = 'default/template/account/verification.tpl';
        }
        
        $this->children = array(
            'common/column_left',
            'common/column_right',
            'common/content_top',
            'common/content_bottom',
            'common/footer',
            'common/header'     
        );
        
      //  $this->response->setOutput($this->render());  */
    

        $this->response->setOutput($this->load->view('account/verification', $data));

    }
}
