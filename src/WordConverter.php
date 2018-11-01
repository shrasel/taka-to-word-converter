<?php
namespace TakaToWordConverter;

class WordConverter {

    const CRORE     = 8;
    const LAC       = 6;
    const THOUSAND  = 4;
    const HUNDRED   = 3;
    
    protected  $taka = array(
        1 => 'one',
        '01'=>'one',
        2 => 'two',
        '02' => 'two',
        3 => 'three',
        '03' => 'three',
        4 => 'four',
        '04' => 'four',
        5 => 'five',
        '05' => 'five',
        6 => 'six',
        '06' => 'six',
        7 => 'seven',
        '07' => 'seven',
        8 => 'eight',
        '08' => 'eight',
        9 => 'nine',
        '09' => 'nine',
        10 => 'ten',
        11 => 'eleven',
        12 => 'twelve',
        13 => 'thirteen',
        14 => 'fourteen',
        15 => 'fifteen',
        16 => 'sixteen',
        17 => 'seventeen',
        18 => 'eighteen',
        19 => 'nineteen',
        20 => 'twenty',
        21 => 'twenty one',
        22 => 'twenty two',
        23 => 'twenty three',
        24 => 'twenty four',
        25 => 'twenty five',
        26 => 'twenty six',
        27 => 'twenty seven',
        28 => 'twenty eight',
        29 => 'twenty nine',
        30 => 'thirty',
        31 => 'thirty one',
        32 => 'thirty two',
        33 => 'thirty three',
        34 => 'thirty four',
        35 => 'thirty five',
        36 => 'thirty six',
        37 => 'thirty seven',
        38 => 'thirty eight',
        39 => 'thirty nine',
        40 => 'forty',
        41 => 'forty one',
        42 => 'forty two',
        43 => 'forty three',
        44 => 'forty four',
        45 => 'forty five',
        46 => 'forty six',
        47 => 'forty seven',
        48 => 'forty eight',
        49 => 'forty nine',
        50 => 'fifty',
        51 => 'fifty one',
        52 => 'fifty two',
        53 => 'fifty three',
        54 => 'fifty four',
        55 => 'fifty five',
        56 => 'fifty six',
        57 => 'fifty seven',
        58 => 'fifty eight',
        59 => 'fifty nine',
        60 => 'sixty',
        61 => 'sixty one',
        62 => 'sixty two',
        63 => 'sixty three',
        64 => 'sixty four',
        65 => 'sixty five',
        66 => 'sixty six',
        67 => 'sixty seven',
        68 => 'sixty eight',
        69 => 'sixty nine',
        70 => 'seventy',
        71 => 'seventy one',
        72 => 'seventy two',
        73 => 'seventy three',
        74 => 'seventy four',
        75 => 'seventy five',
        76 => 'seventy six',
        77 => 'seventy seven',
        78 => 'seventy eight',
        79 => 'seventy nine',
        80 => 'eighty',
        81 => 'eighty one',
        82 => 'eighty two',
        83 => 'eighty three',
        84 => 'eighty four',
        85 => 'eighty five',
        86 => 'eighty six',
        87 => 'eighty seven',
        88 => 'eighty eight',
        89 => 'eighty nine',
        90 => 'ninety',
        91 => 'ninety one',
        92 => 'ninety two',
        93 => 'ninety three',
        94 => 'ninety four',
        95 => 'ninety five',
        96 => 'ninety six',
        97 => 'ninety seven',
        98 => 'ninety eight',
        99 => 'ninety nine',
    );

    public function convert($amount)
    {
        return $this->convertToWord($amount);
    }

    private function convertDecimalToWord($amount)
    {
        $word = '';

        // crore
         if( strlen($amount) >= self::CRORE  ) { 
            $chunkLength = (strlen($amount) - ( self::CRORE - 1));
            $chunkAmount = substr($amount, 0, $chunkLength);
            $amount = substr($amount, $chunkLength) ;
            $word .= $this->convertDecimalToWord($chunkAmount)  . ' crore ';
        }
        //Lac
        if( strlen($amount) >= self::LAC ) { // lac
            $chunkLength = (strlen($amount) - ( self::LAC - 1));
            $chunkAmount = substr($amount, 0, $chunkLength );
            $amount = substr($amount, $chunkLength) ;
            if( $chunkAmount > 0 ) {
                $word .= $this->taka[$chunkAmount * 1]  . ' lac ';
            }

        }
        // Thousand
        if( strlen($amount) >= self::THOUSAND ) { // thousand
            $chunkLength = (strlen($amount) - ( self::THOUSAND - 1));
            $chunkAmount = substr($amount, 0, $chunkLength );
            $amount = substr($amount, $chunkLength) ;
            if( $chunkAmount > 0 ) {
                $word .= $this->taka[$chunkAmount * 1] . ' thousand ';
            }
        }
        // Hundred
        if( strlen($amount) >= self::HUNDRED ) {
            $chunkLength = (strlen($amount) - ( self::HUNDRED - 1));
            $chunkAmount = substr($amount, 0, $chunkLength );
            $amount = substr($amount, $chunkLength) ;
            if( $chunkAmount > 0 ) {
                $word .= $this->taka[$chunkAmount * 1] . ' hundred ';
            }
        }

        if( $amount > 0 ) {
            $word .= $this->taka[$amount * 1];
        }
        
        return $word;
    }

    private function convertTrailingDeciaml($number)
    {
        $word = '';
        if( isset($number) ) {
            if((int)$number>0)
                $word .= $this->taka[$number] . ' poisa';
        }
        return $word;
    }

    protected function convertToWord($amount)
    {        

        if(is_string($amount)) {
            throw new \Exception('Invalid Number');
        }

        $word = '';

        $splitAmounts = preg_split("/\./", number_format($amount,2,'.',''));
        $moneyInDigit = $splitAmounts[0];
        $trailingDecimal = $splitAmounts[1];
        $word .= $this->convertDecimalToWord($moneyInDigit); 
        if(!empty($word)) $word .= 'taka';

        $decimal_word = $this->convertTrailingDeciaml($trailingDecimal);

        if(!empty($word) && !empty($decimal_word))
            $word .= ' and '.$decimal_word;
        if(empty($word) && !empty($decimal_word))
            $word .= $decimal_word;

        if(!empty($word)) $word .= ' only';

        return $word;
    }
}