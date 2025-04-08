<?php

namespace App\Services;

use Illuminate\Support\Facades\Lang;

use function PHPSTORM_META\type;

class Metatag
{
    public string|null $title = null;
    public string|null $description = null;
    public string|null $author = null;

    public string|null $locale = 'fa';
    public string|null $type = 'website';
    public string|null $url = null;
    public string|null $image = null;
    public string|null $published_time = null;
    public string|null $modified_time = null;


    public function __construct() {


        if (request()->route()->getName() !== null && Lang::has('metatags.' . str_replace('.', '-', request()->route()->getName()))) {

            $routeName = str_replace('.', '-', request()->route()->getName());
            
            $this->title = Lang::get('metatags.' . $routeName . '.title');
            $this->description = Lang::get('metatags.' . $routeName . '.description');
            $this->author = Lang::get('metatags.' . $routeName . '.author');
        
        } else {

            $this->title = Lang::get('metatags.welcome.title');
            $this->description = Lang::get('metatags.welcome.description');
        }

        $this->author = Lang::get('metatags.welcome.author');

        $this->locale = config('app.locale');
        $this->type = 'website';
        $this->url = request()->url();
        $this->image = asset('favicon/icon-192x192.png');
        
    }
    /**
     * Set the title
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Set the description
     */
    public function setDescription(string|null $description): self
    {
        $this->description = $description;
        return $this;
    }


    /**
     * Set the author
     */
    public function setAuthor(string $author): self
    {
        $this->author = $author;
        return $this;
    }


    /**
     * Set the locale
     */
    public function setLocale(string $locale): self
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * Set the type
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Set the URL
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Set the image URL
     */
    public function setImage(string $image): self
    {
        $this->image = $image;
        return $this;
    }

    /**
     * Set the published time
     */
    public function setPublishedTime(string $published_time): self
    {
        $this->published_time = $published_time;
        return $this;
    }

    /**
     * Set the modified time
     */
    public function setModifiedTime(string $modified_time): self
    {
        $this->modified_time = $modified_time;
        return $this;
    }

    /**
     * Set multiple properties from an array
     */
    public function setFromArray(array $data): self
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
        return $this;
    }

    /**
     * Get all properties as an array
     */
    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'author' => $this->author,
            'locale' => $this->locale,
            'type' => $this->type,
            'url' => $this->url,
            'image' => $this->image,
            'published_time' => $this->published_time,
            'modified_time' => $this->modified_time,
        ];
    }
} 