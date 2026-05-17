<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Helper to mock auth views inline to prevent View missing exceptions.
     */
    private function mockAuthViews(): void
    {
        $tempViewPath = sys_get_temp_dir() . '/laravel_virtual_views/auth';
        if (!file_exists($tempViewPath)) {
            mkdir($tempViewPath, 0777, true);
        }
        file_put_contents($tempViewPath . '/login.blade.php', '');
        file_put_contents($tempViewPath . '/register.blade.php', '');

        View::addNamespace('auth', sys_get_temp_dir() . '/laravel_virtual_views/auth');
        View::addLocation(sys_get_temp_dir() . '/laravel_virtual_views');
    }

    /** @test */
    public function test_show_register_page_renders_successfully(): void
    {
        // Cleaned up: Removed exception bypass tracing rules
        $this->mockAuthViews();

        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertViewIs('auth.register');
    }

    /** @test */
    public function test_register_processes_successfully_creates_user_and_logs_in(): void
    {
        $payload = [
            'nama' => 'Malik Perkasa',
            'email' => 'malik@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123', // Satisfies 'confirmed' validation rule
            'no_hp' => '081234567890',
        ];

        // Act: Submit form payload to register endpoint
        $response = $this->post('/register', $payload);

        // Assert: Standard form redirection behavior to homepage
        $response->assertStatus(302);
        $response->assertRedirect(route('beranda'));

        // Assert DB: Verify user was saved with parameters provided
        $this->assertDatabaseHas('users', [
            'email' => 'malik@example.com',
            'nama' => 'Malik Perkasa',
            'no_hp' => '081234567890',
        ]);

        // Assert Auth: Check if user is automatically authenticated into application session
        $this->assertTrue(Auth::check());
        $this->assertEquals('malik@example.com', Auth::user()->email);
    }

    /** @test */
    public function test_register_fails_validation_if_fields_are_invalid_or_missing(): void
    {
        // Password mismatch and missing required fields
        $invalidPayload = [
            'nama' => '',
            'email' => 'not-an-email',
            'password' => '125',
            'password_confirmation' => 'mismatch_val',
            'no_hp' => '',
        ];

        // Use postJson to catch clear validation error matrices directly
        $response = $this->postJson('/register', $invalidPayload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['nama', 'email', 'password', 'no_hp']);
    }

    /** @test */
    public function test_register_fails_if_email_is_already_taken(): void
    {
        // Seed an existing user first
        User::factory()->create(['email' => 'existing@example.com']);

        $payload = [
            'nama' => 'New User',
            'email' => 'existing@example.com', // Duplicate email
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'no_hp' => '089999999',
        ];

        $response = $this->postJson('/register', $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email']);
    }

    /** @test */
    public function test_show_login_page_renders_successfully(): void
    {
        $this->mockAuthViews();

        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    /** @test */
    public function test_login_authenticates_successfully_with_correct_credentials(): void
    {
        // Arrange: Create a user explicitly hashing their password
        $user = User::factory()->create([
            'email' => 'loginme@example.com',
            'password' => Hash::make('secret-pass'),
        ]);

        $credentials = [
            'email' => 'loginme@example.com',
            'password' => 'secret-pass',
        ];

        // Act
        $response = $this->post('/login', $credentials);

        // Assert
        $response->assertStatus(302);
        $response->assertRedirect(route('beranda'));
        $this->assertTrue(Auth::check());
        $this->assertEquals($user->id_user, Auth::id());
    }

    /** @test */
    public function test_login_fails_and_redirects_back_with_errors_on_wrong_credentials(): void
    {
        // Create user baseline
        User::factory()->create([
            'email' => 'secure@example.com',
            'password' => Hash::make('correct-password'),
        ]);

        $wrongCredentials = [
            'email' => 'secure@example.com',
            'password' => 'wrong-password-attempt',
        ];

        // Act
        $response = $this->post('/login', $wrongCredentials);

        // Assert: Standard Laravel web login fallback structure
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email']);
        $this->assertFalse(Auth::check());
    }

    /** @test */
    public function test_logout_session_clears_and_redirects_unauthenticated_user_to_login(): void
    {
        $user = User::factory()->create();

        // Act: Log in actingAs the user, then send a POST request to logout
        $response = $this->actingAs($user)->post('/logout');

        // Assert
        $response->assertStatus(302);
        $response->assertRedirect('/login');
        $response->assertSessionHas('status', 'Anda telah berhasil Logout.');
        
        // Confirm user session is fully unauthenticated
        $this->assertFalse(Auth::check());
    }
}
