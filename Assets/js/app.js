async function makeFetchFormRequest(method, controller1, form)
{
    const formData1 = new FormData(form);
  
    try {
        const response = await fetch(controller1, {
            method: method,
            body: formData1,
        });
  
        if (!response.ok) {
            throw new Error(`Error de red: ${response.statusText}`);
        }
  
        return await response.json();
    } catch (error) {
        throw new Error(`Captura del error: ${error.message}`);
    }
}

function actualizarTarea(miId) {
    fetch("Controllers/1ActualizarTareaController.php?id=" + miId)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al obtener los datos');
            }
            return response.json();
        })
        .then(data => {
            //alert("¡Enhorabuena!");
            //window.location.href = "home.php";
            var pagHome = document.getElementById("pagHome");
            if (pagHome) {
                window.location.href = "home.php";
            } else {
                const currentTabla = document.getElementById(miId);
                if (currentTabla) {
                    currentTabla.remove(); // Oculta si el elemento existe
                } else {
                    console.error("Elemento con ID " + miId + " no encontrado");
                }
            }
            
        })
        .catch(error => {
            console.error("Hubo un error:", error);
    });
}

function eliminarTarea(miId) {
    fetch("Controllers/1EliminarTareaController.php?id=" + miId)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al obtener los datos');
            }
            return response.json();
        })
        .then(data => {
            //alert("¡Enhorabuena!");

            var pagHome = document.getElementById("pagHome");

            if (pagHome) {
                window.location.href = "home.php";
            } else {
                const currentTabla = document.getElementById(miId);
                if (currentTabla) {
                    currentTabla.remove(); // Oculta si el elemento existe
                } else {
                    console.error("Elemento con ID " + miId + " no encontrado");
                }
            }
        })
        .catch(error => {
            console.error("Hubo un error:", error);
    });
}

function seleccionarTareasPendientes(controller, contenedorResult2, result1)
{
    fetch(controller)
    .then(response => {
        if (!response.ok) {
            throw new Error('Error al obtener los datos');
        }
        return response.json();
    })
    .then(data => {
        if (data.length === 0) {
            result1.innerHTML = '<p>No hay tareas pendientes</p>';
        } else {
    
            data.forEach(tarea => {
                const tabla = document.createElement('div');
                tabla.id = tarea.ide_tar;
                tabla.style.display = "flex";
                tabla.style.flexDirection = "row";
                tabla.style.padding = "1% 1% 1% 1%";
                tabla.style.backgroundColor = "black";
                
                    const div1 = document.createElement('div');
                    div1.className = "contenedor1";
                        const text1 = document.createElement('text');
                        text1.innerText = tarea.titulo_tar;
                        div1.appendChild(text1);
                    tabla.appendChild(div1);

                    const div2 = document.createElement('div');
                    div2.className = "contenedor2";
                        const text2 = document.createElement('text');
                        text2.innerText = tarea.des_tar;
                        div2.appendChild(text2);
                    tabla.appendChild(div2);

                    const div3 = document.createElement('div');
                    div3.className = "contenedor1";
                        const text3 = document.createElement('text');
                        text3.innerText = tarea.est_tar;
                        div3.appendChild(text3);
                    tabla.appendChild(div3);

                    const div4 = document.createElement('div');
                    div4.className = "contenedor1";
                        const text4 = document.createElement('text');
                        text4.innerText = tarea.fec_tar;
                        div4.appendChild(text4);
                    tabla.appendChild(div4);

                    const div6 = document.createElement('input');
                    div6.className = "contenedor3";
                    div6.type = "button";
                    div6.value = "¡Marcar como Hecha!";
                    div6.addEventListener('click', function(event)
                    {
                        event.preventDefault();
                        let miId = tarea.ide_tar;
                        actualizarTarea(miId);
                    });
                    tabla.appendChild(div6);

                    const div7 = document.createElement('input');
                    div7.className = "contenedor4";
                    div7.type = "button";
                    div7.value = "Eliminar";
                    div7.addEventListener('click', function(event) {
                        event.preventDefault();
                        let miId = tarea.ide_tar;
                        eliminarTarea(miId);
                    });
                    tabla.appendChild(div7);



                contenedorResult2.appendChild(tabla);
            });
                
        }
    })
    .catch(error => {
        result1.innerHTML = `<p>Error: ${error.message}</p>`;
    });
}




function buscarTarea(controller, contenedorResult2, result1, datos = {}) {
    // Construir URL con parámetros si existen


    //alert(controller);

    fetch(controller, {
        method: "POST",  // Cambiado de GET a POST
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(datos) // Enviar los datos correctamente
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error al obtener los datos');
        }
        return response.json();
    })
    .then(data => {
        contenedorResult2.innerHTML = ""; // Limpiar resultados anteriores

        if (data.length === 0) {
            result1.innerHTML = '<p>No hay tareas registradas</p>';
        } else {
            console.log(data);

            // Verifica si 'data' es un objeto y tiene la propiedad 'data'
            if (!data || !Array.isArray(data.data)) {
                result1.innerHTML = '<p>Error: Datos incorrectos</p>';
                return;
            }

            const tareas = data.data; // Accedemos al array de tareas

            if (tareas.length === 0) {
                result1.innerHTML = '<p>No hay tareas registradas</p>';
            } else {
                tareas.forEach(tarea => {
                    // Tu código de creación de elementos aquí...
                    const tabla = document.createElement('div');
                    tabla.id = tarea.ide_tar;
                    tabla.style.display = "flex";
                    tabla.style.flexDirection = "row";
                    tabla.style.padding = "1% 1% 1% 1%";
                    tabla.style.backgroundColor = "black";
                    
                    const div1 = document.createElement('div');
                    div1.className = "contenedor1";
                    const text1 = document.createElement('text');
                    text1.innerText = tarea.titulo_tar;
                    div1.appendChild(text1);
                    tabla.appendChild(div1);

                    const div2 = document.createElement('div');
                    div2.className = "contenedor2";
                    const text2 = document.createElement('text');
                    text2.innerText = tarea.des_tar;
                    div2.appendChild(text2);
                    tabla.appendChild(div2);

                    const div3 = document.createElement('div');
                    div3.className = "contenedor1";
                    const text3 = document.createElement('text');
                    text3.innerText = tarea.est_tar;
                    div3.appendChild(text3);
                    tabla.appendChild(div3);

                    const div4 = document.createElement('div');
                    div4.className = "contenedor1";
                    const text4 = document.createElement('text');
                    text4.innerText = tarea.fec_tar;
                    div4.appendChild(text4);
                    tabla.appendChild(div4);

                    const div6 = document.createElement('input');
                    div6.className = "contenedor3";
                    div6.type = "button";
                    div6.value = "¡Marcar como Hecha!";
                    div6.addEventListener('click', function(event)
                    {
                        event.preventDefault();
                        let miId = tarea.ide_tar;
                        actualizarTarea(miId);
                    });
                    tabla.appendChild(div6);

                    const div7 = document.createElement('input');
                    div7.className = "contenedor4";
                    div7.type = "button";
                    div7.value = "Eliminar";
                    div7.addEventListener('click', function(event) {
                        event.preventDefault();
                        let miId = tarea.ide_tar;
                        eliminarTarea(miId);
                    });
                    tabla.appendChild(div7);

                    contenedorResult2.appendChild(tabla);
                });
            }
        }
    })
    .catch(error => {
        result1.innerHTML = `<p>Error: ${error.message}</p>`;
    });
}








window.addEventListener('load', function (event)
{
    const pagIndex = document.getElementById("pagIndex");
    if(pagIndex)
    {
        const formIniciarSesión = document.getElementById("formIniciarSesión");
        const controller = "Controllers/1ConsultarCuentaUsuarioController.php";
        const botonCrearCuenta = document.getElementById("botonCrearCuenta");
        const result1 = document.getElementById("result1");

        botonCrearCuenta.addEventListener('click', function (event)
        {
            event.preventDefault();
            window.location.href = "crearCuenta.php";
        });

        formIniciarSesión.addEventListener('submit', function (event) {
            event.preventDefault();
        
            makeFetchFormRequest('POST', controller, formIniciarSesión, result1)
                .then(response => {
                    if (response.status === "success") {
                        var id = response.ideUsu;  // ID del usuario
                        var nombre = response.nombreUsu;  // Nombre del usuario
        
                        // Guardar el array en sessionStorage
                        let cuenta = [id, nombre];

                        sessionStorage.setItem("cuenta", JSON.stringify(cuenta));

                        // Redirigir sin pasar datos por la URL
                        window.location.href = "home.php";
                    } else {
                        result1.textContent = response.message || 'Error desconocido.';
                    }
                })
                .catch(error => {
                    console.error("Error en la inserción:", error.message);
                });
        });
        
    }


    const pagCrearCuenta = document.getElementById("pagCrearCuenta");
    if(pagCrearCuenta)
    {
        const formCrearCuenta = document.getElementById("formCrearCuenta");
        const controller = "Controllers/1InsercionCrearCuentaUsuarioController.php";
        const botonCrearCuenta = document.getElementById("botonCrearCuenta");
        const result1 = document.getElementById("result1");

        formCrearCuenta.addEventListener('submit', function (event)
        {
            event.preventDefault();
            
            makeFetchFormRequest('POST', controller, formCrearCuenta)
            .then(response => {
                if (response.status === "success")
                {
                    alert("Se ha creado una Cuenta de Usuario");
                    formCrearCuenta.reset();  // Limpia el formulario
                    window.location.href = "index.php";
                }
                else
                {
                    result1.textContent = response.message || 'Error desconocido.';
                    alert("Error desconocido");
                }
            })
            .catch(error => {
                console.error("Error en la inserción:", error.message);  // Muestra el error en la consola
            })
            .finally(() => {
            // Habilita el botón nuevamente 
            });
        });
    }

    // Ponemos el nombre de Usuario
    const anadirIdCuenta = document.getElementById("anadirIdCuenta");
    // Recuperar datos de sessionStorage
    if(anadirIdCuenta)
    {
        let cuenta = JSON.parse(sessionStorage.getItem("cuenta"));

        if (cuenta) {
            var id = cuenta[0];
            var nombre = cuenta[1];
    
            console.log("ID:", id, "Nombre:", nombre);
    
            const usuarioId = document.getElementById("usuarioId");
            const nombreUsuario = document.getElementById("nombreUsuario");
    
            if (nombreUsuario)
            {
                usuarioId.textContent = "Hola, " + nombre;
            }
        } else {
            alert("No se ha encontrado información de usuario en sessionStorage.");
            window.location.href = "index.php"; // Redirigir al login si no hay datos
        }
    }
    
    const buscadorSi = document.getElementById("buscadorSi");
    if(buscadorSi)
    {
        
        const botonBuscarTarea = document.getElementById("botonBuscarTarea");

        botonBuscarTarea.addEventListener('click', function(event)
        {
            event.preventDefault();
            const textBuscar1 = document.getElementById("textBuscar1").value;
            const est_tar = document.getElementById("est_tar").value;

            window.location.href = `buscar.php?texto=${encodeURIComponent(textBuscar1)}&estado=${encodeURIComponent(est_tar)}`;
        });
    }
    



    const pagHome = document.getElementById("pagHome");
    if(pagHome)
    {
        const botonCrearTarea = document.getElementById("botonCrearTarea");

        botonCrearTarea.addEventListener('click', function (event)
        {
            event.preventDefault();
            window.location.href = "crearTarea.php";
        });

        //LISTAR PENDIENTES
        const contenedorResult2 = document.getElementById("contenedorResult2");
        const result1 = document.getElementById("result1");

        var cuenta = JSON.parse(sessionStorage.getItem("cuenta"));
        var id = cuenta[0];
        const controller = "Controllers/1ConsultarTareasPendientesController.php?id="+id;
        seleccionarTareasPendientes(controller, contenedorResult2, result1);
    }


    const pagCrearTarea = document.getElementById("pagCrearTarea");
    if(pagCrearTarea)
    {
        var cuenta = JSON.parse(sessionStorage.getItem("cuenta"));
        const ide_usu = document.getElementById("ide_usu");
        var id = cuenta[0];
        ide_usu.innerText = id;
        const formCrearTarea = document.getElementById("formCrearTarea");
        const controller = "Controllers/1InsercionCrearTareaController.php?id=";
        const result1 = document.getElementById("result1");

        formCrearTarea.addEventListener('submit', function (event)
        {
            event.preventDefault();
            
            makeFetchFormRequest('POST', controller+id, formCrearTarea)
            .then(response => {
                if (response.status === "success")
                {
                    alert("Se ha creado una Tarea");
                    formCrearTarea.reset();  // Limpia el formulario
                    window.location.href = "home.php";
                }
                else
                {
                    result1.textContent = response.message || 'Error desconocido.';
                    alert("Error desconocido");
                }
            })
            .catch(error => {
                console.error("Error en la inserción:", error.message);  // Muestra el error en la consola
            })
            .finally(() => {
            // Habilita el botón nuevamente 
            });
        });
    }

    const pagBuscar = document.getElementById("pagBuscar");
    if(pagBuscar)
    {
        var cuenta = JSON.parse(sessionStorage.getItem("cuenta"));
        var id = cuenta[0];

        // Función para obtener parámetros de la URL
        function obtenerParametros() {
            let params = new URLSearchParams(window.location.search);
            return {
                texto: params.get("texto") || "No especificado",
                estado: params.get("estado") || "No especificado"
            };
        }

        // Obtener valores de la URL
        let datos = obtenerParametros();
        const controller = `http://localhost/site1/SteepUp/Controllers/1ConsultarBusquedaTareaController.php?id=${id}`;
        const contenedorResult2 = document.getElementById("contenedorResult2");
        const result1 = document.getElementById("result1");

        buscarTarea(controller, contenedorResult2, result1, datos);
    }
});