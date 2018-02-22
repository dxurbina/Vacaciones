<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Empleados</title>
</head>

<body>
    <div class="container-fluid">
        <div clas="row-fluid">
            <div class="panel-heading">
                <center>Datos personales</center>
            </div>
            <div class="panel panel-body">

                <div class="row">
                    <div class="col-sm-4">
                        <output>1er. nombre:</output>
                        <input type="text" name="PNombre" size="15" />

                        <output>2do. nombre:</output>
                        <input type="text" name="SNombre" size="15" />
                        <!-- Es cedula residencia:<input type="button" value="no"> Este esta pendiente -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <output>1er. apellido:</output>
                        <input type="text" name="PApellido" size="15" />

                        <output>2do. apellido :</output>
                        <input type="text" name="SApellido" size="15" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2">
                        <output>N° cédula:</output>
                        <input type="text" name="Cedula" size="15" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <output>N° Inss</output>
                        <input type="text" name="NInss" size="15" />

                        <output>N° Pasaporte:</output>
                        <input type="text" name="Pasaporte" size="15" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <output>Fecha Nacimiento</output>
                        <input type="text" name="FechaNac" size="15" placeholder="dd-mm-aaaa" />

                        <output>Sexo</output>
                        <select name="Sexo">
                            <option value="" disabled selected>Seleccione el Sexo</option>
                            <option value="Hombre">Hombre</option>
                            <option value="Mujer">Mujer</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <output>Hijos</output>
                        <input type="text" name="Hijos" size="15" />

                        <output>Num. Hijos</output>
                        <input type="text" name="NHijos" size="5" placeholder="0" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <output>Hermanos</output>
                        <input type="text" name="Hermanos" size="15" />

                        <output>Num. Hermanos</output>
                        <input type="text" name="NHermanos" size="5" placeholder="0" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <output>Télefonos</output>
                        <input type="text" name="Telefono" size="15" />

                        <output>Estado civil</output>
                        <select name="EstadoCivil">
                            <option value="" disabled selected>Seleccione Estado civil</option>
                            <option value="Soltero">Soltero/a.</option>
                            <option value="Comprometido">Comprometido/a.</option>
                            <option value="Casado">Casado/a.</option>
                            <option value="Divorciado">Divorciado/a.</option>
                            <option value="Viudo">Viudo/a.</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <output>E-mail:</output>
                        <input type="text" name="Correo" size="15" />

                        <output>Escolaridad</output>
                        <select name="Escolaridad">
                            <option value="" disabled selected>Seleccione la Escolaridad</option>
                            <option value="Primaria">Primaria</option>
                            <option value="Secundaria">Secundaria</option>
                            <option value="Universidad">Universidad</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <output>N° Ruc</output>
                        <input type="text" name="NRuc" size="15" />

                        <output>Profesión</output>
                        <input type="text" name="Profesion" size="5" />
                    </div>
                </div>
                <br>
                <header>Dirección</header>
                <hr align="left" width="50%">

                <!-- VERIFICAR AQUÍ QUE SE VA A MANDAR A LLAMAR LA LISTA DE DEPTO -->
                <div class="row">
                    <div class="col-sm-4">
                        <output>Departamento</output>
                        <select name="Departamento">

                        </select>

                    </div>
                </div>

                <!-- VERIFICAR AQUÍ QUE SE VA A MANDAR A LLAMAR LA LISTA DE MUNICIPIO FILTRADA POR EL IDDEPTO -->
                <div class="row">
                    <div class="col-sm-4">
                        <output>Municipio</output>
                        <select name="Municipio">

                        </select>

                    </div>
                    <div class="form-group">
                        <label for="comment">Dirección:</label>
                        <textarea class="form-control" rows="2" id="Direccion"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-sm-2">
                            <output>Nacionalidad</output>
                            <input type="text" name="Nacionalidad" size="15" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2">
                            <output>Nacionalidad 2</output>
                            <input type="text" name="Nacionalidad2" size="15" />
                        </div>
                    </div>

                    <div class="row">
                            <div class="col-sm-2">
                                <output>Habilitadoa</output>
                                <input type="text" name="Estado" size="15" />
                            </div>
                        </div>
    

                </div>

            </div>

        </div>

    </div>

</body>

</html>