<?php

namespace App\Services;

use TCPDF;

class PDFService extends TCPDF
{
    // Declare a property to store the name
    public  $name ;
    public  $report_name  ;
    public  $kheta_image ;


    public function Header()
    {
        // Logo
        $image_url = 'https://test.germaniatek.net/public/assets/site/images/benha_logo.png';
        // Add the image to the header on the left side with specific dimensions
        $this->Image($image_url, 40, 5, 35, 25);
        $this->SetX(10); // Adjust X position as needed
        // Move to position below the left image
        $this->SetY(35); // Adjust Y position as needed

        // Set font for text on the left side
        $this->SetFont('aealarabiya', 'B', 12); // Adjust font size and style as needed

        // Add the image to the header on the right side with specific dimensions
        $kheta_img= 'https://test.germaniatek.net/public/'.$this->kheta_image ;

        $this->Image($kheta_img , 205, 5, 25, 25);

        // Move to position below the right image
        $this->SetY(35); // Adjust Y position as needed
        $this->SetX(175); // Adjust X position as needed

        // Set font for text on the right side
        $this->SetFont('aealarabiya', 'B', 12); // Adjust font size and style as needed

        // Add text below the right image
        //$this->Cell(0, 10, 'جامعه بنها', 0, false, 'C', 0, '', 0, false, 'M', 'M');


        // Move to position below the right image
        $this->SetY(10); // Adjust Y position as needed
        $this->SetX(0); // Adjust X position as needed

        // Set font for text on the right side
        $this->SetFont('aealarabiya', 'B', 15); // Adjust font size and style as needed

        // Add text below the right image
        $this->Cell(0, 10, 'نظام أداء جامعه بنها ', 0, false, 'C', 0, '', 0, false, 'M', 'M');


      // Move to position below the right image
      $this->SetY(20); // Adjust Y position as needed
      $this->SetX(0); // Adjust X position as needed

      // Set font for text on the right side
      $this->SetFont('aealarabiya', 'B', 15); // Adjust font size and style as needed

      $this->SetTextColor(85, 110, 230); // RGB values for color #556ee6

// Add text below the right image with the specified color
      $this->Cell(0, 10, $this->name, 0, false, 'C', 0, '', 0, false, 'M', 'M');
// Reset text color to black (if needed)
      $this->SetTextColor(0, 0, 0); // Reset text color to black

        // Move to position below the right image
        $this->SetY(30); // Adjust Y position as needed
        $this->SetX(0); // Adjust X position as needed

        // Set font for text on the right side
        $this->SetFont('aealarabiya', 'B', 15); // Adjust font size and style as needed

        // Set text color to black
        $this->SetTextColor(0, 0, 0); // RGB values for color black

        // Add text below the right image with the specified color and bold
        $this->Cell(0, 10, $this->report_name, 0, false, 'C', 0, '', 0, false, 'M', 'M');


    }

    public function generate_mokasherat_gehatPDF($data, $fileName)
    {
        // Create new PDF instance
        $pdf = new PDFService();
        $pdf->setRTL(true); // Set RTL direction
        $pdf->AddPage();

        // Set the value of $this->name to $data['kheta_name']

        $pdf->name = $data['kheta_name'];

        $pdf->kheta_image = $data['kehta_image'];

        $pdf->report_name = $data['report_name'];


        // Set header and footer
        $pdf->Header($data); // Pass $data['kheta_name'] directly to setPrintHeader
        $pdf->setPrintFooter(true);

        // Set header and footer data
        $pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

        // Set font with UTF-8 encoding for Arabic text
        $pdf->SetFont('aealarabiya', '', 12); // Set font family and size, with empty string for style (regular)

        // Add content to PDF
        $html = view('admins.reports.print-report.mokasherat_gehat', $data)->render();
        $pdf->writeHTML($html, true, false, false, false, '');

        // Output PDF to browser for preview
        $pdf->Output($fileName, 'I');
    }


    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }

    public function generateMokasherPartsPDF($data, $fileName)
    {

        // Create new PDF instance
        $pdf = new PDFService();
        $pdf->setRTL(true); // Set RTL direction
        $pdf->AddPage();

        // Set the value of $this->name to $data['kheta_name']

        $pdf->name = $data['kheta_name'];

        $pdf->kheta_image = $data['kehta_image'];

        $pdf->report_name = $data['report_name'];


        // Set header and footer
        $pdf->Header($data); // Pass $data['kheta_name'] directly to setPrintHeader
        $pdf->setPrintFooter(true);

        // Set header and footer data
        $pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
        // Add content to PDF
        $html = view('gehat.reports.print-report.mokashert_parts_report', $data)->render();
        $pdf->writeHTML($html, true, false, true, false, '');

        // Output PDF to browser for preview
        $pdf->Output($fileName, 'I');

    }

    public function generateMokasherYearsPDF($data, $fileName)
    {
        // Create new PDF instance
        $pdf = new TCPDF();
        $pdf->setRTL(true); // Set RTL direction
        $pdf->AddPage();

        // Exclude header and footer
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);

        // Set font with UTF-8 encoding for Arabic text
        $pdf->SetFont('aealarabiya', '', 12); // Set font family and size, with empty string for style (regular)

        // Add content to PDF
        $html = view('gehat.reports.print-report.mokasher_years_report', $data)->render();
        $pdf->writeHTML($html, true, false, false, false, '');

        // Output PDF to browser for preview
        $pdf->Output($fileName, 'I');
    }
   public  function generateGehtMokasheratYearsPDF($data, $fileName)
   {
       // Create new PDF instance
       $pdf = new PDFService();
       $pdf->setRTL(true); // Set RTL direction
       $pdf->AddPage();

       // Set the value of $this->name to $data['kheta_name']
       $pdf->name = $data['kheta_name'];
       // Set header and footer
       $pdf->Header(); // Pass $data['kheta_name'] directly to setPrintHeader
       $pdf->setPrintFooter(true);

       // Add content to PDF
       $html = view('admins.reports.print-report.GehtMokasheratYears', $data)->render();
       $pdf->writeHTML($html, true, false, false, false, '');

       // Output PDF to browser for preview
       $pdf->Output($fileName, 'I');
   }
   public  function generateActiveUsersPDF($data, $fileName)
   {
       // Create new PDF instance
       $pdf = new PDFService();
       $pdf->setRTL(true); // Set RTL direction
       $pdf->AddPage();

       // Set the value of $this->name to $data['kheta_name']
       $pdf->name = $data['kheta_name'];
       // Set header and footer
       $pdf->Header(); // Pass $data['kheta_name'] directly to setPrintHeader
       $pdf->setPrintFooter(true);

       // Set header and footer data
       $pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

       // Set font with UTF-8 encoding for Arabic text
       $pdf->SetFont('aealarabiya', '', 12); // Set font family and size, with empty string for style (regular)

       // Add content to PDF
       $html = view('admins.reports.print-report.ActiveUsers', $data)->render();
       $pdf->writeHTML($html, true, false, false, false, '');

       // Output PDF to browser for preview
       $pdf->Output($fileName, 'I');
   }
    public  function generateobjective_histogramPDF($data, $fileName)
    {
        // Create new PDF instance
        $pdf = new TCPDF();
        $pdf->setRTL(true); // Set RTL direction
        $pdf->AddPage();

        // Exclude header and footer
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);

        // Set font with UTF-8 encoding for Arabic text
        $pdf->SetFont('aealarabiya', '', 12); // Set font family and size, with empty string for style (regular)

        // Add content to PDF
        $html = view('admins.reports.print-report.objectives_histogram', $data)->render();
        $pdf->writeHTML($html, true, false, false, false, '');

        // Output PDF to browser for preview
        $pdf->Output($fileName, 'I');
    }

    public  function generateMokasheratWezaraPDF($data, $fileName)
    {
        // Create new PDF instance
        $pdf = new PDFService();
        $pdf->setRTL(true); // Set RTL direction
        $pdf->AddPage();

        // Set the value of $this->name to $data['kheta_name']
        $pdf->name = $data['kheta_name'];
        // Set header and footer
        $pdf->Header(); // Pass $data['kheta_name'] directly to setPrintHeader
        $pdf->setPrintFooter(true);

        // Add content to PDF
        $html = view('admins.reports.print-report.mokasher_wezara', $data)->render();
        $pdf->writeHTML($html, true, false, false, false, '');

        // Output PDF to browser for preview
        $pdf->Output($fileName, 'I');

    }
    //Page header


}
