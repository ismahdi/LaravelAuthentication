<style>
    body{
        font-family: 'Poppins', sans-serif;
        font-weight: 300;
        font-size: 15px;
        line-height: 1.7;
        color: #c4c3ca;
        background-color: #1f2029;
        overflow-x: hidden;
    }
    .reset {
        padding-left: 40px !important;
    }
</style>
<div>
    <h2 style="padding: 100px;">Forget Password Email</h2>
    <span class="reset"> You can reset password from bellow link:
        <a href="{{ route('reset.password.show', $token) }}">Reset Password</a> </span>
</div>
