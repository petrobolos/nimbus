<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * Class Fighter
 *
 * @package App\Models
 */
class Fighter extends Model
{
    use HasFactory;

    /**
     * A fighter belongs to a single race.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function race(): BelongsTo
    {
        return $this->belongsTo(Race::class);
    }

    /**
     * A fighter has a single previous form.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lastForm(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'last_form_id');
    }

    /**
     * A fighter can have multiple next forms.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nextForms(): HasMany
    {
        return $this->hasMany(__CLASS__, 'last_form_id');
    }

    /**
     * Returns the entire form tree of a given fighter, starting at its most base form.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllForms(): Collection
    {
        $currentNode = $this;

        do {
            $currentNode = $currentNode->lastForm;
        } while ($currentNode->lastForm !== null);

        return collect($this->traverseNodesForForms($currentNode));
    }

    /**
     * Traverse recursively through the forms of fighters to build a structured collection of fighter objects.
     *
     * @param \App\Models\Fighter $currentFighter
     * @return array
     */
    private function traverseNodesForForms(Fighter $currentFighter): array
    {
        $fighters = [];

        if ($currentFighter->nextForms->count() !== 0) {
            foreach ($currentFighter->nextForms as $fighterForm) {
                $fighters[$fighterForm->code] = $fighterForm->withoutRelations();
                $fighters[$fighterForm->code]['forms'] = $this->traverseNodesForForms($fighterForm);
            }
        }

        return $fighters;
    }
}
