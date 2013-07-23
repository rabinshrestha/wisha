<?php
	class Fruit extends CI_Controller
	{
		function  __construct()
		{
			parent::__construct();
		}
		
		public function index()
		{
			echo "this is fruit page.";
			
		}
		
		public function view($name)
		{
			echo "name of fruit is: ".$name;
		}
	}