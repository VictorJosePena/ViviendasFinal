<?php include_once "template/header.php" ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <hr>
            <a class="btn btn-secondary" href="leerTabla.php">Visualizar Inmuebles</a>
            <hr>
            <h2 class="mt-4">Insertar Nueva </h2>
            <hr>
            <form method="post" action="accForm_insertar1.php" enctype='multipart/form-data'>
                <div class="form-group">
                    <label for="tipo">Tipo de vivienda</label>
                    <select name="tipo" id="tipo"  class="form-control">
                        <option value="Piso">Piso</option>
                        <option value="Adosado">Adosado</option>
                        <option value="Chalet">Chalet</option>
                        <option value="Casa">Casa</option>
                        <option value="Apartamento">Apartamento</option>
                        <option value="Estudio">Estudio</option>
                    </select>
                </div>
                <label for="zona">Zona</label>
                    <select name="zona" id="zona"  class="form-control">
                        <option value="Centro">Centro</option>
                        <option value="Nervion">Nervion</option>
                        <option value="Triana">Triana</option>
                        <option value="Aljarafe">Aljarafe</option>
                        <option value="Macarena">Macarena</option>
                        
                    </select>
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" name="direccion" id="direccion" class="form-control">
                </div>
                <div class="form-group">
                    <label for="ndormitorios">Seleciona el numero de dormitorios</label><br>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ndormitorios" id="Radio0" value="1">
                    <label class="form-check-label" for="inlineRadio1">Sin dormitorios</label>
                    </div>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ndormitorios" id="Radio1" value="2">
                    <label class="form-check-label" for="inlineRadio2">Uno</label>
                    </div>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ndormitorios" id="Radio2" value="3" >
                    <label class="form-check-label" for="inlineRadio3">Dos</label>
                    </div>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ndormitorios" id="Radio3" value="4" >
                    <label class="form-check-label" for="inlineRadio3">Tres</label>
                    </div>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ndormitorios" id="Radio4" value="5" >
                    <label class="form-check-label" for="inlineRadio3">Cuatro</label>
                    </div>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ndormitorios" id="Radio5" value="6" >
                    <label class="form-check-label" for="inlineRadio3">Cinco</label>
                    </div>
                    </div>
                <div class="form-group">
                    <label for="precio">Precio(€)</label>
                    <input type="text" name="precio" id="precio" class="form-control">
                </div>
                <div class="form-group">
                    <label for="tamano">Tamaño(m2)</label>
                    <input type="text" name="tamano" id="tamano" class="form-control">
                </div>
                <div class="form-group">
                    <label for="tamano">Seleciona los Extras</label>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Piscina" id="defaultCheck1" name="extras[]">
                    <label class="form-check-label" for="defaultCheck1">
                        Piscina
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Jardin" id="defaultCheck2" name="extras[]">
                    <label class="form-check-label" for="defaultCheck2">
                        Jardin
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Garaje" id="defaultCheck2" name="extras[]" >
                    <label class="form-check-label" for="defaultCheck2">
                        Garaje
                    </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="archivo">Seleciona un archivo:</label>
                    <input type="file" name="archivo" id="archivo" class="form-control">
                </div>
                
                <div class="form-group justify-content-md-end mt-3">
                <label for="archivo">Observaciones:</label>
                    <textarea class="form-control" name="observaciones" id="observaciones" cols="50" rows="5"></textarea>
                </div>
                <div class="form-group justify-content-md-end mt-3">
                    <input id="enviar" type="submit" name="submit" class="btn btn-outline-primary" value="Enviar" >
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once "template/footer.php" ?>
