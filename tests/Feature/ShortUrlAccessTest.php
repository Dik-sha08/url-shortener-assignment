<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShortUrlAccessTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
    }

    public function test_admin_and_member_and_superadmin_cannot_create_short_urls()
    {
        $company = Company::factory()->create();

        foreach (['Admin', 'Member', 'SuperAdmin'] as $role) {
            $user = User::factory()->create([
                'role' => $role,
                'company_id' => $company->id,
            ]);

            $this->actingAs($user)
                ->post(route('short-urls.store'), ['original_url' => 'https://example.com'])
                ->assertStatus(403);
        }
    }

    public function test_sales_can_create_short_url()
    {
        $company = Company::factory()->create();

        $user = User::factory()->create([
            'role' => 'Sales',
            'company_id' => $company->id,
        ]);

        $this->actingAs($user)
            ->post(route('short-urls.store'), ['original_url' => 'https://example.com'])
            ->assertRedirect(route('short-urls.index'));

        $this->assertDatabaseCount('short_urls', 1);
    }

    public function test_admin_sees_urls_not_in_their_company()
    {
        $companyA = Company::factory()->create();
        $companyB = Company::factory()->create();

        $otherUrl = ShortUrl::factory()->create(['company_id' => $companyB->id]);
        ShortUrl::factory()->create(['company_id' => $companyA->id]); // same company -> should NOT see

        $admin = User::factory()->create(['role' => 'Admin', 'company_id' => $companyA->id]);

        $this->actingAs($admin);
        $response = $this->get(route('short-urls.index'));

        $response->assertSee($otherUrl->short_code);
    }

    public function test_member_sees_urls_not_created_by_them()
    {
        $company = Company::factory()->create();

        $member = User::factory()->create(['role' => 'Member', 'company_id' => $company->id]);
        $otherUser = User::factory()->create(['role' => 'Member', 'company_id' => $company->id]);

        ShortUrl::factory()->create(['user_id' => $member->id, 'company_id' => $company->id]);    // should NOT see
        $otherUrl = ShortUrl::factory()->create(['user_id' => $otherUser->id, 'company_id' => $company->id]);

        $this->actingAs($member);
        $response = $this->get(route('short-urls.index'));

        $response->assertSee($otherUrl->short_code);
    }

    public function test_short_urls_not_publicly_resolvable()
    {
        $company = Company::factory()->create();
        $user = User::factory()->create(['role' => 'Sales', 'company_id' => $company->id]);
        $short = ShortUrl::factory()->create(['user_id' => $user->id, 'company_id' => $company->id]);

        // guest user
        $this->get(route('short-urls.resolve', $short->short_code))
            ->assertRedirect('/login');
    }
}
