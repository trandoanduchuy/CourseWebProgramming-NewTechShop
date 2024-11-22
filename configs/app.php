<?php

class App {

    private $__controller, $__action, $__params, $__routes;

    function __construct() {
        // Khởi tạo một đối tượng Route mới
        $this->__routes = new Route();

        // Gán controller mặc định (HomeController) cho thuộc tính $__controller
        global $routes;
        if (!empty($routes['default_controller'])) {
            $this->__controller = $routes['default_controller'];
        }
        
        $this->__action = 'index';
        $this->__params = [];

        $this->handelURL();
    }

    // Hàm để lấy url
    function getURL() {
        if(!empty($_SERVER['PATH_INFO'])) {
            $url = $_SERVER['PATH_INFO'];
        } else {
            $url = '/';
        }
        return $url;
    }

    // Hàm để xử lý url
    function handelURL() {
        // Lấy url bằng phương thức getURL
        $url = $this->getURL();  

        // Xử lý lại url cho phù hợp với tên các class
        $url = $this->__routes->handleRoute($url); 

        // Phân tách đường dẫn thành các phần và lưu vào mảng
        $urlArray = array_filter(explode('/', $url));
        $urlArray = array_values($urlArray);

        // Xử lý file controller nằm trong các thư mục con
        $urlCheck = '';
        if(!empty($urlArray)) {
            foreach ($urlArray as $key=>$item) {
                $urlCheck .= $item.'/';
                $fileCheck = rtrim($urlCheck, '/');
                // Tạo mảng các thành phần trong url
                $fileArray = explode('/', $fileCheck);
                $fileArray[count($fileArray) - 1] = ucfirst($fileArray[count($fileArray) - 1]);
                $fileCheck = implode('/', $fileArray);
        
                // Kiểm tra xem file controller tương ứng với đường dẫn có tồn tại không
                if (!empty($urlArray[$key - 1])) {
                    unset($urlArray[$key - 1]);
                }
                if (file_exists(_DIR_ROOT . '/app/controllers/' . $fileCheck .'Controller.php')) {
                    $urlCheck = $fileCheck;
                    break;
                }
            }
            $urlArray = array_values($urlArray);
        }

        // Xử lý controller
        if(!empty($urlArray[0])) {
            $this->__controller = ucfirst($urlArray[0]).'Controller';
        } else {
            // Nếu không có controller sử dụng controller mặc định
            $this->__controller = ucfirst($this->__controller).'Controller';
        }
        
        // Xử lý urlCheck rỗng
        if (empty($urlCheck)) {
            $urlCheck = $this->__controller;
        }

        // Kiểm tra tệp controller có tồn tại không
        if (file_exists(_DIR_ROOT.'/app/controllers/'.$urlCheck.'Controller.php')) {
            require_once _DIR_ROOT.'/app/controllers/'.$urlCheck.'Controller.php';

            // Kiểm tra class $this->controller tồn tại
            if (class_exists($this->__controller)) {
                $this->__controller = new $this->__controller;
                unset($urlArray[0]);
            } else {
                $this->loadError();
            }
        } 
        else {
            $this->loadError();
        }

        // Xử lý action
        if (!empty($urlArray[1])) {
            $this->__action = $urlArray[1];
            unset($urlArray[1]);
        }

        // xử lý params
        $this->__params = array_values($urlArray);

        // Kiểm tra method
        if (method_exists($this->__controller, $this->__action)) {
            call_user_func_array([$this->__controller, $this->__action], $this->__params);
        } else {
            $this->loadError();
        }
    }

    function loadError($errorName = '404') {
        require_once _DIR_ROOT. '/app/controllers/ErrorController.php';
        $this->__controller = new ErrorController;
        $this->__controller->__404();
    }
}