<div class="card">
    <div class="card-header">
        <h4>Upload Gambar</h4>
    </div>
    <div class="card-body">
        <div class="mt-1">
            <img style="height: 250px; object-fit: cover" class="w-100 rounded-lg" id="image-view"
                 src="{{ $imageUrl }}" alt="/">
        </div>
        <input type="file" accept="image/png, image/jpg, image/jpeg" class="d-none form-control" name="image"
               id="image">
        <div class="mt-2">
            <label for="image" class="btn btn-primary w-100 cursor-pointer">Upload Gambar Barang</label>
        </div>
        <div class="mt-2">
            <p class="text-small mb-0">Besar file: maksimum 2 Megabytes. Ekstensi file yang
                diperbolehkan: .JPG .JPEG .PNG
            </p>
            <div class="invalid-feedback"></div>
        </div>
    </div>
</div>
