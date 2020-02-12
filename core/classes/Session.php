<?php

namespace Core;

class Session {

    private $model;
    private $user;

    public function __construct() {
        session_start();
        $this->model = new \App\Users\Model();

        // Execute login from cookie
        $this->loginFromCookie();
    }

    public function loginFromCookie() {
        if ($_SESSION ?? false) {
            $this->login($_SESSION['email'], $_SESSION['password']);
        }
    }

    public function login($email, $password) {
        $users = $this->model->get([
            'email' => $email,
            'password' => $password
        ]);
        
        if ($users) {
            $this->user = $users[0];

            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;

            return true;
        } else {
            $this->user = null;
        }

        return false;
    }

    public function getUser() {
        return $this->user;
    }

    public function userLoggedIn() {
        return $this->user ? true : false;
    }

    public function logout() {
        if (session_status() == PHP_SESSION_ACTIVE) {
            // Clear the superglobal
            $_SESSION = [];

            // Remove server-side cookie file
            session_destroy();

            // Remove client-side cookie
            setcookie(session_name(), null, -1, "/");
        }
    }

}
