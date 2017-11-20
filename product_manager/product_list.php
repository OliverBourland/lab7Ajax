<?php include '../view/header.php'; ?>
<main>
    <h1>Product List</h1>
    <aside>
        <!-- display a list of categories -->
        <h2>Categories</h2>
        <nav>
        <ul id="categoryList">

        </ul>
        </nav>
    </aside>
    <section>
        <!-- display a table of products -->
        <h2 id="categoryName"></h2>
        <table>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th class="right">Price</th>
                <th>&nbsp;</th>
            </tr>
            <tbody id='productTable'>
            
			</tbody>
        </table>
        <p><a href="?action=show_add_form">Add Product</a></p>        
		<p class="last_paragraph"><a href="?action=list_categories">List Categories</a></p>
    </section>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.3/toastr.min.js"></script>
<script src="scripts/productList.js"></script>
<?php include '../view/footer.php'; ?>