<?php

namespace Tests\Feature;

use App\Models\Barang;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\View;
use Tests\TestCase;

class LaporanControllerTest extends TestCase
{
    use RefreshDatabase; // Completely isolated database migration per test function

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();

        // 1. Create a temporary folder path in system memory (/tmp)
        $tempViewPath = sys_get_temp_dir() . '/laravel_virtual_views/laporan';
        if (!file_exists($tempViewPath)) {
            mkdir($tempViewPath, 0777, true);
        }

        // 2. Write empty files into the system temporary folder (not your project folder)
        file_put_contents($tempViewPath . '/index.blade.php', '');
        file_put_contents($tempViewPath . '/show.blade.php', '');

        // 3. Force Laravel's View engine to look inside this system temp folder
        \Illuminate\Support\Facades\View::addNamespace('laporan', sys_get_temp_dir() . '/laravel_virtual_views/laporan');
        
        // 4. Fallback: Tell the view finder where to find global file locations dynamically
        \Illuminate\Support\Facades\View::addLocation(sys_get_temp_dir() . '/laravel_virtual_views');
    }

    /** @test */
    public function test_index_method_renders_the_laporan_blade_view_successfully(): void
    {
        // Arrange: Seed 2 reports using factories
        Laporan::factory()->count(2)->create(['fk_id_user' => $this->user->id_user]);

        // Act: Hit the index endpoint using a standard GET request (not getJson)
        $response = $this->actingAs($this->user)->get('/laporan');

        // Assert: It should return a 200 OK status code
        $response->assertStatus(200);

        // Assert: Check that it tries to load the correct view file layout
        $response->assertViewIs('laporan.index');

        // Assert: Ensure the view payload variable 'laporans' is passed to the template
        $response->assertViewHas('laporans');
    }

    /** @test */
    public function test_store_method_creates_laporan_and_barang_then_redirects(): void
    {
        // 1. Generate report parameters in-memory (skips afterCreating)
        $laporanData = Laporan::factory()->make([
            'kategori_laporan' => 'lost' // Must match enum string exactly
        ])->toArray();

        // 2. Explicitly generate barang data from its own factory in-memory
        $barangData = Barang::factory()->make([
            'kategori_barang' => 'elektronik', // Overriding with a safe enum value
            'nama_barang' => 'Asus ROG Laptop',
            'lokasi' => 'Classroom 3B'
        ])->toArray();

        // 3. Combine both data sets into one single request array body
        $payload = array_merge($laporanData, $barangData);

        // Act: Submit the compound array payload to your controller
        $response = $this->actingAs($this->user)->post('/laporan', $payload);

        // Assert: Standard form redirection behavior
        $response->assertRedirect(route('laporan.index'));
        $response->assertSessionHas('status', 'Laporan berhasil dibuat!');

        // Assert DB: Verify the parent record reached the table safely
        $this->assertDatabaseHas('laporan', [
            'kategori_laporan' => $payload['kategori_laporan'],
            'fk_id_user'       => $this->user->id_user
        ]);
    }


    /** @test */
    public function test_store_fails_validation_if_required_fields_are_absent(): void
    {
        // 1. Arrange: Provide an incomplete payload missing required fields
        $invalidPayload = [
            'deskripsi' => 'Testing validation boundaries with missing fields'
        ];

        // 2. Act: Use postJson() to force Laravel to handle the validation as a stateless API request
        $response = $this->actingAs($this->user)
                         ->postJson('/laporan', $invalidPayload);

        // 3. Assert: Expect HTTP 422 Unprocessable Entity (Standard API Validation Failure) [1]
        $response->assertStatus(422);
        
        // 4. Assert: Verify the JSON structure explicitly lists your missing validation keys [1]
        $response->assertJsonValidationErrors(['kategori_laporan', 'nama_barang', 'kategori_barang']);
    }

    /** @test */
    public function test_show_method_loads_individual_report_details(): void
    {
        // Arrange: Build an entity record inside our temporary database layer
        $laporan = Laporan::factory()->create(['fk_id_user' => $this->user->id_user]);

        // Act: Execute show path using custom routing parameters
        $response = $this->actingAs($this->user)->get("/laporan/{$laporan->id_laporan}");

        // Assert: Check view execution parameters
        $response->assertStatus(200);
        $response->assertViewIs('laporan.show');
        $response->assertViewHas('laporan');
    }

    /** @test */
    public function test_update_method_mutates_the_record_and_redirects_to_details_page(): void
    {
        // 1. Create a baseline record explicitly owned by your user with a valid lowercase enum
        $laporan = Laporan::factory()->create([
            'fk_id_user' => $this->user->id_user,
            'kategori_laporan' => 'lost' 
        ]);
        
        // 2. Prepare payload that strictly satisfies 'sometimes|in:kehilangan,penemuan'
        $updatePayload = [
            'kategori_laporan' => 'found', // Changed to the other valid option
            'deskripsi'        => 'Updated text description context.'
        ];

        // Act: Execute PUT request
        $response = $this->actingAs($this->user)->put("/laporan/{$laporan->id_laporan}", $updatePayload);

        // Assert Status first: If this is 302, it means it is a redirect
        $response->assertStatus(302);

        // Assert Redirect: Check if it actually went to the item details page
        $response->assertRedirect(route('items.detail', $laporan->id_laporan));

        // Assert DB: Verify the changes are real
        $this->assertDatabaseHas('laporan', [
            'id_laporan'       => $laporan->id_laporan,
            'kategori_laporan' => 'found',
            'deskripsi'        => 'Updated text description context.'
        ]);
    }



    /** @test */
    public function test_unauthorized_user_cannot_edit_or_update_another_users_report(): void
    {
        // Arrange: Set up a report belonging to User A
        $laporanBelongsToUserA = Laporan::factory()->create(['fk_id_user' => $this->user->id_user]);

        // Create User B (attacker profile)
        $userB = User::factory()->create();

        // Act: User B attempts to access edit view page or trigger an update
        $editResponse   = $this->actingAs($userB)->get("/api/laporan/{$laporanBelongsToUserA->id_laporan}/edit");
        $editResponse   = $this->actingAs($userB)->get("/laporan/{$laporanBelongsToUserA->id_laporan}/edit");
        $updateResponse = $this->actingAs($userB)->put("/laporan/{$laporanBelongsToUserA->id_laporan}", ['deskripsi' => 'Hacked']);

        // Assert: Both actions must return an HTTP 403 Forbidden status as coded in your controller abort() rules
        $editResponse->assertStatus(403);
        $updateResponse->assertStatus(403);
    }
}
