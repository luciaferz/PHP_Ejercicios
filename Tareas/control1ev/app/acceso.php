<html>

<head>
   <meta charset="UTF-8">
   <link href="web/default.css" rel="stylesheet" type="text/css" />
   <title>NOTAS</title>
   <style>
      .aviso-bloqueo {
         text-align: center;
         font-weight: bold;
      }

      .aviso-bloqueo .titulo {
         font-size: 1.5em;
      }
   </style>
</head>

<body>
   <div id="container" style="width: 600px;">
      <div id="header">
         <h1>ACCESO DE NOTAS</h1>
      </div>
      <div id="content">
         <?php if (!empty($accesoBloqueado)): ?>
            <div class="aviso-bloqueo">
               <div class="titulo">Se ha superado el número máximo de intentos de acceso</div>
               <hr>
               <div>Reinicie el navegador para volver a intentarlo.</div>
            </div>
         <?php else: ?>
            <p><?= $contenido ?></p>
            <form method="Get">
               Nº usuario : <input type="text" name="login"><br>
               <br>
               Contraseña : <input type="passwd" name="clave"><br>
               <input type="submit" value=" Enviar ">
            </form>
            <p>Tienes un máximo de 5 intentos.</p>
         <?php endif; ?>
      </div>
   </div>
</body>

</html>