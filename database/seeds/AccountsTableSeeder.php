<?php

use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
	{
		$data = [

			[
				// 1
				'nomor'         => '1-1110',
				'nama'          => 'Cash In Bank',
				'keterangan'    => 'Kas di Bank',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 2
				'nomor'         => '1-1120',
				'nama'          => 'Petty Cash',
				'keterangan'    => 'Kas Kecil',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 3
				'nomor'         => '1-1210',
				'nama'          => 'Accounts Receivable',
				'keterangan'    => 'Piutang Dagang',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 4
				'nomor'         => '1-1220',
				'nama'          => 'Installment Contract Receivable',
				'keterangan'    => 'Piutang Angsuran',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 5
				'nomor'         => '1-1230',
				'nama'          => 'Allowance for Doubtful Debt',
				'keterangan'    => 'Cadangan Kerugian Piutang',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 6
				'nomor'         => '1-1310',
				'nama'          => 'Merchandise Inventory',
				'keterangan'    => 'Persediaan Barang Dagang',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 7
				'nomor'         => '1-1320',
				'nama'          => 'Supplies',
				'keterangan'    => 'Perlengkapan Toko',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 8
				'nomor'         => '1-1410',
				'nama'          => 'Prepaid Rent',
				'keterangan'    => 'Asuransi dibayar di Muka',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 9
				'nomor'         => '1-1420',
				'nama'          => 'Prepaid Insurance',
				'keterangan'    => 'Sewa dibayar di Muka',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 10
				'nomor'         => '1-2100',
				'nama'          => 'Stock Invesment',
				'keterangan'    => 'Investasi dalam Saham',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 11
				'nomor'         => '1-3100',
				'nama'          => 'Land',
				'keterangan'    => 'Tanah',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 12
				'nomor'         => '1-3210',
				'nama'          => 'Building a cost',
				'keterangan'    => 'Gedung',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 13
				'nomor'         => '1-3220',
				'nama'          => 'Building Accum. Depr.',
				'keterangan'    => 'Akum. Penyunsutan Gedung',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 14
				'nomor'         => '1-3310',
				'nama'          => 'Vehicle',
				'keterangan'    => 'Kedaraan',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 15
				'nomor'         => '1-3320',
				'nama'          => 'Vehicle Accum. Depr.',
				'keterangan'    => 'Akum. Penyunsutan Kedaraan',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 16
				'nomor'         => '1-3410',
				'nama'          => 'Equipment',
				'keterangan'    => 'Peralatan',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 17
				'nomor'         => '1-3420',
				'nama'          => 'Equipment Accum. Depr.',
				'keterangan'    => 'Akum. Penyunsutan Peralatan',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 18
				'nomor'         => '2-1210',
				'nama'          => 'Accounts Payable',
				'keterangan'    => 'Hutang Dagang',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 19
				'nomor'         => '2-1211',
				'nama'          => 'Accruad Expense',
				'keterangan'    => 'Hutang Biaya',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 20
				'nomor'         => '2-1212',
				'nama'          => 'Income Tax Payable',
				'keterangan'    => 'Hutang Pajak Penghasilan (PPh)',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 21
				'nomor'         => '2-1213',
				'nama'          => 'PPN Payable',
				'keterangan'    => 'Hutang PPN',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 22
				'nomor'         => '2-1310',
				'nama'          => 'PPN Outcome',
				'keterangan'    => 'PPN Keluar',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 23
				'nomor'         => '2-1320',
				'nama'          => 'PPN Income',
				'keterangan'    => 'PPN Masuk',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 24
				'nomor'         => '2-2100',
				'nama'          => 'Bank Mandiri Loan',
				'keterangan'    => 'Hutang Jangka Panjang',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 25
				'nomor'         => '3-1100',
				'nama'          => 'Common Stock',
				'keterangan'    => 'Modal Saham',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 26
				'nomor'         => '3-1200',
				'nama'          => 'Retairned Earning',
				'keterangan'    => 'Laba Ditahan',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 27
				'nomor'         => '3-1300',
				'nama'          => 'Deferd gros profit on realization',
				'keterangan'    => 'Laba Kotor Belum Direalisasi',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 28
				'nomor'         => '3-1400',
				'nama'          => 'Income Summary',
				'keterangan'    => 'Ikhtisar Laba Rugi',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 29
				'nomor'         => '4-1100',
				'nama'          => 'Sales Of Merchandise',
				'keterangan'    => 'Penjualan Barang Dagang',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 30
				'nomor'         => '4-2100',
				'nama'          => 'Sales of Installment',
				'keterangan'    => 'Penjualan Angsuran',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 31
				'nomor'         => '4-2200',
				'nama'          => 'Freight Colected',
				'keterangan'    => 'Pendapatan Angkutan',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 32
				'nomor'         => '4-2300',
				'nama'          => 'Late Fee Colected',
				'keterangan'    => 'Pendapatan Denda',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 33
				'nomor'         => '4-2400',
				'nama'          => 'Sales Discount',
				'keterangan'    => 'Potongan Penjualan',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 34
				'nomor'         => '5-1100',
				'nama'          => 'Coft of Goods Sold',
				'keterangan'    => 'Harga Pokok Penjualan',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 35
				'nomor'         => '5-1200',
				'nama'          => 'Coft of Goods Sold of Instalment',
				'keterangan'    => 'Harga Pokok Penjualan Angsuran',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 36
				'nomor'         => '5-2000',
				'nama'          => 'Freight Paid',
				'keterangan'    => 'Beban Transportasi Pembelian',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 37
				'nomor'         => '5-3000',
				'nama'          => 'Purchase Discount',
				'keterangan'    => '?',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 38
				'nomor'         => '6-1000',
				'nama'          => 'Advertising Expenses',
				'keterangan'    => 'Beban Iklan',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 39
				'nomor'         => '6-1200',
				'nama'          => 'In Store Promotion Expenses',
				'keterangan'    => 'Beban Promosi Toko',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 40
				'nomor'         => '6-1210',
				'nama'          => 'Utility Expense',
				'keterangan'    => 'Beban lain lain',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 41
				'nomor'         => '6-1220',
				'nama'          => 'Telepon Expense',
				'keterangan'    => 'Beban Telepon',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 42
				'nomor'         => '6-2300',
				'nama'          => 'Rent Expense',
				'keterangan'    => 'Beban Sewa',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 43
				'nomor'         => '6-2400',
				'nama'          => 'Supplies Expenses',
				'keterangan'    => 'Beban Perlengkapan',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 44
				'nomor'         => '6-2500',
				'nama'          => 'Maintenance and Repair Expenses',
				'keterangan'    => 'Beban Reparasi',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 45
				'nomor'         => '6-2600',
				'nama'          => 'Bad Debt Expenses',
				'keterangan'    => 'Beban Kerugian Piutang',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 46
				'nomor'         => '6-2700',
				'nama'          => 'Depreciation Expenses',
				'keterangan'    => 'Beban Depresiasi Aktiva Tetap (Peralatan)',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 47
				'nomor'         => '6-2800',
				'nama'          => 'Insurance Expenses',
				'keterangan'    => 'Beban Asuransi',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 48
				'nomor'         => '6-2900',
				'nama'          => 'Late Fee Expenses',
				'keterangan'    => 'Beban Denda',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 49
				'nomor'         => '6-3100',
				'nama'          => 'Wages & Salaries Expenses',
				'keterangan'    => 'Beban Upah & Gaji',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 50
				'nomor'         => '8-1000',
				'nama'          => 'Interest Income',
				'keterangan'    => 'Pendapatan Bunga',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 51
				'nomor'         => '8-2000',
				'nama'          => 'Devidend Income',
				'keterangan'    => 'Pendapatan Bunga',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 52
				'nomor'         => '9-1000',
				'nama'          => 'Interest Expenses',
				'keterangan'    => 'Beban Bunga',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 53
				'nomor'         => '9-2000',
				'nama'          => 'Bank Service Charge',
				'keterangan'    => 'Beban Administrasi Bank',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 54
				'nomor'         => '9-3000',
				'nama'          => 'Income Taxt Expenses',
				'keterangan'    => 'Beban Pajak Penghasilan (PPh)',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				// 55
				'nomor'         => '9-4000',
				'nama'          => 'Gain/Loss Sales Vehicle',
				'keterangan'    => 'Laba Rugi Penjualan Kendaraan',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
		];
		DB::table('accounts')->truncate();
		DB::table('accounts')->insert($data);
	}
}
