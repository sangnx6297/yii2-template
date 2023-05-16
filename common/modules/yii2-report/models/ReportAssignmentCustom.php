<?php

namespace lcssoft\report\models;


use lcssoft\report\handler\ReportAccessInterface;

class ReportAssignmentCustom extends ReportAssignment implements ReportAccessInterface
{

    public function checkAccess()
    {
        return $this->key;
    }

}