<?php
/**
 * PHPUnit test for WordConverter Test
 */

use \PHPUnit\Framework\TestCase;

class WordConverterTest extends  TestCase{
	
	public $wct;

	public function setUp() {
		$this->wct = new \TakaToWordConverter\WordConverter();
	}

	public function testMoreThanCrore() {
		$num = 3104007200;
		$word = 'Three Hundred Ten Crore Forty Lac Seven Thousand Two Hundred Taka Only';
		$this->assertEquals( $word, ucwords($this->wct->convert( $num ) ));
	}

	public function testMoreThanLac() {
		$num = 4007200;
		$word = 'Forty Lac Seven Thousand Two Hundred Taka Only';
		$this->assertEquals( $word, ucwords($this->wct->convert( $num ) ));
	}

	public function testZoro() {
		$num = 0;
		$word = '';
		$this->assertEquals( $word, ucwords($this->wct->convert( $num ) ));
	}

	public function testOnlyDecimalNumber() {
		$num = .32;
		$word = 'Thirty Two Poisa Only';
		$this->assertEquals( $word, ucwords($this->wct->convert( $num ) ));
	}

	public function testSmallFloatNumber() {
		$num = 1.32;
		$word = 'One Taka And Thirty Two Poisa Only';
		$this->assertEquals( $word, ucwords($this->wct->convert( $num ) ));
	}

	public function testTakaWithDecimalNumber() {
		$num = 103.32;
		$word = 'One Hundred Three Taka And Thirty Two Poisa Only';
		$this->assertEquals( $word, ucwords($this->wct->convert( $num ) ));
	}

	public function testSmallAmount() {
		$num = '10';
		$word = 'Ten Taka Only';
		$this->assertEquals( $word, ucwords($this->wct->convert( $num ) ));
	}
	
}
