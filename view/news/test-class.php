<?php

class PerhitunganMatematika
{
    // variable di class
    // public $hasilHitungGenap; // variable yang bisa digunakan global bebas
    // private $angka2; // variable yang hanya bisa digunakan di dalam class tersebut
    // protected $angka3; // variable yang hanya bisa digunakan di dalam class tersebut dan turunannya

    public $hasilHitungGenap; // variable yang bisa digunakan global bebas
    public $hasilHitungGanjil; // variable yang hanya bisa digunakan di dalam class tersebut
    public $angkaInputnya; // variable yang hanya bisa digunakan di dalam class tersebut dan turunannya

    public function __construct($var1, $var2, $var3) // funsi yang pasti dipanggil pertama kali class dipanggil
    {
        $this->hasilHitungGenap = $var1;
        $this->hasilHitungGanjil = $var2;
        $this->angkaInputnya = $var3;
    }

    public function hitungGenap($angka)
    {
        // $data = ($angka % 2) == 0 ? 'genap' : 'ganjil';
        $this->hasilHitungGenap = 1;
        $this->hasilHitungGanjil = 2;
        $this->angkaInputnya = 3;
    }

    public function hitungGanjil()
    {
    }

    public function hitungLingkaran()
    {
    }
}

$perhitunganClass = new PerhitunganMatematika(3, 5, 6);
echo $perhitunganClass->hasilHitungGenap;
