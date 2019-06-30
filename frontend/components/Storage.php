<?php

namespace frontend\components;

use phpDocumentor\Reflection\Types\Integer;
use phpDocumentor\Reflection\Types\String_;
use yii;
use yii\base\Component;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;


class Storage extends Component implements StorageInterface
{
    private $filename;

    /**
     * Save given uploadedFile to disk
     * @param UploadedFile $file
     * @return mixed
     */
    public function saveUploadedFile(UploadedFile $file)
    {
        $path = $this->preparePath($file);

        if ($path && $file->saveAs($path)) {
            return $this->filename;
        }
    }

    /**
     * Prepare path to save uploaded file
     *
     * @param UploadedFile $file
     * @return string
     * @throws yii\base\Exception
     */
    protected function preparePath(UploadedFile $file)
    {
        $this->filename = $this->getFileName($file);

        $path = $this->getStoragePath() . $this->filename;

        $path = FileHelper::normalizePath($path);
        if (FileHelper::createDirectory(dirname($path))) {
            return $path;
        }
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    protected function getFilename(UploadedFile $file)
    {
        $hash = sha1_file($file->tempName);

        $name = substr_replace($hash,'/',2,0);
        $name = substr_replace($name,'/',5,0);
        return $name. '.'. $file->extension;
    }

    /**
     * @return bool|string
     */
    protected function getStoragePath()
    {
        return Yii::getAlias(Yii::$app->params['storagePath']);
    }


    public function getFile ($filename)
    {
        return Yii::$app->params['storageUri'].$filename;
    }
}