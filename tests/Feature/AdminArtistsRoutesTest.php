<?php

namespace Tests\Feature;

use App\Models\Art;
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

    public function testUsersAndGuestsCannotSeeActionButtons()
    {
        Artist::factory(10)->create();
        $artists = Artist::with('art')->paginate();
        $user = User::factory()->create();
        //guest
        $this->guestShouldNotAccess(route('artists.index'));
        //user
        $userPOV = $this->actingAs($user)->view('artists.list', compact('artists'));
        $userPOV->assertDontSee(__('New'));
        $userPOV->assertDontSee(__('Edit'));
        $userPOV->assertDontSee(__('Destroy'));
    }

    public function testUsersAndGuestsCannotCreateArtists()
    {
        $page = route('admin.artists.create');

        $this->guestShouldNotAccess($page);
        $this->userShouldNotAccess($page);
    }

    public function testUsersAndGuestsCannotStoreArtists()
    {
        $user = User::factory()->create();
        $mock = [
            "name" => Person::firstNameFemale(),
            "genre" => "Jazz"
        ];
        //guest
        $guestResponse = $this->post(route('admin.artists.store'), $mock);
        $guestResponse->assertRedirect(route('login'));

        //user
        $userResponse = $this->actingAs($user)->post(route('admin.artists.store'), $mock);
        $userResponse->assertStatus(self::UNAUTHORIZED);

    }

    public function testUsersAndGuestsCannotEditArtists()
    {
        $artist = Artist::factory()->create();
        $page = route('admin.artists.edit', $artist);

        $this->guestShouldNotAccess($page);
        $this->userShouldNotAccess($page);
    }

    public function testUsersAndGuestsCannotUpdateArtists()
    {
        $artist = Artist::factory()->create();
        $user = User::factory()->create();
        $page = route('admin.artists.update', $artist);
        $mock = [
            "_method" => "PATCH",
            "name" => Person::firstNameFemale(),
            "genre" => "Jazz"
        ];
        // guest
        $guestResponse = $this->post($page, $mock);
        $guestResponse->assertRedirect(route('login'));
        // user
        $userResponse = $this->actingAs($user)->post($page, $mock);
        $userResponse->assertStatus(self::UNAUTHORIZED);
    }

    public function testUsersAndGuestsCannotDestroyArtists()
    {
        $artist = Artist::factory()->create();
        $user = User::factory()->create();
        $page = route('admin.artists.destroy', $artist);
        $mock = ["_method" => "DELETE"];
        // guest
        $guestResponse = $this->post($page, $mock);
        $this->assertTrue($artist->exists());
        $guestResponse->assertRedirect(route('login'));

        //user
        $userResponse = $this->actingAs($user)->post($page, $mock);
        $this->assertTrue($artist->exists());
        $userResponse->assertStatus(self::UNAUTHORIZED);
    }

    public function testAdminsCanSeeActionButtons()
    {
        Artist::factory(10)->create();
        $artists = Artist::with('art')->paginate();
        $admin = User::factory()->create(['is_admin' => true]);
        $adminPOV = $this->actingAs($admin)->view('artists.list', compact('artists'));
        $adminPOV->assertSeeInOrder([__('New'), __('Edit'), __('Destroy')]);
    }

    public function testAdminsCanCreateArtists()
    {
        $this->adminShouldAccess(route('admin.artists.create'));
    }

    public function testAdminsCanStoreArtists()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $response = $this->actingAs($admin)->post(route('admin.artists.store'), [
            "name" => Person::firstNameFemale(),
            "genre" => "Jazz"
        ]);

        $response->assertStatus(302);
    }

    public function testAdminsCanEditArtists()
    {
        $artist = Artist::factory()->create();
        $this->adminShouldAccess(route('admin.artists.edit', $artist));
    }

    public function testAdminsCanUpdateArtists()
    {
        $artist = Artist::factory()->create();
        $admin = User::factory()->create(['is_admin' => true]);
        $page = route('admin.artists.update', $artist);
        $mock = [
            "_method" => "PATCH",
            "name" => Person::firstNameMale(),
            "genre" => "Blues"
        ];
        $adminResponse = $this->actingAs($admin)->post($page, $mock);
        $adminResponse->assertRedirect(route('artists.show', $artist));
    }

    public function testAdminsCanDestroyArtists()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $artist = Artist::factory()->create();
        $mock = ["_method" => "DELETE"];
        $page = route('admin.artists.destroy', $artist);

        $this->assertTrue($artist->exists());

        $response = $this->actingAs($admin)->post($page, $mock);

        $this->assertFalse($artist->exists());
        $response->assertRedirect(route('artists.index'));

    }


}
