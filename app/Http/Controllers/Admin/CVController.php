<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Helper\Utils;

class CVController extends Controller
{
    public function view()
    {
        $cv = Utils::getMyPortfolio()->curriculum_vitae_pdf;
        $pdf_path = file_get_contents('storage/'.$cv);
        $filename = 'cv.pdf';
        return response($pdf_path)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="' . $filename . '"');
    }

    public function download()
    {
        $cv = Utils::getMyPortfolio()->curriculum_vitae_pdf;
        $pdf_path = file_get_contents('storage/'.$cv);
        $filename = 'cv.pdf';
        return response($pdf_path)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}
