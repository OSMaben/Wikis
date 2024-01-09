<?php

namespace app\Models;

class WriterModel extends UserModel
{



    public function show($table,$columns){
        $columns = implode(",",$columns);//to generate a query
        $stml = $this->database->prepare("SELECT {$columns} FROM {$table}");
        $stml->execute();
        $result = $stml->fetchAll();
        return $result;
    }

    public function showArticles($table, $columns, $id)
    {
        $columns = implode(",",$columns);
        $stml = $this->database->prepare("SELECT {$columns} FROM {$table} WHERE ID_Articles = :id");
        $stml->bindParam(":id",  $id);
        $stml->execute();
        $row = $stml->fetch();
        return $row;
    }

    public function insert($table, $columns,$values)
    {
        $columns = implode(",",$columns);
        $values = implode("','",$values);
        $stml = $this->database->prepare("INSERT INTO {$table} ({$columns}) VALUES ('{$values}')");
        $stml->execute();
        return $stml;
    }

    public function delete($table, $column, $id)
    {
        $stml = $this->database->prepare("DELETE FROM {$table} WHERE ({$column}) = ('{$id}')");
        $stml->execute();
        return $stml;
    }

    public function update($table, $key, $value, $where) {
        $updateData = '';

        for($i = 0; $i < count($key); $i++)
        {
            $updateData .= "{$key[$i]} = '{$value[$i]}'";
            if($i < count($key) - 1)
            {
                $updateData .= ",";
            }
        }
        $stml = $this->database->prepare("UPDATE {$table} SET $updateData WHERE $where");
        $stml->execute();
        return $stml->rowCount();
    }
}