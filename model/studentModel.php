<?php
    class studentModel
    {
        private $id;
        private $studentId;
        private $firstname;
        private $lastname;
        private $middlename;
        private $course;
        private $section;
        private $year;
        private $temperature;
        private $age;
        private $gender;
        private $address;
        private $contact_number;
        private $imageName;
        private $status;
        private $guardianName;
        private $guardianNum;
        private $gateStat;


        public function getId()
        {
            return $this->id;   
        }

        public function setId($id)
        {
            $this->id = $id;
        }


        public function getStudentId()
        {
            return $this->studentId;   
        }

        public function setStudentId($studentId)
        {
            $this->studentId = strtolower($studentId);
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

        public function getMiddlename()
        {
            return $this->middlename;   
        }

        public function setMiddlename($middlename)
        {
            $this->middlename = $middlename;
        }


        public function getCourse()
        {
            return $this->course;   
        }

        public function setCourse($course)
        {
            $this->course = strtolower($course);
        }


        public function getSection()
        {
            return $this->section;   
        }

        public function setSection($section)
        {
            $this->section = strtolower($section);
        }


        public function getYear()
        {
            return $this->year;   
        }

        public function setYear($year)
        {
            $this->year = strtolower($year);
        }


        public function getTemperature()
        {
            return $this->temperature;   
        }

        public function setTemperature($temperature)
        {
            $this->temperature = strtolower($temperature);
        }


        public function getAge()
        {
            return $this->age;   
        }

        public function setAge($age)
        {
            $this->age = $age;
        }


        public function getGender()
        {
            return $this->gender;   
        }

        public function setGender($gender)
        {
            $this->gender = strtolower($gender);
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


        public function getGuardianName()
        {
            return $this->guardianName;   
        }

        public function setGuardianName($guardianName)
        {
            $this->guardianName = $guardianName;
        }


        public function getGuardianNum()
        {
            return $this->guardianNum;   
        }

        public function setGuardianNum($guardianNum)
        {
            $this->guardianNum = $guardianNum;
        }


        public function getGateStat()
        {
            return $this->gateStat;   
        }

        public function setGateStat($gateStat)
        {
            if($gateStat==null || $gateStat=='out')
            {
                $this->gateStat = 'in';
            }
            else
            {
                $this->gateStat = 'out';
            }
        }

    }

?>