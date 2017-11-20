<?php include '../view/header.php'; ?>
<main>

    <h1>Category List</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>&nbsp;</th>
        </tr>                         
            <tbody id='categoryTable'>
            
            </tbody>
    </table>

    <h2>Add Category</h2> 
    <form id='addCategory'>
            
            </form>
    
    <p><a href="index.php?action=list_products">List Products</a></p>

</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.3/toastr.min.js"></script>
<script src="scripts/categoryList.js"></script>
<?php include '../view/footer.php'; ?>