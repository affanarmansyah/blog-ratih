<!-- 1. buat array yang berisi angka 1 - 10 dengan metode for
<br>
<?php
$angka = [];

for ($i = 1; $i <= 10; $i++) {
    $angka[] = $i;
}
print_r($angka);

?> -->

2. buat array yang berisi angka 1 - 10 dengan metode for dan buat juga function yang akan mengganti angka genap menjadi kata "genap"
contoh: [1, genap, 3, genap, 5, genap]
<br>

<?php

function Genap($angkagenap)
{
    if ($angkagenap % 2 == 0) {
        return "genap";
    }
    return true;
}


$angka = [];

for ($i = 0; $i <= 10; $i++) {
    $angka[] = Genap($i);
}
print_r($angka);
?>