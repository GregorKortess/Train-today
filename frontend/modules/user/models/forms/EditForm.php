<?php

namespace frontend\modules\user\models\forms;

use yii\base\Model;
use frontend\models\user;

class EditForm extends Model
{

    const MAX_ABOUT_LENGTH = 250;
    const MAX_WEIGHT_KG = 300;
    const MAX_HEIGHT_SM = 250;


    private $user;

    public $nickname;
    public $about;
    public $weight;
    public $height;


    public function rules()
    {
        return [
            [['nickname'], 'string', 'max' => 50],
            [['about'], 'string', 'max' => self::MAX_ABOUT_LENGTH],
            [['weight'],'integer','max' => self::MAX_WEIGHT_KG],
            [['height'],'integer','max' => self::MAX_HEIGHT_SM],

        ];
    }
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->nickname = $user->nickname;
        $this->about = $user->about;
        $this->weight = $user->weight;
        $this->height = $user->height;
    }

    public function save()
    {
        if ($this->validate()) {

            $this->user->nickname = $this->nickname;
            $this->user->weight = $this->weight;
            $this->user->height = $this->height;
            $this->user->about = $this->about;

            $this->user->save(false);
            return true;
        }
    }
}