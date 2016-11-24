<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Linkscompany extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');
        $this->load->model(array('settings','Linkscompany_model'));
        $this->pengaturan = $this->settings->index();
        $this->emailset  = $this->settings->emailset();
        $this->load->helper(array('url','language'));
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'plugin/linkscompany/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'plugin/linkscompany/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'plugin/linkscompany/index.html';
            $config['first_url'] = base_url() . 'plugin/linkscompany/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Linkscompany_model->total_rows($q);
        $linkscompany = $this->Linkscompany_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $this->data = array(
            'linkscompany_data' => $linkscompany,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
         $this->data['message'] = $this->session->flashdata('message');
        $this->render_page('linkscompany_list', array_merge($this->pengaturan,$this->data ));
    }

    public function read($id) 
    {
        $row = $this->Linkscompany_model->get_by_id($id);
        if ($row) {
            $this->data = array(
		'id' => $row->id,
		'title_link_menu' => $row->title_link_menu,
		'desc_link_menu' => $row->desc_link_menu,
	    );
            $this->render_page('linkscompany_read',array_merge($this->pengaturan,$this->data ));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plugin/linkscompany'));
        }
    }

    public function create() 
    {
        $this->data = array(
            'button' => 'Create',
            'action' => site_url('plugin/linkscompany/create_action'),
	    'id' => set_value('id'),
	    'title_link_menu' => set_value('title_link_menu'),
	    'desc_link_menu' => set_value('desc_link_menu'),
	);
        $this->render_page('linkscompany_form',array_merge($this->pengaturan,$this->data ));
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'title_link_menu' => $this->input->post('title_link_menu',TRUE),
		'desc_link_menu' => $this->input->post('desc_link_menu',TRUE),
	    );

            $this->Linkscompany_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('plugin/linkscompany'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Linkscompany_model->get_by_id($id);

        if ($row) {
            $this->data = array(
                'button' => 'Update',
                'action' => site_url('plugin/linkscompany/update_action'),
		'id' => set_value('id', $row->id),
		'title_link_menu' => set_value('title_link_menu', $row->title_link_menu),
		'desc_link_menu' => set_value('desc_link_menu', $row->desc_link_menu),
	    );
            $this->render_page('linkscompany_form',array_merge($this->pengaturan,$this->data ));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plugin/linkscompany'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'title_link_menu' => $this->input->post('title_link_menu',TRUE),
		'desc_link_menu' => $this->input->post('desc_link_menu',TRUE),
	    );

            $this->Linkscompany_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('plugin/linkscompany'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Linkscompany_model->get_by_id($id);

        if ($row) {
            $this->Linkscompany_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('plugin/linkscompany'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plugin/linkscompany'));
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
	$this->form_validation->set_rules('title_link_menu', 'title link menu', 'trim|required');
	$this->form_validation->set_rules('desc_link_menu', 'desc link menu', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Linkscompany.php */
/* Location: ./application/modules/controllers/Linkscompany.php */
/* Please DO NOT modify this information : */

