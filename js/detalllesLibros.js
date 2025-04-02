/**
 * Función para mostrar la modal de detalles del empleado
 */
async function verDetallesLibros(id_libro) {
  try {
    // Ocultar la modal si está abierta
    const existingModal = document.getElementById("detalleLibroModal");
    if (existingModal) {
      const modal = bootstrap.Modal.getInstance(existingModal);
      if (modal) {
        modal.hide();
      }
      existingModal.remove(); // Eliminar la modal existente
    }

    // Buscar la Modal de Detalles
    const response = await fetch("modales/modalDetalles.php");
    if (!response.ok) {
      throw new Error("Error al cargar la modal de detalles del empleado");
    }
    // response.text() es un método en programación que se utiliza para obtener el contenido de texto de una respuesta HTTP
    const modalHTML = await response.text();

    // Crear un elemento div para almacenar el contenido de la modal
    const modalContainer = document.createElement("div");
    modalContainer.innerHTML = modalHTML;

    // Agregar la modal al documento actual
    document.body.appendChild(modalContainer);

    // Mostrar la modal
    const myModal = new bootstrap.Modal(
      modalContainer.querySelector("#detalleLibro")
    );
    myModal.show();

    await cargarDetalleLibros(id_libro);
  } catch (error) {
    console.error(error);
  }
}

function verDetallesLibros(id_libros) {
    // Lógica para abrir la ventana de detalles del libro
    alert("Detalles del libro con ID: " + id_libros);
    // Aquí puedes agregar la lógica para mostrar los detalles del libro
}

/**
 * Función para cargar y mostrar los detalles del empleado en la modal
 */
async function cargarDetalleLibros(id_libro) {
  try {
    const response = await axios.get(
      `acciones/detallesLibro.php?id=${id_libro}`
    );
    if (response.status === 200) {
      console.log(response.data);
      const { nombre, autor, espacio, fecha_publicacion, edicion, genero, Portada } =
        response.data;
      const PortadaURL = Portada ? `acciones/fotos_empleados/${Portada}` : null;
      const PortadaExistente = PortadaURL
        ? await verificarExistenciaImagen(PortadaURL)
        : false;
      const PortadaHTML = PortadaExistente
        ? `<img src="${PortadaURL}" alt="Avatar" style="width: 100px; height: 100px; display:block;">`
        : "No disponible";

      // Limpiar el contenido existente de la lista ul

      const ulDetalleLibro = document.querySelector(
        "#detalleLibroContenido ul"
      );

      ulDetalleLibro.innerHTML = ` 
        <li class="list-group-item"><b>Nombre:</b> 
          ${nombre ? nombre : "No disponible"}
        </li>
        <li class="list-group-item"><b>Edad:</b> 
          ${autor ? autor : "No disponible"}
        </li>
        <li class="list-group-item"><b>Cédula:</b> 
          ${espacio ? espacio : "No disponible"}
          </li>
        <li class="list-group-item"><b>Sexo:</b>
         ${fecha_publicacion ? fecha_publicacion : "No disponible"}
        </li>
        <li class="list-group-item"><b>Teléfono:</b> ${
          edicion ? edicion : "No disponible"
        }</li>
        <li class="list-group-item"><b>Cargo:</b> 
          ${genero ? genero : "No disponible"}
        </li>
         <li class="list-group-item"><b>Portada:</b> ${PortadaHTML}</li>
      `;
    } else {
      alert(`Error al cargar los detalles del empleado con ID ${id_libro}`);
    }
  } catch (error) {
    console.error(error);
    alert("Hubo un problema al cargar los detalles del empleado");
  }
}

// Función para verificar la existencia de una imagen
async function verificarExistenciaImagen(url) {
  try {
    const response = await fetch(url, { method: "HEAD" });
    return response.ok;
  } catch (error) {
    console.error("Error al verificar la existencia de la imagen:", error);
    return false;
  }
}
