<?php
require_once "app/includes/auth.php";
requireAdmin();
require_once "config/database.php";
$page_css = "assets/css/gestion_emprunts.css";
require_once "app/includes/admin_header.php";

$sql = "select b.id as borrow_id,
        b.status,
        b.borrow_date,
        u.name as user_name,
        u.email,
        bk.title as book_title,
        bk.image
        from borrowing b
        join users u on b.user_id = u.id
        join books bk on b.book_id = bk.id
        order by b.id desc;";
$stmt = $conn->query($sql);
$requests = $stmt->fetchAll();
?>
<div class="container">
    <h1>Borrow Requests</h1>

    <?php if (empty($requests)):?>
        <p class="empty">No borrow requests</p>
    <?php else: ?>
        <div class="requests">
            <?php foreach($requests as $r): ?>
                <div class="request-card">
                    <img src="<?=$r['image'] ?>" alt="book">
                    <div class="info">
                        <h3><?= htmlspecialchars($r["book_title"]) ?></h3>

                         <p><strong>User:</strong> <?= htmlspecialchars($r["user_name"]) ?></p>
                        <p><strong>Email:</strong> <?= htmlspecialchars($r["email"]) ?></p>

                        <span class="status <?= $r['status'] ?>">
                            <?= $r['status'] ?>
                        </span>

                        <div class="actions">
                            <?php if ($r["status"] === "pending"): ?>
                                <a href="?page=approve&id=<?= $r["borrow_id"] ?>" class="approve">Approve</a>
                                <a href="?page=reject&id=<?= $r["borrow_id"] ?>" class="reject">Reject</a>
                            <?php elseif ($r["status"] === "approved"): ?>
                                <a href="?page=unapprove&id=<?= $r["borrow_id"] ?>" class="reject">Remove Approval</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once "app/includes/admin_footer.php"; ?>