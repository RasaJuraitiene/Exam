<?php


namespace App\Feedbacks;

use App\App;
use App\Feedbacks\Feedback;

class Model
{
    private $table_name = 'feedback';

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
        $feedbacks = [];
        $rows = App::$db->getRowsWhere($this->table_name, $conditions);
        foreach ($rows as $row_id => $row_data) {
            $row_data['id'] = $row_id;
            $feedbacks[] = new Feedback($row_data);
        }

        return $feedbacks;
    }

    /**
     * @param Feedback $person
     * @return bool
     */
    public function update(Feedback $person)
    {
        return App::$db->updateRow($this->table_name, $person->getId(), $person->getData());
    }

    /**
     * deletes all feedback from database
     * @param Feedback $feedback
     * @return bool
     */
    public function delete(Feedback $feedback)
    {
        return App::$db->deleteRow($this->table_name, $feedback->getId());
    }

    public function __destruct()
    {
        App::$db->save();
    }

}