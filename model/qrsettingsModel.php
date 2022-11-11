<?php
    class qrsettingsModel
    {
        private $id;
        private $expiryHrs;
        private $qrStatus;


        public function getId()
        {
            return $this->id;   
        }

        public function setId($id)
        {
            $this->id = $id;
        }


        public function getExpiryHrs()
        {
            return $this->expiryHrs;   
        }

        public function setExpiryHrs($expiryHrs)
        {
            $this->expiryHrs = $expiryHrs;
        }


        public function getQrStatus()
        {
            return $this->qrStatus;   
        }

        public function setQrStatus($qrStatus)
        {
            $this->qrStatus = $qrStatus;
        }


    }

?>