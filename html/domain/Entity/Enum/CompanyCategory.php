<?php
  declare(strict_types=1);
  namespace Domain\Enum;

  enum CompanyCategory: string {
    case SAWMILL = "製材所";
    case BUILDER = "工務店";
    case FOREST_ORGANIZATION = "森林組合";
    case DISTRIBUTION = "流通";
    case OFFICE = "事務局";
  }
