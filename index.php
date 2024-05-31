<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <!-- Incluir Bootstrap CSS -->
    <!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css"
  rel="stylesheet"
/>
    <link href="style/estiles.css" rel="stylesheet">

</head>
<body>
<section class="vh-100" style="margin-top: 9%;">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="includes/img/logo.png" class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form action="functions/login.php" method="POST" class="bg-light p-5 rounded shadow">

          <!-- Usuario input -->
          <div class="form-group mb-4">
            <label for="username" class="form-label">Usuario</label>
            <input type="text" id="username" name="username" class="form-control form-control-lg" placeholder="Ingrese su usuario" required>
          </div>

          <!-- Contraseña input -->
          <div class="form-group mb-4">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Ingrese su contraseña" required>
          </div>

          <div class="d-flex justify-content-between align-items-center mb-4">
            <!-- Checkbox -->
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="remember" name="remember">
              <label class="form-check-label" for="remember">
                Recordarme
              </label>
            </div>
            <a href="#" class="text-body">¿Olvidaste tu contraseña?</a>
          </div>

          <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg w-100">Ingresar</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</section>


<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"
></script>

</body>
</html>
