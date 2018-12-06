<?php
    class Database {
        private $host = "localhost";
        private $user = "root";
        private $password = "";
        private $database = "webshop";
        protected $connected = false;

        public function __construct(){
            $this->connect();
        }

        protected function connect(){
            if(!$this->connected){
                $this->connected = mysqli_connect($this->host, $this->user, $this->password, $this->database);

                if(!$this->connected){
                    echo 'Kan niet verbinden';
                    die();
                }
            }

            return $this->connected;
        }

        protected function disconnect(){
            if($this->connected){
                mysqli_close($this->connected);
            }
        }
    }
?>