<?php

namespace lcssoft\report\controllers;

use lcssoft\report\models\form\ExportForm;
use lcssoft\report\form\ExportTransportForm;
use lcssoft\report\handler\ReportAccessInterface;
use lcssoft\report\models\ReportAssignment;
use lcssoft\report\models\ReportConfig;
use lcssoft\report\models\setting\UserRole;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;


class ExportController extends \yii\web\Controller
{


    public function actionTemplate($type)
    {

        $configs = ExportForm::exportTemplateConfig();
        $reportList = array_combine(array_keys($configs), ArrayHelper::getColumn($configs, 'reportObjectLabel'));


        $objectClasses = ArrayHelper::getColumn($configs, 'reportObjectClass');

        $reportAssignment = \common\components\report\entity\ReportConfig::getAssignment($objectClasses);
        $reportDefaultView = \common\components\report\entity\ReportConfig::getDefaultView($objectClasses);

        $reportList = $this->getAccessReportList($configs, $reportList, $reportAssignment);


        if(empty($reportList)){
            throw new ForbiddenHttpException(Yii::t('backend', "You was not granted any report before."));
        }


        if($type == ExportForm::TEMPLATE_DEFAULT){
            $key = array_keys($reportList)[0];
            $type = $key;
            if ($reportDefaultView) {
                $type = $reportDefaultView->getDefaultView();
            }
        }



        if (!isset($configs[$type])) {
            throw new NotFoundHttpException("Report $type not found.");
        }


        $config = $configs[$type];
        $config['class'] = ReportConfig::class;

        if($reportAssignment){
            $config['reportObjectAccess'] = $reportAssignment;
        }
        /**
         * @var $config ReportConfig
         */
        $config = Yii::createObject($config);

        if (!$config->checkAccess()) {
            throw new ForbiddenHttpException("You are not allow to access this page!");
        }

        if (Yii::$app->request->isPost) {
            $parameters = Yii::$app->request->post();
            if ($config->getObject()->load($parameters)) {
                $parameters = $config->getReportObjectParams($parameters);
                return $this->redirect(['/report/export',
                    'ReportForm' => ['type' => \common\models\Report::EXPORT_TEMPLATE, 'object_name' => $config->reportObjectClass, 'dataParams' => $parameters]
                ]);
            }
        }



        return $this->render('template', [
            'config' => $config,
            'type' => $type,
            'listReport' => $reportList,
        ]);
    }

    /**
     * @param $configs
     * @param $reportList
     * @param $dynamicAccess ReportAssignment []
     * @return array
     */
    private function getAccessReportList($configs, $reportList, $dynamicAccess = [])
    {
        if (UserRole::hasRole(UserRole::ROLE_ADMIN, \Yii::$app->user->id)) {
            return $reportList;
        }
        $listFilteredReports = [];

        if (!empty($dynamicAccess)) {
            foreach ($dynamicAccess as $access) {
                if ($access instanceof ReportAccessInterface) {
                    if ($access->checkAccess()) {
                        if (isset($reportList[$access->object_type])) {
                            $listFilteredReports[$access->object_type] = $reportList[$access->object_type];
                        }
                    }
                }
            }
            return $listFilteredReports;
        }

        // remove soon
        $listAccessingReports = array_combine(array_keys($configs), ArrayHelper::getColumn($configs, 'reportObjectAccess'));
        foreach ($listAccessingReports as $key => $accessingReport) {

            if (!is_array($accessingReport)) {
                $accessingReport = [$accessingReport];
            }

            foreach ($accessingReport as $access) {
                if($access instanceof ReportAccessInterface){
                    if($access->checkAccess()){
                        if (isset($reportList[$key])) {
                            $listFilteredReports[$key] = $reportList[$key];
                        }
                        break;
                    }
                } else {
                    if (\Yii::$app->user->can($access) || UserRole::hasRole($access, \Yii::$app->user->id)) {
                        if (isset($reportList[$key])) {
                            $listFilteredReports[$key] = $reportList[$key];
                        }
                        break;
                    }
                }
            }
        }

        return $listFilteredReports;
    }

}
