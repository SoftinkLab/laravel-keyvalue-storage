<?php

namespace SoftinkLab\LaravelKeyvalueStorage\Test;

use SoftinkLab\LaravelKeyvalueStorage\KVOption;

class DatabaseTest extends BaseDBTest
{
    /** @test */
    public function it_can_get_instance()
    {
        $this->assertInstanceOf(KVOption::class, kvoption());
    }

    /** @test */
    public function it_can_set()
    {
        kvoption(['foo', 'bar']);

        $this->assertDatabaseHas('kv_storage', ['key' => 'foo', 'value' => 'bar']);
    }

    /** @test */
    public function it_can_get_default()
    {
        $this->assertEquals('baz', kvoption('foo', 'baz'));
    }

    /** @test */
    public function it_can_get()
    {
        kvoption(['foo', 'bar']);

        $this->assertEquals('bar', kvoption('foo', 'baz'));
    }

    /** @test */
    public function it_can_check_if_exists()
    {
        $this->assertFalse(kvoption_exists('foo'));

        kvoption(['foo', 'bar']);

        $this->assertTrue(kvoption_exists('foo'));
    }

    /** @test */
    public function it_can_remove()
    {
        kvoption(['foo', 'bar']);

        $this->assertDatabaseHas('kv_storage', ['key' => 'foo', 'value' => 'bar']);

        kvoption_remove('foo');

        $this->assertDatabaseMissing('kv_storage', ['key' => 'foo', 'value' => 'bar']);
    }

    /** @test */
    public function it_can_store_multiple()
    {
        kvoption([['foo1', 'bar1'], ['foo2', 'bar2']]);

        $this->assertDatabaseHas('kv_storage', ['key' => 'foo1', 'value' => 'bar1']);
        $this->assertDatabaseHas('kv_storage', ['key' => 'foo2', 'value' => 'bar2']);
    }

    /** @test */
    public function it_can_increment()
    {
        kvoption(['foo', 1]);

        $this->assertDatabaseHas('kv_storage', ['key' => 'foo', 'value' => 1]);

        kvoption()->incrementValue('foo', 1);

        $this->assertDatabaseHas('kv_storage', ['key' => 'foo', 'value' => 2]);
    }

    /** @test */
    public function it_can_decrement()
    {
        kvoption(['foo', 1]);

        $this->assertDatabaseHas('kv_storage', ['key' => 'foo', 'value' => 1]);

        kvoption()->decrementValue('foo', 1);

        $this->assertDatabaseHas('kv_storage', ['key' => 'foo', 'value' => 0]);
    }
}
