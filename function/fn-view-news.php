<?php
$limit = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit; // Offset data
$total_pages = ceil(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM table_news")) / $limit);


if (isset($_GET['cari_disini'])) {
    $cari_disini = $_GET['cari_disini'];
    $query = "SELECT * FROM table_news where title LIKE '%" . $cari_disini . "%' OR status LIKE '%" . $cari_disini . "%' OR created_at LIKE '%" . $cari_disini . "%' LIMIT $limit OFFSET $offset";
}
