<?php
class HomeModel {
    protected $table = 'products';

    // Hàm để lấy danh sách sản phẩm
    public function getList() {
        $data = [
            'Item 1',
            'Item 2',
            'Item 3'
        ];
        return $data;
    }

    public function getDetail($id=0) {
        $data = [
            'Item 1',
            'Item 2',
            'Item 3'
        ];
        return $data[$id];
    }
}