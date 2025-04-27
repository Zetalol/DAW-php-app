<?php
/**
 * Classe encarregada de generar el peu de pàgina.
 *
 * Imprimeix el contingut HTML corresponent al footer, carrega les llibreries
 * de Bootstrap i afegeix un script personalitzat per gestionar el carrusel.
 *
 * @author Carles Canals Gozálvez
 * @version 1.0
 */

class Footer {

    /**
     * Mostra el peu de pàgina amb el disseny i funcionalitats addicionals.
     *
     * Aquest mètode imprimeix el codi del footer, enllaça els scripts externs 
     * de Bootstrap i inicialitza el component de carrusel de manera automàtica.
     *
     * @return void
     */
    public function mostrarFooter(): void {
        // Imprime el HTML del pie de página
        echo '<div class="footer text-center bg-dark text-white py-2">
                <p>&copy; 2023 CIFP Pau Casesnoves · Centro de Formación Profesional</p>
              </div>';

        // Imprime los scripts de Bootstrap desde su repositorio remoto y el script personalizado para activar el carrusel
        echo '<!-- Scripts de Bootstrap i script personalitzat pel carrusel -->';
        echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>';
        echo '<script>
                document.addEventListener(\'DOMContentLoaded\', function () {
                    var myCarousel = new bootstrap.Carousel(document.getElementById(\'carrusel\'), {
                        interval: 2000,
                        wrap: true
                    });
                });
              </script>';

        // Cierra la etiqueta </body> y </html>
        echo '</body></html>';
    }
}

// Crea una instancia de la clase Footer y llama al método mostrarFooter
$footer = new Footer();
$footer->mostrarFooter();
?>
