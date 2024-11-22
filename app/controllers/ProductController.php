<?php 
class ProductController extends Controller {

    public $data = [];

    public function index() {
        $model = $this->model('ProductModel');
        $dataProduct = $model->getProductsList();
        $title = 'Trang index';

        $this->data['sub_content']['product_list'] = $dataProduct;
        
        $this->data['page_title'] = $title;
        $this->data['content'] = 'products/index';
        
        $this->render('layouts/ClientLayout', $this->data);
    }

    public function showListOfProducts() {
        $model = $this->model('ProductModel');
        $dataProduct = $model->getProductsList();
        $title = 'Danh sách sản phẩm';

        $this->data['sub_content']['product_list'] = $dataProduct;
        
        $this->data['page_title'] = $title;
        $this->data['content'] = 'products/list';
        
        $this->render('layouts/ClientLayout', $this->data);
    }

    public function detail() {   
        $title = 'Chi tiết sản phẩm';
        $model = $this->model('ProductModel');
        $dataProduct = $model->getDetail(0);

        $this->data['sub_content']['info'] = $dataProduct; 
        
        $this->data['page_title'] = $title;
        $this->data['content'] = 'products/detail';  

        $this->render('layouts/ClientLayout', $this->data);
    }
}