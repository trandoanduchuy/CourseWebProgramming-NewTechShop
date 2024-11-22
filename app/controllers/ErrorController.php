<?php

class ErrorController extends Controller{
    public function __404() {
        $this->render('errors/_404');
    }
}