<?php defineD('BASEPATH') or die('Direct access is not allowed');
class Mdl_contact extends MY_Model{
	function __construct(){
		parent::__construct();
		$this->table_name = 'contact';
		$this->primary_key = 'contact_id';
	}

	function insertMessage($value)
	{
		$data = array(
				'contact_first_name' => $value['firstName'],
				'contact_last_name' => $value['lastName'],
				'contact_email' => $value['email'],
				'contact_subject' => $value['subject'],
				'contact_message' => $value['message'],
				'contact_isread' => 0
		);
		if($this->db->insert($this->table_name,$data))
			return TRUE;
		else
			return FALSE;
	}

	function sendReplyMail($value)
	{
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->from('shrestha.rabin505@gmail.com', 'Wisha');
		$this->email->to($value);
		$this->email->subject('Thanks From Wisha');
		$this->email->message('Wisha team would like to thank you for your precious feedback.
				Please visit http://www.wisha.ch for more information.');
		if($this->email->send())
		{
			return TRUE;
		}

		else
		{
			return FALSE;
		}
	}
}
