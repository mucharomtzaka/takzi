<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Services extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');
        $this->load->model(array('settings','Services_model'));
        $this->pengaturan = $this->settings->index();
        $this->emailset  = $this->settings->emailset();
        $this->load->helper(array('url','language'));
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'plugin/services/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'plugin/services/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'plugin/services/index.html';
            $config['first_url'] = base_url() . 'plugin/services/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Services_model->total_rows($q);
        $services = $this->Services_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $this->data = array(
            'services_data' => $services,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
         $this->data['message'] = $this->session->flashdata('message');
        $this->render_page('services_list', array_merge($this->pengaturan,$this->data ));
    }

    public function read($id) 
    {
        $row = $this->Services_model->get_by_id($id);
        if ($row) {
            $this->data = array(
		'id' => $row->id,
		'title_services' => $row->title_services,
		'desc_services' => $row->desc_services,
		'icon_services' => $row->icon_services,
	    );
            $this->render_page('services_read',array_merge($this->pengaturan,$this->data ));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plugin/services'));
        }
    }

    public function create() 
    {
        $this->data = array(
            'button' => 'Create',
            'action' => site_url('plugin/services/create_action'),
	    'id' => set_value('id'),
	    'title_services' => set_value('title_services'),
	    'desc_services' => set_value('desc_services'),
	    'icon_services' => set_value('icon_services'),
	);
        $this->render_page('services_form',array_merge($this->pengaturan,$this->data ));
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'title_services' => $this->input->post('title_services',TRUE),
		'desc_services' => $this->input->post('desc_services',TRUE),
	    );

                if($_FILES['icon_services']['name']!=''){
                $logo2 = $_FILES['icon_services']['name'];
                $direktori = './bootasset/uploadImages/services/'; //Folder penyimpanan file
                    //$max_size  = 1000000*10; //Ukuran file maximal 10mb
                $nama_file =  $logo2 ; //Nama file yang akan di Upload
                   // $file_size = $_FILES['file']['size']; //Ukuran file yang akan di Upload
                $nama_tmp  = $_FILES['icon_services']['tmp_name']; //Nama file sementara
                $upload = $direktori . $nama_file;
                move_uploaded_file($nama_tmp, $upload);
                $data['icon_services'] =$logo2;
            }

            $this->Services_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('plugin/services'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Services_model->get_by_id($id);

        if ($row) {
            $this->data = array(
                'button' => 'Update',
                'action' => site_url('plugin/services/update_action'),
		'id' => set_value('id', $row->id),
		'title_services' => set_value('title_services', $row->title_services),
		'desc_services' => set_value('desc_services', $row->desc_services),
		'icon_services' => set_value('icon_services', $row->icon_services),
	    );
            $this->render_page('services_form',array_merge($this->pengaturan,$this->data ));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plugin/services'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'title_services' => $this->input->post('title_services',TRUE),
		'desc_services' => $this->input->post('desc_services',TRUE),
		/*'icon_services' => $this->input->post('icon_services',TRUE),*/
	    );
            if($_FILES['icon_services']['name']!=''){
                $logo2 = $_FILES['icon_services']['name'];
                $direktori = './bootasset/uploadImages/services/'; //Folder penyimpanan file
                    //$max_size  = 1000000*10; //Ukuran file maximal 10mb
                $nama_file =  $logo2 ; //Nama file yang akan di Upload
                   // $file_size = $_FILES['file']['size']; //Ukuran file yang akan di Upload
                $nama_tmp  = $_FILES['icon_services']['tmp_name']; //Nama file sementara
                $upload = $direktori . $nama_file;
                move_uploaded_file($nama_tmp, $upload);
                $data['icon_services'] =$logo2;
            }
                

            $this->Services_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('plugin/services'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Services_model->get_by_id($id);

        if ($row) {
            $this->Services_model->delete($id);
            $lokasi = './bootasset/uploadImages/services/';
            $file = $lokasi.$row->icon_services;
            if(file_exists($file)){
                  unlink($file);
               }
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('plugin/services'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plugin/services'));
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
	$this->form_validation->set_rules('title_services', 'title services', 'trim|required');
	$this->form_validation->set_rules('desc_services', 'desc services', 'trim|required');
	//$this->form_validation->set_rules('icon_services', 'icon services', 'trim|required');
	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Services.php */
/* Location: ./application/modules/controllers/Services.php */
/* Please DO NOT modify this information : */

