<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN</title>
    {{-- {{ asset('backend') }} --}}
    <link rel="stylesheet" href="">
    {{-- <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" /> --}}
    <link rel="stylesheet" href="{{ asset('backend/assets/css/login.css') }}" type="text/css">
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="box">
        <div class="container">
            <div class="top--header">
                {{-- <span>Have an account</span> --}}
                <header>LOGIN</header>
            </div>

            <form action="">
                <div class="input--field">
                    <input type="text" name="email" class="input" placeholder="Email" required>
                    <i class="far fa-user"></i>
                </div>
    
                <div class="input--field">
                    <input type="password" name="password" class="input" placeholder="Password" required>
                    <i class="ri-lock-2-line"></i>
                </div>
    
                <div class="input--field">
                    <input type="submit" name="submit" class="submit" value="Login" required>
                </div>
                
                <div class="bottom">
                    <div class="left">
                        <div class="checkbox" id="check">
                            <label for="check">Remember Me</label>
                            <input type="checkbox" name="checkbox" class="checkboxs">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>
</html>