@extends('layouts.app')

@section('title', 'Master Data Barang - Inventori TB JWP')

@section('page-header')
<div class="iq-navbar-header" style="height: 215px;">
    <div class="container-fluid iq-container">
        <div class="row">
            <div class="col-md-12">
                <div class="flex-wrap d-flex justify-content-between align-items-center text-white">
                    <div>
                        <h1>Daftar Barang</h1>
                        <p>Kelola data material, satuan, beserta batas minimum stok gudang.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="iq-header-img">
        <img src="{{ asset('hope-ui/assets/images/dashboard/top-header.png') }}" alt="header" class="theme-color-default-img img-fluid w-100 h-100 object-cover">
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-sm-12">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span>{{ session('success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="header-title">
                        <h4 class="card-title">Data Persediaan Barang</h4>
                    </div>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createProductModal">
                        + Tambah Barang
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Kode</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Stok</th>
                                    <th>Satuan</th>
                                    <th>Status</th>
                                    <th width="15%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $key => $product)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><code class="text-primary">{{ $product->code }}</code></td>
                                    <td><strong>{{ $product->name }}</strong></td>
                                    <td>{{ $product->category->name ?? '-' }}</td>
                                    <td>{{ number_format($product->stock) }}</td>
                                    <td><span class="badge bg-light text-dark">{{ $product->unit }}</span></td>
                                    <td>
                                        @if($product->stock_status === 'Akan Habis')
                                        <span class="badge bg-danger">Akan Habis</span>
                                        @else
                                        <span class="badge bg-success">Aman</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <button type="button" class="btn btn-warning btn-sm text-white" data-bs-toggle="modal" data-bs-target="#editProductModal{{ $product->id }}">
                                                Edit
                                            </button>

                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('products.update', $product->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Ubah Data Barang</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                                        <select name="category_id" class="form-select" required>
                                                            @foreach($categories as $category)
                                                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                                {{ $category->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label class="form-label">Kode Barang <span class="text-danger">*</span></label>
                                                            <input type="text" name="code" class="form-control" value="{{ $product->code }}" required>
                                                        </div>
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label class="form-label">Satuan <span class="text-danger">*</span></label>
                                                            <input type="text" name="unit" class="form-control" value="{{ $product->unit }}" placeholder="Contoh: Pcs, Lembar, Dus" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Nama Barang <span class="text-danger">*</span></label>
                                                        <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label class="form-label">Stok Awal <span class="text-danger">*</span></label>
                                                            <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" min="0" required>
                                                        </div>
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label class="form-label">Minimal Stok <span class="text-danger">*</span></label>
                                                            <input type="number" name="minimum_stock" class="form-control" value="{{ $product->minimum_stock }}" min="0" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Deskripsi</label>
                                                        <textarea name="description" class="form-control" rows="3">{{ $product->description }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary btn-sm">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-3">Belum ada data barang. Silakan tambahkan kategori terlebih dahulu sebelum mengisi barang.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="createProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Barang Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select name="category_id" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label class="form-label">Kode Barang <span class="text-danger">*</span></label>
                            <input type="text" name="code" class="form-control" placeholder="Contoh: BRG-001" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="form-label">Satuan <span class="text-danger">*</span></label>
                            <input type="text" name="unit" class="form-control" placeholder="Contoh: Sak, Pcs, Batang" required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Nama Barang <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Masukkan nama barang..." required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label class="form-label">Stok Awal <span class="text-danger">*</span></label>
                            <input type="number" name="stock" class="form-control" value="0" min="0" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="form-label">Minimal Stok <span class="text-danger">*</span></label>
                            <input type="number" name="minimum_stock" class="form-control" value="10" min="0" required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Masukkan detail keterangan barang (opsional)..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection