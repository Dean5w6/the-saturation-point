<!DOCTYPE html>
<html>
<head>
    <style>
        .wrapper { background-color: #f8f5f2; padding: 40px 20px; font-family: 'Helvetica', Arial, sans-serif; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 4px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .header { background-color: #0f172a; padding: 30px; text-align: center; border-bottom: 4px solid #c6a87c; }
        .header h1 { color: #c6a87c; margin: 0; font-size: 24px; letter-spacing: 2px; text-transform: uppercase; }
        .body { padding: 40px; color: #333333; line-height: 1.6; }
        .body h2 { color: #0f172a; margin-top: 0; }
        .order-box { background-color: #f8f9fa; padding: 20px; border-radius: 4px; margin: 20px 0; border-left: 4px solid #c6a87c; }
        .footer { padding: 20px; text-align: center; font-size: 12px; color: #777777; }
        .btn { display: inline-block; padding: 12px 25px; background-color: #0f172a; color: #c6a87c; text-decoration: none; border-radius: 2px; font-weight: bold; font-size: 14px; text-transform: uppercase; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <h1>The Saturation Point</h1>
            </div>
            <div class="body">
                <h2>Thank you for your purchase, {{ $order->user->name }}!</h2>
                <p>We've received your order and we're getting it ready for shipment. You can find your official receipt attached to this email as a PDF.</p>
                
                <div class="order-box">
                    <strong>Order Number:</strong> #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}<br>
                    <strong>Total Amount:</strong> ₱{{ number_format($order->total_price, 2) }}<br>
                    <strong>Status:</strong> {{ strtoupper($order->status) }}
                </div>

                <p>Once your items have shipped, we will notify you immediately via email.</p>
                
                <a href="{{ route('orders.history') }}" class="btn">VIEW ORDER HISTORY</a>
            </div>
            <div class="footer">
                &copy; {{ date('Y') }} The Saturation Point. All Rights Reserved.<br>
                Purveyors of fine writing instruments and inks.
            </div>
        </div>
    </div>
</body>
</html>