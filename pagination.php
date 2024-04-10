<div id="pagination">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css">
    <?php
if ($current_page > 2) {
    $first_page = 1;
    ?>
    <a class="page-item" href="?<?=$param?>per_page=<?= $item_per_page ?>&page=<?= $first_page ?>"><i class="ri-skip-left-line"></i></a>
    <?php
}
if ($current_page > 1) {
    $prev_page = $current_page - 1;
    ?>
    <a class="page-item" href="?<?=$param?>per_page=<?= $item_per_page ?>&page=<?= $prev_page ?>"><i class="ri-arrow-left-s-line"></i></i> </a>
    <?php }
?>
    <?php for ($num = 1; $num <= $totalPages; $num++) { ?>
    <?php if ($num != $current_page) { ?>
    <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
    <a class="page-item" href="?<?=$param?>per_page=<?= $item_per_page ?>&page=<?= $num ?>"><?= $num ?></a>
    <?php } ?>
    <?php } else { ?>
    <strong class="current-page page-item"><?= $num ?></strong>
    <?php } ?>
    <?php } ?>
    <?php
if ($current_page < $totalPages - 1) {
    $next_page = $current_page + 1;
    ?>
    <a class="page-item" href="?<?=$param?>per_page=<?= $item_per_page ?>&page=<?= $next_page ?>"><i class="ri-arrow-drop-right-line"></i></a>
    <?php
}
if ($current_page < $totalPages - 1) {
    $end_page = $totalPages;
    ?>
    <a class="page-item" href="?<?=$param?>per_page=<?= $item_per_page ?>&page=<?= $end_page ?>"><i class="ri-skip-right-line"></i></a>
    <?php
}
?>
</div>