<?php
class HomeController extends Controller {
    public $data = [];
    public function index() {
        $title = 'Trang chủ';
        
        $this->data['sub_content'] = [];

        $this->data['page_title'] = $title;
        $this->data['content'] = 'home/index';
        
        $this->render('layouts/ClientLayout', $this->data);
    }

}

