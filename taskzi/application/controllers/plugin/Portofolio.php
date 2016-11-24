<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Portofolio extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');
        $this->load->model(array('settings','Portofolio_model'));
        $this->pengaturan = $this->settings->index();
        $this->emailset  = $this->settings->emailset();
        $this->load->helper(array('url','language'));
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'plugin/portofolio/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'plugin/portofolio/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'plugin/portofolio/index.html';
            $config['first_url'] = base_url() . 'plugin/portofolio/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Portofolio_model->total_rows($q);
        $portofolio = $this->Portofolio_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $this->data = array(
            'portofolio_data' => $portofolio,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
         $this->data['message'] = $this->session->flashdata('message');
        $this->render_page('portofolio_list', array_merge($this->pengaturan,$this->data ));
    }

    public function read($id) 
    {
        $row = $this->Portofolio_model->get_by_id($id);
        if ($row) {
            $this->data = array(
		'id' => $row->id,
		'title_porto' => $row->title_porto,
		'desc_porto' => $row->desc_porto,
		'image_porto' => $row->image_porto,
	    );
            $this->render_page('portofolio_read',array_merge($this->pengaturan,$this->data ));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plugin/portofolio'));
        }
    }

    public function create() 
    {
        $this->data = array(
            'button' => 'Create',
            'action' => site_url('plugin/portofolio/create_action'),
	    'id' => set_value('id'),
	    'title_porto' => set_value('title_porto'),
	    'desc_porto' => set_value('desc_porto'),
	    'image_porto' => set_value('image_porto'),
	);
        $this->render_page('portofolio_form',array_merge($this->pengaturan,$this->data ));
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'title_porto' => $this->input->post('title_porto',TRUE),
		'desc_porto' => $this->input->post('desc_porto',TRUE),
		/*'image_porto' => $this->input->post('image_porto',TRUE),*/
	    );

                if($_FILES['image_porto']['name']!=''){
                $logo2 = $_FILES['image_porto']['name'];
                $direktori = './bootasset/uploadImages/portfolio/'; //Folder penyimpanan file
                    //$max_size  = 1000000*10; //Ukuran file maximal 10mb
                $nama_file =  $logo2 ; //Nama file yang akan di Upload
                   // $file_size = $_FILES['file']['size']; //Ukuran file yang akan di Upload
                $nama_tmp  = $_FILES['image_porto']['tmp_name']; //Nama file sementara
                $upload = $direktori . $nama_file;
                move_uploaded_file($nama_tmp, $upload);
                $data['image_porto'] =$logo2;
                }
                

            $this->Portofolio_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('plugin/portofolio'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Portofolio_model->get_by_id($id);

        if ($row) {
            $this->data = array(
                'button' => 'Update',
                'action' => site_url('plugin/portofolio/update_action'),
		'id' => set_value('id', $row->id),
		'title_porto' => set_value('title_porto', $row->title_porto),
		'desc_porto' => set_value('desc_porto', $row->desc_porto),
		'image_porto' => set_value('image_porto', $row->image_porto),
	    );
            $this->render_page('portofolio_form',array_merge($this->pengaturan,$this->data ));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plugin/portofolio'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'title_porto' => $this->input->post('title_porto',TRUE),
		'desc_porto' => $this->input->post('desc_porto',TRUE),
		/*'image_porto' => $this->input->post('image_porto',TRUE),*/
	    );

             if($_FILES['image_porto']['name']!=''){
                $logo2 = $_FILES['image_porto']['name'];
                $direktori = './bootasset/uploadImages/portfolio/'; //Folder penyimpanan file
                    //$max_size  = 1000000*10; //Ukuran file maximal 10mb
                $nama_file =  $logo2 ; //Nama file yang akan di Upload
                   // $file_size = $_FILES['file']['size']; //Ukuran file yang akan di Upload
                $nama_tmp  = $_FILES['image_porto']['tmp_name']; //Nama file sementara
                $upload = $direktori . $nama_file;
                move_uploaded_file($nama_tmp, $upload);
                $data['image_porto'] =$logo2;
                }

            $this->Portofolio_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('plugin/portofolio'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Portofolio_model->get_by_id($id);

        if ($row) {
            $this->Portofolio_model->delete($id);
            $lokasi = './bootasset/uploadImages/portfolio/';
            $file1  = $lokasi.$row->image_porto;
            if(file_exists($file1)){
                  unlink($file1);
               }
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('plugin/portofolio'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plugin/portofolio'));
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
	$this->form_validation->set_rules('title_porto', 'title porto', 'trim|required');
	$this->form_validation->set_rules('desc_porto', 'desc porto', 'trim|required');
	/*$this->form_validation->set_rules('image_porto', 'image porto', 'trim|required');*/
	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Portofolio.php */
/* Location: ./application/modules/controllers/Portofolio.php */
/* Please DO NOT modify this information : */

