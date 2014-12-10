<?php

namespace Iut;

class FileTools
{
    /**
     * @param $fullPathName Ex: /home/user01/file.log
     * @throws PermissionDeniedException
     */
    static public function createFileIfNotExists($fullPathName)
    {
        if (!file_exists($fullPathName)) {
            if (!is_dir(dirname($fullPathName))) {
                if (!mkdir(dirname($fullPathName), '0777', true)) {
                    throw new PermissionDeniedException($fullPathName);
                }
            }
        }

        if(!touch($fullPathName)) {
            throw new PermissionDeniedException($fullPathName);
        }
    }
}