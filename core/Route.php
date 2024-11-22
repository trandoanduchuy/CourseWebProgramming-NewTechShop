<?php
class Route {
    // Phương thức để định tuyến cho đường dẫn url nhận được
    public function handleRoute($url) {
        global $routes;
        // loại bỏ phần tử đầu tiên trong $routes
        unset($routes['default_controller']);
        
        // loại bỏ dấu gạch chéo ở đầu và ở cuối url
        $url = trim($url, '/');
        if (empty($url)) {
            $url = '/';
        }
        
        // Thay thế url
        $handleURL = $url;  
        if (!empty($routes)) {
            foreach ($routes as $key=>$value) {
                // Nếu url khớp với $key của mảng $routes
                if (preg_match('~'.$key.'~is', $url)) {
                    // thay thế phần khớp trong url bằng $value của $key
                    $handleURL = preg_replace('~'.$key.'~is', $value, $url);
                }
            }
        }
        return $handleURL;
    }
}