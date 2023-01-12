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
$pdf->Cell(0, 7, "LAPORAN PEMBELIAN KASIR", 0, 1, "C");

$pdf->Cell(10, 7, "", 0, 1);

$pdf->SetFont("Times", "B", 10);

$pdf->Cell(8, 6, "No.", 1, 0, "C");
$pdf->Cell(30, 6, "Kode Pembelian", 1, 0, "C");
$pdf->Cell(55, 6, "Barang", 1, 0, "C");
$pdf->Cell(10, 6, "Jumlah", 1, 0, "C");
$pdf->Cell(15, 6, "Satuan", 1, 0, "C");
$pdf->Cell(45, 6, "Supplier", 1, 0, "C");
$pdf->Cell(25, 6, "Harga", 1, 0, "C");
$pdf->Cell(35, 6, "Tanggal", 1, 0, "C");
$pdf->Cell(30, 6, "Sub-total", 1, 1, "C");

$no = 1;
$kueri = "SELECT master_pembelian.id_pembelian,
                                                        master_pembelian.kode_pembelian,
                                                        master_barang.id_barang,
                                                        master_barang.kode_barang,
                                                        master_barang.nama_barang,
                                                        master_pembelian.jumlah,
                                                        master_satuan.id_satuan,
                                                        master_satuan.nama_satuan,
                                                        master_supplier.id_supplier,
                                                        master_supplier.nama_supplier,
                                                        master_supplier.kab_kota,
                                                        master_pembelian.harga,
                                                        master_pembelian.tanggal
                                                    FROM master_pembelian INNER JOIN master_barang ON master_pembelian.barang = master_barang.id_barang
                                                                                JOIN master_satuan ON master_pembelian.satuan = master_satuan.id_satuan
                                                                                JOIN master_supplier ON master_pembelian.supplier = master_supplier.id_supplier";


$ambil = mysqli_query($conn, $kueri) or die(mysqli_error($conn));
while ($data = mysqli_fetch_array($ambil)) {
    $subtotal = $data["jumlah"] * $data["harga"];

    $pdf->Cell(8, 6, $no, 1, 0);
    $pdf->Cell(30, 6, $data["kode_pembelian"], 1, 0);
    $pdf->Cell(55, 6, $data["kode_barang"] . "-" . $data["nama_barang"], 1, 0);
    $pdf->Cell(10, 6, $data["jumlah"], 1, 0);
    $pdf->Cell(15, 6, $data["nama_satuan"], 1, 0);
    $pdf->Cell(45, 6, $data["nama_supplier"] . "-" . $data["kab_kota"], 1, 0);
    $pdf->Cell(25, 6, "Rp." . number_format($data["harga"]), 1, 0);
    $pdf->Cell(35, 6, $data["tanggal"], 1, 0);
    $pdf->Cell(30, 6, "Rp." . number_format($subtotal), 1, 1);
    $no++;
}

$pdf->Output();
