<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menubar extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');
        $this->load->model(array('settings','Menubar_model'));
        $this->pengaturan = $this->settings->index();
        $this->emailset  = $this->settings->emailset();
        $this->load->helper(array('url','language'));
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'menubar/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'menubar/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'menubar/index.html';
            $config['first_url'] = base_url() . 'menubar/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Menubar_model->total_rows($q);
        $menubar = $this->Menubar_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $this->data = array(
            'menubar_data' => $menubar,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->data['message'] = $this->session->flashdata('message');
        $this->render_page('menubar_list', array_merge($this->pengaturan,$this->data ));
    }

    public function read($id) 
    {
        $row = $this->Menubar_model->get_by_id($id);
        if ($row) {
            $this->data = array(
		'menu_id' => $row->menu_id,
		'menu' => $row->menu,
		'menu_link' => $row->menu_link,
	    );
            $this->render_page('menubar_read', array_merge($this->pengaturan,$this->data ));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('menubar'));
        }
    }

    public function create() 
    {
        $this->data = array(
            'button' => 'Create',
            'action' => site_url('menubar/create_action'),
	    'menu_id' => set_value('menu_id'),
	    'menu' => set_value('menu'),
	    'menu_link' => set_value('menu_link'),
	);
        $this->render_page('menubar_form', array_merge($this->pengaturan,$this->data ));
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'menu' => $this->input->post('menu',TRUE),
		'menu_link' => $this->input->post('menu_link',TRUE),
	    );

            $this->Menubar_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('menubar'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Menubar_model->get_by_id($id);

        if ($row) {
            $this->data = array(
                'button' => 'Update',
                'action' => site_url('menubar/update_action'),
		'menu_id' => set_value('menu_id', $row->menu_id),
		'menu' => set_value('menu', $row->menu),
		'menu_link' => set_value('menu_link', $row->menu_link),
	    );
            $this->render_page('menubar/menubar_form', array_merge($this->pengaturan,$this->data ));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('menubar'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('menu_id', TRUE));
        } else {
            $data = array(
		'menu' => $this->input->post('menu',TRUE),
		'menu_link' => $this->input->post('menu_link',TRUE),
	    );

            $this->Menubar_model->update($this->input->post('menu_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('menubar'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Menubar_model->get_by_id($id);

        if ($row) {
            $this->Menubar_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('menubar'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('menubar'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('menu', 'menu', 'trim|required');
	$this->form_validation->set_rules('menu_link', 'menu link', 'trim|required');

	$this->form_validation->set_rules('menu_id', 'menu_id', 'trim');
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
