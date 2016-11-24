<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){
		parent::__construct();
		$this->load->model(array('settings','Slideshow_model','Features_model','Services_model','Messages_model','Linkscompany_model','Linksdevelop_model','Linkssupport_model','Linkspartner_model','Categoriespost_model','Postartikel_model'));
		$this->load->database();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language'));

		//$this->multi_menu->set_items($items);

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
		$this->pengaturan = $this->settings->index();
		//$items = $this->settings->menu_nav_barItem();
		///$this->multi_menu->set_items($items);
	}

	public function index()
	{
		$this->data = array();
		$this->data['slideshow_data'] = $this->Slideshow_model->get_all();
		$this->data['features_data'] = $this->Features_model->get_all();
		$this->data['services_data'] = $this->Services_model->get_all();
		$this->data['links_company_data'] = $this->Linkscompany_model->get_all();
		$this->data['links_support_data'] = $this->Linkssupport_model->get_all();
		$this->data['links_develop_data'] = $this->Linksdevelop_model->get_all();
		$this->data['links_partner_data'] = $this->Linkspartner_model->get_all();
		$this->data['categories_data']  = $this->Categoriespost_model->get_all();
		$this->data['data_categories_porto'] = $this->groupsfotopolio();
		$this->data['message'] = $this->session->flashdata('message');
		$this->render_page('welcome_message',array_merge($this->data,$this->pengaturan));
	}

	public function Blog($param=null)
	{
		
		if($param =='content')
			$this->data['title'] = $param ='conten'?:'';

		$q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'welcome/Blog?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'welcome/Blog?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'welcome/Blog';
            $config['first_url'] = base_url() . 'welcome/Blog';
        }

        $config['per_page'] = 5;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Postartikel_model->total_rows($q);
        $postartikel = $this->Postartikel_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $this->data = array(
            'postartikel_data' => $postartikel,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->data['message'] = '';
		$this->data['title'] = '';
        $this->data['links_company_data'] = $this->Linkscompany_model->get_all();
		$this->data['links_support_data'] = $this->Linkssupport_model->get_all();
		$this->data['links_develop_data'] = $this->Linksdevelop_model->get_all();
		$this->data['links_partner_data'] = $this->Linkspartner_model->get_all();
		$this->render_page('blogs',array_merge($this->data,$this->pengaturan));

	}

	public function detailBlog($id){
		$this->data = array();
		$this->data['postartikel_data'] = $this->db->get_where('postartikel',
													array('article_id'=>$id))->result();
		$this->data['links_company_data'] = $this->Linkscompany_model->get_all();
		$this->data['links_support_data'] = $this->Linkssupport_model->get_all();
		$this->data['links_develop_data'] = $this->Linksdevelop_model->get_all();
		$this->data['links_partner_data'] = $this->Linkspartner_model->get_all();
		$this->render_page('blogsitems',array_merge($this->data,$this->pengaturan));
	}

	public function Service()
	{
		$this->data = array();
		$this->data['services_data'] = $this->Services_model->get_all();
		$this->data['features_data'] = $this->Features_model->get_all();
		$this->data['links_company_data'] = $this->Linkscompany_model->get_all();
		$this->data['links_support_data'] = $this->Linkssupport_model->get_all();
		$this->data['links_develop_data'] = $this->Linksdevelop_model->get_all();
		$this->data['links_partner_data'] = $this->Linkspartner_model->get_all();
		$this->data['message'] = $this->session->flashdata('message');
		$this->render_page('services',array_merge($this->data,$this->pengaturan));
	}


	public function Contact()
	{
		$this->data = array();
		$this->data['message'] = $this->session->flashdata('message');
		$this->render_page('contact',array_merge($this->data,$this->pengaturan));
	}

	private  function groupsfotopolio(){
		$sql = "SELECT * from groups_portfolio join portofolio on portofolio.id = groups_portfolio.id_porto join categoriespost ON categoriespost.categories_id = groups_portfolio.id_categories";
		return $this->db->query($sql)->result();
	}

	public function sendmessage(){
		 $data = array(
		'nameuser' => $this->input->post('nameuser',TRUE),
		'emailuser' => $this->input->post('emailuser',TRUE),
		'phoneuser' => $this->input->post('phoneuser',TRUE),
		'companyuser' => $this->input->post('companyuser',TRUE),
		'subject' => $this->input->post('subject',TRUE),
		'message' => $this->input->post('message',TRUE),
	    );
            $this->Messages_model->insert($data);
           $this->session->set_flashdata('message', 'Your message is send Successfull');
           redirect(site_url('welcome/Contact'));
	}


	public function Profil()
	{
		$this->data = array();
		$this->data['slideshow_data'] = $this->Slideshow_model->get_all();
		//$this->data['features_data'] = $this->Features_model->get_all();
		$this->data['services_data'] = $this->Services_model->get_all();
		$this->data['links_company_data'] = $this->Linkscompany_model->get_all();
		$this->data['links_support_data'] = $this->Linkssupport_model->get_all();
		$this->data['links_develop_data'] = $this->Linksdevelop_model->get_all();
		$this->data['links_partner_data'] = $this->Linkspartner_model->get_all();
		$this->data['message'] = $this->session->flashdata('message');
		$this->render_page('profil',array_merge($this->data,$this->pengaturan));
	}

	public function myprofil()
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth', 'refresh');
		}

		$this->data = array();
		$this->data['message'] = $this->session->flashdata('message');
		
		$id = $this->session->userdata('id');

		$user = $this->ion_auth->user($id)->row();
		$groups=$this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		// validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
		$this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required');
		$this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required');
		$this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'required');

		if (isset($_POST) && !empty($_POST))
		{
			/*// do we have a valid request?
			if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
			{
				show_error($this->lang->line('error_csrf'));
			}*/

			// update the password if it was posted
			if ($this->input->post('password'))
			{
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
			}

			if ($this->form_validation->run() === TRUE)
			{
				$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name'  => $this->input->post('last_name'),
					'company'    => $this->input->post('company'),
					'phone'      => $this->input->post('phone'),
				);

				// update the password if it was posted
				if ($this->input->post('password'))
				{
					$data['password'] = $this->input->post('password');
				}



			/*	// Only allow updating groups if user is admin
				if ($this->ion_auth->is_admin())
				{
				 $groupData = $this->input->post('groups');

					if (isset($groupData) && !empty($groupData)) {

						$this->ion_auth->remove_from_group('', $id);

						foreach ($groupData as $grp) {
							$this->ion_auth->add_to_group($grp, $id);
						}

					}
			 }*/
			// check to see if we are updating the user
			   if($this->ion_auth->update($user->id, $data))
			    {
			    	// redirect them back to the admin page if admin, or to the base url if non admin
				    $this->session->set_flashdata('message', $this->ion_auth->messages() );
				    redirect('welcome/myprofil', 'refresh');

			    }
			    else
			    {
			    	// redirect them back to the admin page if admin, or to the base url if non admin
				    $this->session->set_flashdata('message', $this->ion_auth->errors() );
				   redirect('welcome/myprofil', 'refresh');

			    }

			}
		}

		// display the edit user form
		$this->data['csrf'] = $this->_get_csrf_nonce();

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$this->data['user'] = $user;

		$this->data['groups'] = $groups;
		$this->data['currentGroups'] = $currentGroups;

		$this->data['first_name'] = array(
			'name'  => 'first_name',
			'id'    => 'first_name',
			'type'  => 'text',
			 'class' =>'form-control',
			 'readonly'=>'yes',
			'value' => $this->form_validation->set_value('first_name', $user->first_name),
		);
		$this->data['last_name'] = array(
			'name'  => 'last_name',
			'id'    => 'last_name',
			'type'  => 'text',
			 'class' =>'form-control',
			 'readonly'=>'yes',
			'value' => $this->form_validation->set_value('last_name', $user->last_name),
		);
		$this->data['company'] = array(
			'name'  => 'company',
			'id'    => 'company',
			'type'  => 'text',
			 'class' =>'form-control',
			 'readonly'=>'yes',
			'value' => $this->form_validation->set_value('company', $user->company),
		);
		$this->data['phone'] = array(
			'name'  => 'phone',
			'id'    => 'phone',
			'type'  => 'text',
			 'class' =>'form-control',
			'value' => $this->form_validation->set_value('phone', $user->phone),
		);
		$this->data['password'] = array(
			'name' => 'password',
			'id'   => 'password',
			'type' => 'password',
			 'class' =>'form-control',
		);
		$this->data['password_confirm'] = array(
			'name' => 'password_confirm',
			'id'   => 'password_confirm',
			'type' => 'password',
			 'class' =>'form-control',
		);

		$this->data['title'] = 'Edit My Profil';	
		$this->render_page('myprofil',array_merge($this->data,$this->pengaturan));
	}

	private function render_page($view, $data=null, $returnhtml=false){
		$this->viewdata = (empty($data)) ? $this->data: $data;
		$this->viewdata['q'] ='';
		$this->viewdata['menu'] =  $this->settings->menubar();
		$view_html = $this->load->view('template/userpage/header', $this->viewdata);
		$view_html = $this->load->view('template/userpage/navbar', $this->viewdata);
		//$view_html = $this->load->view('template/userpage/asidebar', $this->viewdata);
		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);
		$view_html = $this->load->view('template/userpage/footer', $this->viewdata);

		if ($returnhtml) return $view_html;//This will return html on 3rd argument being true
	}

	public function register()
    {
        $this->data['title'] = 'Register New User';
        $tables = $this->config->item('tables','ion_auth');
        $identity_column = $this->config->item('identity','ion_auth');
        $this->data['identity_column'] = $identity_column;

        // validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
        if($identity_column!=='email')
        {
            $this->form_validation->set_rules('identity',$this->lang->line('create_user_validation_identity_label'),'required|is_unique['.$tables['users'].'.'.$identity_column.']');
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
        }
        else
        {
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }
        $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');
        $this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'trim');
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        if ($this->form_validation->run() == true)
        {
            $email    = strtolower($this->input->post('email'));
            $identity = ($identity_column==='email') ? $email : $this->input->post('identity');
            $password = $this->input->post('password');

            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'company'    => $this->input->post('company'),
                'phone'      => $this->input->post('phone'),
            );
        }
        if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data))
        {
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("welcome/register", 'refresh');
        }
        else
        {
            // display the create user form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['first_name'] = array(
                'name'  => 'first_name',
                'id'    => 'first_name',
                'type'  => 'text',
                'class' =>'form-control',
                'value' => $this->form_validation->set_value('first_name'),
            );
            $this->data['last_name'] = array(
                'name'  => 'last_name',
                'id'    => 'last_name',
                'type'  => 'text',
                 'class' =>'form-control',
                'value' => $this->form_validation->set_value('last_name'),
            );
            $this->data['identity'] = array(
                'name'  => 'identity',
                'id'    => 'identity',
                'type'  => 'text',
                 'class' =>'form-control',
                'value' => $this->form_validation->set_value('identity'),
            );
            $this->data['email'] = array(
                'name'  => 'email',
                'id'    => 'email',
                'type'  => 'text',
                 'class' =>'form-control',
                'value' => $this->form_validation->set_value('email'),
            );
            $this->data['company'] = array(
                'name'  => 'company',
                'id'    => 'company',
                'type'  => 'text',
                 'class' =>'form-control',
                'value' => $this->form_validation->set_value('company'),
            );
            $this->data['phone'] = array(
                'name'  => 'phone',
                'id'    => 'phone',
                'type'  => 'text',
                 'class' =>'form-control',
                'value' => $this->form_validation->set_value('phone'),
            );
            $this->data['password'] = array(
                'name'  => 'password',
                'id'    => 'password',
                'type'  => 'password',
                 'class' =>'form-control',
                'value' => $this->form_validation->set_value('password'),
            );
            $this->data['password_confirm'] = array(
                'name'  => 'password_confirm',
                'id'    => 'password_confirm',
                'type'  => 'password',
                 'class' =>'form-control',
                'value' => $this->form_validation->set_value('password_confirm'),
            );

            $this->render_page('register',array_merge($this->data,$this->pengaturan));
        }
    }

    public function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}


	public function _valid_csrf_nonce()
	{
		$csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
		if ($csrfkey && $csrfkey == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}



	/*public function change_password()
	{
		$this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
		$this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}

		$user = $this->ion_auth->user()->row();

		if ($this->form_validation->run() == false)
		{
			// display the form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			$this->data['old_password'] = array(
				'name' => 'old',
				'id'   => 'old',
				'type' => 'password',
			);
			$this->data['new_password'] = array(
				'name'    => 'new',
				'id'      => 'new',
				'type'    => 'password',
				'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
			);
			$this->data['new_password_confirm'] = array(
				'name'    => 'new_confirm',
				'id'      => 'new_confirm',
				'type'    => 'password',
				'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
			);
			$this->data['user_id'] = array(
				'name'  => 'user_id',
				'id'    => 'user_id',
				'type'  => 'hidden',
				'value' => $user->id,
			);

			// render
			$this->render_page('change_password', array_merge($this->data,$this->pengaturan));
		}
		else
		{
			$identity = $this->session->userdata('identity');

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change)
			{
				//if the password was successfully changed
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				$this->logout();
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('change_password', 'refresh');
			}
		}
	}*/


}
