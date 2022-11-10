<?php
    class logsModel
    {
        private $id;
        private $activity;
        private $creator;
        private $ipAdd;
        private $accType;
        private $dateStamp;


        public function getId()
        {
            return $this->id;   
        }

        public function setId($id)
        {
            $this->id = $id;
        }


        public function getActivity()
        {
            return $this->activity;   
        }

        public function setActivity($activity)
        {
            $this->activity = $activity;
        }


        public function getCreator()
        {
            return $this->creator;   
        }

        public function setCreator($creator)
        {
            $this->creator = $creator;
        }
        
        public function getIpAdd()
        {
            return $this->ipAdd;   
        }

        public function setIpAdd()
        {
            $ip = '';

               //whether ip is from the share internet  
            if(!empty($_SERVER['HTTP_CLIENT_IP'])) 
            {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
            }  
            //whether ip is from the proxy  
            elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            {  
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
            }  
            //whether ip is from the remote address  
            else
            {  
                $ip = $_SERVER['REMOTE_ADDR'];  
            } 
            
            //$this->ipAdd = getHostByName(getHostName());
            $this->ipAdd = $ip;
        }

        public function getAccType()
        {
            return $this->accType;   
        }

        public function setAccType($accType)
        {
            $this->accType = $accType;
        }

        public function getDateStamp()
        {
            return $this->dateStamp;   
        }

        public function setDateStamp($dateStamp)
        {
            $this->dateStamp = $dateStamp;
        }

    }

?>