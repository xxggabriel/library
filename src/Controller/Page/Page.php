<?php 

namespace Controller\Page;

// namespace
use Rain\Tpl;

class Page 
{
    const VIEWS = "/var/www/html/projetos/Library/src/Views";
    private $tpl;
    private $options = [];
    private $default = [
        "header" => true,
        "footer" => true
    ];
    


    public function __construct($opts = [], $tpl_dir = "/site/")
    {
        // checking whether it is to use the default options or use the past options
        $this->options = array_merge($this->default, $opts);

        // config
        $config = array(
            "tpl_dir"       => Page::VIEWS.$tpl_dir,
            "cache_dir"     => Page::VIEWS."/cache/",
            "debug"         => false, // set to false to improve the speed
        );

        Tpl::configure( $config );

        $this->tpl = new Tpl;
        // Check if it is to display the header 
        if($this->options["header"])$this->tpl->draw("header");
    }

    private function setData($data)
    {
        foreach ($data as $key => $value) {
            // set the variables in the template
            $this->tpl->assign($key,$value);
 
        }
    }

    public function setTpl($tpl, $data = [])
    {    
        // set the variables in the template
        $this->setData($data);
        // draw the template
        $this->tpl->draw($tpl);
    }

    public function __destruct()
    {
        // Check if it is to display the footer 
        if($this->options["footer"])$this->tpl->draw("footer");
    }
}