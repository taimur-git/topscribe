<?php

namespace Markdown;


use Dompdf\Dompdf;

class Converter
{
    /**
     * @var ParsedownExtra
     */
    private $instance;

    /**
     * @var Dompdf
     */
    private $domPdf;

    public function __construct()
    {
        $this->instance = new Parser();
        $this->instance->setPdfMode();
        $this->domPdf = new Dompdf();
    }

    public function convert($markdown)
    {
        $style = $this->getStyleHtml();
        $this->domPdf->loadHtml($style . $this->instance->text($markdown));
        $this->domPdf->setPaper('A3', 'landscape');
        $this->domPdf->render();

        return $this->domPdf->output();
    }

    private function getStyleHtml()
    {
        return "<style>
            * {
                font-family: 'Arial';
            }
            
            table, td, th {
            border: 1px solid grey;
            border-collapse: collapse;
            }
            th, td {
            padding: 5px;
            }
            </style>
        ";
    }
}
