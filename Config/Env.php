<?php 

namespace Config;

class Env
{
    private $env = [
        'database' => [
            'host'  => '127.0.0.1',
            'user' => 'root',
            'password' => 'root',
            'port' => '3306',
            'db_name' => 'dbname'
        ],
        'email' => [
            'host' => 'smtp.gmail.com',
            'port' => '587',
            'username' => 'email@gmail.com',
            'password' => 'password',
            'name' => 'Name',
            
        ],
        'site' => [
            'name' => 'name_site',
            'directory' => '/var/www/html',
        ],
    ];
    public function setEnv($env)
    {
        $this->env = $env;
    }

    public function getEnv()
    {
        return $this->env;
    }

    public function getDatabase($database)
    {
        return $this->env['database'][$database];
    }

    public function getEmail($email)
    {
        return $this->env['email'][$email]; 
    }

    public function getSite($site)
    {
        return $this->env['site'][$site]; 
    }
}