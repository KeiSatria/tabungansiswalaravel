@if (session('error'))
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
    <strong class="font-bold">Error!</strong>
    <span class="block sm:inline">{{ session('error') }}</span>
</div>
@endif
@if (session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
    <strong class="font-bold">Success!</strong>
    <span class="block sm:inline">{{ session('success') }}</span>
</div>
@endif
<!DOCTYPE html>
<html>
<head>
    <title>Form Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md mt-10">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Form Transaksi</h2>
        <form action="{{ route('transaksi') }}" method="post">
            @csrf
            <div class="mb-4">
                <label for="nomor_tabungan" class="block text-gray-700">Nomor Tabungan</label>
                <input type="text" name="nomor_tabungan" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="{{ $tabungan->nomor_tabungan }}" readonly>
            </div>
            <div class="mb-4">
                <label for="saldo" class="block text-gray-700">Saldo</label>
                <input type="text" name="saldo" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="{{ $tabungan->saldo }}" readonly>
            </div>
            <div class="mb-4">
                <label for="histori" class="block text-gray-700">Tipe Transaksi</label>
                <select name="histori" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="Penyetoran">Penyetoran</option>
                    <option value="Penarikan">Penarikan</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="nominal" class="block text-gray-700">Nominal</label>
                <input type="number" name="nominal" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" min="0">
            </div>
            <div class="flex justify-between items-center">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Submit</button>
                <a href="{{ route('admin.tabungan') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>
