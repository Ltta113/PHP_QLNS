<?php
        class Entity_Admin{
        public $Id;
        public $username;
        public $password;
        public function __construct($Id,$username,$password)
        {
                $this->Id = $Id;
                $this->username = $username;
                $this->password = $password;
        }
        
        }
        
 ?>