<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Groups_portfolio extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');
        $this->load->model(array('settings','Groups_portfolio_model'));
        $this->pengaturan = $this->settings->index();
        $this->emailset  = $this->settings->emailset();
        $this->load->helper(array('url','language'));
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'plugin/groups_portfolio/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'plugin/groups_portfolio/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'plugin/groups_portfolio/index.html';
            $config['first_url'] = base_url() . 'plugin/groups_portfolio/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Groups_portfolio_model->total_rows($q);
        $groups_portfolio = $this->Groups_portfolio_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $this->data = array(
            'groups_portfolio_data' => $groups_portfolio,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
         $this->data['message'] = $this->session->flashdata('message');
        $this->render_page('groups_portfolio_list', array_merge($this->pengaturan,$this->data ));
    }

    public function read($id) 
    {
        $row = $this->Groups_portfolio_model->get_by_id($id);
        if ($row) {
            $this->data = array(
		'id' => $row->id,
		'id_categories' => $row->id_categories,
		'id_porto' => $row->id_porto,
	    );
            $this->render_page('groups_portfolio_read',array_merge($this->pengaturan,$this->data ));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plugin/groups_portfolio'));
        }
    }

    public function create() 
    {
        $this->data = array(
            'button' => 'Create',
            'action' => site_url('plugin/groups_portfolio/create_action'),
	    'id' => set_value('id'),
	    'id_categories' => set_value('id_categories'),
	    'id_porto' => set_value('id_porto'),
        'group_categori'=>$this->db->get('categoriespost')->result(),
        'group_portfolio'=>$this->db->get('portofolio')->result(),
	);
        $this->render_page('groups_portfolio_form',array_merge($this->pengaturan,$this->data ));
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_categories' => $this->input->post('id_categories',TRUE),
		'id_porto' => $this->input->post('id_porto',TRUE),
	    );

            $this->Groups_portfolio_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('plugin/groups_portfolio'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Groups_portfolio_model->get_by_id($id);

        if ($row) {
            $this->data = array(
                'button' => 'Update',
                'action' => site_url('plugin/groups_portfolio/update_action'),
		'id' => set_value('id', $row->id),
		'id_categories' => set_value('id_categories', $row->id_categories),
		'id_porto' => set_value('id_porto', $row->id_porto),
        'group_categori'=>$this->db->get('categoriespost')->result(),
        'group_portfolio'=>$this->db->get('portofolio')->result(),
	    );
            $this->render_page('groups_portfolio_form',array_merge($this->pengaturan,$this->data ));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plugin/groups_portfolio'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'id_categories' => $this->input->post('id_categories',TRUE),
		'id_porto' => $this->input->post('id_porto',TRUE),
	    );

            $this->Groups_portfolio_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('plugin/groups_portfolio'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Groups_portfolio_model->get_by_id($id);

        if ($row) {
            $this->Groups_portfolio_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('plugin/groups_portfolio'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plugin/groups_portfolio'));
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
	$this->form_validation->set_rules('id_categories', 'id categories', 'trim|required');
	$this->form_validation->set_rules('id_porto', 'id porto', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Groups_portfolio.php */
/* Location: ./application/modules/controllers/Groups_portfolio.php */
/* Please DO NOT modify this information : */

