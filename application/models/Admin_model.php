<?php 
defined('BASEPATH') OR exit('No direct script access allowed') ;

class Admin_model extends CI_Model
{
	public function __construct()
	{
		parent :: __construct();
		$this->load->database();
	}
		//login  
	public function login($username,$Password)
	{
		$this->db->select('*');
		$this->db->from('admins');
		$this->db->where(array( 'username' => $username,
								'Password' => SHA1($Password)));
		$this->db->order_by('username','desc');
		$query = $this->db->get();
		return $query->row();
	}
}