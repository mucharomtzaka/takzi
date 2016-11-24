<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 */

	public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');
		//if(!$this->ion_auth->is_admin()||!$this->ion_auth->is_programmer()) redirect('/'); 
		$this->load->model(array('settings','Slideshow_model'));
		$this->pengaturan = $this->settings->index();
		$this->emailset  = $this->settings->emailset();
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
				$this->load->database();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language','generate','file'));
		$this->load->dbutil();

		$this->lang->load('auth');
	}
	public function index()
	{
		$this->data = array();
		$this->data['slideshow_data'] = $this->Slideshow_model->get_all();
		$this->data['count_users'] = $this->db->get('users')->num_rows();
		$this->data['count_groups'] = $this->db->get('groups')->num_rows();
		$this->data['count_blog'] = $this->db->get('postartikel')->num_rows();
		$this->data['message'] = $this->session->flashdata('message');
		$this->render_page('message',array_merge($this->data,$this->pengaturan));
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

	public function myprofil(){
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth', 'refresh');
		}

		$this->data = array();
		$this->data['message'] = $this->session->flashdata('message');
		
		$id = $this->session->userdata('id');

		$user = $this->ion_auth->user($id)->row();
		$groups=$this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		// validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
		$this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required');
		$this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required');
		$this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'required');

		if (isset($_POST) && !empty($_POST))
		{
			/*// do we have a valid request?
			if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
			{
				show_error($this->lang->line('error_csrf'));
			}*/

			// update the password if it was posted
			if ($this->input->post('password'))
			{
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
			}

			if ($this->form_validation->run() === TRUE)
			{
				$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name'  => $this->input->post('last_name'),
					'company'    => $this->input->post('company'),
					'phone'      => $this->input->post('phone'),
				);

				// update the password if it was posted
				if ($this->input->post('password'))
				{
					$data['password'] = $this->input->post('password');
				}



			/*	// Only allow updating groups if user is admin
				if ($this->ion_auth->is_admin())
				{
				 $groupData = $this->input->post('groups');

					if (isset($groupData) && !empty($groupData)) {

						$this->ion_auth->remove_from_group('', $id);

						foreach ($groupData as $grp) {
							$this->ion_auth->add_to_group($grp, $id);
						}

					}
			 }*/
			// check to see if we are updating the user
			   if($this->ion_auth->update($user->id, $data))
			    {
			    	// redirect them back to the admin page if admin, or to the base url if non admin
				    $this->session->set_flashdata('message', $this->ion_auth->messages() );
				    redirect('home/myprofil', 'refresh');

			    }
			    else
			    {
			    	// redirect them back to the admin page if admin, or to the base url if non admin
				    $this->session->set_flashdata('message', $this->ion_auth->errors() );
				   redirect('home/myprofil', 'refresh');

			    }

			}
		}

		// display the edit user form
		$this->data['csrf'] = $this->_get_csrf_nonce();

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$this->data['user'] = $user;

		$this->data['groups'] = $groups;
		$this->data['currentGroups'] = $currentGroups;

		$this->data['first_name'] = array(
			'name'  => 'first_name',
			'id'    => 'first_name',
			'type'  => 'text',
			 'class' =>'form-control',
			 'readonly'=>'yes',
			'value' => $this->form_validation->set_value('first_name', $user->first_name),
		);
		$this->data['last_name'] = array(
			'name'  => 'last_name',
			'id'    => 'last_name',
			'type'  => 'text',
			 'class' =>'form-control',
			 'readonly'=>'yes',
			'value' => $this->form_validation->set_value('last_name', $user->last_name),
		);
		$this->data['company'] = array(
			'name'  => 'company',
			'id'    => 'company',
			'type'  => 'text',
			 'class' =>'form-control',
			 'readonly'=>'yes',
			'value' => $this->form_validation->set_value('company', $user->company),
		);
		$this->data['phone'] = array(
			'name'  => 'phone',
			'id'    => 'phone',
			'type'  => 'text',
			 'class' =>'form-control',
			'value' => $this->form_validation->set_value('phone', $user->phone),
		);
		$this->data['password'] = array(
			'name' => 'password',
			'id'   => 'password',
			'type' => 'password',
			 'class' =>'form-control',
		);
		$this->data['password_confirm'] = array(
			'name' => 'password_confirm',
			'id'   => 'password_confirm',
			'type' => 'password',
			 'class' =>'form-control',
		);

		$this->data['title'] = 'Edit My Profil';

		
		$this->render_page('myprofil',array_merge($this->data,$this->pengaturan));
	
	}

	public function postarticle(){
		$this->data = array();
		$this->data['message'] = $this->session->flashdata('message');
		$this->render_page('postarticle',array_merge($this->data,$this->pengaturan));
	}

	

	public function setting($param=null,$logo=null){
		error_reporting(0);
		if($param=='postset'){
			$var_input = $this->input->post(null,true);
			$filter = $this->security->xss_clean($var_input);
			$arraylistdata = array();
			$arraylistdata['id_sett'] = $filter['id'];
			$arraylistdata['header_title'] = $filter['header_title'];
			$arraylistdata['footer_title'] = $filter['footer_title'];
			$arraylistdata['meta_title'] = $filter['meta_title'];
			$arraylistdata['themes'] = $filter['skinthemes'];
			$arraylistdata['name_company'] = $filter['company_title'];
			$arraylistdata['address_company'] = $filter['address_title'];
			$arraylistdata['contact_company'] = $filter['contact_title'];
			$arraylistdata['name_company_profil_des'] = $filter['profil_title'];

			  if ($_FILES['Favicon']['name']!='')
	             {
	               	$logo = $_FILES['Favicon']['name'];
	                $direktori = './bootasset/uploadImages/'; //Folder penyimpanan file
	                //$max_size  = 1000000*10; //Ukuran file maximal 10mb
	                 $nama_file =  $logo ; //Nama file yang akan di Upload
	               // $file_size = $_FILES['file']['size']; //Ukuran file yang akan di Upload
	                 $nama_tmp  = $_FILES['Favicon']['tmp_name']; //Nama file sementara
	                 $upload = $direktori . $nama_file;
	                 $dt = $this->db->get_where('settings',array('id_sett'=>1))->row();
	                 $file ='./bootasset/uploadImages/'.$dt->logo;
	                    if(file_exists($file)){
	                        unlink($file);
	                    }
	                 move_uploaded_file($nama_tmp, $upload);
	                 $arraylistdata['image_favicon'] =$logo;
	               }

	               if ($_FILES['loginback']['name']!='') {
	               	# code...
	               	$logo2 = $_FILES['loginback']['name'];
	                $direktori = './bootasset/uploadImages/'; //Folder penyimpanan file
	                //$max_size  = 1000000*10; //Ukuran file maximal 10mb
	                 $nama_file =  $logo2 ; //Nama file yang akan di Upload
	               // $file_size = $_FILES['file']['size']; //Ukuran file yang akan di Upload
	                 $nama_tmp  = $_FILES['loginback']['tmp_name']; //Nama file sementara
	                 $upload = $direktori . $nama_file;
	                 $dt = $this->db->get_where('settings',array('id_sett'=>1))->row();
	                 $file ='./bootasset/uploadImages/'.$dt->logo;
	                    if(file_exists($file)){
	                        unlink($file);
	                    }
	                 move_uploaded_file($nama_tmp, $upload);
	                 $arraylistdata['backgrounds'] =$logo2;
	               }
        
		            
					$this->settings->save($arraylistdata);

					$listdata = array();
					$listdata['id'] = $filter['id'];
		            $listdata['protocol'] = $filter['smtp_protocol'];
		            $listdata['smtp_host'] = $filter['smtp_host'];
		            $listdata['smtp_user'] = $filter['smtp_user'];
		            $listdata['smtp_pass'] = $filter['smtp_password'];
		            $listdata['smtp_port'] = $filter['smtp_port'];
		            $listdata['newline_smtp'] = $filter['newline'];

					$this->settings->saveemail($listdata);
$string ="<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Email
| -------------------------------------------------------------------------
| This file lets you define parameters for sending emails.
| Please see the user guide for info:
|
| http://ellislab.com/codeigniter/user-guide/libraries/email.html
|
*/
\$config['mailtype'] = 'html';
\$config['protocol']='".$this->emailset['protocol']."';
\$config['smtp_host']='".$this->emailset['smtp_host'].".'; //(SMTP server)
\$config['smtp_port']='".$this->emailset['smtp_port']."'; //(SMTP port)
\$config['smtp_timeout']='30';
\$config['smtp_user']='".$this->emailset['smtp_user']."'; //(user@gmail.com)
\$config['smtp_pass']='".$this->emailset['smtp_pass']."'; // (gmail password)
\$config['charset'] = 'utf-8';
\$config['newline'] = ".$this->emailset['newline_smtp'].";


/* End of file email.php */
/* Location: ./application/config/email.php */";
					$target = 'application/';
					$this->createFile($string, $target."config/email.php");

			$this->session->set_flashdata('message','Setting is update information');
			redirect('home/setting','refresh');
		}else{
			$this->data = array();
			$this->data['message'] = $this->session->flashdata('message');
			$this->render_page('setting',array_merge($this->data,$this->pengaturan,$this->emailset));
		}
			//echo json_encode($this->input->post(null,true));
	}

	public function createFile($string, $path)
		{
		    $create = fopen($path, "w") or die("Unable to open file!");
		    fwrite($create, $string);
		    fclose($create);
		    
		    return $path;
		}

	 public function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}


	public function _valid_csrf_nonce()
	{
		$csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
		if ($csrfkey && $csrfkey == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function modules(){

		$this->data = array();
		$this->data['title'] = 'IT Support';
		$this->data['sub_title'] = ' Pusat Pengembangan modules Aplikasi';
		$this->data['message'] = $this->session->flashdata('message');
		$this->data['table_list'] = $this->db->list_tables();
		$this->render_page('modules',array_merge($this->data,$this->pengaturan));
	}

	public function settgenerate(){
		$path = base_url('settingjson.cfg');
		$get_setting = $this->readJSON($path);

		if (isset($_POST['save'])) {
			    $target = $_POST['target'];
			    $string = '{
							"target": "' . $target . '",
							"copyassets": "0"
							}';
			}
    $hasil_setting = $this->createFile($string, 'settingjson.cfg');
   	$this->session->set_flashdata('message','Setting Updated');
   	redirect('home/modules','refresh');

	}

	private function readJSON($path){
		 $string = file_get_contents($path);
    	 $obj = json_decode($string);
   		 return $obj;
	}


	public function backup($nama_file){
			    
                $nama_file  = 'taskpro_db'.date('Y-m-d');
                $prefs = array(
                        'tables'      => array(),  // Array of tables to backup.
                        'ignore'      => array(),           // List of tables to omit from the backup
                        'format'      => 'txt',             // gzip, zip, txt
                        'filename'    => $nama_file.'.sql',    // File name - NEEDED ONLY WITH ZIP FILES
                        'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
                        'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
                        'newline'     => "\n"               // Newline character used in backup file
                      );

                // Backup your entire database and assign it to a variable
                $backup =& $this->dbutil->backup($prefs);
                // Load the file helper and write the file to your server
               $file = write_file('./backup/'.$nama_file.'.sql', $backup); 
               if(file_exists($file)){
                  unlink($file);
               }
                // Load the download helper and send the file to your desktop
                //$this->load->helper('download');
                $download = '<a href="'.base_url().'/backup/'.$nama_file.'.sql">Silahkan Unduh File ini!</a>';
				$this->session->set_flashdata('message','success backup database '.$nama_file.' is create '.$download.'');
		   		redirect('home/modules','refresh');
		}



	public function generate_module(){
			$table_name = safe($_POST['table_name']);
		    $jenis_tabel = safe($_POST['jenis_tabel']);
		   /* $export_excel = safe($_POST['export_excel']);
		    $export_word = safe($_POST['export_word']);
		    $export_pdf = safe($_POST['export_pdf']);*/
		    $controller = safe($_POST['controller']);
		    $model = safe($_POST['model']);
		      if ($table_name <> ''){
		      		$table_name = $table_name;
			        $c = $controller <> '' ? ucfirst($controller) : ucfirst($table_name);
			        $m = $model <> '' ? ucfirst($model) : ucfirst($table_name) . '_model';
			        $v_list = $table_name . "_list";
			        $v_read = $table_name . "_read";
			        $v_form = $table_name . "_form";
			        $v_doc = $table_name . "_doc";
			        $v_pdf = $table_name . "_pdf";
			        // url
			        $c_url = strtolower($c);
			        // filename
			        $c_file = $c . '.php';
			        $m_file = $m . '.php';
			        $v_list_file = $v_list . '.php';
			        $v_read_file = $v_read . '.php';
			        $v_form_file = $v_form . '.php';
			        $v_doc_file = $v_doc . '.php';
			        $v_pdf_file = $v_pdf . '.php';
			        $path = base_url('settingjson.cfg');
					$get_setting = $this->readJSON($path);
					$target = $get_setting->target;
				/*	if (!file_exists($target . "modules/plugin/views/" . $c_url)){
				            mkdir($target . "modules/plugin/views/" . $c_url, 0777, true);
				        }*/
				     $pk = $this->taskprogenerate->primary_field($table_name);
			         $non_pk = $this->taskprogenerate->not_primary_field($table_name);
			         $all =$this->taskprogenerate->all_field($table_name); 
			         $jenis_tabel == 'reguler_table' ? include APPPATH.'includes/create_view_list.php' : include  APPPATH.'includes/create_view_list_datatables.php';
				        include APPPATH.'includes/create_view_form.php';
				        include APPPATH.'includes/create_view_read.php';
$this->gen_config($target);
$this->model_modules($target,$m,$m_file,$table_name,$pk,$non_pk,$all);
$this->controller_modules($target,$c,$m,$c_file,$c_url,$jenis_tabel,$v_list,$v_read,$v_form,$all,$pk,$non_pk);
					  $this->session->set_flashdata('message','modules is created');  
					  redirect('home/modules','refresh');
		      }else{
				       // $hasil[] = 'No table selected.';
				         $this->session->set_flashdata('message','No table selected');  
					      redirect('home/modules','refresh');
				  }	
   		
	}

	private function controller_modules($target,
										$c,$m,$c_file,$c_url,
										$jenis_tabel,$v_list,$v_read,$v_form,$all,$pk,$non_pk){
$string = "<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class " . $c . " extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!\$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');
        \$this->load->model(array('settings','$m'));
        \$this->pengaturan = \$this->settings->index();
        \$this->emailset  = \$this->settings->emailset();
        \$this->load->helper(array('url','language'));
    }";

if ($jenis_tabel == 'reguler_table') {
    
$string .= "\n\n    public function index()
    {
        \$q = urldecode(\$this->input->get('q', TRUE));
        \$start = intval(\$this->input->get('start'));
        
        if (\$q <> '') {
            \$config['base_url'] = base_url() . 'plugin/$c_url/index?q=' . urlencode(\$q);
            \$config['first_url'] = base_url() . 'plugin/$c_url/index?q=' . urlencode(\$q);
        } else {
            \$config['base_url'] = base_url() . 'plugin/$c_url/index';
            \$config['first_url'] = base_url() . 'plugin/$c_url/index';
        }

        \$config['per_page'] = 10;
        \$config['page_query_string'] = TRUE;
        \$config['total_rows'] = \$this->" . $m . "->total_rows(\$q);
        \$$c_url = \$this->" . $m . "->get_limit_data(\$config['per_page'], \$start, \$q);

        \$this->load->library('pagination');
        \$this->pagination->initialize(\$config);

        \$this->data = array(
            '" . $c_url . "_data' => \$$c_url,
            'q' => \$q,
            'pagination' => \$this->pagination->create_links(),
            'total_rows' => \$config['total_rows'],
            'start' => \$start,
        );
         \$this->data['message'] = \$this->session->flashdata('message');
        \$this->render_page('$v_list', array_merge(\$this->pengaturan,\$this->data ));
    }";

} else {
    
$string .="\n\n    public function index()
    {
        \$$c_url = \$this->" . $m . "->get_all();

        \$this->data = array(
            '" . $c_url . "_data' => \$$c_url
        );

        \$this->render_page('$v_list', array_merge(\$this->pengaturan,\$this->data ));
    }";

}
    
$string .= "\n\n    public function read(\$id) 
    {
        \$row = \$this->" . $m . "->get_by_id(\$id);
        if (\$row) {
            \$this->data = array(";
foreach ($all as $row) {
    $string .= "\n\t\t'" . $row['column_name'] . "' => \$row->" . $row['column_name'] . ",";
}
$string .= "\n\t    );
            \$this->render_page('$v_read',array_merge(\$this->pengaturan,\$this->data ));
        } else {
            \$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plugin/$c_url'));
        }
    }

    public function create() 
    {
        \$this->data = array(
            'button' => 'Create',
            'action' => site_url('plugin/$c_url/create_action'),";
foreach ($all as $row) {
    $string .= "\n\t    '" . $row['column_name'] . "' => set_value('" . $row['column_name'] . "'),";
}
$string .= "\n\t);
        \$this->render_page('$v_form',array_merge(\$this->pengaturan,\$this->data ));
    }
    
    public function create_action() 
    {
        \$this->_rules();

        if (\$this->form_validation->run() == FALSE) {
            \$this->create();
        } else {
            \$data = array(";
foreach ($non_pk as $row) {
    $string .= "\n\t\t'" . $row['column_name'] . "' => \$this->input->post('" . $row['column_name'] . "',TRUE),";
}
$string .= "\n\t    );

            \$this->".$m."->insert(\$data);
            \$this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('plugin/$c_url'));
        }
    }
    
    public function update(\$id) 
    {
        \$row = \$this->".$m."->get_by_id(\$id);

        if (\$row) {
            \$this->data = array(
                'button' => 'Update',
                'action' => site_url('plugin/$c_url/update_action'),";
foreach ($all as $row) {
    $string .= "\n\t\t'" . $row['column_name'] . "' => set_value('" . $row['column_name'] . "', \$row->". $row['column_name']."),";
}
$string .= "\n\t    );
            \$this->render_page('$v_form',array_merge(\$this->pengaturan,\$this->data ));
        } else {
            \$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plugin/$c_url'));
        }
    }
    
    public function update_action() 
    {
        \$this->_rules();

        if (\$this->form_validation->run() == FALSE) {
            \$this->update(\$this->input->post('$pk', TRUE));
        } else {
            \$data = array(";
foreach ($non_pk as $row) {
    $string .= "\n\t\t'" . $row['column_name'] . "' => \$this->input->post('" . $row['column_name'] . "',TRUE),";
}    
$string .= "\n\t    );

            \$this->".$m."->update(\$this->input->post('$pk', TRUE), \$data);
            \$this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('plugin/$c_url'));
        }
    }
    
    public function delete(\$id) 
    {
        \$row = \$this->".$m."->get_by_id(\$id);

        if (\$row) {
            \$this->".$m."->delete(\$id);
            \$this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('plugin/$c_url'));
        } else {
            \$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plugin/$c_url'));
        }
    }

    private function render_page(\$view, \$data=null, \$returnhtml=false){
        \$this->viewdata = (empty(\$data)) ? \$this->data: \$data;
        \$view_html = \$this->load->view('template/adminpage/header', \$this->viewdata);
        \$view_html = \$this->load->view('template/adminpage/navbar', \$this->viewdata);
        \$view_html = \$this->load->view(\$view, \$this->viewdata, \$returnhtml);
        \$view_html = \$this->load->view('template/adminpage/asidebar', \$this->viewdata);
        \$view_html = \$this->load->view('template/adminpage/footer', \$this->viewdata);

        if (\$returnhtml) return \$view_html;//This will return html on 3rd argument being true
    }

    public function _rules() 
    {";
foreach ($non_pk as $row) {
    $int = $row3['data_type'] == 'int' || $row['data_type'] == 'double' || $row['data_type'] == 'decimal' ? '|numeric' : '';
    $string .= "\n\t\$this->form_validation->set_rules('".$row['column_name']."', '".  strtolower(label($row['column_name']))."', 'trim|required$int');";
}    
$string .= "\n\n\t\$this->form_validation->set_rules('$pk', '$pk', 'trim');";
$string .= "\n\t\$this->form_validation->set_error_delimiters('<span class=\"text-danger\">', '</span>');
    }";


$string .= "\n\n}\n\n/* End of file $c_file */
/* Location: ./application/modules/controllers/$c_file */
/* Please DO NOT modify this information : */

";
return $this->createFile($string, $target . "modules/plugin/controllers/" . $c_file);
	}

	
	private function gen_config($target){
		$string = "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
				/* 
				 * Pagination Config Bootstrap 3 CSS Style
				 * Taskpro LTE
				 */

				\$config['query_string_segment'] = 'start';

				\$config['full_tag_open'] = '<nav><ul class=\"pagination\" style=\"margin-top:0px\">';
				\$config['full_tag_close'] = '</ul></nav>';

				\$config['first_link'] = 'First';
				\$config['first_tag_open'] = '<li>';
				\$config['first_tag_close'] = '</li>';

				\$config['last_link'] = 'Last';
				\$config['last_tag_open'] = '<li>';
				\$config['last_tag_close'] = '</li>';

				\$config['next_link'] = 'Next';
				\$config['next_tag_open'] = '<li>';
				\$config['next_tag_close'] = '</li>';

				\$config['prev_link'] = 'Prev';
				\$config['prev_tag_open'] = '<li>';
				\$config['prev_tag_close'] = '</li>';

				\$config['cur_tag_open'] = '<li class=\"active\"><a>';
				\$config['cur_tag_close'] = '</a></li>';

				\$config['num_tag_open'] = '<li>';
				\$config['num_tag_close'] = '</li>';


				/* End of file pagination.php */
				/* Location: ./application/config/pagination.php */
				/* Please DO NOT modify this information : */
				/* Generated by Taskgenerate".date('Y-m-d H:i:s')." */
				/* Taskpro LTE */";

				return $this->createFile($string, $target."config/pagination.php");
	}

	private function model_modules($target,$m,$m_file,$table_name,$pk,$non_pk,$all){
		$string = "
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class " . $m . " extends CI_Model{

public \$table = '$table_name';
public \$id = '$pk';
public \$order = 'DESC';

	function __construct(){
	  parent::__construct();
	}

// get all
	function get_all(){
	 \$this->db->order_by(\$this->id, \$this->order);
	  return \$this->db->get(\$this->table)->result();
	}

// get data by id
	function get_by_id(\$id){
	\$this->db->where(\$this->id, \$id);
	 return \$this->db->get(\$this->table)->row();
	}
				    
 // get total rows
	function total_rows(\$q = NULL) {
	 			\$this->db->like('$pk', \$q);";
	foreach ($non_pk as $row) {
	$string .= "\n\t\$this->db->or_like('" . $row['column_name'] ."', \$q);";
	}    
	 $string .= "\n\t\$this->db->from(\$this->table);
				 return \$this->db->count_all_results();
	}

 // get data with limit and search
	function get_limit_data(\$limit, \$start = 0, \$q = NULL) {
	\$this->db->order_by(\$this->id, \$this->order);
	\$this->db->like('$pk', \$q);";
	foreach ($non_pk as $row) {
	$string .= "\n\t\$this->db->or_like('" . $row['column_name'] ."', \$q);";
	}    
	$string .= "\n\t\$this->db->limit(\$limit, \$start);
			 return \$this->db->get(\$this->table)->result();
	}

// insert data
	function insert(\$data) {
	\$this->db->insert(\$this->table, \$data);
	}

// update data
	function update(\$id, \$data) {
	 \$this->db->where(\$this->id, \$id);
	 \$this->db->update(\$this->table, \$data);
	 }

// delete data
	function delete(\$id)  {
	\$this->db->where(\$this->id, \$id);
	\$this->db->delete(\$this->table);
	 }
}

				/* End of file $m_file */
				/* Location: ./application/models/$m_file */
				/* Please DO NOT modify this information : */
				";
		return $this->createFile($string, $target."models/" . $m_file);
	}
		
}
