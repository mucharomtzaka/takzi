<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Model{
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$d = $this->db->get('settings')->row_array();
		return $d;
	}

	public function emailset(){
		return $this->db->get('settings_email')->row_array();
	}

	public function save($arraylistdata){
		$this->db->set($arraylistdata);
		$this->db->where('id_sett',$arraylistdata['id_sett']);
		return $this->db->update('settings');
	}

	public function saveemail($listdata){
		$this->db->set($listdata);
		$this->db->where('id',$listdata['id']);
		return $this->db->update('settings_email');
	}

	public function menu_nav_barItem(){
		$sql = "SELECT menubar.menu_id,menubar.menu,menubar.menu_link,submenubar.submenu_id,submenubar.submenu_link,submenubar.submenu, submenubar.menu_id AS menu_order from menubar join submenubar on menubar.menu_id = submenubar.menu_id ";
		return $this->db->query($sql)->result_array();
	}

	public function menubar(){
		return $this->db->get('menubar')->result();
	}
}