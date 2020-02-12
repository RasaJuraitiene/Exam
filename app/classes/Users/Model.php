<?php

namespace App\Users;

use \App\App;


class Model
{

    private $table_name = 'users';

    public function __construct()
    {
        App::$db->createTable($this->table_name);
    }


    public function insert(User $user)
    {
        return App::$db->insertRow($this->table_name, $user->getData());
    }


    public function get($conditions = [])
    {
        $users = [];

        $rows = App::$db->getRowsWhere($this->table_name, $conditions);
        foreach ($rows as $row_id => $row) {
            $row['id'] = $row_id;
            $users[] = new User($row);
        }

        return $users;
    }

    public function getById($row_id)
    {
        $user_array = App::$db->getRow($this->table_name, $row_id);

        if ($user_array) {
            $user = new \App\Users\User($user_array);
            $user->setId($row_id);

            return $user;
        }
        return null;
    }


    public function update(User $user)
    {
        return App::$db->updateRow($this->table_name, $user->getId(), $user->getData());
    }


    public function delete(User $user)
    {
        App::$db->deleteRow($this->table_name, $user->getId());
    }

    public function deleteAll()
    {
        App::$db->truncateTable($this->table_name);
    }

    public function __destruct()
    {
        App::$db->save();
    }
}