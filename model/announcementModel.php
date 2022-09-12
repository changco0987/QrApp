<?php
    class announcementModel
    {
        private $id;
        private $heading;
        private $content;
        private $imageName;
        private $isShow;
        private $type;
        private $date;


        public function getId()
        {
            return $this->id;   
        }

        public function setId($id)
        {
            $this->id = $id;
        }


        public function getHeading()
        {
            return $this->heading;   
        }

        public function setHeading($heading)
        {
            $this->heading = $heading;
        }


        public function getContent()
        {
            return $this->content;   
        }

        public function setContent($content)
        {
            $this->content = $content;
        }


        public function getImageName()
        {
            return $this->imageName;   
        }

        public function setImageName($imageName)
        {
            $this->imageName = $imageName;
        }


        public function getIsShow()
        {
            return $this->isShow;   
        }

        public function setIsShow($isShow)
        {
            if($isShow==null || $isShow==false || $isShow==0)
            {
                $this->isShow = false;
            }
            else
            {
                $this->isShow = $isShow;
            }
        }


        public function getType()
        {
            return $this->type;   
        }

        public function setType($type)
        {
            $this->type = $type;
        }


        public function getDate()
        {
            return $this->date;   
        }

        public function setDate($date)
        {
            $this->date = $date;
        }
    }

?>