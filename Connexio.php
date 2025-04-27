<?php
/**
 * Gestor de connexions MySQL mitjançant mysqli.
 *
 * @author  Carles Canals Gozálvez
 * @version 1.0
 */

class Connexio
{
    /** @var string $servidor Nom del servidor MySQL */
    private string $servidor = "localhost";

    /** @var string $usuari Usuari de la BD */
    private string $usuari   = "root";

    /** @var string $contrasenya Contrasenya de la BD */
    private string $contrasenya = "root";

    /** @var string $baseDades Nom de la base de dades */
    private string $baseDades = "la_meva_botiga";

    /**
     * Obté un objecte mysqli amb la connexió oberta.
     *
     * @throws \RuntimeException Si la connexió falla.
     * @return \mysqli Connexió a la base de dades.
     */
    public function obtenirConnexio(): mysqli
    {
        $conexion = new mysqli(
            $this->servidor,
            $this->usuari,
            $this->contrasenya,
            $this->baseDades
        );

        if ($conexion->connect_error) {
            throw new \RuntimeException(
                "Error de connexió: " . $conexion->connect_error
            );
        }
        return $conexion;
    }
}
?>
