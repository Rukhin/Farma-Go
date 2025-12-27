<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Stok Obat</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { text-align: center; color: #333; margin-bottom: 30px; }
        .info { margin-bottom: 20px; font-size: 12px; }
        .info p { margin: 3px 0; }
        .summary-cards { display: flex; gap: 10px; margin: 20px 0; flex-wrap: wrap; }
        .summary-card { flex: 1; min-width: 150px; padding: 10px; background: #f5f5f5; border: 1px solid #ddd; }
        .summary-card p { margin: 3px 0; font-size: 11px; }
        .summary-card strong { font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; font-size: 11px; }
        th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
        th { background: #8b5cf6; color: white; font-weight: bold; }
        tr:nth-child(even) { background: #f5f5f5; }
        .text-right { text-align: right; }
        .status { padding: 3px 8px; border-radius: 3px; font-size: 10px; font-weight: bold; }
        .status.normal { background: #d1fae5; color: #065f46; }
        .status.low { background: #fef3c7; color: #92400e; }
        .status.empty { background: #fee2e2; color: #991b1b; }
        .footer { text-align: center; margin-top: 30px; font-size: 10px; color: #666; }
    </style>
</head>
<body>
    <h1>LAPORAN STOK OBAT</h1>

    <div class="info">
        <p><strong>Tanggal Cetak:</strong> {{ now()->format('d/m/Y H:i:s') }}</p>
    </div>

    <div class="summary-cards">
        <div class="summary-card">
            <p>Total Obat</p>
            <strong>{{ $summary['total_medicines'] }}</strong>
        </div>
        <div class="summary-card">
            <p>Stok Normal</p>
            <strong>{{ $summary['total_medicines'] - $summary['below_minimum'] - $summary['out_of_stock'] }}</strong>
        </div>
        <div class="summary-card">
            <p>Stok Rendah</p>
            <strong>{{ $summary['below_minimum'] }}</strong>
        </div>
        <div class="summary-card">
            <p>Stok Habis</p>
            <strong>{{ $summary['out_of_stock'] }}</strong>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Obat</th>
                <th>Kategori</th>
                <th class="text-right">Stok</th>
                <th class="text-right">Min</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($medicines as $medicine)
                <tr>
                    <td>{{ $medicine->code }}</td>
                    <td>{{ $medicine->name }}</td>
                    <td>{{ $medicine->category?->name ?? '-' }}</td>
                    <td class="text-right">{{ $medicine->stock }}</td>
                    <td class="text-right">{{ $medicine->min_stock }}</td>
                    <td>
                        @if($medicine->stock == 0)
                            <span class="status empty">Habis</span>
                        @elseif($medicine->stock < $medicine->min_stock)
                            <span class="status low">Rendah</span>
                        @else
                            <span class="status normal">Normal</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 20px;">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Laporan ini dicetak secara otomatis oleh sistem</p>
        <p>APOTEK POS - {{ now()->format('Y') }}</p>
    </div>
</body>
</html>
