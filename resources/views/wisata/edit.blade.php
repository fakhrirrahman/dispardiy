<div class="container">
    <h2>Edit Wisata</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ url('wisata-alam/' . $wisata->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_wisata" class="form-label">Nama Wisata</label>
            <input type="text" class="form-control" id="nama_wisata" name="nama_wisata"
                value="{{ $wisata->nama_wisata }}">
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $wisata->alamat }}">
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi">{{ $wisata->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            @if($wisata->gambar_url)
            <div class="mb-2">
                <img src="{{ $wisata->gambar_url }}" alt="Gambar Wisata" width="200">
            </div>
            @endif
            <input type="file" class="form-control" id="gambar" name="gambar">
        </div>

        <div class="mb-3">
            <label for="jam_buka" class="form-label">Jam Buka</label>
            <input type="time" class="form-control" id="jam_buka" name="jam_buka" value="{{ $wisata->jam_buka }}">
        </div>

        <div class="mb-3">
            <label for="jam_tutup" class="form-label">Jam Tutup</label>
            <input type="time" class="form-control" id="jam_tutup" name="jam_tutup" value="{{ $wisata->jam_tutup }}">
        </div>

        <div class="mb-3">
            <label for="latitude" class="form-label">Latitude</label>
            <input type="text" class="form-control" id="latitude" name="latitude" value="{{ $wisata->latitude }}">
        </div>

        <div class="mb-3">
            <label for="longitude" class="form-label">Longitude</label>
            <input type="text" class="form-control" id="longitude" name="longitude" value="{{ $wisata->longitude }}">
        </div>

        <div class="mb-3">
            <label for="harga_tiket" class="form-label">Harga Tiket</label>
            <input type="number" class="form-control" id="harga_tiket" name="harga_tiket"
                value="{{ $wisata->harga_tiket }}">
        </div>

        <div class="mb-3">
            <label for="rating" class="form-label">Rating</label>
            <input type="number" step="0.1" class="form-control" id="rating" name="rating"
                value="{{ $wisata->rating }}">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>