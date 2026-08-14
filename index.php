<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Rafael Antonio Viscarra Aquino VA100422</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/sha1.js"></script>
</head>

<body>

<div class="container-fluid">
    <div class="contenedor">
        <div class="row align-items-center h-100">

            <div class="col"></div>

            <div class="col">
                <div class="align-items-center">

                    <p>Rafael Antonio Viscarra Aquino VA100422</p>

                    <form name="frm_login" id="frm_login" method="post" action="core/process.php">

                        <table>
                            <thead>
                                <tr>
                                    <th class="parrafo_centrado">Inicio de sesión</th>
                                </tr>

                                <tr>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>

                                        <div class="form-row">

                                            <div class="form-group col-md-6">
                                                <label for="txt_usuario">Usuario:</label>

                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    name="txt_usuario"
                                                    id="txt_usuario"
                                                    maxlength="15"
                                                    aria-describedby="txt_user_help"
                                                    required
                                                />

                                                <small id="txt_user_help" class="form-text text-muted">
                                                    El usuario es obligatorio
                                                </small>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="txt_password">Contraseña:</label>

                                                <input
                                                    type="password"
                                                    class="form-control"
                                                    name="txt_password"
                                                    id="txt_password"
                                                    maxlength="15"
                                                    aria-describedby="txt_password_help"
                                                    required
                                                />

                                                <small id="txt_password_help" class="form-text text-muted">
                                                    La contraseña es obligatoria
                                                </small>
                                            </div>

                                        </div>

                                    </td>
                                </tr>

                                <tr>
                                    <td align="center">

                                        <button
                                            type="submit"
                                            class="btn btn-primary"
                                            name="btn_entrar"
                                            id="btn_entrar"
                                        >
                                            Iniciar sesión
                                        </button>

                                        <div class="mensaje"></div>

                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script>

	function enviar_datos(u, p) {

		$.post(
			$("#frm_login").attr("action"),
			{
				txt_usuario: btoa(sha1(u)),
				txt_password: btoa(sha1(p))
			}
		)
		.done(function(datos) {

			window.location.replace(
				datos.data.url + "?token=" + datos.data.token
			);

		})
		.fail(function(xhr, status, error) {

			if (xhr.responseJSON && xhr.responseJSON.error) {
				$(".mensaje").html(xhr.responseJSON.error.message);
			} else {
				$(".mensaje").html("Ocurrió un error al procesar la solicitud.");
			}

		});

	}

	$(document).ready(function() {

		const form = document.querySelector("#frm_login");

		form.addEventListener("submit", function(e) {

			e.preventDefault();

			enviar_datos(
				$("#txt_usuario").val(),
				$("#txt_password").val()
			);

		});

	});

	</script>

</body>
</html>
