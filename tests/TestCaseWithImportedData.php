<?php

namespace Tests;

use Illuminate\Support\Facades\Artisan;

abstract class TestCaseWithImportedData extends TestCaseWithDatabase
{
    /**
     * @inheritDoc
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        Artisan::call('import:game');
    }
}
