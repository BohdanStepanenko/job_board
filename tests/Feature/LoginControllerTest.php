<?php

namespace Tests\Feature;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class LoginControllerTest extends TestCase
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

    public function test_show_validation_error_when_both_fields_empty_in_login(): void
    {
        $data = [
            'email' => '',
            'password' => '',
        ];

        $this->postJson(route('login'), $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['email', 'password']);
    }

    public function test_show_validation_error_on_password_when_credential_dont_match_in_login(): void
    {
        $faker = Factory::create();

        $data = [
            'email' => self::EMAIL,
            'password' => $faker->password,
        ];

        $this->postJson(route('login'), $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_successful_login(): void
    {
        $data = [
            'email' => self::EMAIL,
            'password' => self::PASS,
        ];

        $this->postJson(route('login'), $data)
            ->assertStatus(Response::HTTP_NO_CONTENT);
    }
}
