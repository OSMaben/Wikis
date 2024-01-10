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


    public function insertWiki($category, $tagsString, $title, $content, $userid)
    {

        $sql = "INSERT INTO wikis (CategoryID, Title, Content, UserID , archieve) VALUES (:category, :title, :content,:userid, false)";
        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(':category', $category, \PDO::PARAM_INT);
        $stmt->bindParam(':title', $title, \PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, \PDO::PARAM_STR);
        $stmt->bindParam(':userid', $userid, \PDO::PARAM_INT);

        $stmt->execute();

        $lastWikiID = $this->database->getLastInsertId();

        // Insert data into the articletags table
        $tagsArray = explode(',', rtrim($tagsString, ','));
        foreach ($tagsArray as $tagName) {
            // Fetch the tagID based on the tag name (you need to implement this query)
            $tagID = $this->getTagIDByName($tagName);

            if ($tagID !== false) {
                $tagSql = "INSERT INTO articletags (wikisID, TagID) VALUES (:wikisID, :tagID)";
                $tagStmt = $this->database->prepare($tagSql);
                $tagStmt->bindParam(':wikisID', $lastWikiID, \PDO::PARAM_INT);
                $tagStmt->bindParam(':tagID', $tagID, \PDO::PARAM_INT);
                $tagStmt->execute();
            }
        }
    }


    private function getTagIDByName($tagName)
    {
        $sql = "SELECT TagID FROM tags WHERE TagName = :tagName";
        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(':tagName', $tagName, \PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result ? $result['TagID'] : false;
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