<?php

namespace App\Support\Linting;

use Tighten\TLint\Linters\AlphabeticalImports;
use Tighten\TLint\Linters\ApplyMiddlewareInRoutes;
use Tighten\TLint\Linters\ArrayParametersOverViewWith;
use Tighten\TLint\Linters\ClassThingsOrder;
use Tighten\TLint\Linters\ConcatenationSpacing;
use Tighten\TLint\Linters\ImportFacades;
use Tighten\TLint\Linters\MailableMethodsInBuild;
use Tighten\TLint\Linters\NewLineAtEndOfFile;
use Tighten\TLint\Linters\NoCompact;
use Tighten\TLint\Linters\NoDatesPropertyOnModels;
use Tighten\TLint\Linters\NoDocBlocksForMigrationUpDown;
use Tighten\TLint\Linters\NoDump;
use Tighten\TLint\Linters\NoLeadingSlashesOnRoutePaths;
use Tighten\TLint\Linters\NoSpaceAfterBladeDirectives;
use Tighten\TLint\Linters\NoStringInterpolationWithoutBraces;
use Tighten\TLint\Linters\NoUnusedImports;
use Tighten\TLint\Linters\OneLineBetweenClassVisibilityChanges;
use Tighten\TLint\Linters\QualifiedNamesOnlyForClassName;
use Tighten\TLint\Linters\RemoveLeadingSlashNamespaces;
use Tighten\TLint\Linters\RequestValidation;
use Tighten\TLint\Linters\RestControllersMethodOrder;
use Tighten\TLint\Linters\SpaceAfterBladeDirectives;
use Tighten\TLint\Linters\SpaceAfterSoleNotOperator;
use Tighten\TLint\Linters\SpacesAroundBladeRenderContent;
use Tighten\TLint\Linters\TrailingCommasOnArrays;
use Tighten\TLint\Linters\UseConfigOverEnv;
use Tighten\TLint\Presets\PresetInterface;

/**
 * Class TlintPreset
 *
 * @package App\Support\Linting
 */
final class TlintPreset implements PresetInterface
{
    /**
     * Return an array of linters that TLint will use to check the codebase.
     * @return array
     */
    public function getLinters(): array
    {
        return [
            AlphabeticalImports::class,
            ApplyMiddlewareInRoutes::class,
            ArrayParametersOverViewWith::class,
            ClassThingsOrder::class,
            ConcatenationSpacing::class,
            ImportFacades::class,
            MailableMethodsInBuild::class,
            NewLineAtEndOfFile::class,
            NoCompact::class,
            NoDatesPropertyOnModels::class,
            NoDump::class,
            NoDocBlocksForMigrationUpDown::class,
            NoLeadingSlashesOnRoutePaths::class,
            NoSpaceAfterBladeDirectives::class,
            NoStringInterpolationWithoutBraces::class,
            NoUnusedImports::class,
            OneLineBetweenClassVisibilityChanges::class,
            QualifiedNamesOnlyForClassName::class,
            RemoveLeadingSlashNamespaces::class,
            RequestValidation::class,
            RestControllersMethodOrder::class,
            SpaceAfterBladeDirectives::class,
            SpaceAfterSoleNotOperator::class,
            SpacesAroundBladeRenderContent::class,
            TrailingCommasOnArrays::class,
            UseConfigOverEnv::class,
        ];
    }

    /**
     * Return an array of formatters for TLint to use.
     *
     * @return array
     */
    public function getFormatters(): array
    {
        return [];
    }
}
