<?php

namespace Tests\Feature\Imports;

use App\Imports\AbilitiesImport;
use App\Imports\FightersImport;
use App\Imports\RacesImport;
use App\Models\Ability;
use App\Models\Fighter;
use App\Models\Race;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCaseWithDatabase;

/**
 * Class ImportTest
 *
 * @package Tests\Feature\Imports
 */
final class ImportTest extends TestCaseWithDatabase
{
    protected string $racesFilepath;
    protected string $fightersFilepath;
    protected string $abilitiesFilepath;

    /** @inheritDoc */
    protected function setUp(): void
    {
        parent::setUp();

        $baseFilePath = config('game.imports.dir');

        $this->racesFilepath = $baseFilePath . Race::IMPORT_SHEET;
        $this->fightersFilepath = $baseFilePath . Fighter::IMPORT_SHEET;
        $this->abilitiesFilepath = $baseFilePath . Ability::IMPORT_SHEET;
    }

    public function test_race_import_sheet_exists(): void
    {
        self::assertFileExists($this->racesFilepath);
    }

    public function test_fighters_import_sheet_exists(): void
    {
        self::assertFileExists($this->fightersFilepath);
    }

    public function test_abilities_import_sheet_exists(): void
    {
        self::assertFileExists($this->abilitiesFilepath);
    }

    public function test_races_can_be_imported(): void
    {
        Excel::fake();

        Excel::import(new RacesImport(), $this->racesFilepath);

        Excel::assertImported($this->racesFilepath);
    }

    public function test_fighters_can_be_imported(): void
    {
        Excel::fake();

        Excel::import(new RacesImport(), $this->racesFilepath);
        Excel::import(new FightersImport(), $this->fightersFilepath);

        Excel::assertImported($this->fightersFilepath);
    }

    public function test_abilities_can_be_imported(): void
    {
        Excel::fake();

        Excel::import(new RacesImport(), $this->racesFilepath);
        Excel::import(new FightersImport(), $this->fightersFilepath);
        Excel::import(new AbilitiesImport(), $this->abilitiesFilepath);

        Excel::assertImported($this->abilitiesFilepath);
    }
}
