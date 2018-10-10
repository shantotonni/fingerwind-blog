<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee Activation mail</title>
    <style>
        .container{
            width: 800px;
            margin: 0 auto;
            margin-top: 20px;
        }
        .header{
            background-color: #327380;
            padding: 10px;
        }
        .content{
            background-color: #e8e2f5;
            min-height: 300px;
        }
        .button{
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2 style="text-align: center;color: white">User Activation Mail</h2>
    </div>

    <div class="content">
        <h3 style="margin-top: 0px;margin-left: 30px;padding: 20px;color: #2c8059">
            Your Email : {{ $user->email }}
            <br>
            <br>
        </h3>

        <div class="button">
            <h4>Please Click The Button and Active your Account</h4>
            <a href="{{ route('account.verify',['email'=>$user->email,'verifyToken'=>$user->verifyToken]) }}" style="background-color: #2c8059;text-align: center;padding: 10px 20px;color: white;text-decoration: none">
                Active Your Account
            </a>
        </div>

    </div>
</div>




</body>
</html>