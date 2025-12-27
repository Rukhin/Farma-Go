<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { text-align: center; color: #333; margin-bottom: 30px; }
        .info { margin-bottom: 20px; font-size: 12px; }
        .info p { margin: 3px 0; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; font-size: 11px; }
        th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
        th { background: #10b981; color: white; font-weight: bold; }
        tr:nth-child(even) { background: #f5f5f5; }
        .text-right { text-align: right; }
        .summary { margin: 20px 0; padding: 10px; background: #f0f0f0; border-left: 4px solid #10b981; }
        .summary p { margin: 5px 0; font-weight: bold; }
        .footer { text-align: center; margin-top: 30px; font-size: 10px; color: #666; }
    </style>
</head>
<body>
    <h1>LAPORAN PENJUALAN OBAT</h1>

    <div class="info">
        <p><strong>Periode:</strong> {{ $startDate->format('d/m/Y') }} - {{ $endDate->format('d/m/Y') }}</p>
        <p><strong>Tanggal Cetak:</strong> {{ now()->format('d/m/Y H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Invoice</th>
                <th>Kasir</th>
                <th>Tanggal</th>
                <th>Item</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sales as $sale)
                <tr>
                    <td>{{ $sale->invoice }}</td>
                    <td>{{ $sale->user->name }}</td>
                    <td>{{ $sale->date?->format('d/m/Y H:i') }}</td>
                    <td>{{ $sale->items->count() }}</td>
                    <td class="text-right">Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 20px;">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($summary)
        <div class="summary">
            <p>Total Transaksi: {{ $summary->total_transactions ?? 0 }}</p>
            <p>Total Penjualan: Rp {{ number_format($summary->total_amount ?? 0, 0, ',', '.') }}</p>
            <p>Total Kembalian: Rp {{ number_format($summary->total_change ?? 0, 0, ',', '.') }}</p>
        </div>
    @endif

    <div class="footer">
        <p>Laporan ini dicetak secara otomatis oleh sistem</p>
        <p>APOTEK POS - {{ now()->format('Y') }}</p>
    </div>
</body>
</html>
