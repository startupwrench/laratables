<?php

namespace Startupwrench\Laratables\Columns;

/**
 * This file is part of Laratables,
 * a helper for generating Datatables 1.10+ usable JSON from Eloquent models.
 *
 * @package Startupwrench\Laratables
 *
 * @license MIT
 */
class RawColumn extends BaseColumn
{
    /**
     * The content of the fields in this column.
     *
     * @var string
     */
    protected $content;

    /**
     * Create a column.
     *
     * @param $name
     * @param $content
     */
    public function __construct($name, $content)
    {
        parent::__construct($name);
        $this->content = $content;
    }

    /**
     * Parse the given record.
     *
     * @param  $record
     * @return mixed
     */
    public function parse($record)
    {
        return $this->content;
    }
}
