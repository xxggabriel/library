<?php 

namespace App;

use Config\Env;

class Config extends Env
{
    public function __construct()
    {
               
        $this->setEnv([
            'database' => [
                'host'  => 'localhost',
                'user' => 'localhost',
                'password' => 'localhost',
                'port' => '3306',
                'dbname' => 'dbname'
            ],
            'email' => [
                'host' => 'smtp.gmail.com',
                'port' => '587',
                'username' => 'gmail@gmail.com',
                'password' => 'gmail',
                'name' => 'Name'
        
            ],
            'site' => [
                'name' => 'Biblioteca',
                'directory' => '/var/www/html/projetos'
            ]
        ]);
    }


    

}    
