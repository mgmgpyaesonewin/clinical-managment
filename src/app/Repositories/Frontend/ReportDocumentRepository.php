<?php

namespace App\Repositories\Frontend;

use App\ReportDocument;
use App\Repositories\BaseRepository;

class ReportDocumentRepository extends BaseRepository{


    public function model() {
        return ReportDocument::class;
    }

}
