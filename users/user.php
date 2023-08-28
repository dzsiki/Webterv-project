<?php

abstract class UserType {
    const Normal = 0;
    const Admin = 1;

    public static function toString(int $t)
    {
        switch ($t)
        {
            case UserType::Normal: return "Normális";
            case UserType::Admin: return "Adminisztrátor";
            default: return "";
        }
    }
}

class User {
    private $name;
    private $email;
    private $pass;
    private $imgPath;
    private $type;

    public function __construct(string $name, string $email, string $pass, string $imgPath, int $type=UserType::Normal) {
        $this->name = $name;
        $this->email = $email;
        $this->pass = $pass;
        $this->imgPath = $imgPath;
        $this->type = $type;
    }

    public function getName() : string {
        return $this->name;
    }

    public function getEmail() : string {
        return $this->email;
    }

    public function getPass() : string {
        return $this->pass;
    }

    public function setPass(string $pass) {
        $this->pass = $pass;
    }

    public function getImgPath() : string {
        return $this->imgPath;
    }

    public function setImgPath(string $path) {
        $this->imgPath = $path;
    }

    public function getType() : int {
        return $this->type;
    }

    public function setType(int $type) {
        $this->type = $type;
    }
}
?>