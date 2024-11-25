<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DetailTransaksi;


class DetailTransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data dummy untuk tabel detail_transaksi
        $detailTransaksi = [
            [
                'transaksi_id' => 1,  // ID transaksi yang sesuai dengan tabel transaksi
                'layanan_id' => 3,    // ID layanan dari tabel layanan (pastikan sudah ada ID >= 1)
                'harga' => 50000,      // Harga layanan
            ],

            [
                'transaksi_id' => 2,
                'layanan_id' => 1,    
                'harga' => 25000,      
            ],
            [
                'transaksi_id' => 2,
                'layanan_id' => 2,    
                'harga' => 25000,      
            ],
            [
                'transaksi_id' => 3,
                'layanan_id' => 6,    
                'harga' => 50000,      
            ],
            [
                'transaksi_id' => 3,
                'layanan_id' => 2,    
                'harga' => 25000,      
            ],
        ];

        // Insert data detailtransaksi ke tabel menggunakan Eloquent
        foreach ($detailTransaksi as $data) {
            DetailTransaksi::create($data);
        }
        
    }
}
