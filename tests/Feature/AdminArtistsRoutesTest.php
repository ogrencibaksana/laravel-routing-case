<?php

namespace Tests\Feature;

use App\Models\Artist;
use App\Models\User;
use Faker\Provider\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminArtistsRoutesTest extends TestCase
{
    use RefreshDatabase;

    const UNAUTHORIZED = 401;

    private function guestShouldNotAccess($page)
    {
        $response = $this->get($page);

        $response->assertRedirect(route('login'));
    }

    private function userShouldNotAccess($page)
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get($page);

        $response->assertStatus(self::UNAUTHORIZED);
    }

    private function adminShouldAccess($page)
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $response = $this->actingAs($admin)->get($page);

        $response->assertStatus(200);
    }

    public function testUserAndGuestCannotAccessArtistCreatePage()
    {
        $page = route('admin.artists.create');

        $this->guestShouldNotAccess($page);
        $this->userShouldNotAccess($page);
    }

    public function testAdminCanAccessArtistCreatePage()
    {
        $this->adminShouldAccess(route('admin.artists.create'));
    }

    public function testAdminCanStoreArtist()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $response = $this->actingAs($admin)->post(route('admin.artists.store'), [
            "name" => Person::firstNameFemale(),
            "genre" => "Jazz"
        ]);

        $response->assertStatus(302);
    }

    public function testUserCannotStoreArtist()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('admin.artists.store'), [
            "name" => Person::firstNameFemale(),
            "genre" => "Jazz"
        ]);

        $response->assertStatus(self::UNAUTHORIZED);
    }

    public function testUserAndGuestCannotEditArtists()
    {
        $artist = Artist::factory()->create();
        $page = route('admin.artists.edit', $artist);

        $this->guestShouldNotAccess($page);
        $this->userShouldNotAccess($page);
    }

    public function testUserCannotUpdateArtists()
    {
        $artist = Artist::factory()->create();
        $user = User::factory()->create();
        $page = route('admin.artists.update', $artist);
        $response = $this->actingAs($user)->post($page, [
            "_method" => "PATCH",
            "name" => Person::firstNameFemale(),
            "genre" => "Jazz"
        ]);
        $response->assertStatus(self::UNAUTHORIZED);
    }

}
