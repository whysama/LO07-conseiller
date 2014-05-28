<?php

class Application
{
    private $url_controller = null;

    private $url_action = null;

    private $url_parameter_1 = null;

    private $url_parameter_2 = null;

    private $url_parameter_3 = null;


    public function __construct()
    {
        // 解析URL
        $this->splitUrl();

        // 检查是否存在对应的controller
        if (file_exists('./application/controller/' . $this->url_controller . '.php')) {

            // 如果存在，调用改controller
            require './application/controller/' . $this->url_controller . '.php';
            $this->url_controller = new $this->url_controller();

            // 检查是否存在对应的method
            if (method_exists($this->url_controller, $this->url_action)) {
                //按有多少参数调用method
                if (isset($this->url_parameter_3)) {
                    $this->url_controller->{$this->url_action}($this->url_parameter_1, $this->url_parameter_2, $this->url_parameter_3);
                } elseif (isset($this->url_parameter_2)) {
                    $this->url_controller->{$this->url_action}($this->url_parameter_1, $this->url_parameter_2);
                } elseif (isset($this->url_parameter_1)) {
                    $this->url_controller->{$this->url_action}($this->url_parameter_1);
                } else {
                    $this->url_controller->{$this->url_action}();
                }
            } else {
                $this->url_controller->index();
            }
        } else {
            //不可解析 URL, 返回首页 home/index
            require './application/controller/home.php';
            $home = new Home();
            $home->index();
        }
    }

    /**
     * 获取和分段URL
     */
    private function splitUrl()
    {
        if (isset($_GET['url'])) {

            // split URL
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            // 把URL 的每部分分配到对应功能
            $this->url_controller = (isset($url[0]) ? $url[0] : null);
            $this->url_action = (isset($url[1]) ? $url[1] : null);
            $this->url_parameter_1 = (isset($url[2]) ? $url[2] : null);
            $this->url_parameter_2 = (isset($url[3]) ? $url[3] : null);
            $this->url_parameter_3 = (isset($url[4]) ? $url[4] : null);

            // splitURL 测试
            //echo"----------Application Pamametrage------------"."<br/>";
            //echo 'Controller: ' . $this->url_controller . '<br />';
            //echo 'Action: ' . $this->url_action . '<br />';
            //echo 'Parameter 1: ' . $this->url_parameter_1 . '<br />';
            //echo 'Parameter 2: ' . $this->url_parameter_2 . '<br />';
            //echo 'Parameter 3: ' . $this->url_parameter_3 . '<br />';
            //echo"----------Fin------------"."<br/>"."<br/>"."<br/>";

        }
    }
}
