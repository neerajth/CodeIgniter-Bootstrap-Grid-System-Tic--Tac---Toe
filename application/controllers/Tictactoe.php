<?php
class Tictactoe extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('scores_model');
                $this->load->helper('url_helper');
                $this->load->helper('html');
        }


        public function index()
        {                
            
                $data['scores'] = $this->scores_model->get_scores();
                $data['title'] = 'TicTacToe';
                $data['level']=$this->uri->segment(3);
                $this->load->view('templates/header', $data);
                $this->load->view('tictactoe/index', $data);
                $this->load->view('templates/footer');
        }

        public function view($slug = NULL)
        {
        }
    
        public function create()
        {
        }
}
