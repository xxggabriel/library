<?php 

namespace Model\DB;

use App\Config;
class Sql
{

    private $conn;
    public function __construct()
    {
        try {
            $env = new Config();
            $this->conn = new \PDO('mysql:host='.$env->getDatabase('host').
            ';dbname='.$env->getDatabase('dbname').';',
            $env->getDatabase('user'),
            $env->getDatabase('password'));   
        } catch (\PDOException $e) {
            throw new \Exception("Erro: ".$e->getMessage()."\n".
                                "Code: ".$e->getCode()."\n".
                                "File: ".$e->getFile()."\n".
                                "Line: ".$e->getLine()."\n" );
        }
        
    }

    private function setParams($statement, $parameters = array())
	{
		foreach ($parameters as $key => $value) {
			
			$this->bindParam($statement, $key, $value);
		}
	}
	private function bindParam($statement, $key, $value)
	{
		$statement->bindParam($key, $value);
	}
	public function query($rawQuery, $params = array())
	{
		$stmt = $this->conn->prepare($rawQuery);
		$this->setParams($stmt, $params);
		$stmt->execute();
	}
	public function select($rawQuery, $params = array()):array
	{
		$stmt = $this->conn->prepare($rawQuery);
		$this->setParams($stmt, $params);
		$stmt->execute();
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function backup()
	{
		$env = new Config;
		exec("mysqldump --routines -u ".$env->getDatabase("user")." -p". $env->getDatabase("password")." ".$env->getDatabase("dbname") ."> ". $env->getSite("directory") . "/src/Model/DB/Backups/backup-".date("Y-m-d").".sql");
		
		sleep(5);
		exec("git add ". $env->getSite("directory") . "/src/Model/DB/Backups/backup-".date("Y-m-d").".sql");
		exec("git commit -m 'Backup do banco de dados da data'");
		exec("git push origin master");
		// backup-2018-12-26.sql
		
	}	

}