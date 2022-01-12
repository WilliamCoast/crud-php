<?php 

namespace App\entity;  

use \App\Db\dataBase;  
use \PDO ;

class vaga { 

    /**
     * Identificador único da vaga 
     * @var integer
     */

    public $id;  

    /**
     * Título da vaga  
     * @var string
     */

    public $titulo;  

    /**
     * Descrição da vaga 
     * @var string 
     */

    public $descricao;  

    /**
     * Define s a vaga ativa 
     * @var string (s/n)
     */ 
    public $ativo;  

    /**
     * Data de publicação da vaga 
     * @var string 
     */ 

     public $data;  

    /** 
     * Método responsável para cadastrar uma nova vaga no banco de dados
     * @return boolean 
     */

     public function cadastrar(){
         //DEFINIR DATA 
        $this->data= date('Y-m-d H:i:s');

         

        // INSERIR A VAGA NO BANCO
         $obDatabase = new DataBase('vagas'); 
         
        $this-> id =  $obDatabase->insert([
               'titulo' => $this->titulo, 
               'descricao' => $this-> descricao, 
               'ativo' => $this->ativo
             
           ]);
            
        

         //RETORNAR SUCESSO VAGA

         return true;
     }

         /**Método responsável por atualizar a vaga no banco**/
        public function atualizar (){ 
            return (new Database('vagas'))-> update('id='.$this->id,[
                'titulo' => $this->titulo, 
                'descricao' => $this-> descricao, 
                'ativo' => $this->ativo

            ]);
        }
            //EXCLUIR A VAGA DO BANCO
            public function excluir (){ 
                return (new Database('vagas'))->delete('id= '.$this->id);
            }

    /**
     * Obter as vagas dentro do banco
     */

    public static function getVagas($where= null, $order=null, $limit= null){
            return (new Database('vagas'))->select($where,$order,$limit)
                                          ->fetchAll(PDO::FETCH_CLASS,self::class);
    } 

        /** 
         * Responsável por buscar uma vaga com base em seu ID
         */
        public static function getVaga($id){
            return (new Database('vagas'))->select('id= ' . $id) 
                            ->fetchObject(self::class);
        }

}
