<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

	function Auth($table, $where) {
		return $this->db->get_where($table, $where);
	}
	
}