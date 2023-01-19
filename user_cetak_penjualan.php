<?php
session_start();

require "function.php";
require "fpdf/fpdf.php";

if (!isset($_SESSION["login"])) {
    header("location:login.php");
    exit;
}

$pdf = new FPDF("L", "mm", "Letter");

$pdf->AddPage();

$pdf->SetFont("Times", "B", 16);
$pdf->Cell(0, 7, "LAPORAN PENJUALAN KASIR", 0, 1, "C");

$pdf->Cell(10, 7, "", 0, 1);

$pdf->SetFont("Times", "B", 10);

$pdf->Cell(8, 6, "No.", 1, 0, "C");
$pdf->Cell(30, 6, "Kode Penjualan", 1, 0, "C");
$pdf->Cell(60, 6, "Barang", 1, 0, "C");
$pdf->Cell(15, 6, "Jumlah", 1, 0, "C");
$pdf->Cell(20, 6, "Satuan", 1, 0, "C");
$pdf->Cell(30, 6, "Harga", 1, 0, "C");
$pdf->Cell(20, 6, "User", 1, 0, "C");
$pdf->Cell(35, 6, "Tanggal", 1, 0, "C");
$pdf->Cell(30, 6, "Sub-total", 1, 1, "C");

$no = 1;
$kueri = "SELECT master_penjualan.id_penjualan,
                                                        master_penjualan.kode_penjualan,
                                                        
                                                        master_barang.id_barang,
                                                        master_barang.kode_barang,
                                                        master_barang.nama_barang,
                                                        master_barang.stok,
                                                        
                                                        master_penjualan.jumlah,
                                                        
                                                        master_satuan.id_satuan,
                                                        master_satuan.nama_satuan,
                                                        
                                                        master_penjualan.harga,
                                                        
                                                        master_user.id_user,
                                                        master_user.full_name,
                                                        
                                                        master_penjualan.tanggal
                                                    FROM master_penjualan INNER JOIN master_barang ON master_penjualan.barang = master_barang.id_barang
                                                                                JOIN master_satuan ON master_penjualan.satuan = master_satuan.id_satuan
                                                                                JOIN master_user ON master_penjualan.user = master_user.id_user";

$ambil = mysqli_query($conn, $kueri) or die(mysqli_error($conn));
while ($data = mysqli_fetch_array($ambil)) {
    $subtotal = $data["jumlah"] * $data["harga"];

    $pdf->Cell(8, 6, $no, 1, 0);
    $pdf->Cell(30, 6, $data["kode_penjualan"], 1, 0);
    $pdf->Cell(60, 6, $data["kode_barang"] . "-" . $data["nama_barang"], 1, 0);
    $pdf->Cell(15, 6, $data["jumlah"], 1, 0);
    $pdf->Cell(20, 6, $data["nama_satuan"], 1, 0);
    $pdf->Cell(30, 6, "Rp." . number_format($data["harga"]), 1, 0);
    $pdf->Cell(20, 6, $data["full_name"], 1, 0);
    $pdf->Cell(35, 6, $data["tanggal"], 1, 0);
    $pdf->Cell(30, 6, "Rp." . number_format($subtotal), 1, 1);
    $no++;
}

$pdf->Output();
