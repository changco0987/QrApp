<?php
    class adminModel
    {
        private $id;
        private $username;
        private $password;
        private $loginCount;
        private $activeLogin;
        private $sessionExpiry;


        public function getId()
        {
            return $this->id;   
        }

        public function setId($id)
        {
            $this->id = $id;
        }


        public function getUsername()
        {
            return $this->username;   
        }

        public function setUsername($username)
        {
            $this->username = strtolower($username);
        }


        public function getPassword()
        {
            return $this->password;   
        }

        public function setPassword($password)
        {
            $this->password = strtoupper(hash('sha256',$password));
        }


        public function getLoginCount()
        {
            return $this->loginCount;   
        }

        public function setLoginCount($loginCount)
        {
            $this->loginCount = $loginCount;
        }


        public function getActiveLogin()
        {
            return $this->activeLogin;   
        }

        public function setActiveLogin($activeLogin)
        {
            $this->activeLogin = $activeLogin;
        }


        public function getSessionExpiry()
        {
            return $this->sessionExpiry;   
        }

        public function setSessionExpiry($sessionExpiry)
        {
            $this->sessionExpiry = $sessionExpiry;
        }

    }

?>