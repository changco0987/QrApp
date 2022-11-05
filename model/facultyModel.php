<?php
    class facultyModel
    {
        private $id;
        private $firstname;
        private $lastname;
        private $contact_number;
        private $department;
        private $imageName;
        private $status;
        private $gateStat;
        private $dtrId;


        public function getId()
        {
            return $this->id;   
        }

        public function setId($id)
        {
            $this->id = $id;
        }

        
        public function getFirstname()
        {
            return $this->firstname;   
        }

        public function setFirstname($firstname)
        {
            $this->firstname = $firstname;
        }

        public function getLastname()
        {
            return $this->lastname;   
        }

        public function setLastname($lastname)
        {
            $this->lastname = $lastname;
        }
        

        public function getContact_number()
        {
            return $this->contact_number;   
        }

        public function setContact_number($contact_number)
        {
            $this->contact_number = $contact_number;
        }


        public function getDepartment()
        {
            return $this->department;   
        }

        public function setDepartment($department)
        {
            $this->department = $department;
        }


        public function getImageName()
        {
            return $this->imageName;   
        }

        public function setImageName($imageName)
        {
            $this->imageName = $imageName;
        }


        public function getStatus()
        {
            return $this->status;   
        }

        public function setStatus($status)
        {
            $this->status = $status;
        }


        public function getGateStat()
        {
            return $this->gateStat;   
        }

        public function setGateStat($gateStat)
        {
            $this->gateStat = $gateStat;   
        }


        public function getDtrId()
        {
            return $this->dtrId;   
        }

        public function setDtrId($dtrId)
        {
            $this->dtrId = $dtrId;
        }

    }

?>