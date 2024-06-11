<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .table-header {
            background-color: #4A5568; /* Warna latar belakang untuk header */
            color: #F7FAFC; /* Warna teks untuk header */
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6 text-center">Detail Transaksi</h1>
        <div class="bg-white shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4">
            <table class="w-full text-md text-left text-gray-500 dark:text-gray-400 border">
                <thead class="text-xs uppercase table-header">
                    <tr>
                        <th scope="col" class="px-6 py-4">Informasi</th>
                        <th scope="col" class="px-6 py-4">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Nomor Tabungan</td>
                        <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $detail->nomor_tabungan }}</td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Saldo Awal</td>
                        <td class="px-6 py-4 text-gray-900 dark:text-white">Rp {{ number_format($detail->saldo_awal, 2) }}</td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Saldo Akhir</td>
                        <td class="px-6 py-4 text-gray-900 dark:text-white">Rp {{ number_format($detail->saldo_akhir, 2) }}</td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Nominal</td>
                        <td class="px-6 py-4 text-gray-900 dark:text-white">Rp {{ number_format($detail->nominal, 2) }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="text-center mt-4">
                <a href="{{ url()->previous() }}" class="text-blue-500 hover:text-blue-800 inline-block">Kembali ke Daftar</a>
            </div>
        </div>
    </div>
</body>
</html>
