<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
</head>
<body style="color:#3f3f3f;">

  <div style="font-size:30px;font-weight:bold;padding:15px;border-bottom:5px solid #008D4C;background-color:#2F4F4F;color:#fff">
    Trader Team <span style="font-size:14px;font-weight:normal;">Um time de traders contra o imprevis&iacute;vel!<span>
  </div>

  <div style="margin:10px 50px 5px 50px;">

  @yield('content')

  <hr style="margin-top:50px;">
  <span style="font-size:12px">
    Atenciosamente<br>
    <b>Equipe TraderTeam</b>
  </span>
  </div>


  <footer style="margin-top:40px;font-size:10px;padding:10px;background-color:#c4c4c4;text-align: center;">
      COPYRIGHT &copy; 2017 <a href="{{ route('home') }}">TraderTeam</a>
  </footer>
</body>
</html>
