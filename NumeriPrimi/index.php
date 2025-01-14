<?php
    ini_set('memory_limit', '2048M');

    function ePrimo($numero, $divisor = 2) 
    {
        //CASI BASE
        //Numeri minori di 2 non sono primi
        if ($numero < 2) 
        {
            return false;
        }

        //Divisore maggiore della radice quadrata: numero è primo
        $limite = sqrt($numero);
        if ($divisor > $limite) 
        {
            return true;
        }

        //Numero divisibile dal divisore non è primo
        if ($numero % $divisor == 0) 
        {
            return false;
        }

        //divisore successivo
        return ePrimo($numero, $divisor + 1);
    }

    function trovaPrimi($primes = [], $current = 2) 
    {
        // CASO BASE: se arrivo a 10.000 numeri primi, restituisci la lista
        if (count($primes) == 10000) 
        {
            return $primes;
        }

        //controlla se il numero è primo
        if (ePrimo($current)) 
        {
            $primes[] = $current;
        }

        return trovaPrimi($primes, $current + 1);
    }

    //funzione ricorsiva
    $primes = trovaPrimi();

    foreach ($primes as $prime) 
    {
        echo $prime . "\n";
    }
?>
