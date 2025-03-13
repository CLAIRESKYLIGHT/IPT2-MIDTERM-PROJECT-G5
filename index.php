<?php
session_start();
include('partials\header.php');
include('partials\sidebar.php');
include('database\database.php');
include('database\create.php');
include('database\update.php');
include('database\delete.php');

$status = '';
if (isset($_SESSION['status'])) {
    $status = $_SESSION['status'];
    unset($_SESSION['status']);
}
//FOR PAGENATION
// Set the number of records per page
$records_per_page = 10;

// Get the current page from the query parameter, default to 1 if not set
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the offset for the SQL query
$offset = ($current_page - 1) * $records_per_page;

// Modify the SQL query to fetch only the records for the current page
$sql = "SELECT * FROM tblproduct LIMIT $records_per_page OFFSET $offset";
$tblproduct = $conn->query($sql);

// Get the total number of records
$total_records_sql = "SELECT COUNT(*) AS total FROM tblproduct";
$total_records_result = $conn->query($total_records_sql);
$total_records = $total_records_result->fetch_assoc()['total'];

// Calculate the total number of pages
$total_pages = ceil($total_records / $records_per_page);
?>

<main id="main" class="main">
<!-- ALERT -->
<?php if ($status == "created"): ?>
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center p-3 shadow-sm rounded" role="alert" style="border-left: 5px solid #28a745;">
    <i class="bi bi-check-circle-fill me-2 text-success fs-4"></i>
    <strong>Product added successfully!</strong>
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

<?php elseif ($status == "updated"): ?>
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center p-3 shadow-sm rounded" role="alert" style="border-left: 5px solid #28a745;">
    <i class="bi bi-pencil-square me-2 text-success fs-4"></i>
    <strong>Product updated successfully!</strong>
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

<?php elseif ($status == "error"): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>There was an error adding the product!</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php elseif ($status == "deleted"): ?>
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center p-3 shadow-sm rounded" 
     role="alert" style="border-left: 5px solid #dc3545;">
    <i class="bi bi-trash3-fill me-2 text-danger fs-4"></i>
    <strong>Product deleted successfully!</strong>
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

<?php endif; ?>
<!-- END ALERT -->

<!-- PAGE TITLE -->
<div class="pagetitle">
  <h1>Product Management System</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item">Tables</li>
      <li class="breadcrumb-item active">General</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <div>
              <h5 class="card-title">PRODUCTS</h5>
            </div>
            <div>
              <button class="btn btn-primary btn-sm mt-4 mx-3" data-bs-toggle="modal" data-bs-target="#addProduct">Add Product</button>
            </div>
          </div>

          <!-- Default Table -->
          <table class="table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Product</th>
                <th scope="col">Category</th>
                <th scope="col">Price</th>
                <th scope="col">Stock</th>
                <th scope="col" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($tblproduct->num_rows > 0): ?>
                <?php while ($row = $tblproduct->fetch_assoc()): ?>
                  <tr>
                    <th scope="row"><?php echo $row['id']; ?></th>
                    <td><?php echo $row['product_name']; ?></td>
                    <td><?php echo $row['category']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['stock_quantity']; ?></td>
                    <td class="d-flex justify-content-center">
<!-- Edit Button -->
<button class="btn btn-success btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#editInfo<?php echo $row['id']; ?>">Update</button>

<!-- Edit Modal -->
<style>
    /* Modal Background */
    #editInfo<?php echo $row['id']; ?> .modal-content {
        background: #f8f9fa;
        border-radius: 12px;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
    }

    /* Header Styling */
    #editInfo<?php echo $row['id']; ?> .modal-header {
        background-color: #007bff;
        color: white;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    /* Close Button */
    #editInfo<?php echo $row['id']; ?> .btn-close {
        filter: invert(1);
    }

    /* Form Labels */
    #editInfo<?php echo $row['id']; ?> .form-label {
        font-weight: bold;
        color: #343a40;
    }

    /* Input Fields */
    #editInfo<?php echo $row['id']; ?> .form-control {
        border-radius: 8px;
    }

    /* Select Dropdown */
    #editInfo<?php echo $row['id']; ?> .form-select {
        border-radius: 8px;
    }

    /* Submit Button */
    #editInfo<?php echo $row['id']; ?> .btn-primary {
        width: 100%;
        background: #007bff;
        border: none;
        transition: 0.3s;
        font-weight: bold;
    }

    #editInfo<?php echo $row['id']; ?> .btn-primary:hover {
        background: #0056b3;
    }
</style>
                      
<div class="modal fade" id="editInfo<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="editInfoLabel" aria-hidden="true">
        
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title">Edit Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                <form action="database/update.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<!-- Product Name -->
        <div class="mb-3">
          <label class="form-label">Product Name</label>
              <input type="text" class="form-control" name="product_name" value="<?php echo $row['product_name']; ?>" required>
                </div>

<!-- Category -->
  <div class="mb-3">
    <label class="form-label">Category</label>
      <select class="form-select" name="category" required>
          <option value="Electronics" <?php if ($row['category'] == 'Electronics') echo 'selected'; ?>>Electronics</option>
          <option value="Food" <?php if ($row['category'] == 'Food') echo 'selected'; ?>>Food</option>
          <option value="Home" <?php if ($row['category'] == 'Home') echo 'selected'; ?>>Home</option>
          <option value="Hygiene" <?php if ($row['category'] == 'Hygiene') echo 'selected'; ?>>Hygiene</option>
      </select>
  </div>

<!-- Price -->
    <div class="mb-3">
        <label class="form-label">Price</label>
        <input type="number" class="form-control" name="price" value="<?php echo $row['price']; ?>" required>
    </div>

<!-- Stock Quantity -->
     <div class="mb-3">
      <label class="form-label">Stock Quantity</label>
      <input type="number" class="form-control" name="stock_quantity" value="<?php echo $row['stock_quantity']; ?>" required>
      </div>

      <button type="submit" class="btn btn-primary">Update Product</button>
      </form>
      </div>
      </div>
      </div>
      </div>


<!-- View Button -->
<button class="btn btn-primary btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#viewInfo<?php echo $row['id']; ?>">View</button>

  <!-- View Modal -->
  <style>
    /* Modal Background */
    #viewInfo<?php echo $row['id']; ?> .modal-content {
        background: #f8f9fa;
        border-radius: 12px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    }

    /* Header Styling */
    #viewInfo<?php echo $row['id']; ?> .modal-header {
        background-color: #28a745;
        color: white;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    /* Close Button */
    #viewInfo<?php echo $row['id']; ?> .btn-close {
        filter: invert(1);
    }

    /* Modal Body */
    #viewInfo<?php echo $row['id']; ?> .modal-body {
        padding: 20px;
        font-size: 16px;
    }

    /* Product Details Styling */
    #viewInfo<?php echo $row['id']; ?> .modal-body p {
        background: #ffffff;
        padding: 10px;
        border-radius: 8px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 10px;
    }

    #viewInfo<?php echo $row['id']; ?> strong {
        color: #333;
    }
</style>

<div class="modal fade" id="viewInfo<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="viewInfoLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Product Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p><strong>Name:</strong> <?php echo $row['product_name']; ?></p>
            <p><strong>Category:</strong> <?php echo $row['category']; ?></p>
            <p><strong>Price:</strong> <?php echo $row['price']; ?></p>
            <p><strong>Stock:</strong> <?php echo $row['stock_quantity']; ?></p>
        </div>
      </div>
    </div>
</div>

<!-- Delete Button -->
<button class="btn btn-danger btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#deleteInfo<?php echo $row['id']; ?>">Delete</button>

<!-- Delete Modal -->
<style>
    /* Modal Background */
    #deleteInfo<?php echo $row['id']; ?> .modal-content {
        background: #fff3f3;
        border-radius: 12px;
        box-shadow: 0px 4px 12px rgba(255, 0, 0, 0.3);
        border: 2px solid #dc3545;
    }

    /* Header Styling */
    #deleteInfo<?php echo $row['id']; ?> .modal-header {
        background-color: #dc3545;
        color: white;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    /* Close Button */
    #deleteInfo<?php echo $row['id']; ?> .btn-close {
        filter: invert(1);
    }

    /* Modal Body */
    #deleteInfo<?php echo $row['id']; ?> .modal-body {
        font-size: 18px;
        text-align: center;
        font-weight: bold;
        color: #a30000;
    }

    /* Strong Text */
    #deleteInfo<?php echo $row['id']; ?> strong {
        color: #721c24;
    }

    /* Footer Buttons */
    #deleteInfo<?php echo $row['id']; ?> .modal-footer {
        display: flex;
        justify-content: center;
    }

    /* Delete Button */
    #deleteInfo<?php echo $row['id']; ?> .btn-danger {
        background: #c82333;
        border-color: #bd2130;
        transition: 0.3s;
    }

    #deleteInfo<?php echo $row['id']; ?> .btn-danger:hover {
        background: #a71d2a;
        border-color: #921224;
    }

    /* Cancel Button */
    #deleteInfo<?php echo $row['id']; ?> .btn-secondary {
        background: #6c757d;
        transition: 0.3s;
    }

    #deleteInfo<?php echo $row['id']; ?> .btn-secondary:hover {
        background: #5a6268;
    }
</style>

  <div class="modal fade" id="deleteInfo<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="deleteInfoLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
          <div class="modal-body">Are you sure you want to delete <strong><?php echo $row['product_name']; ?></strong>?</div>
      <div class="modal-footer">
          <form action="database/delete.php" method="GET">
          <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
          <button type="submit" class="btn btn-danger">Yes, Delete</button>
          </form>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
  </div>
  </td>
  </tr>
  <?php endwhile; ?>
  <?php endif; ?>
  </tbody>
  </table>

<!-- ADDING PRODUCT Modal  -->
<style>
    /* Modal Background */
    #addProduct .modal-content {
        background: linear-gradient(135deg, #ffffff, #f8f9fa);
        border-radius: 12px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    }

    /* Header Styling */
    #addProduct .modal-header {
        background-color: #007bff;
        color: white;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    /* Close Button */
    #addProduct .btn-close {
        filter: invert(1);
    }

    /* Form Inputs */
    #addProduct .form-control, 
    #addProduct .form-select {
        border-radius: 8px;
        border: 1px solid #ced4da;
        padding: 10px;
    }

    /* Form Labels */
    #addProduct .form-label {
        font-weight: bold;
        color: #495057;
    }

    /* Footer Buttons */
    #addProduct .modal-footer {
        border-top: none;
    }

    #addProduct .btn-primary {
        background-color: #007bff;
        border-radius: 8px;
        padding: 8px 16px;
    }

    #addProduct .btn-secondary {
        border-radius: 8px;
        padding: 8px 16px;
    }
</style>

<div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addProductLabel">Add Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="database/create.php" method="POST">
          <!-- Product Name -->
          <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" class="form-control" name="product_name" required>
          </div>

          <!-- Category -->
          <div class="mb-3">
            <label class="form-label">Category</label>
            <select class="form-select" name="category" required>
              <option value="Electronics">Electronics</option>
              <option value="Food">Food</option>
              <option value="Home">Home</option>
              <option value="Hygiene">Hygiene</option>
            </select>
          </div>

          <!-- Price -->
          <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" class="form-control" name="price" required>
          </div>

          <!-- Stock Quantity -->
          <div class="mb-3">
            <label class="form-label">Stock Quantity</label>
            <input type="number" class="form-control" name="stock_quantity" required>
          </div>

          <button type="submit" class="btn btn-primary">Add Product</button>
          
        </form>
      </div>
    </div>
  </div>
</div>

          <!-- End OF Table Modal and alert -->

          <!-- Pagination -->
          <div class="mx-4">
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <li class="page-item <?php if ($current_page <= 1) echo 'disabled'; ?>">
                  <a class="page-link" href="?page=<?php echo $current_page - 1; ?>">Previous</a>
                </li>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                  <li class="page-item <?php if ($i == $current_page) echo 'active'; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                  </li>
                <?php endfor; ?>
                <li class="page-item <?php if ($current_page >= $total_pages) echo 'disabled'; ?>">
                  <a class="page-link" href="?page=<?php echo $current_page + 1; ?>">Next</a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</main><!-- End #main -->

<?php
include('partials\footer.php');
?>