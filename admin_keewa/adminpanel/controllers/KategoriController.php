<?php
require "../../koneksi.php";

class KategoriController
{
    public function store($nama)
    {
        global $con;

        $nama = mysqli_real_escape_string($con, $nama);

        $insertQuery = mysqli_query($con, "INSERT INTO kategori (nama) VALUES ('$nama')");

        if ($insertQuery) {
            // Redirect to the page where you display the categories
            header("Location: ../kategori.php");
            exit();
        } else {
            // Handle the error
            echo "Error creating category: " . mysqli_error($con);
        }
    }

    public function update($id, $nama)
    {
        global $con;

        $id = mysqli_real_escape_string($con, $id);
        $nama = mysqli_real_escape_string($con, $nama);

        $updateQuery = mysqli_query($con, "UPDATE kategori SET nama='$nama' WHERE id='$id'");

        if ($updateQuery) {
            // Redirect to the page where you display the categories            header("Location: ../kategori.php");
            header("Location: ../kategori.php");
            exit();
        } else {
            // Handle the error
            echo "Error updating category: " . mysqli_error($con);
        }
    }

    public function destroy($id)
    {
        global $con;

        $id = mysqli_real_escape_string($con, $id);

        $deleteQuery = mysqli_query($con, "DELETE FROM kategori WHERE id='$id'");

        if ($deleteQuery) {
            // Redirect to the page where you display the categories
            header("Location: ../kategori.php");
            exit();
        } else {
            // Handle the error
            echo "Error deleting category: " . mysqli_error($con);
        }
    }
}

// Example usage:

// Create an instance of the KategoriController
$kategoriController = new KategoriController();

// Check if $_POST['delete_id'] is set for deletion
if (isset($_POST['delete_id'])) {
    $kategoriController->destroy($_POST['delete_id']);
}

// Check if $_POST['edit_id'] and $_POST['edit_nama'] are set for updating
if (isset($_POST['edit_id']) && isset($_POST['edit_nama'])) {
    $kategoriController->update($_POST['edit_id'], $_POST['edit_nama']);
}

// Check if $_POST['nama'] is set for storing a new category
if (isset($_POST['add_nama'])) {
    $kategoriController->store($_POST['add_nama']);
}
?>
