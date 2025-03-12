<?php
session_start();
  include('partials\header.php');
  include('partials\sidebar.php');
  include('database\database.php');
  include('database\create.php');
  include('database\update.php');
  include('database\delete.php');

  $sql = "SELECT * FROM tblproduct";

  $tblproduct = $conn->query($sql);
  $status = '';
  if (isset($_SESSION['status'])) {
      $status = $_SESSION['status'];
      unset($_SESSION['status']);
  }
  
  // Your PHP BACK CODE HERE

?>

<main id="main" class="main">
<!--ALERT-->
<?php if ($status == "created"): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Product added successfully!</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php elseif ($status == "updated"): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Product updated successfully!</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php elseif ($status == "error"): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>There was an error adding the product!</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php elseif ($status == "deleted"): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Product deleted successfully!</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!--END ALERT-->

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
        <?php
        $sql = "SELECT * FROM tblproduct";
        $tblproduct = $conn->query($sql);

        if ($tblproduct->num_rows > 0):
            while ($row = $tblproduct->fetch_assoc()):
        ?>
        <tr>
            <th scope="row"><?php echo $row['id']; ?></th>
            <td><?php echo $row['product_name']; ?></td>
            <td><?php echo $row['category']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['stock_quantity']; ?></td>
            <td class="d-flex justify-content-center">
                <!-- Edit Button -->
                <button class="btn btn-success btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#editInfo<?php echo $row['id']; ?>">Edit</button>

                <!-- Edit Modal -->
        <div class="modal fade" id="editInfo<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="editInfoLabel" aria-hidden="true">
        <div class="modal-dialog">
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

                    <!-- Category (Added the missing category dropdown) -->
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select class="form-select" name="category" required>
                            <option value="Electronics" <?php if ($row['category'] == 'Electronics') echo 'selected'; ?>>Electronics</option>
                            <option value="Clothing" <?php if ($row['category'] == 'Clothing') echo 'selected'; ?>>Food</option>
                            <option value="Home" <?php if ($row['category'] == 'Home') echo 'selected'; ?>>Home</option>
                            <option value="Home" <?php if ($row['category'] == 'Home') echo 'selected'; ?>>Hygene</option>
                        </select>
                    </div>

                    <!-- Price -->
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" class="form-control" name="price" value="<?php echo $row['price']; ?>" required>
                    </div>

                    <!-- Stock Quantity (if missing) -->
                    <div class="mb-3">
                        <label class="form-label">Stock Quantity</label>
                        <input type="number" class="form-control" name="stock_quantity" value="<?php echo $row['stock_quantity']; ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>


                <!-- View Button -->
                <button class="btn btn-primary btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#viewInfo<?php echo $row['id']; ?>">View</button>

                <!-- View Modal -->
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
                <div class="modal fade" id="deleteInfo<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="deleteInfoLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Confirm Delete</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete <strong><?php echo $row['product_name']; ?></strong>?
                            </div>
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
        <?php endwhile; endif; ?>
    </tbody>
</table>


<!-- End Default Table Example -->
            </div>
            <div class="mx-4">
              <nav aria-label="Page navigation example">
                <ul class="pagination">
                  <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
              </nav>
            </div>
          </div>

        </div>

        
      </div>

      <!-- Modal -->
      <div class="modal fade" id="addProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addProductLabel">Add New Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="productForm" action="database/create.php" method="POST">
                    <div class="mb-3">
                        <label for="product_name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category" required>
                            <option selected disabled>Select category</option>
                            <option value="Electronics">Electronics</option>
                            <option value="Hygiene">Hygiene</option>
                            <option value="Home">Home</option>
                            <option value="food">Food</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="stock_quantity" class="form-label">Stock Quantity</label>
                        <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


    </section>

  </main><!-- End #main -->
<?php
include('partials\footer.php');
?>