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
                if (empty($user_fullname) or empty($email) or empty($password)){
                    return false;
                }

                //$hashPassword = password_hash($password, PASSWORD_DEFAULT);

                return $this->userModel->registerUser($user_fullname, $email, $password); // Chama o método registerUser da classe User para registrar o usuário no banco de dados

            } catch(Exception $error) {
                echo "Erro ao cadastrar o usuário: " . $error->getMessage();
                return false; // retorna falso se ocorrer um erro
            }
        }

        //EMAIL JÁ CADASTRADO?
        public function checkUserByEmail($email) {
            return $this->userModel->getUserByEmail($email); // Chama o método getUserByEmail da classe User para verificar se o email já está cadastrado
        }

        //LOGIN DE USUÁRIO
        public function login($email, $password){
            $user = $this->userModel->getUserByEmail($email);
            /**
             * $user = [
             * "id" : 1,
             * "user_fullname" : "Teste",
             * "email" : "example@teste.com",
             * "password" : "$2y$10$eImiTMZG4qj8/6z5a1b1uO3Q0Z5f5F5F5F5F5F5F5F5F5F5F5F5F5"
             * ]
             *  */ 
            
            if($user && password_verify($password, $user['password'])){
                $_SESSION['id'] = $user['id'];
                $_SESSION['user_fullname'] = $user['user_fullname'];
                $_SESSION['email'] = $user['email'];

                return true;
            }return false;


        //USUÁRIO LOGADO?

        //RESGATAR DADOS DO USUÁRIO
    }
        //USUÁRIO LOGADO?
        public function isLoggedIn(){
            return isset($_SESSION['id']);
        }

        //RESGATAR DADOS DO USUÁRIO
        public function getUserData($id, $user_fullname, $email){

            return $this->userModel->getUserInfo($id, $user_fullname, $email); // Chama o método getUserInfo da classe User para obter os dados do usuário logado
        }
}
?>