<?php
    namespace Controller;

    use Model\User;
    use Exception;

    class UserController {

        private $userModel;
        public function __construct() {
            $this->userModel = new User();
        }

        //RESGISTRO DE USUÁRIO
        public function registerUser($user_fullname, $email, $password){
            try {
                if (empty($user_fullname) or ($email) or ($password)){
                    return false;
                }

                $hashPassword = password_hash($password, PASSWORD_DEFAULT);

                return $this->userModel->registerUser($user_fullname, $email, $hashPassword); // Chama o método registerUser da classe User para registrar o usuário no banco de dados

            } catch(Exception $error) {
                echo "Erro ao cadastrar o usuário: " . $error->getMessage();
                return false; // retorna falso se ocorrer um erro
            }
        }

        //LOGIN DE USUÁRIO
        public function login($email, $password){
            $user = $this->userModel->getUserByEmail($email); 

            if($user){
                if(crypt($password, $user['password'])){
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['user_fullname'] = $user['user_fullname'];
                    $_SESSION['email'] = $user['email'];

                    return true; 
                } else {
                    return false;
                }
            } return false; 
            }
        //USUÁRIO LOGADO?

        //RESGATAR DADOS DO USUÁRIO
    }
?>