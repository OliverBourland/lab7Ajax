window.onload = setupPage;
var url = "../services/productServiceIndex.php";
var categoryid;
var newCategoryName;

function setupPage() {
	getCategories();
}

function getCategories(){		
	geturl = "../services/categoryServiceIndex.php" + "?action=getCategories";
	$.getJSON( geturl, createCategoryList);
}

function createCategoryList(categories) {
	$("ul#categoryList li").remove();
	$.each(categories, function(i, category) {
		$("ul#categoryList").append("<li>" +
		"<a class='getProducts' href='' id='" + category.id + "'>" + category.name + "</a></li>");
	});	
	$("a.getProducts").click( function(event){
    	event.preventDefault();
    	newCategoryName = this.innerHTML;
		geturl = url + "?action=getProductsByCategory&category_id=" + this.id;
		$.getJSON( geturl, createProductTable);
	});
	$("a.getProducts:first").trigger("click");
}

function getProductsByCategory(event) {
	geturl = url + "?action=getProductsByCategory&" + this.href;
	$.getJSON( geturl, createProductTable);
}

function createProductTable(products) {
	if (products.length > 0) {
		categoryid = products[0].category.id;
		$("h2#categoryName").text(products[0].category.name);
	
		$("tbody#productTable tr").remove();
		$.each(products, function(i, product) {
			$("tbody#productTable").append("<tr><td>" + product.code + "</td>" +
			"<td>" + product.name + "</td>" + 
			"<td class='right'>" + parseFloat(product.price).toFixed(2) + "</td>" + 
			"<td><button class='deleteProduct' id='" + product.id + "'>Delete</button></td>" + 
			"</tr>");
		});	
		$("button.deleteProduct").click(deleteProduct);
	}
	else
		toastr.info('There are no ' + newCategoryName + '!') 
}

function deleteProduct() {
	productid = this.id;
	deleteurl = url + "?action=deleteProduct";
	//$.post(deleteurl, {product_id: productid, category_id: categoryid}, createProductTable);
	$.post(deleteurl, {product_id: productid, category_id: categoryid})
		.done(createProductTable)
		.fail(displayError);
}

function displayError()
{
	toastr.error('Something has gone wrong!') 
}