<?php

namespace App\Core\DataTable;

/**
 * Class Filter
 */
class Filter
{
    /**
     * @var string
     */
    public string $name;
    /**
     * @var string
     */
    public string $scope;
    /**
     * @var string
     */
    public string $title;
    /**
     * @var string
     */
    public string $type;
    /**
     * @var array
     */
    public array $opts;
    /**
     * @var bool
     */
    public bool $hidden;

    /**
     * @param string $name
     * @param string $title
     */
    public function __construct(string $name, string $title = '')
    {
        $this->name = $name;
        $this->scope = $name;
        $this->title = $title;
        $this->type = 'text';
        $this->opts = [];
        $this->hidden = false;
    }

    /**
     * @param string $name
     * @param string $title
     * @return static
     */
    public static function make(string $name, string $title = ''): static
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
    public function title(string $title = ''): static
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function type(string $type = 'text'): static
    {
        $this->type = $type;
        if ($type === 'daterange') {
            $this->opts(['range']);
        }
        return $this;
    }

    /**
     * @param array $opts
     * @return $this
     */
    public function opts(array $opts = []): static
    {
        $this->opts = $opts;
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

    public function scope(string $scope): static
    {
        $this->scope = $scope;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'scope' => $this->scope,
            'title' => $this->title,
            'type' => $this->type,
            'opts' => $this->opts,
            'hidden' => $this->hidden,
        ];
    }
}
