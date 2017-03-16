<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%admin}}".
 *
 * @property integer $admin_id
 * @property string $admin_name
 * @property string $email
 * @property string $pwd
 * @property string $pwd_hash
 * @property string $purview
 * @property string $rank
 * @property integer $add_time
 * @property integer $last_login_time
 * @property string $last_login_ip
 * @property string $site_purview
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['admin_name', 'email', 'pwd'], 'required'],
            [['purview', 'site_purview'], 'string'],
            [['add_time', 'last_login_time'], 'integer'],
            [['admin_name', 'email'], 'string', 'max' => 40],
            [['pwd', 'rank'], 'string', 'max' => 32],
            [['pwd_hash'], 'string', 'max' => 30],
            [['last_login_ip'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'admin_id' => 'Admin ID',
            'admin_name' => 'Admin Name',
            'email' => 'Email',
            'pwd' => 'Pwd',
            'pwd_hash' => 'Pwd Hash',
            'purview' => 'Purview',
            'rank' => 'Rank',
            'add_time' => 'Add Time',
            'last_login_time' => 'Last Login Time',
            'last_login_ip' => 'Last Login Ip',
            'site_purview' => 'Site Purview',
        ];
    }
    public function create1($data)//AR模式1
    {
        
        $this->setAttributes($data);//载入数据
        return $this->insert();//返回结果
        
    } 
    
    public function create2($data)//AR模式2
    {
        $this->setAttributes($data);//载入数据
        $this->isNewRecord = true;//新插入数据
        $this->id = 0;//id为0
        return $this->save();//保存        
    }
    public function create3($data){//DAO模式
        $sql = "insert into yii_news(title,content)values('{$data['title']}','{$data['content']}')";
        return yii::$app->db->createCommand($sql)->execute();
    }
    public function del1($id)//AR模式
    {
        return $this->deleteAll(['id'=>$id]);
    }
    public function del2($id)//DAO模式
    {
        $sql = "delete from 　 yii_news where id='$id'";
        return yii::$app->db->createCommand($sql)->execute();
    }
    //修改
    public function save1($data){//AR模式
       return  $this->setAttributes($data) && $this->save();
    }
    public function save2($data)//DAO模式
    {
        $sql = "update   yii_news set title='{$data['title']}',content='{$data['content']}'";
        return yii::$app->db->createCommand($sql)->execute();
    }

    //查询
    public function getOne($id)
    {
        return $this->find()->where(['id'=>3])->andWhere(['1'=>'1'])->orWhere(['0'=>1])->asArray()->one();;
    }
    public function getOne2($sql)
    {
        return yii::$app->db->createCommand($sql)->queryOne();
    }
    public function getAll($condition)
    {
        return $this->find()/*->where()->andWhere->orWhere*/->asArray()->all();
    }
    public function getAll2($condition)
    {
        $sql='select * from yii_news ';// where $condtion
        return yii::$app->db->createCommand($sql)->queryAll();
    }
}
