<?php
class Controller 
{
    // Hàm dùng để load model
    public function model($model) {
        if (file_exists(_DIR_ROOT. '/app/models/'.$model.'.php')) {
            require_once _DIR_ROOT. '/app/models/'.$model.'.php';
            if (class_exists($model)) {
                return new $model();
            }
        } else {
            return false;
        } 
    }

    // Hàm dùng để render view
    public function render($view, $data=[]) {
        extract($data);
        if (file_exists(_DIR_ROOT.'/app/views/'.$view.'.php')) {
            require_once _DIR_ROOT.'/app/views/'.$view.'.php';
        } else {
            return false;
        } 
        
    }
}