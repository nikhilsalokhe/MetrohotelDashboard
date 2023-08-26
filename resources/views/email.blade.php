<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Coupon Template</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .coupon {
      max-width: 400px;
      margin: 50px auto;
      border: 2px solid #ccc;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      background-color: #f9f9f9;
      text-align: center;
      /* border: dashed;w */
    }

    .coupon h2 {
      font-size: 24px;
      margin: 0;
      padding: 10px 0;
    }

    .coupon p {
      font-size: 18px;
      margin: 0;
      padding: 5px 0;
    }

    .coupon .code {
      font-size: 30px;
      font-weight: bold;
      padding: 15px 0;
      background-color: #eaeaea;
      border-radius: 5px;
    }

    .coupon .expiration {
      font-size: 16px;
      margin-top: 10px;
    }

    .coupon .fine-print {
      font-size: 14px;
      color: #888;
      margin-top: 20px;
    }

    .coupon .fine-print a {
      color: #888;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="coupon">
    <h2>Special Offer!</h2>
    <p>Get <strong>{{$discount_amount}} off</strong> on your next purchase</p>
    <div class="code">{{$voucher_name}}</div>
    <p class="expiration">Expires on: {{$expired_date}}</p>
    <p class="fine-print">*Not valid with any other offer. One per customer. <a href="#">Terms and conditions apply</a>.</p>
  </div>
</body>
</html>
