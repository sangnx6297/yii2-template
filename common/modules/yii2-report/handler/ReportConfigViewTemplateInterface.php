<?php

namespace lcssoft\report\handler;

interface ReportConfigViewTemplateInterface
{
    public function renderPath($accessType);

    public function availableAccess();
}