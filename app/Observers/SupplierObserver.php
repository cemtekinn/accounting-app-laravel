<?php

namespace App\Observers;

use App\Models\Supplier;

class SupplierObserver
{
    public function deleted(Supplier $supplier): void
    {
        $supplier->contacts()->delete();
    }
}
