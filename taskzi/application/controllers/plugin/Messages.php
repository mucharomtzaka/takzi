<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Messages extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');
        $this->load->model(array('settings','Messages_model'));
        $this->pengaturan = $this->settings->index();
        $this->emailset  = $this->settings->emailset();
        $this->load->helper(array('url','language'));
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'plugin/messages/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'plugin/messages/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'plugin/messages/index.html';
            $config['first_url'] = base_url() . 'plugin/messages/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Messages_model->total_rows($q);
        $messages = $this->Messages_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $this->data = array(
            'messages_data' => $messages,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
         $this->data['message'] = $this->session->flashdata('message');
        $this->render_page('messages_list', array_merge($this->pengaturan,$this->data ));
    }

    public function read($id) 
    {
        $row = $this->Messages_model->get_by_id($id);
        if ($row) {
            $this->data = array(
		'id' => $row->id,
		'nameuser' => $row->nameuser,
		'emailuser' => $row->emailuser,
		'phoneuser' => $row->phoneuser,
		'companyuser' => $row->companyuser,
		'subject' => $row->subject,
		'message' => $row->message,
	    );
            $this->render_page('messages_read',array_merge($this->pengaturan,$this->data ));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plugin/messages'));
        }
    }

    public function create() 
    {
        $this->data = array(
            'button' => 'Create',
            'action' => site_url('plugin/messages/create_action'),
	    'id' => set_value('id'),
	    'nameuser' => set_value('nameuser'),
	    'emailuser' => set_value('emailuser'),
	    'phoneuser' => set_value('phoneuser'),
	    'companyuser' => set_value('companyuser'),
	    'subject' => set_value('subject'),
	    'message' => set_value('message'),
	);
        $this->render_page('messages_form',array_merge($this->pengaturan,$this->data ));
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nameuser' => $this->input->post('nameuser',TRUE),
		'emailuser' => $this->input->post('emailuser',TRUE),
		'phoneuser' => $this->input->post('phoneuser',TRUE),
		'companyuser' => $this->input->post('companyuser',TRUE),
		'subject' => $this->input->post('subject',TRUE),
		'message' => $this->input->post('message',TRUE),
	    );
            $this->Messages_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('plugin/messages'));
            if(!$this->ion_auth->logged_in()){
                 $this->session->set_flashdata('message', 'Your message is send Successfull');
                 redirect(site_url('welcome/Contact'));
            }
        }
    }
    
    public function update($id) 
    {
        $row = $this->Messages_model->get_by_id($id);

        if ($row) {
            $this->data = array(
                'button' => 'Update',
                'action' => site_url('plugin/messages/update_action'),
		'id' => set_value('id', $row->id),
		'nameuser' => set_value('nameuser', $row->nameuser),
		'emailuser' => set_value('emailuser', $row->emailuser),
		'phoneuser' => set_value('phoneuser', $row->phoneuser),
		'companyuser' => set_value('companyuser', $row->companyuser),
		'subject' => set_value('subject', $row->subject),
		'message' => set_value('message', $row->message),
	    );
            $this->render_page('messages_form',array_merge($this->pengaturan,$this->data ));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plugin/messages'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nameuser' => $this->input->post('nameuser',TRUE),
		'emailuser' => $this->input->post('emailuser',TRUE),
		'phoneuser' => $this->input->post('phoneuser',TRUE),
		'companyuser' => $this->input->post('companyuser',TRUE),
		'subject' => $this->input->post('subject',TRUE),
		'message' => $this->input->post('message',TRUE),
	    );

            $this->Messages_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('plugin/messages'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Messages_model->get_by_id($id);

        if ($row) {
            $this->Messages_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('plugin/messages'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plugin/messages'));
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
	$this->form_validation->set_rules('nameuser', 'nameuser', 'trim|required');
	$this->form_validation->set_rules('emailuser', 'emailuser', 'trim|required');
	/*$this->form_validation->set_rules('phoneuser', 'phoneuser', 'trim|required');
	$this->form_validation->set_rules('companyuser', 'companyuser', 'trim|required');*/
	$this->form_validation->set_rules('subject', 'subject', 'trim|required');
	$this->form_validation->set_rules('message', 'message', 'trim|required');
	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Messages.php */
/* Location: ./application/modules/controllers/Messages.php */
/* Please DO NOT modify this information : */

