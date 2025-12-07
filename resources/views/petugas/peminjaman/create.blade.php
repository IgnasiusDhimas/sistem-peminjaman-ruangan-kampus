@extends('layouts.app')

@section('content')
<style>
    .create-container {
        max-width: 1000px;
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
        background: linear-gradient(to right, #10b981, transparent);
        border: none;
        margin: 25px 0;
    }
    
    .form-card {
        background-color: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }
    
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-bottom: 20px;
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
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }
    
    .form-input::placeholder {
        color: #9ca3af;
    }
    
    .time-group {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    
    .form-actions {
        display: flex;
        gap: 15px;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #e5e7eb;
    }
    
    .submit-button {
        background-color: #10b981;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .submit-button:hover {
        background-color: #059669;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(16, 185, 129, 0.2);
    }
    
    .cancel-button {
        background-color: white;
        color: #4b5563;
        border: 2px solid #d1d5db;
        padding: 10px 22px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .cancel-button:hover {
        background-color: #f3f4f6;
        border-color: #9ca3af;
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
        
        .form-row {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        .time-group {
            grid-template-columns: 1fr;
            gap: 15px;
        }
        
        .form-title {
            font-size: 20px;
        }
        
        .form-actions {
            flex-direction: column;
        }
        
        .submit-button, .cancel-button {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="create-container">
    <!-- Header -->
    <div class="form-header">
        <h1 class="form-title">Buat Peminjaman Baru</h1>
        <p class="form-subtitle">Isi formulir di bawah ini untuk membuat peminjaman ruangan</p>
    </div>

    <div class="form-card">
        <form action="{{ route('petugas.peminjaman.store') }}" method="POST">
            @csrf

            <div class="form-row">
                <!-- Left Column -->
                <div>
                    <!-- Gedung -->
                    <div class="form-group">
                        <label class="form-label">Pilih Gedung <span>*</span></label>
                        <select name="gedung_id" class="form-select" id="gedungSelect" required>
                            <option value="">-- Pilih Gedung --</option>
                            @foreach ($gedung as $g)
                                <option value="{{ $g->id }}">{{ $g->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Ruangan -->
                    <div class="form-group">
                        <label class="form-label">Pilih Ruangan <span>*</span></label>
                        <select name="ruang_id" class="form-select" id="ruangSelect" required>
                            <option value="">-- Pilih Ruangan --</option>
                        </select>
                        <div class="info-hint">Pilih gedung terlebih dahulu untuk melihat daftar ruangan</div>
                    </div>

                    <!-- Tanggal -->
                    <div class="form-group">
                        <label class="form-label">Tanggal <span>*</span></label>
                        <input type="date" name="tanggal" class="form-input" required>
                    </div>
                </div>

                <!-- Right Column -->
                <div>
                    <!-- Waktu -->
                    <div class="form-group">
                        <label class="form-label">Waktu Peminjaman <span>*</span></label>
                        <div class="time-group">
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

                    <!-- Keperluan -->
                    <div class="form-group">
                        <label class="form-label">Keperluan <span>*</span></label>
                        <textarea name="keperluan" class="form-textarea" rows="5" placeholder="Jelaskan tujuan peminjaman ruangan..." required></textarea>
                    </div>
                </div>
            </div>

            <!-- Catatan -->
            <div class="form-group">
                <label class="form-label">Catatan Tambahan</label>
                <textarea name="catatan" class="form-textarea" rows="3" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                <div class="info-hint">Opsional</div>
            </div>

            <!-- Actions -->
            <div class="form-actions">
                <button type="submit" class="submit-button">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/>
                        <path d="M17 21v-8H7v8M7 3v5h8"/>
                    </svg>
                    Simpan Peminjaman
                </button>
                
                <a href="{{ route('petugas.peminjaman.index') }}" class="cancel-button">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('gedungSelect').addEventListener('change', function() {
        const gedungId = this.value;

        fetch('{{ url("ajax/ruang") }}/' + gedungId)
            .then(res => res.json())
            .then(data => {
                let options = '<option value="">-- Pilih Ruangan --</option>';

                data.forEach(r => {
                    options += `<option value="${r.id}">
                        ${r.nama} (Kapasitas: ${r.kapasitas} orang)
                    </option>`;
                });

                document.getElementById('ruangSelect').innerHTML = options;
            });
    });
</script>
@endsection