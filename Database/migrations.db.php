<?php

function createMigrationsTable()
{
    $query = "CREATE TABLE `migrations`  (
        `id` int(0) NOT NULL AUTO_INCREMENT,
        `date` datetime(0) NOT NULL,
        `tableList` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
        `batch` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
        PRIMARY KEY (`id`)
      );";

      return $query;
}