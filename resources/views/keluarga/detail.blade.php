@extends('layouts.app')

@section('title', 'Data Keluarga BSK')

@section('content')
    
    <link rel="stylesheet" href="{{ asset('css/detail-keluarga.css') }}">

    <div class="card card-keluarga mb-4">
        <div class="card-header">
            <h5 class="mb-0">Detail Keluarga BSK</h5>
        </div>

        <div class="card-body">
            <div class="row mb-2">
                <div class="col-sm-4 label">No BSK</div>
                <div class="col-sm-8 value">{{ $keluarga->no_bsk }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-sm-4 label">Nama Kepala Keluarga</div>
                <div class="col-sm-8 value">{{ $keluarga->nama_kk }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-sm-4 label">Alamat</div>
                <div class="col-sm-8 value">{{ $keluarga->alamat }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-sm-4 label">RT / RW</div>
                <div class="col-sm-8 value">{{ $keluarga->rt_rw }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-sm-4 label">Status</div>
                <div class="col-sm-8 value">
                    <span class="badge {{ $keluarga->status === 'aktif' ? 'bg-success' : 'bg-secondary' }}">
                        {{ ucfirst($keluarga->status) }}
                    </span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 label">Total Jiwa</div>
                <div class="col-sm-8 value">
                    <strong>{{ $keluarga->jiwa }} Orang</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Daftar Tanggungan</h4>
        <button class="btn btn-primary" onclick="openTambahModal()">
            Tambah Tanggungan
        </button>
    </div>

    <table>
    <tr>
        <th class="text-center">Nama</th>
        <th class="text-center">Hubungan</th>
        <th class="text-center">Status</th>
        <th class="text-center">Aksi</th>
    </tr>

    @foreach ($keluarga->tanggungan as $t)
    <tr>
        <td>{{ $t->nama_tanggungan }}</td>
        <td>{{ $t->hubungan }}</td>
        <td class="text-center">
            <span class="{{ $t->status == 'Meninggal' ? 'text-danger' : 'text-success' }}">
                {{ $t->status }}
            </span>
        </td>
        <td class="text-center">
            <a href="#"
                class="btn btn-sm btn-warning"
                onclick="openEditModal(
                        '{{ $t->id }}',
                        '{{ $t->nama_tanggungan }}',
                        '{{ $t->hubungan }}',
                        '{{ $t->status }}'
                )">
                <i class="bi bi-pencil-square"></i>
            </a>
            <!-- MODAL EDIT TANGGUNGAN -->
            <div id="editModal" class="modal-overlay">
                <div class="modal-box">
                    <h3>Edit Tanggungan</h3>

                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="text" name="nama_tanggungan" id="editNama" required>

                        <select name="hubungan" id="editHubungan" required>
                            <option value="Kepala Keluarga">Kepala Keluarga</option>
                            <option value="Istri">Istri</option>
                            <option value="Anak">Anak</option>
                            <option value="Orang Tua">Orang Tua</option>
                        </select>

                        <select name="status" id="editStatus" required>
                            <option value="Hidup">Hidup</option>
                            <option value="Meninggal">Meninggal</option>
                        </select>

                        <div class="modal-action">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" onclick="closeEditModal()" class="btn btn-secondary">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
            <script>
                function openEditModal(id, nama, hubungan, status) {
                    document.getElementById('editModal').style.display = 'flex';

                    document.getElementById('editNama').value = nama;
                    document.getElementById('editHubungan').value = hubungan;
                    document.getElementById('editStatus').value = status;

                    let form = document.getElementById('editForm');
                    form.action = action="{{ route('tanggungan.update', [$keluarga->no_bsk, $t->id]) }}";
                }

                function closeEditModal() {
                    document.getElementById('editModal').style.display = 'none';
                }
            </script>            

            <form action="{{ route('tanggungan.destroy', [$keluarga->no_bsk, $t->id]) }}"
                    method="POST" style="display:inline">
                    @csrf   
                    @method('DELETE')
                    <button onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <br>
    
    <div id="tambahModal" class="modal-overlay">
        <div class="modal-box">
            <h3>Tambah Tanggungan</h3>

            <p>
                <strong>No BSK:</strong> {{ $keluarga->no_bsk }} <br>
                <strong>Kepala Keluarga:</strong> {{ $keluarga->nama_kk }}
            </p>

            @if ($errors->any())
                <ul style="color:red">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            @endif

            <form action="{{ route('tanggungan.store', $keluarga->no_bsk) }}" method="POST">
                @csrf

                <div id="wrapper">
                    <div class="row-input">
                        <input type="text" name="nama_tanggungan[]" placeholder="Nama Tanggungan" required>

                        <select name="hubungan[]" required>
                            <option value="Istri">Istri</option>
                            <option value="Anak">Anak</option>
                            <option value="Adik">Adik</option>
                            <option value="Orang Tua">Orang Tua</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>

                        <select name="status[]" required>
                            <option value="Hidup" selected>Hidup</option>
                            <option value="Meninggal">Meninggal</option>
                        </select>
                    </div>
                </div>

                <br>

                <button type="button" onclick="tambahInput()">+ Tambah Input</button>

                <div class="modal-action">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" onclick="closeTambahModal()" class="btn btn-secondary">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function openTambahModal() {
            document.getElementById('tambahModal').style.display = 'flex';
        }

        function closeTambahModal() {
            document.getElementById('tambahModal').style.display = 'none';
        }

        function tambahInput() {
            const div = document.createElement('div');
            div.classList.add('row-input');

            div.innerHTML = `
                <input type="text" name="nama_tanggungan[]" placeholder="Nama Tanggungan" required>

                <select name="hubungan[]" required>
                    <option value="Istri">Istri</option>
                    <option value="Anak">Anak</option>
                    <option value="Adik">Adik</option>
                    <option value="Orang Tua">Orang Tua</option>
                    <option value="Lainnya">Lainnya</option>
                </select>

                <select name="status[]" required>
                    <option value="Hidup" selected>Hidup</option>
                    <option value="Meninggal">Meninggal</option>
                </select>
            `;

            document.getElementById('wrapper').appendChild(div);
        }
        </script>


    <a href="{{ route('keluarga.index') }}" class="btn btn-secondary">Kembali</a>
    
@endsection