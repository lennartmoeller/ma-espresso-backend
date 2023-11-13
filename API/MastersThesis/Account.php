<?php

/**
 * PHP version 8.1
 *
 * @package    Apps\MastersThesis\API\MastersThesis
 * @author     Lennart Möller <kontakt@lennartmoeller.com>
 * @copyright  2020-2023 Lennart Möller
 */

namespace Apps\MastersThesis\API\MastersThesis;

use Apps\MastersThesis\Model\Account as AccountModel;
use Core\Base\API;
use Core\Database\Exceptions\BadNullException;
use Core\Database\Exceptions\CheckConstraintViolatedException;
use Core\Database\Exceptions\ColumnNotInitializedException;
use Core\Database\Exceptions\DuplicateEntryException;
use Core\Database\Exceptions\InvalidValueTypeForColumnException;
use Core\Database\Exceptions\PrimaryColumnNotSetException;
use JetBrains\PhpStorm\NoReturn;

class Account extends API {

    /**
     * @throws ColumnNotInitializedException
     * @throws CheckConstraintViolatedException
     * @throws PrimaryColumnNotSetException
     * @throws DuplicateEntryException
     * @throws BadNullException
     */
    #[NoReturn] public static function put(array $data): void {
        $account = AccountModel::create($data);
        $account->save();
        self::success(['id' => $account->id->get()]);
    }

    /**
     * @throws InvalidValueTypeForColumnException
     */
    #[NoReturn] public static function delete(string $id): void {
        $account = new AccountModel();
        $account->id->set($id);
        $account->delete();
        self::success();
    }

}
