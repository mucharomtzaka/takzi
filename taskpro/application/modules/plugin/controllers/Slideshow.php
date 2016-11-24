<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Slideshow extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');
        $this->load->model(array('settings','Slideshow_model'));
        $this->pengaturan = $this->settings->index();
        $this->emailset  = $this->settings->emailset();
        $this->load->helper(array('url','language'));
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'plugin/slideshow/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'plugin/slideshow/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'plugin/slideshow/index.html';
            $config['first_url'] = base_url() . 'plugin/slideshow/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Slideshow_model->total_rows($q);
        $slideshow = $this->Slideshow_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $this->data = array(
            'slideshow_data' => $slideshow,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
         $this->data['message'] = $this->session->flashdata('message');
        $this->render_page('slideshow_list', array_merge($this->pengaturan,$this->data ));
    }

    public function read($id) 
    {
        $row = $this->Slideshow_model->get_by_id($id);
        if ($row) {
            $this->data = array(
		'id' => $row->id,
		'image_front' => $row->image_front,
		'image_back' => $row->image_back,
		'description' => $row->description,
		'active' => $row->active,
	    );
            $this->render_page('slideshow_read',array_merge($this->pengaturan,$this->data ));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plugin/slideshow'));
        }
    }

    public function create() 
    {
        $this->data = array(
            'button' => 'Create',
            'action' => site_url('plugin/slideshow/create_action'),
	    'id' => set_value('id'),
	    'image_front' => set_value('image_front'),
	    'image_back' => set_value('image_back'),
	    'description' => set_value('description'),
	    'active' => set_value('active'),
	);
        $this->render_page('slideshow_form',array_merge($this->pengaturan,$this->data ));
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                		/*'image_front' => $this->input->post('image_front',TRUE),*/
                		/*'image_back' => $this->input->post('image_back',TRUE),*/
                		'description' => $this->input->post('description',TRUE),
                		'active' => $this->input->post('active',TRUE),
                	    );

                $logo2 = $_FILES['image_front']['name'];
                $direktori = './bootasset/uploadImages/slider/'; //Folder penyimpanan file
                    //$max_size  = 1000000*10; //Ukuran file maximal 10mb
                $nama_file =  $logo2 ; //Nama file yang akan di Upload
                   // $file_size = $_FILES['file']['size']; //Ukuran file yang akan di Upload
                $nama_tmp  = $_FILES['image_front']['tmp_name']; //Nama file sementara
                $upload = $direktori . $nama_file;
                move_uploaded_file($nama_tmp, $upload);
                $data['image_front'] =$logo2;
     

                $logo3 = $_FILES['image_back']['name'];
                $direktori2 = './bootasset/uploadImages/slider/'; //Folder penyimpanan file
                    //$max_size  = 1000000*10; //Ukuran file maximal 10mb
                $nama_file2 =  $logo3 ; //Nama file yang akan di Upload
                   // $file_size = $_FILES['file']['size']; //Ukuran file yang akan di Upload
                $nama_tmp2  = $_FILES['image_back']['tmp_name']; //Nama file sementara
                $upload2 = $direktori2 . $nama_file2;
                move_uploaded_file($nama_tmp2, $upload2);
                $data['image_back'] =$logo3;


           

            $this->Slideshow_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('plugin/slideshow'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Slideshow_model->get_by_id($id);

        if ($row) {
            $this->data = array(
                'button' => 'Update',
                'action' => site_url('plugin/slideshow/update_action'),
		'id' => set_value('id', $row->id),
		'image_front' => set_value('image_front', $row->image_front),
		'image_back' => set_value('image_back', $row->image_back),
		'description' => set_value('description', $row->description),
		'active' => set_value('active', $row->active),
	    );
            $this->render_page('slideshow_form',array_merge($this->pengaturan,$this->data ));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plugin/slideshow'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		/*'image_front' => $this->input->post('image_front',TRUE),
		'image_back' => $this->input->post('image_back',TRUE),*/
		'description' => $this->input->post('description',TRUE),
		'active' => $this->input->post('active',TRUE),
	    );

            if($_FILES['image_front']['name']!=''){
                $logo2 = $_FILES['image_front']['name'];
                $direktori = './bootasset/uploadImages/slider/'; //Folder penyimpanan file
                    //$max_size  = 1000000*10; //Ukuran file maximal 10mb
                $nama_file =  $logo2 ; //Nama file yang akan di Upload
                   // $file_size = $_FILES['file']['size']; //Ukuran file yang akan di Upload
                $nama_tmp  = $_FILES['image_front']['tmp_name']; //Nama file sementara
                $upload = $direktori . $nama_file;
                move_uploaded_file($nama_tmp, $upload);
                $data['image_front'] =$logo2;
            }
                
     
            if($_FILES['image_back']['name']!=''){
                 $logo3 = $_FILES['image_back']['name'];
                $direktori2 = './bootasset/uploadImages/slider/'; //Folder penyimpanan file
                    //$max_size  = 1000000*10; //Ukuran file maximal 10mb
                $nama_file2 =  $logo3 ; //Nama file yang akan di Upload
                   // $file_size = $_FILES['file']['size']; //Ukuran file yang akan di Upload
                $nama_tmp2  = $_FILES['image_back']['tmp_name']; //Nama file sementara
                $upload2 = $direktori2 . $nama_file2;
                move_uploaded_file($nama_tmp2, $upload2);
                $data['image_back'] =$logo3;
            }

               
            $this->Slideshow_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('plugin/slideshow'));
            }
    }
    
    public function delete($id) 
    {
        $row = $this->Slideshow_model->get_by_id($id);

        if ($row) {
            $this->Slideshow_model->delete($id);
            $lokasi = './bootasset/uploadImages/slider/';
            $file2 = $lokasi.$row->image_back;
            $file1  = $lokasi.$row->image_front;
            if(file_exists($file1)){
                  unlink($file1);
               }
            if (file_exists($file2)) {
                   # code...
                 unlink($file2);
            }
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('plugin/slideshow'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plugin/slideshow'));
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

	//$this->form_validation->set_rules('image_front', 'image front', 'trim|required');
	//$this->form_validation->set_rules('image_back', 'image back', 'trim|required');
	$this->form_validation->set_rules('description', 'description', 'trim|required');
	$this->form_validation->set_rules('active', 'active', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Slideshow.php */
/* Location: ./application/modules/controllers/Slideshow.php */
/* Please DO NOT modify this information : */

