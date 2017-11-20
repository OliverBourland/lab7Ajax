<?php
class CategoryDB {
    public static function getCategories() {
        $db = Database::getDB();
        $query = 'SELECT * FROM categories
                  ORDER BY categoryID';
        $statement = $db->prepare($query);
        $statement->execute();
        
        $categories = array();
        foreach ($statement as $row) {
            $category = new Category($row['categoryID'],
                                     $row['categoryName']);
            $categories[] = $category;
        }
        return $categories;
    }

    public static function getCategory($category_id) {
        $db = Database::getDB();
        $query = 'SELECT * FROM categories
                  WHERE categoryID = :category_id';    
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();    
        $row = $statement->fetch();
        $statement->closeCursor();    
        $category = new Category($row['categoryID'],
                                 $row['categoryName']);
        return $category;
    }
	
	public static function deleteCategory($category_id) {
		$db = Database::getDB();
		$query = 'DELETE FROM categories
				  WHERE categoryID = :category_id';
		$statement = $db->prepare($query);
		$statement->bindValue(':category_id', $category_id);
		$success = $statement->execute();
		$rowCount = $statement->rowCount();
		$statement->closeCursor();
		if ($success === false || $rowCount != 1)
			throw new PDOException("Cannot delete category with id $category_id.");
	}

	public static function addCategory($name) {
	    $db = Database::getDB();
		$query = 'INSERT INTO categories
					 (categoryName)
				  VALUES
					 (:name)';
		$statement = $db->prepare($query);
		$statement->bindValue(':name', $name);
		$success = $statement->execute();
		$rowCount = $statement->rowCount();
		$statement->closeCursor();
		if ($success === false || $rowCount != 1)
			throw new PDOException("Cannot add category with name $name.");
	}
}
?>