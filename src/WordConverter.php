<?php
namespace TakaToWordConverter;

class WordConverter extends AbstractConverter {

    public function convert()
    {
        return $this->convertToWord($this->amount);
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
                $word .= ' and ' . $this->taka[$number] . ' poisa';
        }
        return $word;
    }

    protected function convertToWord($amount)
    {        
        $word = '';
        $splitAmounts = preg_split("/\./", number_format($amount,2,'.',''));
        $moneyInDigit = $splitAmounts[0];
        $trailingDecimal = $splitAmounts[1];
        $word .= $this->convertDecimalToWord($moneyInDigit); 
        if(!empty($word)) $word .= ' taka';
        $word .= $this->convertTrailingDeciaml($trailingDecimal);
        
        if(!empty($word)) $word .= ' only';

        return $word;
    }
}