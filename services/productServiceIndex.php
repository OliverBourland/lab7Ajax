<?php
try
{
	require('../model/database.php');
	require('../model/category.php');
	require('../model/category_db.php');
	require('../model/product.php');
	require('../model/product_db.php');
	
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
        header('Access-Control-Allow-Headers: token, Content-Type');
        header('Access-Control-Max-Age: 1728000');
        header('Content-Length: 0');
        header('Content-Type: text/plain');
        die();
    }

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
    $action = filter_input(INPUT_POST, 'action');
	if ($action == NULL) {
		$action = filter_input(INPUT_GET, 'action');
		if ($action == NULL) {
			$action = 'getProducts';
		}
	}

	if ($action == 'getProductsByCategory') {
		$category_id = filter_input(INPUT_GET, 'category_id', 
				FILTER_VALIDATE_INT);
		if ($category_id == NULL || $category_id == FALSE) {
			$category_id = 1;
		}
		$products = ProductDB::getProductsByCategory($category_id);
		echo json_encode($products);
	}	
	
	else if ($action == 'deleteProduct') {
		$category_id = filter_input(INPUT_POST, 'category_id', 
				FILTER_VALIDATE_INT);
		if ($category_id == NULL || $category_id == FALSE) {
			$category_id = 1;
		}
		$product_id = filter_input(INPUT_POST, 'product_id', 
			FILTER_VALIDATE_INT);
		if ($product_id == NULL || $product_id == FALSE) {
			$error = "Missing or incorrect product id.";
		} else { 
			ProductDB::deleteProduct($product_id);
			$products = ProductDB::getProductsByCategory($category_id);
			echo json_encode($products);
		}
	}
	else {
		$error = "Invalid action";
	}
	
	if (isset($error)) {
		header('HTTP/1.1 500 Internal Server Booboo');
		$result = array();
		$result['status'] = 500;
		$result['message'] = $error;
		echo json_encode($result);
	}
		
}
catch (PDOException $e) {
	header('HTTP/1.1 500 Internal Server Booboo');
	$error = $e->getMessage();
	$result = array();
	$result['status'] = 500;
	$result['message'] = $error;
	echo json_encode($result);
}
?>