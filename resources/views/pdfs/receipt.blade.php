<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Receipt</title>
    <style>
        body { font-family: 'Helvetica', Arial, sans-serif; color: #333; font-size: 14px; }
        .header { text-align: center; border-bottom: 2px solid #c6a87c; padding-bottom: 10px; margin-bottom: 20px; }
        .logo-text { font-size: 24px; font-weight: bold; color: #0f172a; }
        .details { margin-bottom: 30px; }
        .details table { width: 100%; }
        .items-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .items-table th { background-color: #0f172a; color: #ffffff; padding: 10px; text-align: left; }
        .items-table td { border-bottom: 1px solid #ddd; padding: 10px; }
        .total-row td { font-weight: bold; font-size: 16px; border-top: 2px solid #0f172a; }
        .footer { text-align: center; font-size: 12px; color: #777; margin-top: 40px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo-text">The Saturation Point</div>
        <p>Official Order Receipt</p>
    </div>

    <div class="details">
        <table>
            <tr>
                <td>
                    <strong>Customer:</strong> {{ $order->user->name }}<br>
                    <strong>Email:</strong> {{ $order->user->email }}
                </td>
                <td style="text-align: right;">
                    <strong>Order ID:</strong> #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}<br>
                    <strong>Date:</strong> {{ $order->created_at->format('F d, Y') }}<br>
                    <strong>Status:</strong> <span style="text-transform: uppercase;">{{ $order->status }}</span>
                </td>
            </tr>
        </table>
    </div>

    <table class="items-table">
        <thead>
            <tr>
                <th>Item</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>PHP {{ number_format($item->price, 2) }}</td>
                <td>PHP {{ number_format($item->price * $item->quantity, 2) }}</td>
            </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="3" style="text-align: right;">Total Amount:</td>
                <td>PHP {{ number_format($order->total_price, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        Thank you for shopping with The Saturation Point.<br>
        For inquiries, contact us at contact@thesaturationpoint.tech
    </div>
</body>
</html>