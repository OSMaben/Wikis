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

    public function showWiki($table,$columns, $id){
        $columns = implode(",",$columns);//to generate a query
        $stml = $this->database->prepare("SELECT {$columns} FROM {$table} WHERE UserID = $id");
        $stml->execute();
        $result = $stml->fetchAll();
        return $result;
    }

    public function updateSingWiki($table, $columns, $id) {
        $columns = implode(",", $columns);
        $stml = $this->database->prepare("SELECT {$columns} FROM {$table} WHERE wikisID = :id");
        $stml->bindParam(':id', $id, \PDO::PARAM_INT);
        $stml->execute();
        $result = $stml->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }


    public function insert($table, $columns,$values)
    {

        $stml = $this->database->prepare("INSERT INTO {$table} ({$columns}) VALUES ('{$values}')");
        $stml->execute();
        return $stml;
    }


    public function insertWiki($category, $tagsString, $title, $content, $image ,$userid)
    {
        $sql = "INSERT INTO wikis (CategoryID, Title, Content, image, UserID, archieve) VALUES (:category, :title, :content, :image, :userid, false)";

        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(':category', $category, \PDO::PARAM_INT);
        $stmt->bindParam(':title', $title, \PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, \PDO::PARAM_STR);
        $stmt->bindParam(':image', $image, \PDO::PARAM_STR);
        $stmt->bindParam(':userid', $userid, \PDO::PARAM_INT);

        $stmt->execute();

        $lastWikiID = $this->database->getLastInsertId();

        // Insert data into the articletags table
        $tagsArray = explode(',', rtrim($tagsString, ','));
        foreach ($tagsArray as $tagName) {
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




    public function UpdateSingWikiWrite($title, $content, $image ,$id)
    {
        $sql = "UPDATE `wikis` SET `Title`=:title,`Content`=:content, `image`= :image WHERE wikisID = :id";

        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(':title', $title, \PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, \PDO::PARAM_STR);
        $stmt->bindParam(':image', $image, \PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

        return $stmt->execute();
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

    public function update($table, $value, $where) {

        $sql = "UPDATE {$table} SET TagName = '$value' WHERE TagID = $where";

        $stmt = $this->database->prepare($sql);

        $stmt->execute();
        return $stmt->rowCount();
    }


    public function showWikisModel()
    {
        $sql = "SELECT
                w.wikisID,
                w.Title,
                w.Content,
                w.image,
                w.PublishedDate,
                w.archieve,
                c.CategoryName,
                GROUP_CONCAT(t.TagName) AS Tags
            FROM
                wikis w
            JOIN categories c ON w.CategoryID = c.CategoryID
            LEFT JOIN articletags at ON w.wikisID = at.wikisID
            LEFT JOIN tags t ON at.TagID = t.TagID
            WHERE 
            	archieve = 0
            GROUP BY
                w.wikisID
            ORDER BY
                w.PublishedDate DESC 
            limit 6
                ";

        $stmt = $this->database->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }



    public function showSignlWiki($id)
    {
        $sql = "SELECT
                w.wikisID,
                w.Title,
                w.Content,
                w.image,
                w.PublishedDate,
                w.archieve,
                c.CategoryName,
                GROUP_CONCAT(t.TagName) AS Tags
            FROM
                wikis w
            JOIN categories c ON w.CategoryID = c.CategoryID
            LEFT JOIN articletags at ON w.wikisID = at.wikisID
            LEFT JOIN tags t ON at.TagID = t.TagID
            WHERE 
                w.WikisID = $id
                ";

        $stmt = $this->database->prepare($sql)  ;
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }


    public function UpdateWiki()
    {

    }



    public function getCategry($id)
    {
        $sql = "SELECT
               c.CategoryName,
               GROUP_CONCAT(t.TagName) AS Tags
            FROM
               wikis w
            JOIN categories c ON w.CategoryID = c.CategoryID
            LEFT JOIN articletags at ON w.wikisID = at.wikisID
            LEFT JOIN tags t ON at.TagID = t.TagID
            WHERE 
                   w.WikisID = $id";
        $stmt = $this->database->prepare($sql)  ;
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function Analytics($table)
    {
        $sql = "SELECT COUNT(*) AS Tags FROM {$table}";
        $stmt = $this->database->prepare($sql)  ;
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function deleteIt($table, $id)
    {
        $this->DeleteWikiTag($id);
        $sql = "DELETE FROM {$table} WHERE wikisID = $id";
        $stmt = $this->database->prepare($sql)  ;
        return $stmt->execute();
    }

    private function DeleteWikiTag($id)
    {
        $sql = "DELETE FROM articletags WHERE wikisID = $id";
        $stmt = $this->database->prepare($sql)  ;
        $stmt->execute();
    }

    public function archive($id)
    {
        $sql = "UPDATE `wikis` SET `archieve`= 1 WHERE wikisID =  $id";
        $stmt = $this->database->prepare($sql)  ;
        $stmt->execute();
    }

    public function deleteTagAndCateggory($table1,$table2, $id, $condition)
    {

        $sql = "SELECT COUNT(*) FROM {$table1} WHERE $condition = :id";
        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $count = $stmt->fetchColumn();


        if($count > 0)
        {
            $sql = "DELETE FROM {$table1} WHERE $condition = :id";
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }

        $sql = "DELETE FROM {$table2} WHERE $condition = :id";
        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function updateCategory($table, $value, $where) {


        $sql = "UPDATE {$table} SET CategoryName = '$value' WHERE CategoryID = $where";

        $stmt = $this->database->prepare($sql);

        $stmt->execute();
        return $stmt->rowCount();
    }

    public function UpdateSingleCategry()
    {
        $sql = "SELECT * FROM categories";
        $stmt = $this->database->prepare($sql)  ;
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }


    public function UpdateSingleTag()
    {
        $sql = "SELECT * FROM tags";
        $stmt = $this->database->prepare($sql)  ;
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function searchWiki($searchInput)
    {

            $sql = "SELECT * FROM wikis WHERE Title LIKE :searchInput";
            $stmt = $this->database->prepare($sql);
            $str = "%$searchInput%";
            $stmt->bindParam(':searchInput', $str, \PDO::PARAM_STR);
            $stmt->execute();

            $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $results;
    }

}