<?php
namespace lcssoft\report\events;

use lcssoft\report\models\ReportSession;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use yii\base\Model;

class ReportEvent extends \yii\base\Event
{

    /**
     * @var $activeSheet Worksheet
     */
    public $activeSheet;
    /**
     * @var Model
     */
    public $model;

    public $endRowIndex;

    public $startRowIndex;

    /**
     * @var $sessionStorage ReportSession
     */
    public $sessionStorage;

}