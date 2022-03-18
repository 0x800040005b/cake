<?php
declare(strict_types=1);

namespace App\Test\TestCase\Form;

use App\Form\ResetForm;
use Cake\TestSuite\TestCase;

/**
 * App\Form\ResetForm Test Case
 */
class ResetFormTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Form\ResetForm
     */
    protected $Reset;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->Reset = new ResetForm();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Reset);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Form\ResetForm::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
