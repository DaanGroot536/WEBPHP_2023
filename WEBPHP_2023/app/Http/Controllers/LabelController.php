<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Label;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Dompdf\Dompdf;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;

class LabelController extends Controller
{
    public function getLabels()
    {
        $packages = Package::where('webshopName', Auth::user()->company)->get();
        $labels = Label::all();
        return view('labels.labellist', ['packages' => $packages, 'labels' => $labels]);
    }

    public function saveLabel(Request $request)
    {
        $label = Label::create([
            'packageID' => $request->packageID,
            'deliverer' => $request->deliverer
        ]);

        Package::where('id', $request->packageID)->update([
            'labelID' => $label->id
        ]);

        $this->generatePDF($request, $label->id);

        return redirect('/packageList');
    }

    public function saveLabelBulk(Request $request)
    {
        $packages = DB::table('packages')->get();
        foreach ($packages as $package) {
            if ($request->{$package->id} != null) {
                $label = Label::create([
                    'packageID' => $package->id,
                    'deliverer' => $request->delivererBulk
                ]);
                Package::where('id', $package->id)->update([
                    'labelID' => $label->id
                ]);
            }
        }

        return redirect('/packageList');
    }

    public function generatePDF(Request $request, $labelID)
    {
        // Create a new instance of the Dompdf class
        $pdf = new Dompdf();

        // Retrieve the package
        $package = Package::where('id', $request->packageID)->first();

        //echo DNS1D::getBarcodeSVG('4445645656', 'PHARMA2T');
        // echo '<img src="data:image/png,' . DNS1D::getBarcodePNG('4', 'C39+') . '" alt="barcode"   />';
        // echo DNS1D::getBarcodePNGPath('4445645656', 'PHARMA2T');
        // echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG('4', 'C39+') . '" alt="barcode"   />';



        // Define the label HTML content
        $html = '<style>
        /* Define styles for the label */
        .label {
            position: relative;
            display: inline-block;
            width: 100mm;
            height: 150mm;
            border: 1px solid #000;
            margin: 5mm;
            padding: 5mm;
            font-family: Arial, sans-serif;
        }
        .label h1 {
            font-size: 18pt;
            font-weight: bold;
            margin-bottom: 5mm;
            text-align: center;
        }
        .label p {
            margin: 0;
            line-height: 1.2;
            font-size: 11pt;
        }
        .label .address {
            margin-bottom: 5mm;
        }
        .label .divider {
            height: 1px;
            border-top: 1px solid #000;
            margin: 5mm 0;
        }
        .label .barcode {
            margin: auto;
            display: block;
            height: 30px;
          }          
        .label .barcode-code {
            text-align: center;
            font-size: 10pt;
            margin-top: 2mm;
        }
        .label .track-trace {
            text-align: center;
            font-size: 10pt;
        }
    </style>
    <div class="label">
        <h1>PRIORITY MAIL</h1>
        <div style="float:left;width:50%;">
            <p><strong>Sender: </strong>' . $package->webshopName . '</p>
            <p><strong>Address: </strong>' . $package->webshopStreet . ' ' . $package->webshopHousenumber . '</p>
            <p><strong>City: </strong>' . $package->webshopCity . '</p>
            <p><strong>Zip: </strong>' . $package->webshopZipcode . '</p>
        </div>
        <div style="float:right;width:50%;text-align:right;">
        <img src="" alt="QR Code" />
            <p><strong>Weight: </strong>' . $package->weight . '</p>
            <p><strong>Dimensions: </strong>' . $package->dimensions . '</p>
        </div>
        <div style="clear:both;"></div>
        <div class="divider"></div>
        <div class="address">
            <p><strong>Recipient: </strong>' . $package->customerName . '</p>
            <p><strong>Address: </strong>' . $package->customerStreet . ' ' . $package->customerHousenumber . '</p>
            <p><strong>City: </strong>' . $package->customerCity . '</p>
            <p><strong>Zip: </strong>' . $package->customerZipcode . '</p>
        </div>
        <div class="divider"></div>
        <div class="barcode">' . DNS1D::getBarcodeHTML(strval($labelID), 'C39') . ' <div>
        <div class="barcode-code">' . $labelID . '</div>
        <div class="divider"></div>
        <div class="track-trace">Track &amp; Trace: ' . $package->trackandtracecode . '</div>
    </div>';

        //' . $qr_code_file . '
        //' . $barcode_file . '
        // Load the label HTML content into the Dompdf object
        $pdf->loadHtml($html);

        // Set the paper size and orientation (landscape)
        $pdf->setPaper('A4', 'landscape');

        // Render the HTML content into a PDF
        $pdf->render();

        // Output the PDF to the browser for the user to download or view
        $pdf->stream();
    }
}
