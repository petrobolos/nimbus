<?php

namespace Tests\Unit\Repositories;

use App\Models\Fighter;
use App\Repositories\FighterRepository;
use Tests\TestCaseWithImportedData;

final class FighterRepositoryTest extends TestCaseWithImportedData
{
    protected FighterRepository $repository;

    /**
     * @inheritDoc
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = app(FighterRepository::class);
    }

    public function test_fighters_can_be_extracted_from_an_array_of_codes(): void
    {
        $codes = $this->provideSlugArray();
        $fighters = $this->repository->getFightersFromSlugRoster($codes);

        self::assertCount(count($codes), $fighters);
        self::assertContainsOnlyInstancesOf(Fighter::class, $fighters);
        self::assertEquals($codes[0], $fighters->first()->code);
    }

    public function test_fighters_can_be_extracted_from_a_collection_of_codes(): void
    {
        $codes = collect($this->provideSlugArray());
        $fighters = $this->repository->getFightersFromSlugRoster($codes);

        self::assertCount($codes->count(), $fighters);
        self::assertContainsOnlyInstancesOf(Fighter::class, $fighters);
        self::assertEquals($codes->first(), $fighters->first()->code);
    }

    /**
     * Provide an array of fighter codes.
     *
     * @return array
     */
    protected function provideSlugArray(): array
    {
        return [
            Fighter::inRandomOrder()->first()->code,
            Fighter::inRandomOrder()->first()->code,
            Fighter::inRandomOrder()->first()->code,
        ];
    }
}
