<?php

/**
 * PHP version 8.1
 *
 * @package    Apps\MastersThesis\Model
 * @author     Lennart Möller <kontakt@lennartmoeller.com>
 * @copyright  2020-2023 Lennart Möller
 */

namespace Apps\MastersThesis\Model;

use Core\Database\Columns\ChoiceColumn;
use Core\Database\Columns\IDColumn;
use Core\Database\Columns\StringColumn;
use Core\Database\Rows\Row;

class Category extends Row {

    // options for type column
    public const TYPE_INCOME = 1;
    public const TYPE_EXPENSE = 2;

    public const TABLE_NAME = 'ma_categories';

    public IDColumn $id;

    public StringColumn $label;

    public ChoiceColumn $type;

    public function __construct() {
        $this->id = new IDColumn();
        $this->label = new StringColumn();
        $this->type = new ChoiceColumn(default_value: self::TYPE_EXPENSE);
        $this->add_check_constraint('type_range', "`type` BETWEEN 1 AND 2");
    }

}
