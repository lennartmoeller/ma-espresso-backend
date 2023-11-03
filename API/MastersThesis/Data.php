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

    /**
     * @throws ColumnNotInitializedException
     * @throws FontAwesomeException
     */
    #[NoReturn] public function get(): void {
        $categories = Category::get_multiple();
        $icon_ids = [];
        foreach ($categories as $category) {
            $icon_id = $category->icon->get();
            if ($icon_id === null || in_array($icon_id, $icon_ids, true)) {
                continue;
            }
            $icon_ids[] = $icon_id;
        }
        $icons = FontAwesomeIcon::get_multiple(FontAwesomeIcon::STYLE_SOLID, $icon_ids ?? []);
        self::success(array(
            'accounts' => Account::get_multiple(),
            'categories' => $categories,
            'icons' => $icons,
            'transactions' => Transaction::get_multiple(),
        ));
    }

}
