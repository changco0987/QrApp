<?php
    class dtrModel
    {
        private $id;
        private $dataId;
        private $accType;
        private $time_in;
        private $time_out;


        public function getId()
        {
            return $this->id;   
        }

        public function setId($id)
        {
            $this->id = $id;
        }


        public function getDataId()
        {
            return $this->dataId;   
        }

        public function setDataId($dataId)
        {
            $this->dataId = $dataId;
        }


        public function getAccType()
        {
            return $this->accType;   
        }

        public function setAccType($accType)
        {
            $this->accType = $accType;
        }


        public function getTime_in()
        {
            return $this->time_in;   
        }

        public function setTime_in($time_in)
        {
            $this->time_in = $time_in;
        }


        public function getTime_out()
        {
            return $this->time_out;   
        }

        public function setTime_out($time_out)
        {
            $this->time_out = $time_out;
        }

    }

?>