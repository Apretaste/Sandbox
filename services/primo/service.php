<?php

class primo extends Service
{

    public function _main (Request $request)
    {
        $numero = intval($request->query);
        $es_primo = $this->esPrimo($numero);
        
        $respuesta = "El numero $numero " . ($es_primo ? "es" : "no es") . " primo";
        
        $response = new Response();
        $response->setResponseSubject($respuesta);
        $response->createFromTemplate("basic.tpl", array(
                "respuesta" => $respuesta
        ));
        return $response;
    }

    private function esPrimo ($numero)
    {
        for ($i = 2; $i <= intval($numero / 2); $i ++)
            if ($numero % $i == 0) {
                return false;
            }
        return true;
    }

    public function _lista (Request $request)
    {
        $max = intval($request->query);
        
        if ($max > 10000) {
            $response = new Response();
            $response->setResponseSubject("Numero demasiado grande para procesar");
            $response->createFromText("El numero $max es demasiado grande para procesar la lista de primos.");
            return $response;
        }
        
        $primos = array();
        
        for ($i = 1; $i <= $max; $i ++) {
            if ($this->esPrimo($i)) $primos[] = $i;
        }
        
        $response = new Response();
        $response->setResponseSubject("Lista de numeros primos hasta el $max");
        $response->createFromTemplate("lista.tpl", array(
                "primos" => $primos,
                "max" => $max
        ));
        return $response;
    }
}
