<?php

/**
 * PHP version 8.1
 *
 * @package    Apps\MastersThesis\API\MastersThesis
 * @author     Lennart Möller <kontakt@lennartmoeller.com>
 * @copyright  2020-2023 Lennart Möller
 */

namespace Apps\MastersThesis\API\MastersThesis;

use Apps\FontAwesome\FontAwesomeException;
use Apps\FontAwesome\FontAwesomeIcon;
use Apps\MastersThesis\Model\Account;
use Apps\MastersThesis\Model\Category;
use Apps\MastersThesis\Model\Transaction;
use Core\Base\API;
use Core\Database\Exceptions\ColumnNotInitializedException;
use JetBrains\PhpStorm\NoReturn;

class Data extends API {

    private const STD_ICONS = ['building-columns', 'icons', 'money-bills', 'question'];

    /**
     * @throws ColumnNotInitializedException
     * @throws FontAwesomeException
     */
    #[NoReturn] public function get(): void {
        $accounts = Account::get_multiple();
        $categories = Category::get_multiple();
        $transactions = Transaction::get_multiple();
        // get all used icons
        $icon_ids = self::STD_ICONS;
        foreach ([...$accounts, ...$categories] as $row) {
            $icon_id = $row->icon->get();
            if ($icon_id === null || in_array($icon_id, $icon_ids, true)) {
                continue;
            }
            $icon_ids[] = $icon_id;
        }
        $icons = FontAwesomeIcon::get_multiple(FontAwesomeIcon::STYLE_SOLID, $icon_ids ?? []);
        self::success(array(
            'accounts' => $accounts,
            'categories' => $categories,
            'icons' => $icons,
            'transactions' => $transactions,
        ));
    }

}
