<?php

namespace Tests\Feature\Console\Commands;

use Illuminate\Support\Facades\Config;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCaseWithDatabase;
use Throwable;

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

    public function test_import_game_data_command_will_throw_a_validation_exception_because_of_broken_data(): void
    {
        $this->expectException(Throwable::class);

        Config::set('game.imports.dir', base_path('tests/Fixtures/Imports/'));

        $this->artisan('import:game');
    }

    public function test_import_game_data_import_throws_an_exception_as_file_is_completely_missing(): void
    {
        $this->expectException(Throwable::class);

        Config::set('game.imports.dir', base_path());

        $this->artisan('import:game');
    }
}
