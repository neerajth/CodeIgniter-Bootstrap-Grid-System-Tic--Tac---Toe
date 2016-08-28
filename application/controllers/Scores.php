<?php
class Scores extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('scores_model');
                $this->load->helper('url_helper');
        }

        public function index()
        {            
                $data['scores'] = $this->scores_model->get_scores();
                $this->load->view('scores/index', $data);
        }

        public function view($slug = NULL)
        {
        }
    
        public function create()
        {         
                $this->scores_model->set_scores();
                $data['scores'] = $this->scores_model->get_scores();
                $this->load->view('scores/index', $data);                
        }
}
