<?php

namespace app\Models;

use app\Models\UserModel;

class AuthModel extends UserModel
{
    public function createAccount($fullName, $email,$password)
    {

        $sql = "INSERT INTO `users` (`UserName`,`Email`,`Password`, `RoleID`) VALUES ('$fullName', '$email', '$password', 3)";
        $conn = $this->database;

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

    }
//login
    public function findAccount($email,$password)
    {
        $sql = "SELECT * from users where Email = '{$email}'";
        $conn = $this->database;
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['Password'])) {
                return [
                    'UserID' => $user['UserID'],
                    'Role' => ($user['RoleID'] == 1) ? "Admin" : (($user['RoleID'] == 2) ? "Author" : "Reader")
                ];
            }else
                return false;
        }catch (\PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
    }
}