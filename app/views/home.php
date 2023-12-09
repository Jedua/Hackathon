<!-- Contenido para la página de inicio -->

<br>

<div id = "titulo">
<center><h1 class="letratitulo">Bienvenido a Medical</h1>
<h3 class="letratitulo2"> El lugar donde la salud se encuentra con la comunidad y el conocimiento médico. Nos esforzamos por construir una comunidad dinámica donde pacientes, profesionales de la salud y organizaciones puedan interactuar, aprender y colaborar con las personas de una manera más significativa. </h3></center> <br>
</div>

<br>

<div>
    <center>
    <span><img src="public/img/familias-felices.jpg"></span>
    </center>
    
</div> 

<br>

<div class="navbar">

    <div class="dropdown">
        <button class="dropbtn"> <a href="#noticias"><h3 class="letramenu">Noticias</h3></a></button>
    </div>

    <div class="dropdown">
        <button class="dropbtn"><a href="#eventos"><h3 class="letramenu">Eventos</h3></a></button>
    </div>

    <div class="dropdown">
        <button class="dropbtn"><a href="#comunidad"><h3 class="letramenu">Comunidad</h3></a></button>
        <div class="dropdown-content">
            <a href="#especialidades">Especialidades</a>
            <a href="#hospitales">Hospital</a>
            <a href="#citas">Citas</a>
            <a href="#perfiles">Perfiles</a>
        </div>
    </div>

    <div class="dropdown">
        <button class="dropbtn"><a href="#foro"><h3 class="letramenu">Foro</h3></a></button>
        <div class="dropdown-content">
            <a href="#opiniones">Opiniones</a>
            <a href="#preguntas">Preguntas</a>
            <a href="#respuestas">Respuestas</a>
        </div>
    </div>
</div>

<br>
<section id="noticias">
    <div class="seccionnoticias">
        <h1 id = "noticias2">Noticias</h1>
    </div> 

    <br>
    <br>
    
    <div class="encabezado-container">
        <center>
            <span class="mov">
            
            <img src="public/img/imss.jpeg" class="encabezado-imagen"> 
            <a href=""><h1 class="abajo">Reportan que con IMSS Bienestar aumentaron las atenciones médicas en un mes</h1></a>
            
            </span>
            <span class="mov">
            <img src="public/img/enfermedades.jpeg" class="encabezado-imagen">
            <h1 class="abajo">Incrementan 15% las citas médicas por enfermedades respiratorias</h1>
            </span>

            <span class="mov">
            <img src="public/img/chatgpt.jpg" class="encabezado-imagen">
            <h1 class="abajo">ChatGPT hace recomendaciones médicas y seguirlas es todo un riesgo mortal</h1>
            </span>
        </center>
    </div>

        <script src="public/js/home.js"></script>
        <br>
        <br>
    
</section>
<br>
<section id="eventos">
    <div class="navbar">
        <h1 id = "noticias2">Eventos</h1>
    </div>
    <div class="encabezado-container">
        <div id="contenedorhome1">
            <br>
            <h3 id="colorNegro">Evento 1</h3>
            <span><img src="public/img/evento1.jpeg" id = "img1" class="izquierda"></span>
        </div>
        <div id="contenedorhome1">
            <br>
            <h3 id="colorNegro">Evento 2</h3>
            <span><img src="public/img/evento2.jpeg" id = "img1" class="centrado"></span>
        </div>
        <div id="contenedorhome1">
            <br>
            <h3 id="colorNegro">Evento 3</h3>
            <span><img src="public/img/evento3.jpeg" id = "img1" class="derecha"></span>
        </div>
    </div>
</section>

<br>

<section id="comunidad">

    <div class="navbar">
        <h1 id = "noticias2">Comunidad</h1>
    </div>

    <div class="contene">
    <section id="especialidades">
      <h2>Especialidades</h2>
      <button id="dropdownBtn">Selecciona una especialidad</button>
      <select id="specialtiesDropdown">
        <option value="cardiologia">Cardiología</option>
        <option value="dermatologia">Dermatología</option>
        <option value="neurologia">Neurología</option>
      </select>
    </section>

    <section id="hospitales">
      <h2>Hospitales</h2>
      <button class="filterBtn" data-filter="all">Todos</button>
      <button class="filterBtn" data-filter="private">Privados</button>
      <button class="filterBtn" data-filter="public">Públicos</button>
    </section>

    <section id="citas">
      <h2>Citas</h2>
      <button>Genera tu cita</button>
      <button>Ver hospitales más cercanos</button>
      <button>Ver especialistas cercanos</button>
    </section>

    <section id="perfiles">
      <h2>Perfiles</h2>
      <div class="profil">Perfil 1</div>
      <div class="profil">Perfil 2</div>
      <div class="profil">Perfil 3</div>
    </section>
  </div>

</section>


<br>
<section id="foro">
    <div class="navbar">
        <h1 id = "noticias2">Foro</h1>
    </div>

    <div class="contene">
        <section id="opiniones">
            <h2>Opiniones</h2>
            <div class="caja" contenteditable="fales"><center><p>Aquí aparecen las opiniones</p></center></div>
        </section>

        <section id="preguntas">
            <h2>Preguntas</h2>
            <div class="caja" contenteditable="true" placeholder="Escribe tu pregunta aquí..."></div>
        </section>

        <section id="respuestas">
            <h2>Respuestas</h2>
            <div class="caja" contenteditable="true" placeholder="Escribe tu respuesta aquí..."></div>
        </section>
  </div>


</section>
<br>

<br>    
<div class="encabezado-container">
    <div id="contenedorhome1">
        <span><img src="public/img/hospitales.jpg" id = "img1" class="izquierda"></span>
    </div>
    <div id="contenedorhome1">
        <span><img src="public/img/infraestructura-en-salud.jpg" id = "img1" class="centrado"></span>
    </div>
    <div id="contenedorhome1">
        <span><img src="public/img/doctor.jpg" id = "img1" class="derecha"></span>
    </div>
</div>