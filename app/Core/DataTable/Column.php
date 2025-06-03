<?php

namespace App\Core\DataTable;

/**
 * Class Column
 */
class Column
{
    /**
     * @var string
     */
    public string $name;
    /**
     * @var string
     */
    public string $title;
    /**
     * @var string|null
     */
    public ?string $format;
    /**
     * @var bool
     */
    public bool $searchable;
    /**
     * @var bool
     */
    public bool $sortable;
    /**
     * @var bool
     */
    public bool $hidden;


    /**
     * @param string $name
     * @param string $title
     * @param string|null $format
     */
    public function __construct(string $name, string $title, ?string $format = null)
    {
        $this->name = $name;
        $this->title = $title;
        $this->format = $format;
        $this->searchable = true;
        $this->sortable = true;
        $this->hidden = false;
    }

    /**
     * @param string $name
     * @param string $title
     * @return static
     */
    public static function make(string $name, string $title): static
    {
        return new static($name, $title);
    }

    /**
     * @param string $name
     * @return $this
     */
    public function name(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function title(string $title): static
    {
        $this->title = $title;
        return $this;
    }


    /**
     * @param string|null $format date|datetime|money|phone|email|url|image
     * @return $this
     */
    public function format(?string $format): static
    {
        $this->format = $format;
        return $this;
    }

    /**
     * @param bool $searchable
     * @return $this
     */
    public function searchable(bool $searchable = true): static
    {
        $this->searchable = $searchable;
        return $this;
    }

    /**
     * @param bool $sortable
     * @return $this
     */
    public function sortable(bool $sortable = true): static
    {
        $this->sortable = $sortable;
        return $this;
    }

    /**
     * @param bool $hidden
     * @return $this
     */
    public function hidden(bool $hidden = true): static
    {
        $this->hidden = $hidden;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'title' => $this->title,
            'format' => $this->format,
            'searchable' => $this->searchable,
            'sortable' => $this->sortable,
            'hidden' => $this->hidden,
        ];
    }
}
