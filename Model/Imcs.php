<?php

    namespace Model; // define o namespace como Model, que é onde a classe Imcs está localizada

    use PDO; // importa a classe PDO para manipulação de banco de dados
    use PDOException; // importa a classe PDOException para capturar erros de banco de dados
    use Model\Connection; // importa a classe Connection para estabelecer a conexão com o banco de dados

    class Imcs{

        private $db; //conexão com o banco de dados
        
        public function __construct() //metodo será executado toda vez que for criado um objeto da classe Imcs
        {
            $this->db = Connection::getInstance(); // chama o método getInstance da classe Connection para obter a conexão com o banco de dados e atribui à variável $db
        }

        public function createImc($weight, $height, $result){
            try{
                $sql = "INSERT INTO imcs (weight, height, result, created_at) VALUES (:weight, :height, :result, NOW())";

                $stmt = $this->db->prepare($sql); // prepara o banco de dados para receber o comando do sql pra receber o comando da linha 20

                $stmt->bindParam(":weight", $weight, PDO::PARAM_STR); // vincula o parâmetro :weight ao valor da variável $weight, com o tipo de dado string
                $stmt->bindParam(":height", $height, PDO::PARAM_STR); // vincula o parâmetro :height ao valor da variável $height, com o tipo de dado string
                $stmt->bindParam(":result", $result, PDO::PARAM_STR); // vincula o parâmetro :result ao valor da variável $result, com o tipo de dado string

                $stmt->execute(); // executa o comando sql

            }catch(PDOException $error){ // captura qualquer erro que ocorra durante a execução do comando sql
                echo "Erro ao criar IMC: " . $error->getMessage();
                return false; // retorna falso se ocorrer um erro
            }
    }   
}
?>