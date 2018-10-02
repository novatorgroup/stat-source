<?php

namespace novatorgroup\statsource;

interface DataSourceInterface
{
    public function load(?string $start = null, ?string $end = null): array;
}