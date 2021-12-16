<?php

namespace AppRestaurant\Restaurant\Shared\Infrastructure;

use Illuminate\Support\Facades\DB;

trait TraitRepository
{
    private function setCodigo($len_numero=6, $inicia='0')
    {
        $year = (new \DateTime())->format("y");
        $codigo = str_pad($this->getLastCodigo($year), $len_numero, $inicia, STR_PAD_LEFT);
        return $this->prefix.$year.$codigo;
    }

    private function getLastCodigo($year)
    {
        $code = DB::table($this->table)->where('code', 'LIKE', $this->prefix.'%')->max('code');
        $codigo = empty($code) ? 0 : (int) str_replace($this->prefix.$year, "", $code);
        return (string) ($codigo + 1);
    }
}
