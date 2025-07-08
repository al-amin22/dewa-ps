{{-- Modal Tambah Pengeluaran --}}
<div class="modal fade" id="tambahPengeluaranModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-plus-circle me-2"></i>Tambah Pengeluaran Baru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formPengeluaran" method="POST" action="{{ route('pengeluaran.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="tglPengeluaran" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tglPengeluaran" name="tanggal" required>
                        </div>
                        <div class="col-md-6">
                            <label for="ketPengeluaran" class="form-label">Keterangan</label>
                            <input type="text" class="form-control" id="ketPengeluaran" name="keterangan" required>
                        </div>
                        <div class="col-md-12">
                            <label for="jmlPengeluaran" class="form-label">Jumlah</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="jmlPengeluaran" name="jumlah" min="0" value="0" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit Pengeluaran --}}
<div class="modal fade" id="editPengeluaranModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title">
                    <i class="fas fa-edit me-2"></i>Edit Pengeluaran
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formEditPengeluaran" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="edit_tglPengeluaran" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="edit_tglPengeluaran" name="tanggal" required>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_ketPengeluaran" class="form-label">Keterangan</label>
                            <input type="text" class="form-control" id="edit_ketPengeluaran" name="keterangan" required>
                        </div>
                        <div class="col-md-12">
                            <label for="edit_jmlPengeluaran" class="form-label">Jumlah</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="edit_jmlPengeluaran" name="jumlah" min="0" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Hapus Pengeluaran --}}
<div class="modal fade" id="hapusPengeluaranModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="fas fa-trash-alt me-2"></i>Hapus Pengeluaran</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus pengeluaran ini?</p>
            </div>
            <div class="modal-footer">
                <form id="formHapusTransaksi" method="POST">
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
    let deleteId = null;

    function deletePengeluaran(id) {
        deleteId = id;
        const form = document.getElementById('formHapusPengeluaran');
        form.action = `/pengeluaran/${id}`;
        new bootstrap.Modal(document.getElementById('hapusPengeluaranModal')).show();
    }
</script>
