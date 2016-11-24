<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categoriespost extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');
        $this->load->model(array('settings','Categoriespost_model'));
        $this->pengaturan = $this->settings->index();
        $this->emailset  = $this->settings->emailset();
        $this->load->helper(array('url','language'));
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'categoriespost/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'categoriespost/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'categoriespost/index';
            $config['first_url'] = base_url() . 'categoriespost/index';
        }

        $config['per_page'] = 5;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Categoriespost_model->total_rows($q);
        $categoriespost = $this->Categoriespost_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $this->data = array(
            'categoriespost_data' => $categoriespost,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->data['message'] = $this->session->flashdata('message');
        $this->render_page('categoriespost_list', array_merge($this->pengaturan,$this->data ));
    }

    public function read($id) 
    {
        $row = $this->Categoriespost_model->get_by_id($id);
        if ($row) {
           $this->data = array(
		'categories_id' => $row->categories_id,
		'kategories_title' => $row->kategories_title,
		'kategories_description' => $row->kategories_description,
	    );
            $this->render_page('categoriespost_read',array_merge($this->pengaturan,$this->data ));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('categoriespost'));
        }
    }

    public function create() 
    {
        $this->data = array(
            'button' => 'Create',
            'action' => site_url('categoriespost/create_action'),
	    'categories_id' => set_value('categories_id'),
	    'kategories_title' => set_value('kategories_title'),
	    'kategories_description' => set_value('kategories_description'),
	);
        $this->render_page('categoriespost_form',array_merge($this->pengaturan,$this->data ));
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kategories_title' => $this->input->post('kategories_title',TRUE),
		'kategories_description' => $this->input->post('kategories_description',TRUE),
	    );

            $this->Categoriespost_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('categoriespost'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Categoriespost_model->get_by_id($id);

        if ($row) {
            $this->data = array(
                'button' => 'Update',
                'action' => site_url('categoriespost/update_action'),
		'categories_id' => set_value('categories_id', $row->categories_id),
		'kategories_title' => set_value('kategories_title', $row->kategories_title),
		'kategories_description' => set_value('kategories_description', $row->kategories_description),
	    );
            $this->data['message'] = $this->session->flashdata('message');
            $this->render_page('categoriespost_form', array_merge($this->pengaturan,$this->data ));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('categoriespost'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('categories_id', TRUE));
        } else {
            $data = array(
		'kategories_title' => $this->input->post('kategories_title',TRUE),
		'kategories_description' => $this->input->post('kategories_description',TRUE),
	    );

            $this->Categoriespost_model->update($this->input->post('categories_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('categoriespost'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Categoriespost_model->get_by_id($id);

        if ($row) {
            $this->Categoriespost_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('categoriespost'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('categoriespost'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kategories_title', 'kategories title', 'trim|required');
	$this->form_validation->set_rules('kategories_description', 'kategories description', 'trim|required');

	$this->form_validation->set_rules('categories_id', 'categories_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    private function render_page($view, $data=null, $returnhtml=false){
        $this->viewdata = (empty($data)) ? $this->data: $data;
        $view_html = $this->load->view('template/adminpage/header', $this->viewdata);
        $view_html = $this->load->view('template/adminpage/navbar', $this->viewdata);
        $view_html = $this->load->view($view, $this->viewdata, $returnhtml);
        $view_html = $this->load->view('template/adminpage/asidebar', $this->viewdata);
        $view_html = $this->load->view('template/adminpage/footer', $this->viewdata);

        if ($returnhtml) return $view_html;//This will return html on 3rd argument being true
    }

}
