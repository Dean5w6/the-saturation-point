<!DOCTYPE html>
<html>
<head> 
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style> 
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap');

        .wrapper { background-color: #f8f5f2; padding: 40px 20px; font-family: 'Lato', 'Helvetica', Arial, sans-serif; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 4px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        
        .header { background-color: #0f172a; padding: 35px 20px; text-align: center; border-bottom: 4px solid #c6a87c; }
         
        .header h1 { 
            color: #c6a87c; 
            margin: 0; 
            font-size: 26px; 
            letter-spacing: 1px; 
            text-transform: none; 
            font-family: 'Playfair Display', 'Georgia', 'Times New Roman', serif; 
            font-weight: 700;
        }
        
        .body { padding: 40px; color: #333333; line-height: 1.6; text-align: center; }
        
        .body h2 { 
            color: #0f172a; 
            margin-bottom: 20px;
            font-family: 'Playfair Display', 'Georgia', 'Times New Roman', serif; 
        }
        
        .btn { 
            display: inline-block; 
            padding: 14px 35px; 
            background-color: #0f172a; 
            color: #ffffff !important; 
            text-decoration: none; 
            border-radius: 2px; 
            font-weight: bold; 
            font-size: 14px; 
            text-transform: uppercase; 
            margin-top: 25px; 
            letter-spacing: 1px;
        }
        
        .footer { padding: 25px; text-align: center; font-size: 12px; color: #777777; border-top: 1px solid #eeeeee; background-color: #fafafa; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <h1>The Saturation Point</h1>
            </div>
            <div class="body">
                <h2>Welcome to the Club, {{ $user->name }}!</h2>
                <p>We are thrilled to have you join our community of fine writing enthusiasts.</p>
                <p>Please click the button below to verify your email address and activate your account.</p>
                 
                <a href="{{ $url }}" class="btn">Verify Email Address</a>
                
                <p style="margin-top: 30px; font-size: 12px; color: #999;">If you did not create an account, no further action is required.</p>
            </div>
            <div class="footer">
                &copy; {{ date('Y') }} The Saturation Point. All Rights Reserved.
            </div>
        </div>
    </div>
</body>
</html>