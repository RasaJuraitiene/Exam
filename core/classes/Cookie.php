<?php

namespace Core;

class Cookie
{
    /**
     * Cookie pavadinimas
     *
     * Jis naudojamas tiek nuskaitant duomenis iš
     * $_COOKIE, tiek funkcijoje setcookie
     * @var string
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Turi patikrinti ar cookie duotu pavadinimu egzistuoja
     */
    public function exists(): bool
    {
        if (isset($_COOKIE[$this->name])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Turi return'inti json_decode'intą cookie'o
     * turinį.
     *
     * Patikrinti ar pavyko json_decode'inti
     * (Use Google)
     * Jei nepavyko, funkcija turi mesti warning'ą
     * (ne EXCEPTION'ą, bet WARNING'ą - Use Google).
     * ir return'inti tuščią array
     *
     * Jei cookie'is nustatytu pavadinimu neegzistuoja,
     * turi return'inti tuščią array'ų
     */
    public function read(): array
    {
        $array = json_decode($_COOKIE[$this->name], true);
        if ($array) {
            return $array;
        } else {
            trigger_error('Nepavyko dekodinti Bl*t!', E_USER_WARNING);
        }
        return [];
    }

    /**
     * Turi į Cookie duotu pavadinimu
     * išsaugoti json_encode'intą $data array'jų
     * (Google setcookie)
     *
     * Į cookie galima įrašyt tik string'ą.
     * Kadangi mes norim galimybę turėti į tą patį
     * Cookie storinti daugiau data'os, galim tiesiog
     * encode'inti ir decode'inti array'jų su json'u.
     *
     * Mes į cookie įrašysim už'json_encodinę $data
     * ir atkursim atgal json_decode'inę tai ką radom Cookie
     *
     * @param $data array
     * @param $expires_in int Už kiek laiko sekundemis cookie nebegalios
     */
    public function save(array $data, int $expires_in = 3600): void
    {
        $string = json_encode($data);
        setcookie($this->name, $string, time() + $expires_in, "/");
    }

    /**
     * Turi ištrinti Cookie
     * (Use google)
     */
    public function delete(): void
    {
        unset($_COOKIE[$this->name]);
        setcookie($this->name, null, -1, "/");
    }
}