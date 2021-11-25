<?php

namespace Goedemiddag\Auth\Tests\Unit;

use Goedemiddag\Auth\SimpleUserProvider;
use Illuminate\Auth\GenericUser;
use Illuminate\Contracts\Auth\Authenticatable;
use Mockery as m;
use PHPUnit\Framework\TestCase;

class SimpleUserProviderTest extends TestCase
{

    public function testRetrieveByIDReturnsUserWhenUserIsFound()
    {
        $provider = new SimpleUserProvider('foo', 'bar');
        $user = $provider->retrieveById('foo');

        $this->assertInstanceOf(GenericUser::class, $user);
        $this->assertSame('foo', $user->getAuthIdentifier());
    }


    public function testRetrieveByIDReturnsNullWhenUserIsNotFound()
    {
        $provider = new SimpleUserProvider('foo', 'bar');
        $user = $provider->retrieveById(1);

        $this->assertNull($user);
    }


    public function testRetrieveByCredentialsReturnsUserWhenUserIsFound()
    {
        $provider = new SimpleUserProvider('foo', 'bar');
        $user = $provider->retrieveByCredentials(['email' => 'foo', 'password' => 'bar']);

        $this->assertInstanceOf(GenericUser::class, $user);
        $this->assertSame('foo', $user->getAuthIdentifier());
    }


    public function testRetrieveByCredentialsReturnsNullWhenUserIsFound()
    {
        $provider = new SimpleUserProvider('foo', 'bar');
        $user = $provider->retrieveByCredentials(['email' => 'dayle']);

        $this->assertNull($user);
    }


    public function testCredentialValidation()
    {
        $provider = new SimpleUserProvider('foo', 'bar');
        $user = m::mock(Authenticatable::class);
        $user->shouldReceive('getAuthPassword')->once()->andReturn('bar');
        $result = $provider->validateCredentials($user, ['password' => 'bar']);

        $this->assertTrue($result);
    }


    public function testCredentialValidationWithWrongPassword()
    {
        $provider = new SimpleUserProvider('foo', 'bar');
        $user = m::mock(Authenticatable::class);
        $user->shouldReceive('getAuthPassword')->once()->andReturn('bar');
        $result = $provider->validateCredentials($user, ['password' => 'wrong']);

        $this->assertFalse($result);
    }

}
