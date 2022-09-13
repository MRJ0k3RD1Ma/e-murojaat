<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appeal_temp".
 *
 * @property int $id
 * @property int $pursuit
 * @property string|null $passport
 * @property string|null $passport_jshshir
 * @property int|null $person_id
 * @property string $person_name
 * @property string $person_phone
 * @property string|null $date_of_birth
 * @property string|null $specialization
 * @property string|null $job
 * @property string|null $work_place
 * @property int $gender
 * @property int $nation_id
 * @property int|null $home_id
 * @property string|null $types
 * @property string|null $detail
 * @property int $region_id
 * @property int $district_id
 * @property int $village_id
 * @property string $address
 * @property string|null $email
 * @property string|null $businessman
 * @property int $isbusinessman
 * @property string|null $appeal_preview
 * @property string $appeal_detail
 * @property string|null $appeal_file
 * @property int|null $question_id
 * @property string|null $executor_files
 * @property string|null $appeal_file_extension
 * @property int $appeal_type_id
 * @property int|null $appeal_shakl_id
 * @property int $appeal_control_id
 * @property int $count_applicant
 * @property int $count_list
 * @property int $status
 * @property string|null $deadtime
 * @property string $created
 * @property string $updated
 * @property int $boshqa_tashkilot
 * @property string|null $boshqa_tashkilot_number
 * @property string|null $boshqa_tashkilot_date
 * @property int|null $boshqa_tashkilot_group_id
 * @property int|null $boshqa_tashkilot_id
 * @property string|null $answer_name
 * @property string|null $answer_file
 * @property string|null $answer_preview
 * @property string|null $answer_detail
 * @property int $answer_reply_send
 * @property string|null $answer_number
 * @property string|null $answer_date
 * @property int|null $company_id
 */
class AppealTemp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appeal_temp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pursuit', 'person_id', 'gender', 'nation_id', 'home_id', 'region_id', 'district_id', 'village_id', 'isbusinessman', 'question_id', 'appeal_type_id', 'appeal_shakl_id', 'appeal_control_id', 'count_applicant', 'count_list', 'status', 'boshqa_tashkilot', 'boshqa_tashkilot_group_id', 'boshqa_tashkilot_id', 'answer_reply_send', 'company_id'], 'integer'],
            [['person_name', 'person_phone', 'region_id', 'district_id', 'village_id', 'address', 'appeal_detail', 'appeal_type_id'], 'required'],
            [['date_of_birth', 'deadtime', 'created', 'updated', 'boshqa_tashkilot_date', 'answer_date'], 'safe'],
            [['types', 'detail', 'appeal_preview', 'appeal_detail', 'executor_files', 'answer_detail'], 'string'],
            [['passport', 'passport_jshshir', 'person_name', 'person_phone', 'specialization', 'job', 'work_place', 'address', 'email', 'appeal_file', 'appeal_file_extension', 'boshqa_tashkilot_number', 'answer_name', 'answer_file', 'answer_preview', 'answer_number'], 'string', 'max' => 255],
            [['businessman'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pursuit' => 'Pursuit',
            'passport' => 'Passport',
            'passport_jshshir' => 'Passport Jshshir',
            'person_id' => 'Person ID',
            'person_name' => 'Person Name',
            'person_phone' => 'Person Phone',
            'date_of_birth' => 'Date Of Birth',
            'specialization' => 'Specialization',
            'job' => 'Job',
            'work_place' => 'Work Place',
            'gender' => 'Gender',
            'nation_id' => 'Nation ID',
            'home_id' => 'Home ID',
            'types' => 'Types',
            'detail' => 'Detail',
            'region_id' => 'Region ID',
            'district_id' => 'District ID',
            'village_id' => 'Village ID',
            'address' => 'Address',
            'email' => 'Email',
            'businessman' => 'Businessman',
            'isbusinessman' => 'Isbusinessman',
            'appeal_preview' => 'Appeal Preview',
            'appeal_detail' => 'Appeal Detail',
            'appeal_file' => 'Appeal File',
            'question_id' => 'Question ID',
            'executor_files' => 'Executor Files',
            'appeal_file_extension' => 'Appeal File Extension',
            'appeal_type_id' => 'Appeal Type ID',
            'appeal_shakl_id' => 'Appeal Shakl ID',
            'appeal_control_id' => 'Appeal Control ID',
            'count_applicant' => 'Count Applicant',
            'count_list' => 'Count List',
            'status' => 'Status',
            'deadtime' => 'Deadtime',
            'created' => 'Created',
            'updated' => 'Updated',
            'boshqa_tashkilot' => 'Boshqa Tashkilot',
            'boshqa_tashkilot_number' => 'Boshqa Tashkilot Number',
            'boshqa_tashkilot_date' => 'Boshqa Tashkilot Date',
            'boshqa_tashkilot_group_id' => 'Boshqa Tashkilot Group ID',
            'boshqa_tashkilot_id' => 'Boshqa Tashkilot ID',
            'answer_name' => 'Answer Name',
            'answer_file' => 'Answer File',
            'answer_preview' => 'Answer Preview',
            'answer_detail' => 'Answer Detail',
            'answer_reply_send' => 'Answer Reply Send',
            'answer_number' => 'Answer Number',
            'answer_date' => 'Answer Date',
            'company_id' => 'Company ID',
        ];
    }
}
