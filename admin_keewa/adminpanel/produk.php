<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

require "../koneksi.php";

$queryProduk = mysqli_query($con, "SELECT * FROM produk");
$jumlahProduk = mysqli_num_rows($queryProduk);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>

<style>
    .no-decoration {
        text-decoration: none;
    }
</style>

<body>
    <?php require "navbar.php"; ?>

    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="../adminpanel" class="no-decoration text-muted">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-curent="page">
                    Produk
                </li>
            </ol>
        </nav>

        <!-- Add Product Modal -->
        <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="controllers/ProdukController.php" enctype="multipart/form-data">
                            <!-- You may need to adjust these field names based on your database structure -->
                            <div class="form-group">
                                <label for="addNama">Product Name:</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="kategori_id">Product Category:</label>
                                <select class="form-control" id="kategori_id" name="kategori_id" required>
                                    <?php
                                        // Fetch categories from the database
                                        $queryCategories = mysqli_query($con, "SELECT * FROM kategori");

                                        // Check if there are categories
                                        if (mysqli_num_rows($queryCategories) > 0) {
                                            while ($category = mysqli_fetch_assoc($queryCategories)) {
                                                echo '<option value="' . $category['id'] . '">' . $category['nama'] . '</option>';
                                            }
                                        } else {
                                            echo '<option value="" disabled>No categories available</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="addFoto">Product Image:</label>
                                <input type="file" class="form-control-file" id="foto" name="foto">
                            </div>
                            <div class="form-group">
                                <label for="addDetail">Product Details:</label>
                                <textarea class="form-control" id="detail" name="detail" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="addKetersediaan">Availability:</label>
                                <!-- Replace this with a dynamic dropdown for availability -->
                                <select class="form-control" id="ketersediaan_stok" name="ketersediaan_stok" required>
                                    <option value="ready_stok">Ready Stock</option>
                                    <option value="sold_out">Sold Out</option>
                                    <option value="pre_order">Pre Order</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <h2>List Produk</h2>

            <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addProductModal">
                Add
            </button>


            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Image</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Availability</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $jumlah = 1;
                    while ($data = mysqli_fetch_array($queryProduk)) {
                    ?>
                        <tr>
                            <td><?php echo $jumlah; ?></td>
                            <td><img src="<?php echo $data['foto'] ?>" alt="" class="img-fluid" style="height: 50px;"></td>
                            <td><?php echo $data['nama']; ?></td>
                            <?php
                            $availibilityAlias = '';
                            if ($data['ketersediaan_stok'] == 'ready_stok') {
                                $availibilityAlias = 'Ready Stok';
                            } else if ($data['ketersediaan_stok'] == 'pre_order') {
                                $availibilityAlias = 'Pre Order';
                            } else if ($data['ketersediaan_stok'] == 'sold_out') {
                                $availibilityAlias = 'Sold Out';
                            }
                            ?>
                            <td><?php echo $availibilityAlias; ?></td>
                            <td>
                                <?php
                                // Fetch the category name based on kategori_id
                                $queryCategoryName = mysqli_query($con, "SELECT nama FROM kategori WHERE id = " . $data['kategori_id']);
                                
                                if ($categoryData = mysqli_fetch_assoc($queryCategoryName)) {
                                    echo $categoryData['nama'];
                                } else {
                                    echo "Category not found";
                                }
                                ?>
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editProductModal<?php echo $data['id']; ?>">
                                    Edit
                                </button>

                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteProductModal<?php echo $data['id']; ?>">
                                    Delete
                                </button>
                            </td>
                        </tr>

                        <!-- Edit Product Modal -->
                        <div class="modal fade" id="editProductModal<?php echo $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editProductModalLabel">Edit Produk</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Edit product form -->
                                        <form action="controllers/ProdukController.php" method="post" enctype="multipart/form-data">
                                            <!-- Hidden input for product ID -->
                                            <input type="hidden" name="edit_id" value="<?php echo $data['id']; ?>">

                                            <!-- Kategori ID field (you may want to replace this with a dropdown) -->
                                            <div class="form-group">
                                                <label for="kategori_id">Kategori:</label>
                                                <select class="form-control" id="kategori_id" name="kategori_id" required>
                                                    <?php
                                                    // Fetch categories from the database
                                                    $queryCategories = mysqli_query($con, "SELECT * FROM kategori");

                                                    // Check if there are categories
                                                    if (mysqli_num_rows($queryCategories) > 0) {
                                                        while ($category = mysqli_fetch_assoc($queryCategories)) {
                                                            // Check if the current category ID matches the data's category ID
                                                            $selected = ($category['id'] == $data['kategori_id']) ? 'selected' : '';

                                                            echo '<option value="' . $category['id'] . '" ' . $selected . '>' . $category['nama'] . '</option>';
                                                        }
                                                    } else {
                                                        echo '<option value="" disabled>No categories available</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <!-- Nama field -->
                                            <div class="form-group">
                                                <label for="nama">Nama Produk:</label>
                                                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data['nama']; ?>" required>
                                            </div>

                                            <!-- Foto field -->
                                            <div class="form-group">
                                                <label for="foto">Foto Produk:</label>
                                                <input type="file" class="form-control-file" id="foto" name="foto">
                                            </div>

                                            <!-- Detail field -->
                                            <div class="form-group">
                                                <label for="detail">Detail Produk:</label>
                                                <textarea class="form-control" id="detail" name="detail" rows="3" required><?php echo $data['detail']; ?></textarea>
                                            </div>

                                            <!-- Ketersediaan Stok field -->
                                            <div class="form-group">
                                                <label for="ketersediaan_stok">Ketersediaan Stok:</label>
                                                <select class="form-control" id="ketersediaan_stok" name="ketersediaan_stok" required>
                                                    <option value="ready_stok" <?php echo ($data['ketersediaan_stok'] == 'ready_stok') ? 'selected' : ''; ?>>Ready Stok</option>
                                                    <option value="sold_out" <?php echo ($data['ketersediaan_stok'] == 'sold_out') ? 'selected' : ''; ?>>Sold Out</option>
                                                    <option value="pre_order" <?php echo ($data['ketersediaan_stok'] == 'pre_order') ? 'selected' : ''; ?>>Pre Order</option>
                                                </select>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Product Modal -->
                        <div class="modal fade" id="deleteProductModal<?php echo $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteProductModalLabel">Delete Produk</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this product?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <form method="post" action="controllers/ProdukController.php">
                                            <input type="hidden" name="delete_id" value="<?php echo $data['id']; ?>">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php
                        $jumlah++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="../Css/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>
