<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    @font-face {
    font-family: 'verdana';
    src : url('fonts/verdana.ttf');
    }
    @font-face {
    font-family: 'verdana bold';
    src : url('fonts/verdana-bold.ttf');
    }
    @font-face {
    font-family: 'verdana bold italix';
    src : url('fonts/verdana-bold-italic.ttf');
    }
    body {
        margin:0px;
        padding:0px;
    }
    .login__section {
        background-color: #ED2736;
        height: 100vh;
        width: 100vw;
        padding:0px;
        margin:0px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    .login__container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    .login__form {
        width:300px;
        margin-top: 20px;
        margin-left: 0;
        padding:26px 26px;
        font-weight: 400;
        overflow: hidden;
        background: #fff;
        border: 1px solid #c3c4c7;
        box-shadow: 0 1px 3px rgba(0,0,0,.04);
        border-radius: 9px !important;
        border: 2px solid #ffffff !important;
        background: rgba(235,64,52,1) url() repeat top left !important;
        -moz-box-shadow: 0 4px 10px -1px #555555 !important;
        -webkit-box-shadow: 0 4px 10px -1px #555555 !important;
        box-shadow: 0 4px 10px -1px #555555 !important;
    }
    .login__form label {
        color: #ffffff;
        font-size: 14px;
        font-weight: 400;
    }
    .login__form input {
        /* padding:0px 20px; */
        display:flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        margin:0px;
        width:100%;
        height: 30px;
        margin-bottom: 10px;
        border: 1px solid #c3c4c7;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 400;
        color: #555;
        background-color: #fff;
        -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
        box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
        -webkit-transition: border .15s linear,box-shadow .15s linear;
        -o-transition: border .15s linear,box-shadow .15s linear;
        transition: border .15s linear,box-shadow .15s linear; */
    }
    .login__section__judul {
        color: #ffffff;
        font-family: 'arial';
        font-size: 48px;
        font-weight: 700;
        text-align: center;
        margin-bottom: 20px;
    }
    .password {
        margin-top: 20px;
    }
    .login__button {
        margin-top: 20px;
        background: rgba(85,85,85, 0.9);
        border:none;
        border-radius: 6px;
        width:80px;
        height: 30px;
        color:#ffffff;
        font-weight: 400;
    }
    
</style>
<body>
    <div class="login__section">
        <form action="{{ route('login') }}" method="POST" class="login__form">
            @csrf
            <h1 class="login__section__judul">ADMIN PDF</h1>
            <div>
                <label for="email">Email</label>
            <input type="text" type="text" name="email">
            </div>
            <div class="password">
                <label for="password" >Password</label>
                <input type="password" name="password">
            </div>  
            <button class="login__button">Log In</button>
        </form>
    </div>
</body>
</html>



