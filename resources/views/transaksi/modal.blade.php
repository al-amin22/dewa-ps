<!-- Modal Tambah Transaksi -->
<div class="modal fade" id="tambahTransaksiModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-plus-circle me-2"></i>Tambah Data Baru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formTransaksi" method="POST" action="{{ route('transaksi.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Bulan & Tahun</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-calendar-alt"></i>
                                </span>
                                <input type="text" class="form-control bg-light" id="bulanTahunDisplay" readonly>
                            </div>
                            <input type="hidden" id="bulan" name="bulan">
                            <input type="hidden" id="tahun" name="tahun">
                        </div>
                        <div class="col-md-6">
                            <label for="siang" class="form-label">Pendapatan Siang</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="siang" name="siang" value="0" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="malam" class="form-label">Pendapatan Malam</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="malam" name="malam" value="0" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="jumlah" class="form-label">Total Pendapatan</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control bg-light" id="jumlah" name="jumlah" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Transaksi -->
<div class="modal fade" id="editTransaksiModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title">
                    <i class="fas fa-edit me-2"></i>Edit Data
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditTransaksi" method="POST" action="('transaksi.update', ['transaksi' => $item->id])">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="edit_tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="edit_tanggal" name="tanggal" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Bulan & Tahun</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-calendar-alt"></i>
                                </span>
                                <input type="text" class="form-control bg-light" id="edit_bulanTahunDisplay" readonly>
                            </div>
                            <input type="hidden" id="edit_bulan" name="bulan">
                            <input type="hidden" id="edit_tahun" name="tahun">
                        </div>
                        <div class="col-md-6">
                            <label for="edit_siang" class="form-label">Pendapatan Siang</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="edit_siang" name="siang" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_malam" class="form-label">Pendapatan Malam</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="edit_malam" name="malam" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="edit_jumlah" class="form-label">Total Pendapatan</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control bg-light" id="edit_jumlah" name="jumlah" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save me-1"></i> Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Hapus Pengeluaran -->
<div class="modal fade" id="hapusTransaksiModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="fas fa-trash-alt me-2"></i>Hapus Pemasukan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus Pemasukan ini?</p>
            </div>
            <div class="modal-footer">
                <form id="formHapusPengeluaran" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function deleteTransaksi(id) {
        const form = document.getElementById('formHapusPengeluaran');
        form.action = `/transaksi/${id}`;
        const modal = new bootstrap.Modal(document.getElementById('hapusTransaksiModal'));
        modal.show();
    }
</script>


<script>
    // Tanggal change handler untuk form tambah
    document.getElementById('tanggal').addEventListener('change', function() {
        const tanggal = new Date(this.value);
        const bulan = tanggal.getMonth() + 1;
        const tahun = tanggal.getFullYear();

        document.getElementById('bulan').value = bulan;
        document.getElementById('tahun').value = tahun;

        const namaBulan = new Intl.DateTimeFormat('id-ID', {
            month: 'long'
        }).format(tanggal);
        document.getElementById('bulanTahunDisplay').value = `${namaBulan} ${tahun}`;

        hitungJumlah();
    });

    // Tanggal change handler untuk form edit
    document.getElementById('edit_tanggal').addEventListener('change', function() {
        const tanggal = new Date(this.value);
        const bulan = tanggal.getMonth() + 1;
        const tahun = tanggal.getFullYear();

        document.getElementById('edit_bulan').value = bulan;
        document.getElementById('edit_tahun').value = tahun;

        const namaBulan = new Intl.DateTimeFormat('id-ID', {
            month: 'long'
        }).format(tanggal);
        document.getElementById('edit_bulanTahunDisplay').value = `${namaBulan} ${tahun}`;

        hitungEditJumlah();
    });

    // Hitung jumlah untuk form tambah
    function hitungJumlah() {
        const siang = parseInt(document.getElementById('siang').value) || 0;
        const malam = parseInt(document.getElementById('malam').value) || 0;
        document.getElementById('jumlah').value = siang + malam;
    }

    // Hitung jumlah untuk form edit
    function hitungEditJumlah() {
        const siang = parseInt(document.getElementById('edit_siang').value) || 0;
        const malam = parseInt(document.getElementById('edit_malam').value) || 0;
        document.getElementById('edit_jumlah').value = siang + malam;
    }

    // Edit Transaksi
    function editTransaksi(id) {
        fetch(`/transaksi/${id}`)
            .then(response => response.json())
            .then(data => {
                const tanggal = new Date(data.tanggal);
                const namaBulan = new Intl.DateTimeFormat('id-ID', {
                    month: 'long'
                }).format(tanggal);

                // Set form values
                document.getElementById('edit_tanggal').value = data.tanggal;
                document.getElementById('edit_bulan').value = data.bulan;
                document.getElementById('edit_tahun').value = data.tahun;
                document.getElementById('edit_bulanTahunDisplay').value = `${namaBulan} ${data.tahun}`;
                document.getElementById('edit_siang').value = data.siang;
                document.getElementById('edit_malam').value = data.malam;
                document.getElementById('edit_jumlah').value = data.jumlah;

                // Set form action
                document.getElementById('formEditTransaksi').action = `/transaksi/${id}`;

                // Show modal
                new bootstrap.Modal(document.getElementById('editTransaksiModal')).show();
            });
    }
</script>