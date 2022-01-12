<?php 


namespace App\Db;  

use PDO;
use PDOException;

class dataBase{ 

    const HOST= 'localhost'; 

    const NAME= 'vagas';

    const USER= 'root'; 

    const PASS= '1234'; 

    /**
     * nome da tabela a ser manipulada
     * @var string 
     */
    public $table; 
    /**
     * instancia de conexão com o banco de dados 
     * @var PDO
     */
    private $connection; 

        /**
         * Define a tabela e instancia a conexão 
         * @param string $table
         */

    public function __construct($table = null){ 
            $this->table = $table;
            $this->setconnection(); 
    } 


    private function setconnection(){   
        try{
            $this->connection= new PDO('mysql:host='.self::HOST.';dbname='.self::NAME,self::USER,self::PASS); 
            $this->connection-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die('ERROR');
        } 
    }   

    /** 
     * Executar querys dentro do banco de dados
     * @param array
     * @return PDOStatement
     */

    public function execute($query, $params = []){
        try{  
            $statement= $this->connection->prepare($query); 
            $statement ->execute($params);  
            return $statement;
        }catch(PDOException $e){
            die('ERROR'.$e->getMessage());
        } 
    }
 
/**
 * metodo responsavel por inserir dados no banco
 * @param array $values  [field => value] 
 * @return integer
 */

    public function insert ($values){ 
            //dados da query
            $fields = array_keys($values); 
            $binds = array_pad([],count($fields),'?');
           
      
                //query
             $query ='INSERT INTO '.$this->table.' ('.implode(',',$fields).') VALUES ('.implode(',',$binds).')';

            //EXECUTA O INSERT
            $this->execute($query,array_values($values)); 

            //RETORNA O ID 
            return $this->connection->lastInsertId();
    }  

        
        public function select ($where= null, $order=null, $limit= null, $fields ='*'){  
                $where = strlen ($where) ? 'WHERE'.$where : '';
                $order = strlen ($order) ? 'ORDE BY'.$order : '';
                $where = strlen ($limit) ? 'LIMIT'.$limit : '';
            

            $query ='SELECT'.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;

            return $this->execute($query);
        }
            // responsavel por executar atualizações no banco de dados
            public function update($where,$values){ 
                    //dados da query 
                    $fields= array_keys($values);

                //monta query
                $query = 'UPDATE'.$this->table.' SET'.implode('=?,',$fields).'=? WHERE'.$where; 

                //EXECUTAR QUERY  query
                $this -> execute($query,array_values($values));
                return true;
            }
            
            // metedo responsavel por deletar dados do banco
            public function delete ($where){ 
                // MONTA QUERY
                $query = 'DELETE FROM '.$this->table.' WHERE '.$where; 

                //executa query 
                $this->execute ($query); 

                //retorna sucesso 
                return true;
            }

}