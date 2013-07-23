<?php
class Contact extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->lang->load('contact');
		$this->load->helper('captcha');
		$this->load->helper('form');
	}

	public function index()
	{
		$this->load->view('cms/header_inner');
		$this->load->view('contact');
		$this->load->view('cms/footer');
	}

	public function sucess()
	{
		// 		$this->load->helper('form');
		// 		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('your-first-name','First name','required');
		$this->form_validation->set_rules('your-email','email','required|valid_email');
		// 		$this->form_validation->set_rules('your-last-name','email','required');
		$this->form_validation->set_rules('your-subject','subject','required');
		$this->form_validation->set_rules('your-message','message','required');
		$this->form_validation->set_rules('your-captcha','captcha','required');
		if($this->form_validation->run() == FALSE)
		{
			// redirect to contact form
			if($this->lang->lang() == 'fr')
			{
				redirect(base_url().'fr/contact');
			}
			else
			{
				redirect(base_url().'de/kontakt');
			}
		}
		else
		{
			// extract provided values
			$data['firstName'] = $this->input->post('your-first-name');
			$data['lastName'] = $this->input->post('your-last-name');
			$data['email'] = $this->input->post('your-email');
			$data['subject'] = $this->input->post('your-subject');
			$data['message'] = $this->input->post('your-message');
				
			// First, delete old captchas
			$expiration = time()-3600; // One hour limit
			$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);

			// Then see if a captcha exists:
			$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
			$binds = array($this->input->post('your-captcha'), $this->input->ip_address(), $expiration);
			$query = $this->db->query($sql, $binds);
			$row = $query->row();

			if ($row->count == 0)
			{
				// 				echo 'no entry on db.';
				// 				die();
				// 				$captcha_error = lang('contact_captcha_error_unmatch');
				$this->session->set_flashdata('contact_captcha_error','unmatched captcha');
				$this->session->set_flashdata('contact_first_name',$data['firstName']);
				$this->session->set_flashdata('contact_last_name',$data['lastName']);
				$this->session->set_flashdata('contact_email',$data['email']);
				$this->session->set_flashdata('contact_subject',$data['email']);
				$this->session->set_flashdata('contact_message',$data['message']);
				// 				die();
				// error inserting captcha
				// 				echo "You must submit the word that appears in the image";
				// redirect to contact form
				if($this->lang->lang() == 'fr')
				{
					redirect(base_url().'fr/contact');
				}
				else
				{
					redirect(base_url().'de/kontakt');
				}
			}

			//save to database
			$this->load->model('mdl_contact','model');
			$sucess = TRUE;
			if(	$this->model->insertMessage($data))
			{
				//contact message sucessfully saved
				//send feedback to user
				$this->model->sendReplyMail($data['email']);

				// show sucess message
				$this->load->view('cms/header_inner');
				$this->load->view('sucess');
				$this->load->view('cms/footer');
			}

			//send reply message to that email

			// show sucess message
		}
	}

}