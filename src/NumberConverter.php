<?php
namespace TakaToWordConverter;

class NumberConverter extends AbstractConverter {

    public function convert()
    {
        return $this->amount;
    }
}