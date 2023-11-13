<?php

/**
 * PHP version 8.1
 *
 * @package    Apps\MastersThesis\API\MastersThesis
 * @author     Lennart Möller <kontakt@lennartmoeller.com>
 * @copyright  2020-2023 Lennart Möller
 */

namespace Apps\MastersThesis\API\MastersThesis;

use Apps\MastersThesis\Model\Transaction as TransactionModel;
use Core\Base\API;
use Core\Database\Exceptions\BadNullException;
use Core\Database\Exceptions\CheckConstraintViolatedException;
use Core\Database\Exceptions\ColumnNotInitializedException;
use Core\Database\Exceptions\DuplicateEntryException;
use Core\Database\Exceptions\InvalidValueTypeForColumnException;
use Core\Database\Exceptions\PrimaryColumnNotSetException;
use JetBrains\PhpStorm\NoReturn;

class Transaction extends API {

    /**
     * @throws ColumnNotInitializedException
     * @throws CheckConstraintViolatedException
     * @throws PrimaryColumnNotSetException
     * @throws DuplicateEntryException
     * @throws BadNullException
     */
    #[NoReturn] public static function put(array $data): void {
        $transaction = TransactionModel::create($data);
        $transaction->save();
        self::success(['id' => $transaction->id->get()]);
    }

    /**
     * @throws InvalidValueTypeForColumnException
     */
    #[NoReturn] public static function delete(string $id): void {
        $transaction = new TransactionModel();
        $transaction->id->set($id);
        $transaction->delete();
        self::success();
    }

}
