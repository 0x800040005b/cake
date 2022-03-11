<?php
declare(strict_types=1);

namespace App\Test\TestCase\Form;

use App\Form\AuthForm;
use Cake\TestSuite\TestCase;

/**
 * App\Form\AuthForm Test Case
 */
class AuthFormTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Form\AuthForm
     */
    protected $Auth;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->Auth = new AuthForm();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Auth);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Form\AuthForm::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
