<?php 

namespace Model;

use Controller\Model;
use Model\DB\Sql;
class Client extends Model
{
    public function createClient($data = array())
    {
        $sql = new Sql();
        $this->setData($data);

        $result = $sql->select("SELECT email FROM clients WHERE email = ".$data['email']);
        if($result === 0)
        {
            $sql->query("CALL create_client(:name, :email, :password,:photo,:status_client)",[
                ":name" => $this->getname(),
                ":email" => $this->getemail(),
                ":password" => $this->getpassword(),
                ":photo" => $this->getphoto(),
                ":status_client" => $this->getstatus_client()
            ]);
        } else 
        {
            throw new \Exception("Email existente, tente usar outro email ou autenticar com seu email:" . $data['email']);
            
        }
    }

    public function update($id_client, $data)
    {
        $sql = new Sql();
        $this->setData($data);

        
    }

    public function selectClient($id_client)
    {
        $sql = new Sql();

        return $sql->select("SELECT * FROM clients WHERE id_client = :id_client AND status_client > 0",[
            ":id_client"   => $id_client
        ]);
    }

    public function selectAllClients()
    {
        $sql = new Sql();

        return $sql->select("SELECT * FROM clients WHERE status_client > 0");
    }

    public function deleteClient($id_client)
    {
        $sql = new Sql();

        $sql->query("CALL delete_client(:id_client)",[
            ":id_client" => $id_client
        ]);
    }
}