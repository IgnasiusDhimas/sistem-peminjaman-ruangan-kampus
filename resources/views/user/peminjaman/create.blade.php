@extends('layouts.app')

@section('content')
<style>
    .create-container {
        max-width: 700px;
        margin: 0 auto;
        padding: 20px;
    }
    
    .form-header {
        margin-bottom: 30px;
    }
    
    .form-title {
        font-size: 24px;
        font-weight: 600;
        color: #1e293b;
        margin: 0 0 10px 0;
    }
    
    .form-subtitle {
        color: #64748b;
        font-size: 14px;
    }
    
    .form-divider {
        height: 2px;
        background: linear-gradient(to right, #3b82f6, transparent);
        border: none;
        margin: 25px 0;
    }
    
    .error-alert {
        background-color: #fee2e2;
        color: #991b1b;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 25px;
        border-left: 4px solid #dc2626;
    }
    
    .error-list {
        margin: 0;
        padding-left: 20px;
    }
    
    .error-list li {
        margin-bottom: 5px;
        font-size: 14px;
    }
    
    .form-card {
        background-color: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }
    
    .form-group {
        margin-bottom: 25px;
    }
    
    .form-label {
        display: block;
        font-weight: 500;
        margin-bottom: 8px;
        color: #374151;
        font-size: 14px;
    }
    
    .form-label span {
        color: #ef4444;
    }
    
    .form-input, .form-select, .form-textarea {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 15px;
        transition: all 0.2s;
    }
    
    .form-input:focus, .form-select:focus, .form-textarea:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    .form-input::placeholder {
        color: #9ca3af;
    }
    
    .time-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    
    .submit-button {
        width: 100%;
        padding: 14px;
        background-color: #3b82f6;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        margin-top: 10px;
    }
    
    .submit-button:hover {
        background-color: #2563eb;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(37, 99, 235, 0.2);
    }
    
    .submit-button:active {
        transform: translateY(0);
    }
    
    .info-hint {
        font-size: 12px;
        color: #6b7280;
        margin-top: 5px;
        font-style: italic;
    }
    
    @media (max-width: 768px) {
        .create-container {
            padding: 15px;
        }
        
        .form-card {
            padding: 20px;
        }
        
        .time-row {
            grid-template-columns: 1fr;
            gap: 15px;
        }
        
        .form-title {
            font-size: 20px;
        }
    }
</style>

<div class="create-container">
    <!-- Header -->
    <div class="form-header">
        <h1 class="form-title">Ajukan Peminjaman Ruangan</h1>
        <p class="form-subtitle">Isi formulir di bawah ini untuk mengajukan peminjaman ruangan</p>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="error-alert">
            <ul class="error-list">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-card">
        <form method="POST" action="{{ route('user.peminjaman.store') }}">
            @csrf

            <!-- Gedung -->
            <div class="form-group">
                <label class="form-label">Gedung <span>*</span></label>
                <select name="gedung_id" id="gedung" class="form-select" required>
                    <option value="">-- Pilih Gedung --</option>
                    @foreach ($gedungs as $g)
                        <option value="{{ $g->id }}">{{ $g->nama }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Ruang -->
            <div class="form-group">
                <label class="form-label">Ruangan <span>*</span></label>
                <select name="ruang_id" id="ruang" class="form-select" required>
                    <option value="">-- Pilih Ruangan --</option>
                </select>
                <div class="info-hint">Pilih gedung terlebih dahulu untuk melihat daftar ruangan</div>
            </div>

            <!-- Divider -->
            <hr class="form-divider">

            <!-- Tanggal -->
            <div class="form-group">
                <label class="form-label">Tanggal Peminjaman <span>*</span></label>
                <input type="date" name="tanggal" class="form-input" required>
            </div>

            <!-- Jam -->
            <div class="form-group">
                <label class="form-label">Waktu Peminjaman <span>*</span></label>
                <div class="time-row">
                    <div>
                        <label class="form-label">Jam Mulai</label>
                        <input type="time" name="jam_mulai" class="form-input" required>
                    </div>
                    <div>
                        <label class="form-label">Jam Selesai</label>
                        <input type="time" name="jam_selesai" class="form-input" required>
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <hr class="form-divider">

            <!-- Keperluan -->
            <div class="form-group">
                <label class="form-label">Keperluan <span>*</span></label>
                <input type="text" name="keperluan" class="form-input" placeholder="Contoh: Rapat, Presentasi, Seminar, dll" required>
            </div>

            <!-- Catatan -->
            <div class="form-group">
                <label class="form-label">Catatan Tambahan</label>
                <textarea name="catatan" class="form-textarea" rows="3" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                <div class="info-hint">Opsional</div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="submit-button">
                Ajukan Peminjaman
            </button>
        </form>
    </div>
</div>

<script>
// AJAX load ruang berdasarkan gedung
document.getElementById('gedung').addEventListener('change', function() {
    let gId = this.value;

    fetch("{{ url('ajax/ruangan') }}?gedung_id=" + gId)
        .then(res => res.json())
        .then(data => {
            let ruangSelect = document.getElementById('ruang');
            ruangSelect.innerHTML = '<option value="">-- Pilih Ruangan --</option>';

            data.forEach(r => {
                ruangSelect.innerHTML += `<option value="${r.id}">
                    ${r.nama} (Kapasitas: ${r.kapasitas} orang)
                </option>`;
            });

        });
});
</script>
@endsection