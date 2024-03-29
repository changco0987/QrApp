<?php
    class guardianModel
    {
        private $id;
        private $username;
        private $password;
        private $firstname;
        private $lastname;
        private $address;
        private $contact_number;
        private $studentId;
        private $qr_ExDate;
        private $imageName;
        private $status;
        private $notification;
        private $gateStat;
        private $dtrId;
        private $otp;


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


        public function getAddress()
        {
            return $this->address;   
        }

        public function setAddress($address)
        {
            $this->address = $address;
        }


        public function getContact_number()
        {
            return $this->contact_number;   
        }

        public function setContact_number($contact_number)
        {
            $this->contact_number = $contact_number;
        }


        public function getStudentId()
        {
            return $this->studentId;   
        }

        public function setStudentId($studentId)
        {
            $this->studentId = $studentId;
        }


        public function getQr_ExDate()
        {
            return $this->qr_ExDate;   
        }

        public function setQr_ExDate($qr_ExDate)
        {
            $this->qr_ExDate = $qr_ExDate;
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


        public function getNotification()
        {
            return $this->notification;   
        }

        public function setNotification($notification)
        {
            if($notification==null || $notification==false || $notification==0)
            {
                $this->notification = 0;
            }
            else
            {
                $this->notification = $notification;
            }
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


        public function getOtp()
        {
            return $this->otp;   
        }

        public function setOtp($otp)
        {
            $this->otp = $otp;
        }

    }

?>