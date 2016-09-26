<?php

namespace App\Models\Traits\Seo;

trait SeoTrait
{
    /**
     * Returns the seo entry that belongs to entity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    abstract public function seo();

    /**
     * Determines if the entity has a seo entry attached.
     *
     * @return bool
     */
    public function hasSeo()
    {
        return (bool) $this->seo;
    }

    /**
     * Creates a new seo entry.
     *
     * @param array $attributes
     *
     * @return Seo
     */
    public function createSeo(array $data)
    {
        return $this->seo()->create($this->sanatize($data));
    }

    /**
     * Updates the seo entry with the given attributes.
     *
     * @param array $attributes
     *
     * @return \Werxe\LaravelSeo\Contracts\Seo
     */
    public function updateSeo(array $data)
    {
        $seo = $this->seo;

        $seo->fill($this->sanatize($data))->save();

        return $seo;
    }

    /**
     * Creates or Updates the seo entry with the given attributes.
     *
     * @param array $attributes
     *
     * @return Seo
     */
    public function storeSeo(array $attributes)
    {
        $method = !$this->seo ? 'createSeo' : 'updateSeo';

        return $this->{$method}($attributes);
    }

    /**
     * Deletes the seo entry that's attached to the entity.
     *
     * @return Seo
     */
    public function deleteSeo()
    {
        return $this->seo->delete();
    }

    protected function sanatize($data)
    {
        return ['title' => $data['title'], 'description' => $data['description'], 'keywords' => $data['keywords'], 'robots' => $data['robots']];
    }
}
