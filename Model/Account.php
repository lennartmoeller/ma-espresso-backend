<?php

/**
 * PHP version 8.1
 *
 * @package    Apps\MastersThesis\Model
 * @author     Lennart Möller <kontakt@lennartmoeller.com>
 * @copyright  2020-2023 Lennart Möller
 */

namespace Apps\MastersThesis\Model;

use Core\Database\Columns\IDColumn;
use Core\Database\Columns\IntegerColumn;
use Core\Database\Columns\StringColumn;
use Core\Database\Rows\Row;

class Account extends Row {

    public const TABLE_NAME = 'ma_accounts';

    public IDColumn $id;

    public StringColumn $label;

    public IntegerColumn $start_balance;

    public function __construct() {
        $this->id = new IDColumn();
        $this->label = new StringColumn(unique: true);
        $this->start_balance = new IntegerColumn(max_size: 10000000000, default_value: 0);
    }

}
