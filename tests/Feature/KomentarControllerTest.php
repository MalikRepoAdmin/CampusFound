<?php

namespace Tests\Feature;

use App\Models\Komentar;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\View;
use Tests\TestCase;

class KomentarControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_store_method_successfully_creates_comment_and_redirects(): void
    {
        // 1. Arrange: Create the user and their associated report record
        $user = \App\Models\User::factory()->create();
        $report = \App\Models\Laporan::factory()->create([
            'fk_id_user' => $user->id_user
        ]);

        // 2. Mock virtual views inline to prevent redirect namespace exceptions
        $tempViewPath = sys_get_temp_dir() . '/laravel_virtual_views/laporan';
        if (!file_exists($tempViewPath)) {
            mkdir($tempViewPath, 0777, true);
        }
        file_put_contents($tempViewPath . '/show.blade.php', '');
        \Illuminate\Support\Facades\View::addNamespace('laporan', sys_get_temp_dir() . '/laravel_virtual_views/laporan');
        \Illuminate\Support\Facades\View::addLocation(sys_get_temp_dir() . '/laravel_virtual_views');

        // 3. Prepare the form comment text content payload
        $payload = [
            'isi_komentar' => 'This is a valid test comment text content.',
        ];

        // 4. Act: Execute the POST request passing the report model ID directly into the route helper
        $response = $this->actingAs($user)
                         ->post(route('komentar.store', $report->id_laporan), $payload);

        // 5. Assert: Verify the redirect and session success status message
        $response->assertStatus(302);
        $response->assertRedirect(route('laporan.show', $report->id_laporan));
        $response->assertSessionHas('status', 'Komentar berhasil ditambahkan!');

        // 6. Assert DB: Verify that fk_id_laporan is now populated with the real ID
        $this->assertDatabaseHas('komentar', [
            'isi_komentar'  => $payload['isi_komentar'],
            'fk_id_laporan' => $report->id_laporan,
            'fk_id_user'    => $user->id_user
        ]);
    }

    /** @test */
    public function test_store_fails_validation_if_comment_content_exceeds_max_characters(): void
    {
        $user = User::factory()->create();
        $report = Laporan::factory()->create(['fk_id_user' => $user->id_user]);

        $invalidPayload = [
            'isi_komentar' => str_repeat('A', 1001),
        ];

        $response = $this->actingAs($user)
                         ->postJson(route('komentar.store', ['laporan' => $report->id_laporan]), $invalidPayload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['isi_komentar']);
    }

    /** @test */
    public function test_store_fails_validation_if_comment_content_is_missing(): void
    {
        $user = User::factory()->create();
        $report = Laporan::factory()->create(['fk_id_user' => $user->id_user]);

        $invalidPayload = [
            'isi_komentar' => '',
        ];

        $response = $this->actingAs($user)
                         ->postJson(route('komentar.store', ['laporan' => $report->id_laporan]), $invalidPayload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['isi_komentar']);
    }

    /** @test */
    public function test_destroy_method_allows_owner_to_delete_their_own_comment(): void
    {
        // 1. Arrange: Create a user and a report record
        $user = \App\Models\User::factory()->create();
        $report = \App\Models\Laporan::factory()->create(['fk_id_user' => $user->id_user]);
        
        // Create a comment explicitly belonging to our active test user
        $comment = \App\Models\Komentar::factory()->create([
            'fk_id_user'    => $user->id_user,
            'fk_id_laporan' => $report->id_laporan
        ]);

        // Ensure type properties match identically for strict comparisons (!==)
        $user->id_user = (int) $comment->fk_id_user;

        // 2. Act: Send the DELETE request using your standard resource route path mapping
        $response = $this->actingAs($user)
                         ->delete(route('komentar.destroy', $comment->id_komentar));

        // 3. Assert: Expect a 302 Redirection since it redirects back to the interface
        $response->assertStatus(302);

        // 4. Assert DB: Confirm that the comment entry was successfully deleted from the table
        $this->assertDatabaseMissing('komentar', [
            'id_komentar' => $comment->id_komentar
        ]);
    }
    /** @test */
    public function test_destroy_method_denies_unauthorized_user_from_deleting_someone_elses_comment(): void
    {
        // 1. Arrange: Create a valid comment belonging to the original reporter profile
        $ownerUser = User::factory()->create();
        $report = Laporan::factory()->create(['fk_id_user' => $ownerUser->id_user]);
        
        $comment = Komentar::factory()->create([
            'fk_id_user'    => $ownerUser->id_user,
            'fk_id_laporan' => $report->id_laporan
        ]);

        // Create an attacker profile
        $unauthorizedUser = User::factory()->create();

        // 2. Act: Attempt unauthorized resource destruction request
        $response = $this->actingAs($unauthorizedUser)
                         ->delete(route('komentar.destroy', $comment->id_komentar));

        // 3. Assert: Confirm access is forbidden
        $response->assertStatus(403);

        // Assert DB: The original comment entry must remain protected in the data store
        $this->assertDatabaseHas('komentar', [
            'id_komentar' => $comment->id_komentar
        ]);
    }
}
