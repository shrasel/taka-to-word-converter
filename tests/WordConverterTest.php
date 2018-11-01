<?php
/**
 * PHPUnit test for WordConverter Test
 */

use \PHPUnit\Framework\TestCase;

class WordConverterTest extends  TestCase{
	
	public $ntw;

	public function setUp() {
		$this->ntw = new \TakaToWordConverter\WordConverter();
	}

	public function testMoreThanCrore() {
		$num = 3104007200;
		$word = 'Three Hundred Ten Crore Forty Lac Seven Thousand Two Hundred Taka Only';
		$this->assertEquals( $word, ucwords($this->ntw->convert( $num ) ));
	}

	public function testMoreThanLac() {
		$num = 4007200;
		$word = 'Forty Lac Seven Thousand Two Hundred Taka Only';
		$this->assertEquals( $word, ucwords($this->ntw->convert( $num ) ));
	}

	public function testZoro() {
		$num = 0;
		$word = '';
		$this->assertEquals( $word, ucwords($this->ntw->convert( $num ) ));
	}

	public function testDecimalNumber() {
		$num = .32;
		$word = 'Thirty Two Poisa Only';
		$this->assertEquals( $word, ucwords($this->ntw->convert( $num ) ));
	}

	public function testTakaWithDecimalNumber() {
		$num = 100.32;
		$word = 'One Hundred Taka And Thirty Two Poisa Only';
		$this->assertEquals( $word, ucwords($this->ntw->convert( $num ) ));
	}

	public function testNumToWordException() {
		$this->ntw->convert( 'foo' );
	}

	
}
