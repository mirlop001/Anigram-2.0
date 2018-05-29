<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Anigram</title>
</head>
<body>
<?php include 'App/views/Comun/cabecera.php'; ?>
    
    <div id="container-index-video">
        <video id="background-video"  autoplay loop>
            <source src="public/img/Entrada.mp4" type="video/mp4">
        </video>
    </div>
   
    <div id="container-index">
        <span id="sonido-index-video"><i class="fas fa-volume-off on"></i></span>
        <span id="ver-index-video"><i class="fas fa-eye"></i></span>

        <div id="contenido">
            <section id="inicial">
                <h1>Anigram</h1>
                <div id="boton_enviar">
                    <button class="submitHueso" onclick="location='App/views/login.php'">Acceder</button>
                </div>
                <a href="#sobre-anigram" class="scrollLink"><i class="fas fa-angle-down"></i></a>
            </section>
            
            <section id="sobre-anigram">
                <h1>Acerca de Anigram</h1>
                <h3>¿Cansado de que tu mascota te robe el móvil para subir fotos a tu Instagram?</h3>
                <h3>¿De que se lleve todos los likes y corazones mientras tu no te llevas ni un simple hola?</h3>
                <h2>¡Ese tiempo queda ya atrás con Anigram !</h2>

                <h5>Anigram es una red social con la que podrás gestionar diferentes contenidos como fotos y videos de tus mascotas por separado.</h5>
                <h5>Para ello sólo tendrás que gestionar tu perfil al público y luego seleccionar las mascotas que quieres enseñar al mundo.</h5>

                <a href="#sobre-nosotros" class="scrollLink"><i class="fas fa-angle-down"></i></a>
            </section>
            
            <section id="sobre-nosotros">
                <h1>Sobre nosotros</h1>
                <div id="miembros-anigram" class="row">

                    <div id="Carla" class="miembro col-4">
                        <h4 class="panel-title">Carla Peñarieta Uribe</h4>
                        <div>
                            <img class="media-object imagen-perfil" src="public/img/Miembros/Carla.png" alt="Foto de Carla">
                        </div>
                        <h5> Soy una persona alegre y extrovertida.</h5>
                        <p>Me encanta la informática, no podría imaginarme haciendo otra cosa. Adoro los animales, hacer deporte y salir con los amigos, aunque al final del día siempre hay tiempo para pizza y peli en Netflix.</p>
                    </div>
                    
                    <div id="Enrique" class="miembro col-4">
                        <h4 class="panel-title">Enrique Fuertes Franco</h4>
                        <div>
                            <img class="media-object imagen-perfil" src="public/img/Miembros/Enrique.png" alt="Foto de Enrique">
                        </div>
                        <h5>Amante de la informática.</h5>
                        <p> Actualmente estoy trabajando como freelance en el desarrollo de páginas web, cosa que me encanta. Además de eso siempre tengo tiempo para aprender cosas nuevas e iniciar proyectos por mi cuenta. Adoro los coches, los videojuegos y, por supuesto los animales.</p>
                    </div>

                    <div id="Miriam" class="miembro col-4">
                        <h4 class="panel-title">Miriam López Sierra</h4>
                        <div>
                            <img class="media-object imagen-perfil"  src="public/img/Miembros/Miriam.png" alt="Foto de Miriam">
                        </div>
                        <h5>Apasionada de los libros, la informática, los videojuegos y las series.</h5>
                        <p>Siempre ando buscando nuevos retos con los que superarme, haciendo proyectos propios y aprendiendo todo lo que esté en mi mano. Me pierdo siempre que veo un perro pasar por delante.</p>
                    </div>
                </div>
                <a href="#inicial" class="scrollLink"><i class="fas fa-angle-double-up"></i></a>
            </section>
        </div>
    </div>
</body>
</html>