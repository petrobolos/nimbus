<?php

namespace Tests\Feature\Console\Commands;

use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCaseWithDatabase;

/**
 * Class ImportGameDataCommandTest
 *
 * @package Tests\Feature\Console\Commands
 */
final class ImportGameDataCommandTest extends TestCaseWithDatabase
{
    public function test_import_game_data_command_will_import_data_from_all_game_sheets(): void
    {
        Excel::fake();

        $this->artisan('import:game')
            ->expectsOutput('Starting import!')
            ->assertExitCode(0);
    }
}
