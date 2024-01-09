<?php

namespace app\Models;
use app\config\Database;
class UserModel
{
    protected Database $database;
    public function __construct()
    {
        $this->database = new Database();
    }

}