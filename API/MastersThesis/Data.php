<?php

/**
 * PHP version 8.1
 *
 * @package    Apps\MastersThesis\API\MastersThesis
 * @author     Lennart Möller <kontakt@lennartmoeller.com>
 * @copyright  2020-2023 Lennart Möller
 */

namespace Apps\MastersThesis\API\MastersThesis;

use Apps\MastersThesis\Model\Account;
use Apps\MastersThesis\Model\Category;
use Apps\MastersThesis\Model\Transaction;
use Core\Base\API;
use JetBrains\PhpStorm\NoReturn;

class Data extends API {

    #[NoReturn] public function get(): void {
        self::success(array(
            'accounts' => Account::get_multiple(),
            'categories' => Category::get_multiple(),
            'transactions' => Transaction::get_multiple()
        ));
    }

}
