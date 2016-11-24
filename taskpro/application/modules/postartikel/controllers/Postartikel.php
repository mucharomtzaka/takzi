<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Postartikel extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');
        $this->load->model(array('settings','Postartikel_model'));
        $this->pengaturan = $this->settings->index();
        $this->emailset  = $this->settings->emailset();
        $this->load->helper(array('url','language'));
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'postartikel/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'postartikel/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'postartikel/index.html';
            $config['first_url'] = base_url() . 'postartikel/index.html';
        }

        $config['per_page'] = 10;
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
        $this->data['message'] = $this->session->flashdata('message');
        $this->render_page('postartikel/postartikel_list', array_merge($this->pengaturan,$this->data ));
    }

    public function read($id) 
    {
        $row = $this->Postartikel_model->get_by_id($id);
        if ($row) {
            $this->data = array(
		'article_id' => $row->article_id,
		'article_title' => $row->article_title,
		'article_description' => $row->article_description,
		'Date' => $row->Date,
		'Image' => $row->Image,
	    );
            $this->render_page('postartikel/postartikel_read', array_merge($this->pengaturan,$this->data ));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('postartikel'));
        }
    }

    public function create() 
    {
        $this->data = array(
            'button' => 'Create',
            'action' => site_url('postartikel/create_action'),
	    'article_id' => set_value('article_id'),
	    'article_title' => set_value('article_title'),
	    'article_description' => set_value('article_description'),
	    'Date' => set_value('Date'),
	    'Image' => set_value('Image'),
	);
        $this->render_page('postartikel/postartikel_form', array_merge($this->pengaturan,$this->data ));
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

        	
         $data = array(
				'article_title' => $this->input->post('article_title',TRUE),
				'article_description' => $this->input->post('article_description',TRUE),
				'Date' => $this->input->post('Date',TRUE),
	    	);

         if ($_FILES['Image']['name']!='') {
	               	# code...
	               	$logo2 = $_FILES['Image']['name'];
	                $direktori = './bootasset/uploadImages/blog/'; //Folder penyimpanan file
	                //$max_size  = 1000000*10; //Ukuran file maximal 10mb
	                 $nama_file =  $logo2 ; //Nama file yang akan di Upload
	               // $file_size = $_FILES['file']['size']; //Ukuran file yang akan di Upload
	                 $nama_tmp  = $_FILES['Image']['tmp_name']; //Nama file sementara
	                 $upload = $direktori . $nama_file;
	                 move_uploaded_file($nama_tmp, $upload);
	                 $data['Image'] =$logo2;
	       }
         

            $this->Postartikel_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('postartikel'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Postartikel_model->get_by_id($id);

        if ($row) {
            $this->data = array(
                'button' => 'Update',
                'action' => site_url('postartikel/update_action'),
		'article_id' => set_value('article_id', $row->article_id),
		'article_title' => set_value('article_title', $row->article_title),
		'article_description' => set_value('article_description', $row->article_description),
		'Date' => set_value('Date', $row->Date),
		'Image' =>$row->Image,
	    );
            $this->render_page('postartikel/postartikel_form', array_merge($this->pengaturan,$this->data ));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('postartikel'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('article_id', TRUE));
        } else {

        $data = array(
		'article_title' => $this->input->post('article_title',TRUE),
		'article_description' => $this->input->post('article_description',TRUE),
		'Date' => $this->input->post('Date',TRUE),
	     );
        
        if ($_FILES['Image']['name']!='') {
	               	# code...
	               	$logo2 = $_FILES['Image']['name'];
	                $direktori = './bootasset/uploadImages/blog/'; //Folder penyimpanan file
	                //$max_size  = 1000000*10; //Ukuran file maximal 10mb
	                 $nama_file =  $logo2 ; //Nama file yang akan di Upload
	               // $file_size = $_FILES['file']['size']; //Ukuran file yang akan di Upload
	                 $nama_tmp  = $_FILES['Image']['tmp_name']; //Nama file sementara
	                 $upload = $direktori . $nama_file;
	                 move_uploaded_file($nama_tmp, $upload);
	                 $data['Image'] =$logo2;
	         }
            
            $this->Postartikel_model->update($this->input->post('article_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('postartikel'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Postartikel_model->get_by_id($id);

        if ($row) {
            $this->Postartikel_model->delete($id);
             $lokasi = './bootasset/uploadImages/blog/';
             $file = $lokasi.$row->Image;
            if(file_exists($file)){
                  unlink($file);
               }
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('postartikel'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('postartikel'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('article_title', 'article title', 'trim|required');
	$this->form_validation->set_rules('article_description', 'article description', 'trim|required');
	$this->form_validation->set_rules('Date', 'date', 'trim|required');

	$this->form_validation->set_rules('article_id', 'article_id', 'trim');
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

