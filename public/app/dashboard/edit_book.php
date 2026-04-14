<?php
require "../includes/auth.php";
requireLogin();
require "../../config/database.php";

$page_css = "../../assets/css/add_books.css";
require "../includes/admin_header.php";

/* =========================
   GET BOOK ID
========================= */
$id = $_GET['id'] ?? null;

if (!$id) {
    die("Invalid book ID");
}

/* =========================
   FETCH BOOK
========================= */
$stmt = $conn->prepare("SELECT * FROM books WHERE id = ?");
$stmt->execute([$id]);
$book = $stmt->fetch();

if (!$book) {
    die("Book not found");
}

/* =========================
   FETCH CATEGORIES
========================= */
$categories = $conn->query("SELECT * FROM categories")->fetchAll();

/* =========================
   HANDLE UPDATE
========================= */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $title = $_POST["bookName"];
    $author = $_POST["author"];
    $description = $_POST["description"];
    $category_id = $_POST["category"];
    $available = isset($_POST["available"]) ? 1 : 0;

    $imagePath = $book['image'];

    /* =====================
       IMAGE UPDATE (OPTIONAL)
    ===================== */
    if (!empty($_FILES["image"]["name"])) {

        $allowed = ["image/jpeg", "image/png", "image/jpg"];

        if (!in_array($_FILES["image"]["type"], $allowed)) {
            die("Invalid image type");
        }

        $ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

        $cleanTitle = preg_replace("/[^a-zA-Z0-9]/", "_", strtolower($title));
        $unique = uniqid();

        $imagePath = "uploads/images/" . $cleanTitle . "_" . $unique . "." . $ext;

        move_uploaded_file($_FILES["image"]["tmp_name"], "../../" . $imagePath);
    }

    /* =====================
       UPDATE DB
    ===================== */
    $sql = "UPDATE books 
            SET title=?, author=?, description=?, category_id=?, image=?, available=?
            WHERE id=?";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        $title,
        $author,
        $description,
        $category_id,
        $imagePath,
        $available,
        $id
    ]);

    /* =====================
       REDIRECT (IMPORTANT)
    ===================== */
    header("Location: modify_books.php");
    exit();
}
?>

<div id="container">
    <form method="POST" enctype="multipart/form-data">

        <input type="text" name="bookName" value="<?= $book['title'] ?>" required>

        <input type="text" name="author" value="<?= $book['author'] ?>" required>

        <!-- CATEGORY -->
        <select name="category" required>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>"
                    <?= ($book['category_id'] == $cat['id']) ? 'selected' : '' ?>>
                    <?= $cat['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- IMAGE -->
        <div>
            <p>Current Image:</p>
            <img src="../../<?= $book['image'] ?>" width="100">
        </div>

        <input type="file" name="image" accept="image/*">

        <!-- DESCRIPTION -->
        <textarea name="description" required><?= $book['description'] ?></textarea>

        <!-- AVAILABLE -->
        <label>
            <input type="checkbox" name="available" <?= $book['available'] ? 'checked' : '' ?>>
            Available
        </label>

        <button type="submit">Update Book</button>
    </form>
</div>

<?php require "../includes/admin_footer.php"; ?>