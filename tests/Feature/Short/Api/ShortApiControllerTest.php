<?php

use App\Models\Short;
use App\Models\User;
use App\Models\App;

beforeEach(function () {
    $user = User::factory()->create();
    $this->appModel = App::factory()->for($user)->create();
    $this->token = $this->appModel->createToken('test-token', ['shorts:view'])->plainTextToken;
});

it('can get an owned short by code', function () {
    $short = Short::factory()->for($this->appModel, 'shortable')->create();

    $this->withHeader('Authorization', 'Bearer ' . $this->token)
        ->getJson(route('api.v1.shorts.show', ['code' => $short->code]))
        ->assertOk();
});

it('can not get a short by code without permission', function () {
    $short = Short::factory()->for($this->appModel, 'shortable')->create();
    $token = $this->appModel->createToken('test-token', ['shorts:create'])->plainTextToken;

    $this->withHeader('Authorization', 'Bearer ' . $token)
        ->getJson(route('api.v1.shorts.show', ['code' => $short->code]))
        ->assertForbidden();
});

it('can not get a short owned by another user or app', function () {
    Short::factory()->for($this->appModel, 'shortable')->create();

    $user2 = User::factory()->create();
    $app2 = App::factory()->for($user2)->create();
    $short2 = Short::factory()->for($app2, 'shortable')->create();

    $this->withHeader('Authorization', 'Bearer ' . $this->token)
        ->getJson(route('api.v1.shorts.show', ['code' => $short2->code]))
        ->assertNotFound();
});

it('can not get a short if requested by a User instead of an App', function () {
    $user = User::factory()->create();
    $short = Short::factory()->for($this->appModel, 'shortable')->create();
    $token = $user->createToken('test-token', ['shorts.create'])->plainTextToken;

    $this->withHeader('Authorization', 'Bearer ' . $token)
        ->getJson(route('api.v1.shorts.show', ['code' => $short->code]))
        ->assertForbidden();
});

it('can not create a short without permission', function () {
    $this->withHeader('Authorization', 'Bearer ' . $this->token)
        ->postJson(route('api.v1.shorts.store'))
        ->assertForbidden();
});

it('can not create if code already exists for the same app', function () {
    $short = Short::factory()->for($this->appModel, 'shortable')->create();
    $token = $this->appModel->createToken('test-token', ['shorts:create'])->plainTextToken;

    $this->withHeader('Authorization', 'Bearer ' . $token)
        ->postJson(route('api.v1.shorts.store'), [
            'url' => 'https://example.com',
            'code' => $short->code,
        ])
        ->assertJsonValidationErrors(['code']);
});

it('can create a short with a code that exists on another app', function () {
    $app2 = App::factory()->for($this->appModel->user)->create();
    $short = Short::factory()->for($app2, 'shortable')->create();
    $token = $this->appModel->createToken('test-token', ['shorts:create'])->plainTextToken;

    $this->withHeader('Authorization', 'Bearer ' . $token)
        ->postJson(route('api.v1.shorts.store'), [
            'url' => 'https://example.com',
            'code' => $short->code,
        ])
        ->assertCreated();
});

it('automatically generates a code if none is provided', function () {
    $token = $this->appModel->createToken('test-token', ['shorts:create'])->plainTextToken;
    $url = 'https://example.com';
    $this->withHeader('Authorization', 'Bearer ' . $token)
        ->postJson(route('api.v1.shorts.store'), [
            'url' => $url,
        ])
        ->assertCreated();

    $this->assertDatabaseHas('shorts', [
        'shortable_type' => App::class,
        'shortable_id' => $this->appModel->id,
        'url' => $url,
    ]);
});