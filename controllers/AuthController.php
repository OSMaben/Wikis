<?php

namespace app\controllers;
use app\controllers\UserController;
use app\Models\AuthModel;

class AuthController extends UserController
{

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (!empty($_POST['fullname']) && !empty($_POST['email'])) {
                $fullName = $_POST['fullname'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                $fullName = $this->validation($fullName);
                $email = $this->validation($email);

                $password = password_hash($password, PASSWORD_DEFAULT);
                $user = new AuthModel();
                $user->createAccount($fullName, $email, $password);
                $this->router->redirect("/login");
            } else {
                echo "<div class='container-fluid d-flex justify-content-center' >
                            <p class='h4 pb-2 mb-4 text-danger border-bottom border-danger' style=' position: relative; top: 13rem;'>Inputs Should Not Be Empty</p>
                       </div>";
                return $this->router->renderView("register");
            }
        }
    }

// Function to check if input is valid (you can customize this based on your validation rules)


    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if(!empty($_POST['email']) && !empty($_POST['password']))
            {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $email = $this->validation($email);
                $password = $this->validation($password);
                $user = new AuthModel();
                $res = $user->findAccount($email, $password);

                $_SESSION['role'] = $res['Role'];
                $_SESSION['idUser'] = $res['UserID'];

                if ($res['Role'] == "Admin") {
                    $this->router->redirect("admin");
                } elseif ($res['Role'] == "Author") {
                    $this->router->redirect("reservation");
                } elseif ($res['Role'] == "Reader") {
                    $this->router->redirect("/");
                }
                else
                {
                    $this->router->redirect("/login");
                }

            }else
            {
                echo "<p class='alert alert-danger'>There was an error</p>";
                return $this->router->renderView("login");
            }
        }
    }

    public function validation($data)
    {
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = addslashes($data);

        return $data;
    }

    public function destroy()
    {
        session_destroy();
        return $this->router->redirect('/');
    }
}