<?php
class Excel {
	private $header = "<?xml version=\"1.0\" encoding=\"%s\"?\>\n<Workbook xmlns=\"urn:schemas-microsoft-com:office:spreadsheet\" xmlns:x=\"urn:schemas-microsoft-com:office:excel\" xmlns:ss=\"urn:schemas-microsoft-com:office:spreadsheet\" xmlns:html=\"http://www.w3.org/TR/REC-html40\">";
	private $footer = "</Workbook>";
	private $lines = array();
	public $sEncoding;
	public $bConvertTypes;
	public $sWorksheetTitle;

	public function __construct($sEncoding = 'UTF-8', $bConvertTypes = false, $sWorksheetTitle = 'Table1') {
		$this->bConvertTypes = $bConvertTypes;
		$this->setEncoding($sEncoding);
		$this->setWorksheetTitle($sWorksheetTitle);
	}
	
	public function setEncoding($sEncoding) {
		$this->sEncoding = $sEncoding;
	}

	function setSheetData($str) {
		$str = preg_replace('/[^\x20-\x7E]/','', $str);
		return htmlentities($str, ENT_COMPAT, $this->sEncoding);
	}

	public function setWorksheetTitle ($title) {
		$title = preg_replace ("/[\\\|:|\/|\?|\*|\[|\]]/", "", $title);
		$title = substr ($title, 0, 31);
		$this->sWorksheetTitle = $title;
	}

	private function addRow ($array, $type, $style=false) {
		$cells = "";
		foreach($array as $k => $v):
			$type = 'String';
			if ($this->bConvertTypes === true && is_numeric($v)):
				$type = 'Number';
			endif;
			$v = htmlentities($v, ENT_COMPAT, $this->sEncoding);
			if ($style) $cells .= "<Cell ss:StyleID=\"Header\"><Data ss:Type=\"$type\">" . $this -> setSheetData(strip_tags($v)) . "</Data></Cell>\n";
			else $cells .= "<Cell><Data ss:Type=\"$type\">" . $this -> setSheetData(strip_tags($v)) . "</Data></Cell>\n";
		endforeach;
		$this->lines[] = "<Row>\n" . $cells . "</Row>\n";
	}

	public function addArray ($array) {
		foreach ($array['desc'] as $k => $v) $this->addRow ($v, 2);
		$this->addRow ($array['header'], 1, true);
		foreach ($array['data'] as $k => $v) $this->addRow ($v, 2);
	}

	function generateStyles() {
		$res = "<Styles>\n";
		$res .= "<Style ss:ID=\"Header\" ss:Name=\"Header1\">\n";
		$res .= "<Font ss:Bold=\"1\" ss:Size=\"10\"/>\n";
		$res .= "<Interior ss:Color=\"#aebe16\" ss:Pattern=\"Solid\" />";
		$res .= "<Borders>\n";
		$res .= "<Border ss:Position=\"Bottom\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"/>\n";
		$res .= "<Border ss:Position=\"Left\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"/>\n";
		$res .= "<Border ss:Position=\"Right\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"/>\n";
		$res .= "<Border ss:Position=\"Top\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"/>\n";
		$res .= "</Borders>\n";
		$res .= "</Style>\n";
		$res .= "</Styles>\n";
		return $res;
	}
	
	public function generateXML ($filename = 'excel-export') {
		$filename = preg_replace('/[^aA-zZ0-9\_\-]/', '', $filename);

		header("Content-Type: application/vnd.ms-excel; charset=" . $this->sEncoding);
		header("Content-Disposition: inline; filename=\"" . $filename . ".xls\"");

		$res = stripslashes (sprintf($this->header, $this->sEncoding));
		$res .= self::generateStyles();
		$res .= "\n<Worksheet ss:Name=\"" . $this->sWorksheetTitle . "\">\n<Table>\n";
		foreach ($this->lines as $line) $res .= $line;
		$res .= "</Table>\n</Worksheet>\n";
		$res .= $this->footer;
		echo $res;
	}
}
