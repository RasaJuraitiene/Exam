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
     * Irašo $person i duombaze
     * @param Feedback $person
     * @return bool
     */
    public function insert(Feedback $person)
    {
        $row_id = App::$db->insertRow($this->table_name, $person->getData());
        $person->setId($row_id);

        return $person;
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
     * @param Feedback $person
     * @return bool
     */
    public function update(Feedback $person)
    {
        return App::$db->updateRow($this->table_name, $person->getId(), $person->getData());
    }

    /**
     * deletes all participants from database
     * @param Feedback $person
     * @return bool
     */
    public function delete(Feedback $person)
    {
        return App::$db->deleteRow($this->table_name, $person->getId());
    }

    public function __destruct()
    {
        App::$db->save();
    }
}