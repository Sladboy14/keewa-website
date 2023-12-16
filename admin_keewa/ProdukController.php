<?php
require "koneksi.php";

class ProdukController
{
    public function store($kategori_id, $nama, $foto, $detail, $ketersediaan_stok)
    {
        global $con;

        $nama = mysqli_real_escape_string($con, $nama);
        $foto = $this->uploadImage($foto); // Call the function to upload image and get the file path
        $detail = mysqli_real_escape_string($con, $detail);
        $ketersediaan_stok = mysqli_real_escape_string($con, $ketersediaan_stok);

        $insertQuery = mysqli_query($con, "INSERT INTO produk (kategori_id, nama, foto, detail, ketersediaan_stok) 
                                           VALUES ('$kategori_id', '$nama', '$foto', '$detail', '$ketersediaan_stok')");

        if ($insertQuery) {
            // Redirect to the page where you display the products
            header("Location: ../produk.php");
            exit();
        } else {
            // Handle the error
            echo "Error creating product: " . mysqli_error($con);
        }
    }

    public function update($id, $kategori_id, $nama, $detail, $ketersediaan_stok)
    {
        global $con;

        $id = mysqli_real_escape_string($con, $id);
        $kategori_id = mysqli_real_escape_string($con, $kategori_id);
        $nama = mysqli_real_escape_string($con, $nama);
        $detail = mysqli_real_escape_string($con, $detail);
        $ketersediaan_stok = mysqli_real_escape_string($con, $ketersediaan_stok);

        // Get the current filename of the photo
        $currentFotoQuery = mysqli_query($con, "SELECT foto FROM produk WHERE id='$id'");
        $currentFotoData = mysqli_fetch_assoc($currentFotoQuery);
        $currentFoto = $currentFotoData['foto'];

        // Upload the new photo
        if ($_FILES['foto']['name']) {
            $newFotoPath = $this->uploadImage($_FILES['foto']);
        } else {
            // If no new photo is uploaded, keep the existing photo path
            $newFotoPath = $currentFoto;
        }

        // Update the product in the database
        $updateQuery = mysqli_query($con, "UPDATE produk 
                                        SET kategori_id='$kategori_id', nama='$nama', foto='$newFotoPath', detail='$detail', ketersediaan_stok='$ketersediaan_stok' 
                                        WHERE id='$id'");

        if ($updateQuery) {
            // Delete the old photo if it exists
            if ($_FILES['foto']['name'] && $currentFoto && file_exists("../$currentFoto")) {
                unlink("../$currentFoto");
            }

            // Redirect to the page where you display the products
            header("Location: ../produk.php");
            exit();
        } else {
            // Handle the error
            echo "Error updating product: " . mysqli_error($con);
        }
    }

    public function index() {
        global $con;

        $insertQuery = mysqli_query($con, "SELECT * FROM produk");
        // $data = mysqli_fetch_assoc($insertQuery);

        // if ($insertQuery) {
        //     // Redirect to the page where you display the products
        //     header("Location: ../produk.php");
        //     exit();
        // } else {
        //     // Handle the error
        //     echo "Error creating product: " . mysqli_error($con);
        // }

        return $insertQuery;
    }

    public function destroy($id)
    {
        global $con;

        $id = mysqli_real_escape_string($con, $id);

        // Get the filename of the image associated with the product
        $imageQuery = mysqli_query($con, "SELECT foto FROM produk WHERE id='$id'");
        $imageData = mysqli_fetch_assoc($imageQuery);
        $imageFilename = $imageData['foto'];

        // Delete the product from the database
        $deleteQuery = mysqli_query($con, "DELETE FROM produk WHERE id='$id'");

        if ($deleteQuery) {
            // Delete the associated image file
            if ($imageFilename && file_exists("../$imageFilename")) {
                unlink("../$imageFilename");
            }

            // Redirect to the page where you display the products
            header("Location: ../produk.php");
            exit();
        } else {
            // Handle the error
            echo "Error deleting product: " . mysqli_error($con);
        }
    }

    // Function to handle image upload
    private function uploadImage($image)
    {
        // Specify the target directory for image uploads
        $targetDir = "../uploads/images/products/";

        // Generate a unique filename to prevent overwriting existing files
        $uniqueFilename = time() . '_' . basename($image['name']);

        // Create the full file path
        $targetFilePath = $targetDir . $uniqueFilename;

        echo $targetFilePath;

        // Attempt to move the uploaded file to the target directory
        try {
            // Check if the file was successfully moved
            if (move_uploaded_file($image['tmp_name'], $targetFilePath)) {
                return 'uploads/images/products/' . $uniqueFilename; // Return the file path if successful
            } else {
                // Handle the move error
                throw new Exception("Error moving uploaded file.");
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            exit(); // You may want to handle the error more gracefully, depending on your application flow
        }
    }
}

// Example usage:

// Create an instance of the ProdukController
$produkController = new ProdukController();

// Check if $_POST['delete_id'] is set for deletion
if (isset($_POST['delete_id'])) {
    $produkController->destroy($_POST['delete_id']);
}

// Check if $_POST['id'] and other fields are set for updating
if (isset($_POST['edit_id']) && isset($_POST['kategori_id']) && isset($_POST['nama']) && isset($_POST['detail']) && isset($_POST['ketersediaan_stok'])) {
    $produkController->update($_POST['edit_id'], $_POST['kategori_id'], $_POST['nama'], $_POST['detail'], $_POST['ketersediaan_stok']);
}

// Check if $_POST['store'] and other fields are set for storing a new product
if (isset($_POST['kategori_id']) && isset($_POST['nama']) && isset($_FILES['foto']) && isset($_POST['detail']) && isset($_POST['ketersediaan_stok'])) {
    $produkController->store($_POST['kategori_id'], $_POST['nama'], $_FILES['foto'], $_POST['detail'], $_POST['ketersediaan_stok']);
}
?>
