<?php

class LogoutController {

    public function execute() {
        session_destroy();
        header("Location: /GauchoRocket/");
        exit();
    }
}
