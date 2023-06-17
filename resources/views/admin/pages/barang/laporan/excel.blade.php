<table class="table table-bordered  table-md">
    <thead>
    <tr>
        <th>No</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Tanggal Masuk/Keluar/Retur</th>
        <th>Tipe</th>
    </tr>
    </thead>
    <tbody>
    @forelse($products as $product)
        <tr>
            <td>{{ $loop->index }}</td>
            <td>{{ $product->code }}</td>
            <td>{{ $product->product['name'] }}</td>
            <td>{{ formatRupiah($product->price) }}</td>
            <td>{{ $product->quantity }}</td>
            <td>{{ $product->date->format('F j, Y') }}</td>
            <td>{{ $product->getType() }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="6">
                <p class="text-center"><em>There is no record.</em></p>
            </td>
        </tr>
    @endforelse
    <tr>
        <td colspan="3"></td>
        <td>{{ formatRupiah($products->sum('price')) }}</td>
        <td>{{ $products->sum('quantity') }}</td>
    </tr>
    </tbody>
</table>
