<?php 
/**
* TemplateGeneratorTest
*/
class TemplateGeneratorTest extends CDbTestCase 
{
	public $templateGenerator;
	public function setUp()
	{
		$this->templateGenerator = new TemplateGenerator();
	}
	public function tearDown()
	{
		$this->templateGenerator = null;
	}
	public function testGenerate()
	{
		$generatedFile = $this->templateGenerator->generate();
		$this->assertNotNull($generatedFile, 'Test if the returned file is not null');
		$this->assertFileExists($generatedFile, 'Test if the generated file exists');
	}	
}