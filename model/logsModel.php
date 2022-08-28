<?php
    class logsModel
    {
        private $id;
        private $activity;
        private $creator;
        private $ipAdd;
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

        public function setIpAdd($ipAdd)
        {
            $this->ipAdd = $ipAdd;
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