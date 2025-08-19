<?php

namespace Tests\Unit;

use App\Models\Employee;
use PHPUnit\Framework\TestCase;

class EmployeeTest extends TestCase
{
    /** @test N°1 */
    public function it_sets_name_and_last_name_in_title_case()
    {
        $employee = new Employee();

        $employee->name_employee = 'pedro';
        $employee->last_name_employee = 'lópez';

        $this->assertEquals('Pedro', $employee->name_employee);
        $this->assertEquals('López', $employee->last_name_employee);
    }

    /** @test N°2 */
    public function it_sets_email_in_lowercase()
    {
        $employee = new Employee();

        $employee->email_employee = 'TEST@MAIL.COM';

        $this->assertEquals('test@mail.com', $employee->email_employee);
    }

    /** @test N°3 */
    public function it_gets_full_name_correctly()
    {
        $employee = new Employee([
            'name_employee' => 'Laura',
            'last_name_employee' => 'Martínez',
        ]);

        $this->assertEquals('Laura Martínez', $employee->full_name);
    }
    public function test_example(): void
    {
        $this->assertTrue(true);
    }
}
