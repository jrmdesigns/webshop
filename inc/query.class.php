<?php
// error_reporting(E_ERROR | E_PARSE);
    class Query extends Database{
        private $amountRows;
        public function __construct(){
            $this->connect();
        }

        public function query($query){
            $connection = $this->connected;
            if(!$connection){
                echo "Query Class:  Kan niet verbinden met database";
                die();
            }

            $result = mysqli_query($connection, $query);
            if(!$result){
                echo "Query fout";
                die();
            } else{
                $this->amountRows = mysqli_num_rows($result);
                $fetch = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $return = $fetch;
            }

            $this->disconnect();
            return $return;
        }

        public function getAllQuery($query){
            $connection = $this->connected;
            if(!$connection){
                echo "Query Class: Kan niet verbinden met database";
                die();
            }

            $result = mysqli_query($connection, $query);
            if(!$result){
                echo "Query fout";
                die();
            } else{
                $this->amountRows = mysqli_num_rows($result);
                $return = array();

                while($data = mysqli_fetch_assoc($result)){
                    $return[] = $data;
                }
            }
            
            $this->disconnect();
            return $return;
        }

        public function getRows(){
            echo $this->amountRows;
        }


    }
?>