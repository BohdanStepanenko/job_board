<?php

namespace Tests\Feature;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    private const EMAIL = 'test@test.com';
    private const PASS = 'password';

    public function setUp(): void
    {
        parent::setUp();

        Notification::fake();

        User::factory()->create([
            'email' => self::EMAIL,
            'password' => Hash::make(self::PASS),
        ]);
    }

    public function test_show_validation_error_when_all_fields_empty_in_register(): void
    {
        $data = [
            'name' => '',
            'email' => '',
            'password' => '',
        ];

        $this->postJson(route('register'), $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['name', 'email', 'password']);
    }

    public function test_show_validation_error_when_name_field_empty_in_register(): void
    {
        $faker = Factory::create();

        $data = [
            'name' => '',
            'email' => $faker->email,
            'password' => $faker->password,
        ];

        $this->postJson(route('register'), $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['name']);
    }

    public function test_show_validation_error_when_email_field_empty_in_register(): void
    {
        $faker = Factory::create();

        $data = [
            'name' => $faker->name,
            'email' => '',
            'password' => $faker->password,
        ];

        $this->postJson(route('register'), $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['email']);
    }

    public function test_show_validation_error_when_password_field_empty_in_register(): void
    {
        $faker = Factory::create();

        $data = [
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => '',
        ];

        $this->postJson(route('register'), $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['password']);
    }
}
