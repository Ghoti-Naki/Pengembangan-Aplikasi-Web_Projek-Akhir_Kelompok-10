<!DOCTYPE html>
<html>
<head>
    <title>Undangan Kegiatan</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; line-height: 1.6;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px;">
        <h2 style="color: #4f46e5; text-align: center;">SpaceFlow Invitation</h2>
        
        <p>Halo Rekan Mahasiswa/Dosen,</p>
        <p>Anda diundang untuk menghadiri kegiatan berikut:</p>
        
        <div style="background-color: #f9fafb; padding: 15px; border-radius: 8px; margin: 20px 0;">
            <p><strong>🏷 Nama Kegiatan:</strong><br> {{ $booking->purpose }}</p>
            <p><strong>📍 Lokasi:</strong><br> {{ $booking->room->name }} ({{ $booking->room->room_code }})</p>
            <p><strong>📅 Waktu:</strong><br> 
                {{ \Carbon\Carbon::parse($booking->start_time)->translatedFormat('l, d F Y') }}<br>
                Pukul {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }} WIB
            </p>
        </div>

        <p>Mohon kehadirannya tepat waktu. Terima kasih.</p>
        
        <hr style="border: none; border-top: 1px solid #eee; margin: 20px 0;">
        <p style="font-size: 12px; color: #888; text-align: center;">
            Email ini dikirim otomatis oleh Sistem SpaceFlow.
        </p>
    </div>
</body>
</html>