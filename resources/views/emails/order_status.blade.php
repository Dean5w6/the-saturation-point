<!DOCTYPE html>
<html>
<head>
    <style>
        .wrapper { background-color: #f8f5f2; padding: 40px 20px; font-family: 'Helvetica', Arial, sans-serif; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 4px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .header { background-color: #0f172a; padding: 30px; text-align: center; border-bottom: 4px solid #c6a87c; }
        .header h1 { color: #c6a87c; margin: 0; font-size: 24px; letter-spacing: 2px; text-transform: uppercase; }
        .body { padding: 40px; color: #333333; line-height: 1.6; }
        .status-badge { display: inline-block; padding: 5px 15px; background-color: #c6a87c; color: #0f172a; font-weight: bold; border-radius: 20px; text-transform: uppercase; font-size: 14px; }
        .footer { padding: 20px; text-align: center; font-size: 12px; color: #777777; }
        .btn { display: inline-block; padding: 12px 25px; background-color: #0f172a; color: #ffffff; text-decoration: none; border-radius: 2px; font-weight: bold; font-size: 14px; text-transform: uppercase; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <h1>The Saturation Point</h1>
            </div>
            <div class="body">
                <h2>Good news, {{ $order->user->name }}!</h2>
                <p>The status of your order <strong>#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</strong> has been updated.</p>
                
                <p>Current Status: <span class="status-badge">{{ $order->status }}</span></p>

                <p>If your order is now marked as SHIPPED, please allow 3-5 business days for delivery. If it is COMPLETED, we hope you enjoy your new writing instruments!</p>
                
                <a href="{{ route('orders.history') }}" class="btn">Track My Order</a>
            </div>
            <div class="footer">
                Questions? Contact our support at dean@thesaturationpoint.tech<br>
                &copy; {{ date('Y') }} The Saturation Point.
            </div>
        </div>
    </div>
</body>
</html>