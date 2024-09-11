<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100..900&display=swap" rel="stylesheet">
    <title>نظام أداء </title>
    <style>
        body{
            background-color: #eeee;
            font-family: "Noto Kufi Arabic", sans-serif;
            direction: rtl;
        }
        .login_data
        {
            width:800px;
            background-color: #fff;
            box-shadow: 5px 5px 5px #eee ;
            padding: 10px;
            margin:  0 auto;
            margin-bottom: 20px;
        }
        .login_data h1
        {
            font-size: 18px ;
            color: #556ee6 ;
            margin-bottom: 15px ;
        }
        .login_data h3
        {
            font-size: 15px ;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .login_data span{
            font-weight: bold;
        }
        .login_data p{
            font-size: 15px;
        }
    </style>
</head>
<body>
<div class="card login_data ">
    <div class="card-body text-center ">
                    <div class="container">
                    <h1> نظام أداء - جامعه بنها  </h1>
                    <h3> بيانات الدخول </h3>
                    <p> <span> الرقم الوظيفى  : </span>   {{ $mailData['job_number'] }}    </p>
                    <p>  <span>الرقم السري : </span>   {{ $mailData['password'] }}    </p>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
