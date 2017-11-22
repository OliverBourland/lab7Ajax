window.onload = setupPage;
var url = "../services/categoryServiceIndex.php";
var categoryid;
var newCategoryName;

function setupPage() {
	getCategories();
	var addCategory = document.forms[0].elements.namedItem("addCategory");
	addCategory.onclick = createCategory;
}

function getCategories(){		
	geturl = "../services/categoryServiceIndex.php" + "?action=getCategories";
	$.getJSON( geturl, createCategoryTable);

}

function createCategoryTable(categories) {
	if (categories.length > 0) {	
		$("tbody#categoryTable tr").remove();
		$.each(categories, function(i, category) {
			$("tbody#categoryTable").append("<tr><td>" + category.name + "</td>" + 
			"<td><button class='deleteCategory' id='" + category.id + "'>Delete</button></td>" + 
			"</tr>");
		});	
		$("button.deleteCategory").click(deleteCategory);
	}
	else
		toastr.info('There are no categories!') 
}

// function createAddCategory() {
// 	$("form#addCategory").append("<label>Category Name:</label>" + "<input type='text' name='categoryname' />" +
// 	"<button href='?action=list_categories' class='addCategory'>Add</button>");
// 	$("button.addCategory").click(addCategory);
// }

function createCategory() {
	newCategoryName = document.forms[0].elements.namedItem("category_name").value;
	addurl = url + "?action=addCategory";
	$.post(addurl, {category_name: newCategoryName})
		.done(createCategoryTable)
		.fail(displayError);
}

function deleteCategory() {
	categoryid = this.id;
	deleteurl = url + "?action=deleteCategory";
	$.post(deleteurl, {category_id: categoryid})
		.done(createCategoryTable)
		.fail(displayError);
}

function displayError()
{
	toastr.error('Something has gone wrong!') 
}