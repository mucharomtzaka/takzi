<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menus extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');
        $this->load->model(array('settings','Menus_model'));
        $this->pengaturan = $this->settings->index();
        $this->emailset  = $this->settings->emailset();
        $this->load->helper(array('url','language'));
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'plugin/menus/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'plugin/menus/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'plugin/menus/index';
            $config['first_url'] = base_url() . 'plugin/menus/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Menus_model->total_rows($q);
        $menus = $this->Menus_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $this->data = array(
            'menus_data' => $menus,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
         $this->data['message'] = $this->session->flashdata('message');
        $this->render_page('menus_list', array_merge($this->pengaturan,$this->data ));
    }

    public function read($id) 
    {
        $row = $this->Menus_model->get_by_id($id);
        if ($row) {
            $this->data = array(
		'id' => $row->id,
		'parent' => $row->parent,
		'name' => $row->name,
		'icon' => $row->icon,
		'slug' => $row->slug,
		'number' => $row->number,
	    );
            $this->render_page('menus_read',array_merge($this->pengaturan,$this->data ));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plugin/menus'));
        }
    }

    public function create() 
    {
        $this->data = array(
            'button' => 'Create',
            'action' => site_url('plugin/menus/create_action'),
	    'id' => set_value('id'),
	    'parent' => set_value('parent'),
	    'name' => set_value('name'),
	    'icon' => set_value('icon'),
	    'slug' => set_value('slug'),
	    'number' => set_value('number'),
	);
        $this->render_page('menus_form',array_merge($this->pengaturan,$this->data ));
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'parent' => $this->input->post('parent',TRUE),
		'name' => $this->input->post('name',TRUE),
		'icon' => $this->input->post('icon',TRUE),
		'slug' => $this->input->post('slug',TRUE),
		'number' => $this->input->post('number',TRUE),
	    );

            $this->Menus_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('plugin/menus'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Menus_model->get_by_id($id);

        if ($row) {
            $this->data = array(
                'button' => 'Update',
                'action' => site_url('plugin/menus/update_action'),
		'id' => set_value('id', $row->id),
		'parent' => set_value('parent', $row->parent),
		'name' => set_value('name', $row->name),
		'icon' => set_value('icon', $row->icon),
		'slug' => set_value('slug', $row->slug),
		'number' => set_value('number', $row->number),
	    );
            $this->render_page('menus_form',array_merge($this->pengaturan,$this->data ));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plugin/menus'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'parent' => $this->input->post('parent',TRUE),
		'name' => $this->input->post('name',TRUE),
		'icon' => $this->input->post('icon',TRUE),
		'slug' => $this->input->post('slug',TRUE),
		'number' => $this->input->post('number',TRUE),
	    );

            $this->Menus_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('plugin/menus'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Menus_model->get_by_id($id);

        if ($row) {
            $this->Menus_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('plugin/menus'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plugin/menus'));
        }
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

    public function _rules() 
    {
	$this->form_validation->set_rules('parent', 'parent', 'trim|required');
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	//$this->form_validation->set_rules('icon', 'icon', 'trim|required');
	$this->form_validation->set_rules('slug', 'slug', 'trim|required');
	$this->form_validation->set_rules('number', 'number', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Menus.php */
/* Location: ./application/modules/controllers/Menus.php */
/* Please DO NOT modify this information : */

