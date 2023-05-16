<?php

namespace lcssoft\report\handler;

use lcssoft\report\entity\ReportMeta;

interface ReportAccessInterface
{
    /**
     * @return boolean;
     */
   public function checkAccess();

}