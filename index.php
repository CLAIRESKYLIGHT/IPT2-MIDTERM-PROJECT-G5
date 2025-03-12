<?php
session_start();
  include('partials\header.php');
  include('partials\sidebar.php');
  include('database\database.php');
  include('database\create.php');

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
      <h1>Employee Information Management System</h1>
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
                                    <div class="mb-3">
                                        <label class="form-label">Product Name</label>
                                        <input type="text" class="form-control" name="product_name" value="<?php echo $row['product_name']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Price</label>
                                        <input type="number" class="form-control" name="price" value="<?php echo $row['price']; ?>" required>
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
                                <form action="database/delete.php" method="POST">
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

                <!--<tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Brandon Jacob</td>
                    <td>Designer</td>
                    <td>28</td>
                    <td>2016-05-25</td>
                    <td class="d-flex justify-content-center">
                      <button class="btn btn-success btn-sm mx-1">Edit</button>
                      <button class="btn btn-primary btn-sm mx-1" title="View Employee Information" data-bs-toggle="modal" data-bs-target="#editInfo">View</button>
                      <button class="btn btn-danger btn-sm mx-1">Delete</button>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Bridie Kessler</td>
                    <td>Developer</td>
                    <td>35</td>
                    <td>2014-12-05</td>
                    <td class="d-flex justify-content-center">
                      <button class="btn btn-success btn-sm mx-1">Edit</button>
                      <button class="btn btn-primary btn-sm mx-1" title="View Employee Information" data-bs-toggle="modal" data-bs-target="#editInfo">View</button>
                      <button class="btn btn-danger btn-sm mx-1">Delete</button>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Ashleigh Langosh</td>
                    <td>Finance</td>
                    <td>45</td>
                    <td>2011-08-12</td>
                    <td class="d-flex justify-content-center">
                      <button class="btn btn-success btn-sm mx-1">Edit</button>
                      <button class="btn btn-primary btn-sm mx-1" title="View Employee Information" data-bs-toggle="modal" data-bs-target="#editInfo">View</button>
                      <button class="btn btn-danger btn-sm mx-1">Delete</button>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">4</th>
                    <td>Angus Grady</td>
                    <td>HR</td>
                    <td>34</td>
                    <td>2012-06-11</td>
                    <td class="d-flex justify-content-center">
                      <button class="btn btn-success btn-sm mx-1">Edit</button>
                      <button class="btn btn-primary btn-sm mx-1" title="View Employee Information" data-bs-toggle="modal" data-bs-target="#editInfo">View</button>
                      <button class="btn btn-danger btn-sm mx-1">Delete</button>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">5</th>
                    <td>Raheem Lehner</td>
                    <td>Dynamic Division Officer</td>
                    <td>47</td>
                    <td>2011-04-19</td>
                    <td class="d-flex justify-content-center">
                      <button class="btn btn-success btn-sm mx-1">Edit</button>
                      <button class="btn btn-primary btn-sm mx-1" title="View Employee Information" data-bs-toggle="modal" data-bs-target="#editInfo">View</button>
                      <button class="btn btn-danger btn-sm mx-1">Delete</button>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">1</th>
                    <td>Brandon Jacob</td>
                    <td>Designer</td>
                    <td>28</td>
                    <td>2016-05-25</td>
                    <td class="d-flex justify-content-center">
                      <button class="btn btn-success btn-sm mx-1">Edit</button>
                      <button class="btn btn-primary btn-sm mx-1" title="View Employee Information" data-bs-toggle="modal" data-bs-target="#editInfo">View</button>
                      <button class="btn btn-danger btn-sm mx-1">Delete</button>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Bridie Kessler</td>
                    <td>Developer</td>
                    <td>35</td>
                    <td>2014-12-05</td>
                    <td class="d-flex justify-content-center">
                      <button class="btn btn-success btn-sm mx-1">Edit</button>
                      <button class="btn btn-primary btn-sm mx-1" title="View Employee Information" data-bs-toggle="modal" data-bs-target="#editInfo">View</button>
                      <button class="btn btn-danger btn-sm mx-1">Delete</button>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Ashleigh Langosh</td>
                    <td>Finance</td>
                    <td>45</td>
                    <td>2011-08-12</td>
                    <td class="d-flex justify-content-center">
                      <button class="btn btn-success btn-sm mx-1">Edit</button>
                      <button class="btn btn-primary btn-sm mx-1" title="View Employee Information" data-bs-toggle="modal" data-bs-target="#editInfo">View</button>
                      <button class="btn btn-danger btn-sm mx-1">Delete</button>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">4</th>
                    <td>Angus Grady</td>
                    <td>HR</td>
                    <td>34</td>
                    <td>2012-06-11</td>
                    <td class="d-flex justify-content-center">
                      <button class="btn btn-success btn-sm mx-1">Edit</button>
                      <button class="btn btn-primary btn-sm mx-1" title="View Employee Information" data-bs-toggle="modal" data-bs-target="#editInfo">View</button>
                      <button class="btn btn-danger btn-sm mx-1">Delete</button>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">5</th>
                    <td>Raheem Lehner</td>
                    <td>Dynamic Division Officer</td>
                    <td>47</td>
                    <td>2011-04-19</td>
                    <td class="d-flex justify-content-center">
                      <button class="btn btn-success btn-sm mx-1">Edit</button>
                      <button class="btn btn-primary btn-sm mx-1" title="View Employee Information" data-bs-toggle="modal" data-bs-target="#editInfo">View</button>
                      <button class="btn btn-danger btn-sm mx-1">Delete</button>
                    </td>
                  </tr>
                </tbody>-->
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