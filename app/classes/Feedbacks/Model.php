<?php


namespace App\Feedbacks;

use \App\App;
use App\Feedbacks\Feedback;

class Model
{

    private $table_name = 'feedbacks';

    public function __construct()
    {
        App::$db->createTable($this->table_name);
    }

    /**
     * Irašo $user i duombaze
     * @param Feedback $user
     * @return bool
     */
    public function insert(Feedback $user)
    {
        $row_id = App::$db->insertRow($this->table_name, $user->getData());
        $user->setId($row_id);

        return $user;
    }

    /**
     * @param array $conditions
     * @return array
     */
    public function get($conditions = [])
    {
        $reviews = [];
        $rows = App::$db->getRowsWhere($this->table_name, $conditions);
        foreach ($rows as $row_id => $row_data) {
            $row_data['id'] = $row_id;
            $reviews[] = new Feedback($row_data);
        }

        return $reviews;
    }

    /**
     * @param Feedback $user
     * @return bool
     */
    public function update(Feedback $user)
    {
        return App::$db->updateRow($this->table_name, $user->getId(), $user->getData());
    }

    /**
     * deletes all participants from database
     * @param Feedback $user
     * @return bool
     */
    public function delete(Feedback $user)
    {
        return App::$db->deleteRow($this->table_name, $user->getId());
    }

    public function __destruct()
    {
        App::$db->save();
    }
}