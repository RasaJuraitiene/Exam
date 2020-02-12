<?php

namespace Core;

class FileDB  {

    private $file_name;

    /** @var array $data */
    private $data;

    public function __construct($file_name) {
        $this->file_name = $file_name;
    }

    /**
     * Loads all data from file to $data
     */
    public function load() {
        if (file_exists($this->file_name)) {
            $encoded_string = file_get_contents($this->file_name);

            if ($encoded_string !== false) {
                $this->data = json_decode($encoded_string, true);
            }
        }
    }

    /**
     * Saves all data to file
     * @return boolean
     */
    public function save() {
        $string = json_encode($this->data);
        return file_put_contents($this->file_name, $string);
    }

    /**
     * Gets all database data as array
     * @return type
     */
    public function getData() {
        if ($this->data == null) {
            $this->load();
        }

        return $this->data;
    }

    /**
     * Sets all data from an array
     * @param type $data
     */
    public function setData(array $data) {
        $this->data = $data;
    }

    /**
     * Checks if table exists
     * @param string $table_name
     * @return boolean
     */
    public function tableExists($table_name) {
        if (isset($this->data[$table_name])) {
            return true;
        }

        return false;
    }

    /**
     * Creates a table
     * @param string $table_name
     * @return boolean
     */
    public function createTable($table_name) {
        if (!$this->tableExists($table_name)) {
            $this->data[$table_name] = [];
            return true;
        }

        return false;
    }

    /**
     * Deletes table from database
     * @param string $table_name
     * @return boolean
     */
    public function dropTable($table_name) {
        unset($this->data[$table_name]);

        return true;
    }

    /**
     * Deletes all table content
     * @param string $table_name
     * @return boolean
     */
    public function truncateTable($table_name) {
        if ($this->tableExists($table_name)) {
            $this->data[$table_name] = [];
            return true;
        }

        return false;
    }

    /**
     * Inserts row to table
     * @param string $table
     * @param array $row
     * @param string|integer $row_id
     * @return boolean
     */
    public function insertRow($table, $row, $row_id = null) {
        if ($this->tableExists($table)) {
            if ($row_id) {
                $this->data[$table][$row_id] = $row;
            } else {
                $this->data[$table][] = $row;
            }

            return key(array_slice($this->data[$table], -1, 1, true));
        }

        return false;
    }

    /**
     * Checks if row exists in table
     * @param string $table
     * @param mixed $row_id
     * @return boolean
     */
    public function rowExists($table, $row_id) {
        if (isset($this->data[$table][$row_id])) {
            return true;
        }

        return false;
    }

    /**
     * Updates row content in a given row_id
     * @param string $table
     * @param string|number $row_id
     * @param array $row
     * @return boolean
     */
    public function updateRow($table, $row_id, $row) {
        if ($this->rowExists($table, $row_id)) {
            $this->data[$table][$row_id] = $row;
            return true;
        }

        return false;
    }

    /**
     * Creates a row if it doesn't exist in table
     * @param string $table
     * @param string|integer $row_id
     * @param array $row
     * @return boolean
     */
    public function rowInsertIfNotExists($table, $row_id, $row) {
        if (!$this->rowExists($table, $row_id)) {
            return $this->insertRow($table, $row, $row_id); // insertRow function returns boolean
        }

        return false;
    }

    /**
     * Deletes row from table
     * @param string $table
     * @param string|number $row_id
     * @return boolean
     */
    public function deleteRow($table, $row_id) {
        if ($this->rowExists($table, $row_id)) {
            unset($this->data[$table][$row_id]);
            return true;
        }

        return false;
    }

    /**
     * Gets content from row
     * @param string $table
     * @param string|number $row_id
     * @return boolean
     */
    public function getRow($table, $row_id) {
        if ($this->rowExists($table, $row_id)) {
            return $this->data[$table][$row_id];
        }

        return false;
    }

    /**
     * Gets content from row where conditions exist
     * @param string $table
     * @param array $conditions
     * @return array
     */
    public function getRowsWhere($table, $conditions) {
        $rows = [];
        foreach ($this->data[$table] as $row_id => $row) {
            $condition_met = true;
            foreach ($conditions as $condition_id => $condition) {
                if ($condition_id === 'row_id') {
                    if ($row_id != $condition) {
                        $condition_met = false;
                        break;
                    }
                } else if ($row[$condition_id] !== $condition) {
                    $condition_met = false;
                    break;
                }
            }

            if ($condition_met) {
                $rows[$row_id] = $row;
            }
        }
        return $rows;
    }

    public
            function __destruct() {
        $this->save();
    }

}
