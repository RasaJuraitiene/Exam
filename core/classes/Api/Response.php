<?php

namespace Core\Api;

class Response {

    private $data;
    private $errors;

    public function __construct($data = []) {
        if ($data) {
            $this->setData($data['data'] ?? []);
            $this->setErrors($data['errors'] ?? []);
        }
    }

    public function print() {
        $is_success = $this->errors ? false : true;
        
        print json_encode([
            'status' => $is_success ? 'success' : 'fail',
            'data' => $this->data,
            'errors' => $this->errors
        ]);
        exit;
    }

    public function setData($data) {
        $this->data = $data;
    }
    
    public function addData($body, $index = null) {
        if ($index) {
            $this->data[$index] = $body;
        } else {
            $this->data[] = $body;
        }
    }
    
    public function setErrors($errors) {
        $this->errors = $errors;
    }
    
    public function addError($body, $index = null) {
        if ($index) {
            $this->errors[$index] = $body;
        } else {
            $this->errors[] = $body;
        }        
    }

}
