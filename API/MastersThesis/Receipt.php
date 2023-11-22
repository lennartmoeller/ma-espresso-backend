<?php

/**
 * PHP version 8.1
 *
 * @package    Apps\MastersThesis\API\MastersThesis
 * @author     Lennart Möller <kontakt@lennartmoeller.com>
 * @copyright  2020-2023 Lennart Möller
 */

namespace Apps\MastersThesis\API\MastersThesis;

use Core\Base\API;
use Core\Media\Exceptions\FileAlreadyExistException;
use Core\Media\Exceptions\FileNotExistException;
use Core\Media\Exceptions\FileNotSavedException;
use Core\Media\Exceptions\FileTypeUnsupportedException;
use Core\Media\ImageFile;
use JetBrains\PhpStorm\NoReturn;

class Receipt extends API {

    /**
     * Saves the image file in the media folder and creates a database entry.
     * Responds with the filename of the image file on success.
     * @param array{name: string, full_path: string, type: string, tmp_name: string, error: int, size: int} $file
     * @throws FileNotSavedException
     * @throws FileNotExistException
     */
    #[NoReturn] public static function post(array $file): void {
        try {
            try {
                $image = ImageFile::create_original($file['name'], $file['tmp_name']);
            } catch (FileAlreadyExistException $e) {
                $image = new ImageFile($e->filename);
            }
        } catch (FileTypeUnsupportedException $e) {
            self::bad_request_error($e);
        }
        self::success(array('filename' => $image->filename));
    }

}
