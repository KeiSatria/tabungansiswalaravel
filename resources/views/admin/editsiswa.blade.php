<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Data</title>
	<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
	<style>
	
	
	</style>
</head>

<body class="bg-gray-900">
	<div class="container mx-auto mt-10 max-w-lg bg-gray-800 p-6 rounded-lg shadow-lg">
		<div class="bg-white shadow-lg rounded-lg">
			<div class="bg-blue-500 text-white text-center py-4 rounded-t-lg">
				<h2 class="text-2xl font-bold">Edit Data</h2>
			</div>
			<div class="p-6">
				<div class="mb-4">
					<a href="/admin/siswa"
						class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded inline-block transition duration-300">Kembali</a>
				</div>

				@foreach($siswa as $p)
					<form action="/admin/siswa/update" method="post">
						{{ csrf_field() }}
						<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<input type="hidden" name="id" value="{{ $p->nisn }}">
						<div class="mb-4">
							<label for="nisn" class="block text-gray-700 font-bold mb-2">Nisn</label>
							<input type="text" id="nisn" name="nisn"
								class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
								required value="{{ $p->nisn }}">
						</div>
						<div class="mb-4">
							<label for="nama" class="block text-gray-700 font-bold mb-2">Nama</label>
							<input type="text" id="nama" name="nama"
								class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
								required value="{{ $p->nama }}">
						</div>
						<div class="mb-4">
							<label for="tanggal_lahir" class="block text-gray-700 font-bold mb-2">Tanggal Lahir</label>
							<input type="date" id="tanggal_lahir" name="tanggal_lahir"
								class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
								required value="{{ $p->tanggal_lahir }}">
						</div>
						<div class="mb-4">
							<label for="nomor_telepon" class="block text-gray-700 font-bold mb-2">Nomor Telepon</label>
							<input type="text" id="nomor_telepon" name="nomor_telepon"
								class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
								value="{{ $p->nomor_telepon }}">
						</div>
						<div class="mb-4 flex justify-center">
							<button type="submit" name="submit"
								class="w-full bg-blue-300 hover:bg-blue-400 text-blue-800 font-semibold py-2 px-4 rounded transition"
								value="Simpan Data"
								onclick="return confirm('Apakah Anda Ingin Mengubah Data Ini?') && showNotification()">Simpan</button>
						</div>

					</form>
				@endforeach
			</div>
		</div>
	</div>
	</div>
	<script>
		function showNotification() {
			var notificationMessage = "Data berhasil diubah!";
			localStorage.setItem("notificationMessage", notificationMessage);
		}

		window.onload = function () {
			var notificationMessage = localStorage.getItem("notificationMessage");
			if (notificationMessage) {
				alert(notificationMessage);
				localStorage.removeItem("notificationMessage");
			}
		};
	</script>
</body>

</html>
