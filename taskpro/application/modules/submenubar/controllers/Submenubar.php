<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Submenubar extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');
        $this->load->model(array('settings','Submenubar_model'));
        $this->pengaturan = $this->settings->index();
        $this->emailset  = $this->settings->emailset();
        $this->load->helper(array('url','language'));
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'submenubar/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'submenubar/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'submenubar/index.html';
            $config['first_url'] = base_url() . 'submenubar/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Submenubar_model->total_rows($q);
        $submenubar = $this->Submenubar_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $this->data = array(
            'submenubar_data' => $submenubar,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->data['message'] = $this->session->flashdata('message');
        $this->render_page('submenubar_list', array_merge($this->pengaturan,$this->data ));
    }

    public function read($id) 
    {
        $row = $this->Submenubar_model->get_by_id($id);
        if ($row) {
            $this->data = array(
		'submenu_id' => $row->submenu_id,
		'submenu' => $row->submenu,
		'menu_id' => $row->menu_id,
		'submenu_link' => $row->submenu_link,
	    );
            $this->render_page('submenubar_read', array_merge($this->pengaturan,$this->data ));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('submenubar'));
        }
    }

    public function create() 
    {
        $this->data = array(
            'button' => 'Create',
            'action' => site_url('submenubar/create_action'),
	    'submenu_id' => set_value('submenu_id'),
	    'submenu' => set_value('submenu'),
	    'menu_id' => set_value('menu_id'),
	    'submenu_link' => set_value('submenu_link'),
        'group_menubar'=>$this->db->get('menubar')->result()
	);
        $this->render_page('submenubar_form', array_merge($this->pengaturan,$this->data ));
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'submenu' => $this->input->post('submenu',TRUE),
		'menu_id' => $this->input->post('menu_id',TRUE),
		'submenu_link' => $this->input->post('submenu_link',TRUE),
	    );

            $this->Submenubar_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('submenubar'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Submenubar_model->get_by_id($id);

        if ($row) {
            $this->data = array(
                'button' => 'Update',
                'action' => site_url('submenubar/update_action'),
		'submenu_id' => set_value('submenu_id', $row->submenu_id),
		'submenu' => set_value('submenu', $row->submenu),
		'menu_id' => set_value('menu_id', $row->menu_id),
		'submenu_link' => set_value('submenu_link', $row->submenu_link),
        'group_menubar'=>$this->db->get('menubar')->result()
	    );
            $this->render_page('submenubar_form',array_merge($this->pengaturan,$this->data ));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('submenubar'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('submenu_id', TRUE));
        } else {
            $data = array(
		'submenu' => $this->input->post('submenu',TRUE),
		'menu_id' => $this->input->post('menu_id',TRUE),
		'submenu_link' => $this->input->post('submenu_link',TRUE),
	    );

            $this->Submenubar_model->update($this->input->post('submenu_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('submenubar'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Submenubar_model->get_by_id($id);

        if ($row) {
            $this->Submenubar_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('submenubar'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('submenubar'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('submenu', 'submenu', 'trim|required');
	$this->form_validation->set_rules('menu_id', 'menu id', 'trim|required');
	$this->form_validation->set_rules('submenu_link', 'submenu link', 'trim|required');

	$this->form_validation->set_rules('submenu_id', 'submenu_id', 'trim');
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
