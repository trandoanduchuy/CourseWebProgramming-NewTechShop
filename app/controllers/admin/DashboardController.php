<?php 
class DashboardController extends Controller {
    public function index() {
        echo 'Index of Dashboard';
    }

    public function detail($id) {
        echo 'Detail Dashboard - '.$id;
    }
}