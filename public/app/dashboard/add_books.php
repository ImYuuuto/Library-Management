<?php
require_once "app/includes/auth.php";
requireAdmin();

require_once "config/database.php";

$page_css = "assets/css/add_books.css";
require_once "app/includes/admin_header.php";

$js_script = "assets/js/add_books.js";

/* =========================
   HANDLE FORM
========================= */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $title = $_POST["bookName"] ?? "";
    $author = $_POST["author"] ?? "";
    $description = $_POST["description"] ?? "";

    $imagePath = null;
    $pdfPath = null;

    /* =====================
       IMAGE UPLOAD
    ===================== */
    if (!empty($_FILES["image"]["name"])) {

        $allowedImages = ["image/jpeg", "image/png", "image/jpg"];

        if (!in_array($_FILES["image"]["type"], $allowedImages)) {
            die("Invalid image type");
        }

        $imageExt = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

        $cleanTitle = preg_replace("/[^a-zA-Z0-9]/", "_", strtolower($title));
        $unique = uniqid();

        $imagePath = "uploads/images/" . $cleanTitle . "_" . $unique . "." . $imageExt;

        move_uploaded_file(
            $_FILES["image"]["tmp_name"],
            $imagePath
        );
    }

    /* =====================
       PDF UPLOAD
    ===================== */
    if (!empty($_FILES["pdf"]["name"])) {

        if ($_FILES["pdf"]["type"] !== "application/pdf") {
            die("Invalid PDF file");
        }

        $pdfExt = pathinfo($_FILES["pdf"]["name"], PATHINFO_EXTENSION);

        $cleanTitle = preg_replace("/[^a-zA-Z0-9]/", "_", strtolower($title));
        $unique = uniqid();

        $pdfPath = "uploads/pdfs/" . $cleanTitle . "_" . $unique . "." . $pdfExt;

        move_uploaded_file(
            $_FILES["pdf"]["tmp_name"],
            $pdfPath
        );
    }

    /* =====================
       INSERT INTO DATABASE
    ===================== */
    $sql = "INSERT INTO books (title, author, description, image, pdf)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$title, $author, $description, $imagePath, $pdfPath]);

    /* =====================
       REDIRECT (VERY IMPORTANT)
    ===================== */
    header("Location: ?page=modify_books");
    exit();
}
?>

<div id="container">
    <form method="post" enctype="multipart/form-data" action="?page=add_book">

        <input type="text" name="bookName" placeholder="Book name" required>

        <input type="text" name="author" placeholder="Author name" required>

        <div class="file-box">
            <label>Upload Book PDF</label>

            <div class="drop-zone">
                Drag & Drop PDF or Click to Upload
                <input type="file" hidden accept="application/pdf" name="pdf">
            </div>
        </div>

        <div class="drop-zone">
            Drag & Drop Image or Click to Upload
            <input type="file" name="image" hidden accept="image/*">
        </div>

        <textarea name="description" placeholder="Describe the book..." required></textarea>

        <button type="submit">Submit</button>
    </form>
</div>

<script src="<?= $js_script ?>?v=<?= time() ?>"></script>

<?php require_once "app/includes/admin_footer.php"; ?>