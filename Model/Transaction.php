<?php

/**
 * PHP version 8.1
 *
 * @package    Apps\MastersThesis\Model
 * @author     Lennart Möller <kontakt@lennartmoeller.com>
 * @copyright  2020-2023 Lennart Möller
 */

namespace Apps\MastersThesis\Model;

use Core\Database\Columns\DateColumn;
use Core\Database\Columns\IDColumn;
use Core\Database\Columns\IntegerColumn;
use Core\Database\Columns\ManyToOneColumn;
use Core\Database\Columns\StringColumn;
use Core\Database\Rows\Row;

class Transaction extends Row {

    public const TABLE_NAME = 'ma_transactions';

    public IDColumn $id;

    public DateColumn $date;

    public ManyToOneColumn $account;

    public ManyToOneColumn $category;

    public StringColumn $description;

    public IntegerColumn $amount;

    public function __construct() {
        $this->id = new IDColumn();
        $this->date = new DateColumn();
        $this->account = new ManyToOneColumn(referenced_row: new Account);
        $this->category = new ManyToOneColumn(referenced_row: new Category);
        $this->description = new StringColumn();
        $this->amount = new IntegerColumn(max_size: 10000000000);
    }

}
