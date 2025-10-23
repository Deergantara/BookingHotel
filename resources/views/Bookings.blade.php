<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OYO - View Booking</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
            background-color: #ff5a5f;
            color: white;
            padding: 15px 20px;
            border-radius: 8px 8px 0 0;
        }
        
        .logo {
            font-size: 24px;
            font-weight: bold;
        }
        
        .Booking-card {
            background-color: white;
            border-radius: 0 0 8px 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 20px;
        }
        
        .section {
            padding: 20px;
            border-bottom: 1px solid #eee;
        }
        
        .section:last-child {
            border-bottom: none;
        }
        
        h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        
        h2 {
            font-size: 18px;
            margin-bottom: 15px;
            color: #ff5a5f;
        }
        
        .savings {
            background-color: #e8f5e9;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        
        .savings-icon {
            color: #4caf50;
            margin-right: 10px;
            font-size: 20px;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }
        
        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        
        .mobile-input {
            display: flex;
        }
        
        .country-code {
            width: 80px;
            border-right: none;
            border-radius: 4px 0 0 4px;
        }
        
        .mobile-number {
            flex: 1;
            border-radius: 0 4px 4px 0;
        }
        
        .btn {
            background-color: #ff5a5f;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            width: 100%;
            margin-top: 10px;
        }
        
        .btn:hover {
            background-color: #e04a50;
        }
        
        .hotel-info {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .hotel-rating {
            background-color: #4caf50;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 14px;
            margin-left: 10px;
        }
        
        .Booking-details {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }
        
        .detail-item {
            flex: 1;
            min-width: 200px;
            margin-bottom: 10px;
        }
        
        .detail-label {
            font-size: 14px;
            color: #666;
        }
        
        .detail-value {
            font-weight: 500;
        }
        
        .price-breakdown {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        
        .price-breakdown tr {
            border-bottom: 1px solid #eee;
        }
        
        .price-breakdown td {
            padding: 8px 0;
        }
        
        .price-breakdown td:last-child {
            text-align: right;
            font-weight: 500;
        }
        
        .discount {
            color: #4caf50;
        }
        
        .total-amount {
            font-size: 18px;
            font-weight: bold;
            color: #ff5a5f;
        }
        
        .divider {
            height: 1px;
            background-color: #eee;
            margin: 15px 0;
        }
        
        @media (max-width: 600px) {
            .container {
                padding: 10px;
            }
            
            .Booking-details {
                flex-direction: column;
            }
            
            .detail-item {
                min-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">OYO</div>
        </header>
        
        <div class="Booking-card">
            <div class="section">
                <h1>View Your Booking</h1>
                
                <div class="savings">
                    <div class="savings-icon">✓</div>
                    <div>
                        <strong>Yay! you just saved Rp{{ number_format($BookingData['savings'], 0, ',', '.') }} on this Booking!</strong>
                    </div>
                </div>
                
                <h2>Enter your details</h2>
                <p>We will use these details to share your Booking information</p>
                
                <form action="#" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" id="fullName" name="full_name" placeholder="Enter first and last name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="name@abc.com" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="mobile">Mobile Number</label>
                        <div class="mobile-input">
                            <select class="country-code" name="country_code">
                                <option value="+82">+82</option>
                                <option value="+62">+62</option>
                                <option value="+91">+91</option>
                                <option value="+1">+1</option>
                            </select>
                            <input type="tel" class="mobile-number" name="mobile_number" placeholder="e.g. 1234567890" required>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn">Send passcode</button>
                </form>
            </div>
            
            <div class="divider"></div>
            
            <div class="section">
                <div class="hotel-info">
                    <h2>{{ $BookingData['hotel']['name'] }}</h2>
                    <div class="hotel-rating">
                        {{ $BookingData['hotel']['rating'] }} ({{ $BookingData['hotel']['total_ratings'] }} Rating) - {{ $BookingData['hotel']['rating_text'] }}
                    </div>
                </div>
                
                <div class="Booking-details">
                    <div class="detail-item">
                        <div class="detail-label">Duration</div>
                        <div class="detail-value">{{ $BookingData['duration']['nights'] }} Night</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Check-in / Check-out</div>
                        <div class="detail-value">{{ $BookingData['duration']['check_in'] }} – {{ $BookingData['duration']['check_out'] }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Room & Guests</div>
                        <div class="detail-value">{{ $BookingData['room']['quantity'] }} Room, {{ $BookingData['room']['guests'] }} Guests</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Room Type</div>
                        <div class="detail-value">{{ $BookingData['room']['type'] }}</div>
                    </div>
                </div>
                
                <table class="price-breakdown">
                    <tr>
                        <td>Room price for {{ $BookingData['duration']['nights'] }} Night X {{ $BookingData['room']['guests'] }} Guests</td>
                        <td>Rp{{ number_format($BookingData['pricing']['room_price'], 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Price Drop</td>
                        <td class="discount">-Rp{{ number_format($BookingData['pricing']['price_drop'], 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>{{ $BookingData['pricing']['coupon_percentage'] }}% Coupon Discount</td>
                        <td class="discount">-Rp{{ number_format($BookingData['pricing']['coupon_discount'], 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="total-amount">Payable Amount</td>
                        <td class="total-amount">Rp{{ number_format($BookingData['pricing']['payable_amount'], 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>