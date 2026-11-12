<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class ApiTokenExpiryTest extends TestCase
{
    use RefreshDatabase;

    private function tokenValidForOneDay(): string
    {
        // sama seperti AuthController::login(): ability lengkap + kedaluwarsa 1 hari
        return User::factory()->create()
            ->createToken('mobile-kasir', ['products:read'], now()->addDay())
            ->plainTextToken;
    }

    public function test_valid_token_is_accepted_before_expiry(): void
    {
        $token = $this->tokenValidForOneDay();

        // kontrol: tanpa ini, 401 di test berikutnya bisa saja disebabkan hal lain
        $this->withToken($token)->getJson('/api/v1/products')->assertOk();
    }

    public function test_expired_token_is_rejected_with_401(): void
    {
        $token = $this->tokenValidForOneDay();

        // majukan waktu 2 hari: lewat dari masa berlaku 1 hari
        Carbon::setTestNow(now()->addDays(2));

        $this->withToken($token)
            ->getJson('/api/v1/products')
            ->assertUnauthorized()                         // 401
            ->assertJson(['message' => 'Unauthenticated.']);
    }

    public function test_token_is_still_valid_just_before_expiry(): void
    {
        $token = $this->tokenValidForOneDay();

        // batas: 23 jam 59 menit setelah dibuat, token masih sah
        Carbon::setTestNow(now()->addHours(23)->addMinutes(59));

        $this->withToken($token)->getJson('/api/v1/products')->assertOk();
    }
}