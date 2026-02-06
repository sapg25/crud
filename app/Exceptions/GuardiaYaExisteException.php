<?php

namespace App\Exceptions;

use Exception;

class GuardiaYaExisteException extends Exception
{
    public function __construct($cedula = "")
    {
        $message = "El guardia con cédula $cedula ya se encuentra registrado en el sistema.";
        parent::__construct($message);
    }

    public function render()
    {
        return back()->with('error', $this->getMessage())->withInput();
    }
}
