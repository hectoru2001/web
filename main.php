<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú de Tarjetas de Departamentos Clickeables</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            transition: box-shadow 0.3s;
            cursor: pointer;
        }

        .card:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .card-body {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Departamentos</h1>

        <div class="row">
            <!-- Tarjeta 1 - Departamento de Ventas -->
            <div class="col-md-4 mb-4">
                <a href="submain-sistemas.php" class="card-link">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Sistemas</h5>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Tarjeta 2 - Departamento de Recursos Humanos -->
            <div class="col-md-4 mb-4">
                <a href="submain-logistica.php" class="card-link">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Logística</h5>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Tarjeta 3 - Departamento de Marketing -->
            <div class="col-md-4 mb-4">
                <a href="marketing.php" class="card-link">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">...</h5>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Tarjeta 4 - Departamento de Tecnología -->
            <div class="col-md-4 mb-4">
                <a href="tecnologia.php" class="card-link">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">...</h5>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Tarjeta 5 - Departamento de Finanzas -->
            <div class="col-md-4 mb-4">
                <a href="finanzas.php" class="card-link">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">...</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
