<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Struk Penjualan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 10px; }
        .receipt { max-width: 400px; margin: 0 auto; border: 1px solid #ddd; padding: 20px; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
        .header h2 { margin: 0; font-size: 18px; }
        .header p { margin: 5px 0; font-size: 12px; color: #666; }
        .info { font-size: 12px; margin-bottom: 20px; }
        .info p { margin: 3px 0; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; font-size: 12px; }
        th, td { padding: 5px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f5f5f5; font-weight: bold; }
        .qty { text-align: center; }
        .price, .total { text-align: right; }
        .summary { margin: 15px 0; font-size: 12px; border-top: 2px solid #000; padding-top: 10px; }
        .summary-line { display: flex; justify-content: space-between; margin: 5px 0; }
        .summary-line.total { font-size: 14px; font-weight: bold; }
        .footer { text-align: center; margin-top: 20px; font-size: 11px; color: #666; border-top: 1px solid #ddd; padding-top: 10px; }
        @media print { body { margin: 0; padding: 0; } }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="header">
            <h2>APOTEK POS</h2>
            <p>Sistem Penjualan Obat</p>
        </div>

        <div class="info">
            <p><strong>Struk:</strong> {{ $sale->invoice }}</p>
            <p><strong>Kasir:</strong> {{ $sale->user->name }}</p>
            <p><strong>Tanggal:</strong> {{ $sale->date->format('d/m/Y H:i:s') }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Obat</th>
                    <th class="qty">Qty</th>
                    <th class="price">Harga</th>
                    <th class="total">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sale->items as $item)
                    <tr>
                        <td>{{ $item->medicine->name }}</td>
                        <td class="qty">{{ $item->quantity }}</td>
                        <td class="price">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="total">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="summary">
            <div class="summary-line">
                <span>Subtotal:</span>
                <span>Rp {{ number_format($sale->total, 0, ',', '.') }}</span>
            </div>
            @if($sale->payment)
                <div class="summary-line">
                    <span>Pembayaran:</span>
                    <span>Rp {{ number_format($sale->payment, 0, ',', '.') }}</span>
                </div>
                <div class="summary-line">
                    <span>Kembalian:</span>
                    <span>Rp {{ number_format($sale->payment - $sale->total, 0, ',', '.') }}</span>
                </div>
            @endif
            <div class="summary-line total" style="border-top: 1px solid #ddd; padding-top: 5px;">
                <span>TOTAL:</span>
                <span>Rp {{ number_format($sale->total, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="footer">
            <p>Terima kasih telah berbelanja</p>
            <p>Apotek POS - {{ now()->format('Y') }}</p>
        </div>
    </div>
</body>
</html>
