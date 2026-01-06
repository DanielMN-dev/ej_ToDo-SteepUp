<div class="menuBaseHome">
    <div id="pagCrearTarea"></div>
    <div id="anadirIdCuenta"></div>
    <div id="buscadorSi"></div>

    <div class="buscadorTareas">

        <div class="textoBuscarTarea">
            <h2>Buscar una tarea:</h2>
        </div>

        <div class="inputBuscarTarea">
            <input type="text" id="textBuscar1" name="textBuscar1">
        </div>

        <div class="categoriaBuscarTarea">
            <select name="est_tar" id="est_tar">
                <option value="pendiente">pendiente</option>
                <option value="completado">completado</option>
            </select>
        </div>

        <input type="button" id="botonBuscarTarea" class="botonInputBuscarTarea" value="Buscar">
        <div class="inputBuscarTarea">
            
        </div>

        
    </div>

    <div class="contenedorMaestro">
        <div class="tituloCategoria">
            <h4>CREAR TAREA</h4>
        </div>
    </div>

    <form id="formCrearTarea" class="centrarContenedor">
        <div class="contenedorformulario">
            <div>
                <input type="hidden" id="ide_usu" name="ide_usu" value="" required>
            </div>
            <div class="Filas">
                <h4>Titulo:</h4>
                <input type="text" id="titulo_tar" name="titulo_tar" required>
            </div>
            <div class="Filas">
                <h4>Descripción:</h4>
                <textarea placeholder="Escribe tu descripción aquí..." id="des_tar" name="des_tar" rows="4" cols="50"></textarea required>
            </div>

            <div class="FilaBoton">
               <input type="submit" class="botonInputSubmit1" value="crear">
            </div>
            
        </div>
    </form>

    <div id="result1"></div>


</div>


