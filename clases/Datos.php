<?php
namespace Clases;
use Faker\Factory;
use Clases\Usuarios;
require "../vendor/autoload.php";

class Datos {
    public $faker;

    public function __construct($tabla, $cantidad)
    {
        $this->faker = Factory::create('es_ES');
        switch($tabla) {
            case "users":
                $this->miUsuario($cantidad);
                break;
        }
    }

    public function miUsuario($n) {
        $miUsuario = New Usuarios();
        $miUsuario->borrarDatos();
        $miUsuario->setNombre("Juan");
        $miUsuario->setApellidos("Quero Gomez");
        $miUsuario->setUsername("Admin");
        $miUsuario->setMail("juan@gmail.com");
        $password = hash('sha256', 'secret0');
        $miUsuario->setPass($password);
        $miUsuario->create();

        for($i=0;$i<$n-1;$i++) {
            $miUsuario->setNombre($this->faker->firstName());
            $miUsuario->setApellidos($this->faker->lastName() ." ". $this->faker->lastName());
            $miUsuario->setUsername($this->faker->unique()->userName);
            $miUsuario->setMail($this->faker->unique()->email);
            $miUsuario->setPass($this->faker->sha256);
            $miUsuario->create();
        }

        $miUsuario = null;
    }
}