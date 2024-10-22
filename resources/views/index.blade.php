@extends('components.layout')
@section('content')
    <div class="container mt-5">
        <!-- Tombol Create -->
        <div class="mb-3">
            <a href="{{ route('create') }}" class="btn btn-primary">
                Create
            </a>
        </div>
        <form action="{{route('search')}}" method="GET">
            @csrf
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari buku" name="search">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
            </div>
        @if (@session('status'))
            <script>
                alert('{{ session('status') }}');
            </script>
        @endif
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Penulis</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Tanggal Terbit</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Looping data -->
                @php $no = 1; @endphp <!-- Inisialisasi variabel nomor -->
                @foreach ($books as $book)
                <tr>
                    <th scope="row">{{ $no++ }}</th> <!-- Nomor bertambah secara otomatis -->
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ "Rp" . number_format($book->harga, 2, ',', '.') }}</td>
                    <td>{{ $book->tanggal_terbit }}</td>
                    <td>
                        <!-- Form untuk Delete -->
                        <form action="{{ route('destroy', $book->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                        <!-- Tombol Edit -->
                        <a href="{{ route('edit', $book->id) }}" class="btn btn-info btn-sm">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Bagian untuk menampilkan total buku dan total harga -->
        <div class="mt-3 p-3 bg-light">
            <p class="h5">Total Buku: {{ $totalBooks }}</p>
            <p class="h5">Total Harga Buku: Rp{{ number_format($totalHarga, 2, ',', '.') }}</p>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $books->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
