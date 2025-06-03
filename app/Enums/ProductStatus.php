<?php

namespace App\Enums;

enum ProductStatus: string
{
    case active = 'active';
    case inactive = 'inactive';
    case draft = 'draft';
    case out_of_stock = 'out_of_stock';

}
