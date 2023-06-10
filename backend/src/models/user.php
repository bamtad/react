
<?php 
class User{
    private $fname;
    private $lname;
    private $phone;
    private $email;
    private $profile_pic;
    private $bg_pic;
    private $address;
    private $userType;

    function __construct($fname,$email){
        $this->fname=$fname;
        $this->email=$email;
    }



}