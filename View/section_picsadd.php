<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "section_picsinfo.php" ?>
<?php include "sectioninfo.php" ?>
<?php include "loto_loginsinfo.php" ?>
<?php include "userfn7.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Create page object
$section_pics_add = new csection_pics_add();
$Page =& $section_pics_add;

// Page init
$section_pics_add->Page_Init();

// Page main
$section_pics_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var section_pics_add = new ew_Page("section_pics_add");

// page properties
section_pics_add.PageID = "add"; // page ID
section_pics_add.FormID = "fsection_picsadd"; // form ID
var EW_PAGE_ID = section_pics_add.PageID; // for backward compatibility

// extend page with ValidateForm function
section_pics_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_picture"];
		aelm = fobj.elements["a" + infix + "_picture"];
		var chk_picture = (aelm && aelm[0])?(aelm[2].checked):true;
		if (elm && chk_picture && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($section_pics->picture->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_picture"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));
		elm = fobj.elements["x" + infix + "_section"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($section_pics->section->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_order"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($section_pics->order->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_hd_bg"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
section_pics_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
section_pics_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
section_pics_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
section_pics_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $section_pics->TableCaption() ?><br><br>
<a href="<?php echo $section_pics->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$section_pics_add->ShowMessage();
?>
<form name="fsection_picsadd" id="fsection_picsadd" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return section_pics_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="section_pics">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($section_pics->picture->Visible) { // picture ?>
	<tr<?php echo $section_pics->picture->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $section_pics->picture->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $section_pics->picture->CellAttributes() ?>><span id="el_picture">
<input type="file" name="x_picture" id="x_picture" title="<?php echo $section_pics->picture->FldTitle() ?>" size="30"<?php echo $section_pics->picture->EditAttributes() ?>>
</div>
</span><?php echo $section_pics->picture->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($section_pics->section->Visible) { // section ?>
	<tr<?php echo $section_pics->section->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $section_pics->section->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $section_pics->section->CellAttributes() ?>><span id="el_section">
<?php if ($section_pics->section->getSessionValue() <> "") { ?>
<div<?php echo $section_pics->section->ViewAttributes() ?>><?php echo $section_pics->section->ViewValue ?></div>
<input type="hidden" id="x_section" name="x_section" value="<?php echo ew_HtmlEncode($section_pics->section->CurrentValue) ?>">
<?php } else { ?>
<select id="x_section" name="x_section" title="<?php echo $section_pics->section->FldTitle() ?>"<?php echo $section_pics->section->EditAttributes() ?>>
<?php
if (is_array($section_pics->section->EditValue)) {
	$arwrk = $section_pics->section->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($section_pics->section->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
<?php } ?>
</span><?php echo $section_pics->section->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($section_pics->url->Visible) { // url ?>
	<tr<?php echo $section_pics->url->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $section_pics->url->FldCaption() ?></td>
		<td<?php echo $section_pics->url->CellAttributes() ?>><span id="el_url">
<input type="text" name="x_url" id="x_url" title="<?php echo $section_pics->url->FldTitle() ?>" size="30" maxlength="200" value="<?php echo $section_pics->url->EditValue ?>"<?php echo $section_pics->url->EditAttributes() ?>>
</span><?php echo $section_pics->url->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($section_pics->target->Visible) { // target ?>
	<tr<?php echo $section_pics->target->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $section_pics->target->FldCaption() ?></td>
		<td<?php echo $section_pics->target->CellAttributes() ?>><span id="el_target">
<div id="tp_x_target" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME; ?>"><input type="checkbox" name="x_target[]" id="x_target[]" title="<?php echo $section_pics->target->FldTitle() ?>" value="{value}"<?php echo $section_pics->target->EditAttributes() ?>></div>
<div id="dsl_x_target" repeatcolumn="5">
<?php
$arwrk = $section_pics->target->EditValue;
if (is_array($arwrk)) {
	$armultiwrk= explode(",", strval($section_pics->target->CurrentValue));
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = "";
		for ($ari = 0; $ari < count($armultiwrk); $ari++) {
			if (strval($arwrk[$rowcntwrk][0]) == trim(strval($armultiwrk[$ari]))) {
				$selwrk = " checked=\"checked\"";
				if ($selwrk <> "") $emptywrk = FALSE;
				break;
			}
		}

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="checkbox" name="x_target[]" id="x_target[]" title="<?php echo $section_pics->target->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $section_pics->target->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $section_pics->target->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($section_pics->order->Visible) { // order ?>
	<tr<?php echo $section_pics->order->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $section_pics->order->FldCaption() ?></td>
		<td<?php echo $section_pics->order->CellAttributes() ?>><span id="el_order">
<input type="text" name="x_order" id="x_order" title="<?php echo $section_pics->order->FldTitle() ?>" size="30" value="<?php echo $section_pics->order->EditValue ?>"<?php echo $section_pics->order->EditAttributes() ?>>
</span><?php echo $section_pics->order->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($section_pics->pic_alt->Visible) { // pic_alt ?>
	<tr<?php echo $section_pics->pic_alt->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $section_pics->pic_alt->FldCaption() ?></td>
		<td<?php echo $section_pics->pic_alt->CellAttributes() ?>><span id="el_pic_alt">
<input type="text" name="x_pic_alt" id="x_pic_alt" title="<?php echo $section_pics->pic_alt->FldTitle() ?>" size="30" maxlength="200" value="<?php echo $section_pics->pic_alt->EditValue ?>"<?php echo $section_pics->pic_alt->EditAttributes() ?>>
</span><?php echo $section_pics->pic_alt->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($section_pics->hd_bg->Visible) { // hd_bg ?>
	<tr<?php echo $section_pics->hd_bg->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $section_pics->hd_bg->FldCaption() ?></td>
		<td<?php echo $section_pics->hd_bg->CellAttributes() ?>><span id="el_hd_bg">
<input type="file" name="x_hd_bg" id="x_hd_bg" title="<?php echo $section_pics->hd_bg->FldTitle() ?>" size="30"<?php echo $section_pics->hd_bg->EditAttributes() ?>>
</div>
</span><?php echo $section_pics->hd_bg->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$section_pics_add->Page_Terminate();
?>
<?php

//
// Page class
//
class csection_pics_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'section_pics';

	// Page object name
	var $PageObjName = 'section_pics_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $section_pics;
		if ($section_pics->UseTokenInUrl) $PageUrl .= "t=" . $section_pics->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		if (@$_SESSION[EW_SESSION_MESSAGE] <> "") { // Append
			$_SESSION[EW_SESSION_MESSAGE] .= "<br>" . $v;
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = $v;
		}
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage);
		if ($sMessage <> "") { // Message in Session, display
			echo "<p><span class=\"ewMessage\">" . $sMessage . "</span></p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm, $section_pics;
		if ($section_pics->UseTokenInUrl) {
			if ($objForm)
				return ($section_pics->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($section_pics->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csection_pics_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (section_pics)
		$GLOBALS["section_pics"] = new csection_pics();

		// Table object (section)
		$GLOBALS['section'] = new csection();

		// Table object (loto_logins)
		$GLOBALS['loto_logins'] = new cloto_logins();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'section_pics', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new cTimer();

		// Open connection
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $section_pics;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		$Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->TableName);
		$Security->TablePermission_Loaded();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		if (!$Security->CanAdd()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("section_picslist.php");
		}

		// Create form object
		$objForm = new cFormObj();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		$this->Page_Redirecting($url);
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}
	var $sDbMasterFilter = "";
	var $sDbDetailFilter = "";
	var $lPriv = 0;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $section_pics;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $section_pics->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Set up master/detail parameters
		$this->SetUpMasterDetail();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $section_pics->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->GetUploadFiles(); // Get upload files
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$section_pics->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $section_pics->CurrentAction = "C"; // Copy record
		  } else {
		    $section_pics->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($section_pics->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("section_picslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$section_pics->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $section_pics->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$section_pics->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $section_pics;

		// Get upload data
			if ($section_pics->picture->Upload->UploadFile()) {

				// No action required
			} else {
				echo $section_pics->picture->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
			if ($section_pics->hd_bg->Upload->UploadFile()) {

				// No action required
			} else {
				echo $section_pics->hd_bg->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load default values
	function LoadDefaultValues() {
		global $section_pics;
		$section_pics->picture->CurrentValue = NULL; // Clear file related field
		$section_pics->hd_bg->CurrentValue = NULL; // Clear file related field
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $section_pics;
		$section_pics->section->setFormValue($objForm->GetValue("x_section"));
		$section_pics->url->setFormValue($objForm->GetValue("x_url"));
		$section_pics->target->setFormValue($objForm->GetValue("x_target"));
		$section_pics->order->setFormValue($objForm->GetValue("x_order"));
		$section_pics->pic_alt->setFormValue($objForm->GetValue("x_pic_alt"));
		$section_pics->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $section_pics;
		$section_pics->id->CurrentValue = $section_pics->id->FormValue;
		$section_pics->section->CurrentValue = $section_pics->section->FormValue;
		$section_pics->url->CurrentValue = $section_pics->url->FormValue;
		$section_pics->target->CurrentValue = $section_pics->target->FormValue;
		$section_pics->order->CurrentValue = $section_pics->order->FormValue;
		$section_pics->pic_alt->CurrentValue = $section_pics->pic_alt->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $section_pics;
		$sFilter = $section_pics->KeyFilter();

		// Call Row Selecting event
		$section_pics->Row_Selecting($sFilter);

		// Load SQL based on filter
		$section_pics->CurrentFilter = $sFilter;
		$sSql = $section_pics->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$section_pics->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $section_pics;
		$section_pics->id->setDbValue($rs->fields('id'));
		$section_pics->picture->Upload->DbValue = $rs->fields('picture');
		$section_pics->section->setDbValue($rs->fields('section'));
		$section_pics->url->setDbValue($rs->fields('url'));
		$section_pics->target->setDbValue($rs->fields('target'));
		$section_pics->order->setDbValue($rs->fields('order'));
		$section_pics->pic_alt->setDbValue($rs->fields('pic_alt'));
		$section_pics->hd_bg->Upload->DbValue = $rs->fields('hd_bg');
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $section_pics;

		// Initialize URLs
		// Call Row_Rendering event

		$section_pics->Row_Rendering();

		// Common render codes for all row types
		// picture

		$section_pics->picture->CellCssStyle = ""; $section_pics->picture->CellCssClass = "";
		$section_pics->picture->CellAttrs = array(); $section_pics->picture->ViewAttrs = array(); $section_pics->picture->EditAttrs = array();

		// section
		$section_pics->section->CellCssStyle = ""; $section_pics->section->CellCssClass = "";
		$section_pics->section->CellAttrs = array(); $section_pics->section->ViewAttrs = array(); $section_pics->section->EditAttrs = array();

		// url
		$section_pics->url->CellCssStyle = ""; $section_pics->url->CellCssClass = "";
		$section_pics->url->CellAttrs = array(); $section_pics->url->ViewAttrs = array(); $section_pics->url->EditAttrs = array();

		// target
		$section_pics->target->CellCssStyle = ""; $section_pics->target->CellCssClass = "";
		$section_pics->target->CellAttrs = array(); $section_pics->target->ViewAttrs = array(); $section_pics->target->EditAttrs = array();

		// order
		$section_pics->order->CellCssStyle = ""; $section_pics->order->CellCssClass = "";
		$section_pics->order->CellAttrs = array(); $section_pics->order->ViewAttrs = array(); $section_pics->order->EditAttrs = array();

		// pic_alt
		$section_pics->pic_alt->CellCssStyle = ""; $section_pics->pic_alt->CellCssClass = "";
		$section_pics->pic_alt->CellAttrs = array(); $section_pics->pic_alt->ViewAttrs = array(); $section_pics->pic_alt->EditAttrs = array();

		// hd_bg
		$section_pics->hd_bg->CellCssStyle = ""; $section_pics->hd_bg->CellCssClass = "";
		$section_pics->hd_bg->CellAttrs = array(); $section_pics->hd_bg->ViewAttrs = array(); $section_pics->hd_bg->EditAttrs = array();
		if ($section_pics->RowType == EW_ROWTYPE_VIEW) { // View row

			// picture
			if (!ew_Empty($section_pics->picture->Upload->DbValue)) {
				$section_pics->picture->ViewValue = $section_pics->picture->Upload->DbValue;
				$section_pics->picture->ImageWidth = 100;
				$section_pics->picture->ImageHeight = 0;
				$section_pics->picture->ImageAlt = $section_pics->picture->FldAlt();
			} else {
				$section_pics->picture->ViewValue = "";
			}
			$section_pics->picture->CssStyle = "";
			$section_pics->picture->CssClass = "";
			$section_pics->picture->ViewCustomAttributes = "";

			// section
			if (strval($section_pics->section->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($section_pics->section->CurrentValue) . "";
			$sSqlWrk = "SELECT `section` FROM `section`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `section`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$section_pics->section->ViewValue = $rswrk->fields('section');
					$rswrk->Close();
				} else {
					$section_pics->section->ViewValue = $section_pics->section->CurrentValue;
				}
			} else {
				$section_pics->section->ViewValue = NULL;
			}
			$section_pics->section->CssStyle = "";
			$section_pics->section->CssClass = "";
			$section_pics->section->ViewCustomAttributes = "";

			// url
			$section_pics->url->ViewValue = $section_pics->url->CurrentValue;
			$section_pics->url->CssStyle = "";
			$section_pics->url->CssClass = "";
			$section_pics->url->ViewCustomAttributes = "";

			// target
			if (strval($section_pics->target->CurrentValue) <> "") {
				$section_pics->target->ViewValue = "";
				$arwrk = explode(",", strval($section_pics->target->CurrentValue));
				for ($ari = 0; $ari < count($arwrk); $ari++) {
					switch (trim($arwrk[$ari])) {
						case "1":
							$section_pics->target->ViewValue .= "Pagina nueva";
							break;
						default:
							$section_pics->target->ViewValue .= trim($arwrk[$ari]);
					}
					if ($ari < count($arwrk)-1) $section_pics->target->ViewValue .= ew_ViewOptionSeparator($ari);
				}
			} else {
				$section_pics->target->ViewValue = NULL;
			}
			$section_pics->target->CssStyle = "";
			$section_pics->target->CssClass = "";
			$section_pics->target->ViewCustomAttributes = "";

			// order
			$section_pics->order->ViewValue = $section_pics->order->CurrentValue;
			$section_pics->order->CssStyle = "";
			$section_pics->order->CssClass = "";
			$section_pics->order->ViewCustomAttributes = "";

			// pic_alt
			$section_pics->pic_alt->ViewValue = $section_pics->pic_alt->CurrentValue;
			$section_pics->pic_alt->CssStyle = "";
			$section_pics->pic_alt->CssClass = "";
			$section_pics->pic_alt->ViewCustomAttributes = "";

			// hd_bg
			if (!ew_Empty($section_pics->hd_bg->Upload->DbValue)) {
				$section_pics->hd_bg->ViewValue = $section_pics->hd_bg->Upload->DbValue;
				$section_pics->hd_bg->ImageWidth = 0;
				$section_pics->hd_bg->ImageHeight = 100;
				$section_pics->hd_bg->ImageAlt = $section_pics->hd_bg->FldAlt();
			} else {
				$section_pics->hd_bg->ViewValue = "";
			}
			$section_pics->hd_bg->CssStyle = "";
			$section_pics->hd_bg->CssClass = "";
			$section_pics->hd_bg->ViewCustomAttributes = "";

			// picture
			$section_pics->picture->HrefValue = "";
			$section_pics->picture->TooltipValue = "";

			// section
			$section_pics->section->HrefValue = "";
			$section_pics->section->TooltipValue = "";

			// url
			$section_pics->url->HrefValue = "";
			$section_pics->url->TooltipValue = "";

			// target
			$section_pics->target->HrefValue = "";
			$section_pics->target->TooltipValue = "";

			// order
			$section_pics->order->HrefValue = "";
			$section_pics->order->TooltipValue = "";

			// pic_alt
			$section_pics->pic_alt->HrefValue = "";
			$section_pics->pic_alt->TooltipValue = "";

			// hd_bg
			$section_pics->hd_bg->HrefValue = "";
			$section_pics->hd_bg->TooltipValue = "";
		} elseif ($section_pics->RowType == EW_ROWTYPE_ADD) { // Add row

			// picture
			$section_pics->picture->EditCustomAttributes = "";
			if (!ew_Empty($section_pics->picture->Upload->DbValue)) {
				$section_pics->picture->EditValue = $section_pics->picture->Upload->DbValue;
				$section_pics->picture->ImageWidth = 100;
				$section_pics->picture->ImageHeight = 0;
				$section_pics->picture->ImageAlt = $section_pics->picture->FldAlt();
			} else {
				$section_pics->picture->EditValue = "";
			}

			// section
			$section_pics->section->EditCustomAttributes = "";
			if ($section_pics->section->getSessionValue() <> "") {
				$section_pics->section->CurrentValue = $section_pics->section->getSessionValue();
			if (strval($section_pics->section->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($section_pics->section->CurrentValue) . "";
			$sSqlWrk = "SELECT `section` FROM `section`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `section`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$section_pics->section->ViewValue = $rswrk->fields('section');
					$rswrk->Close();
				} else {
					$section_pics->section->ViewValue = $section_pics->section->CurrentValue;
				}
			} else {
				$section_pics->section->ViewValue = NULL;
			}
			$section_pics->section->CssStyle = "";
			$section_pics->section->CssClass = "";
			$section_pics->section->ViewCustomAttributes = "";
			} else {
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `section`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `section`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `section`";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$section_pics->section->EditValue = $arwrk;
			}

			// url
			$section_pics->url->EditCustomAttributes = "";
			$section_pics->url->EditValue = ew_HtmlEncode($section_pics->url->CurrentValue);

			// target
			$section_pics->target->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Pagina nueva");
			$section_pics->target->EditValue = $arwrk;

			// order
			$section_pics->order->EditCustomAttributes = "";
			$section_pics->order->EditValue = ew_HtmlEncode($section_pics->order->CurrentValue);

			// pic_alt
			$section_pics->pic_alt->EditCustomAttributes = "";
			$section_pics->pic_alt->EditValue = ew_HtmlEncode($section_pics->pic_alt->CurrentValue);

			// hd_bg
			$section_pics->hd_bg->EditCustomAttributes = "";
			if (!ew_Empty($section_pics->hd_bg->Upload->DbValue)) {
				$section_pics->hd_bg->EditValue = $section_pics->hd_bg->Upload->DbValue;
				$section_pics->hd_bg->ImageWidth = 0;
				$section_pics->hd_bg->ImageHeight = 100;
				$section_pics->hd_bg->ImageAlt = $section_pics->hd_bg->FldAlt();
			} else {
				$section_pics->hd_bg->EditValue = "";
			}
		}

		// Call Row Rendered event
		if ($section_pics->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$section_pics->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $section_pics;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($section_pics->picture->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("WrongFileType");
		}
		if ($section_pics->picture->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $section_pics->picture->Upload->FileSize > EW_MAX_FILE_SIZE) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize"));
		}
		if (in_array($section_pics->picture->Upload->Error, array(1, 2, 3, 6, 7, 8))) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("PhpUploadErr" . $section_pics->picture->Upload->Error);
		}
		if (!ew_CheckFileType($section_pics->hd_bg->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("WrongFileType");
		}
		if ($section_pics->hd_bg->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $section_pics->hd_bg->Upload->FileSize > EW_MAX_FILE_SIZE) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize"));
		}
		if (in_array($section_pics->hd_bg->Upload->Error, array(1, 2, 3, 6, 7, 8))) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("PhpUploadErr" . $section_pics->hd_bg->Upload->Error);
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (is_null($section_pics->picture->Upload->Value)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $section_pics->picture->FldCaption();
		}
		if (!is_null($section_pics->section->FormValue) && $section_pics->section->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $section_pics->section->FldCaption();
		}
		if (!ew_CheckInteger($section_pics->order->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $section_pics->order->FldErrMsg();
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Add record
	function AddRow() {
		global $conn, $Language, $Security, $section_pics;
		$rsnew = array();

		// picture
		$section_pics->picture->Upload->SaveToSession(); // Save file value to Session
		if (is_null($section_pics->picture->Upload->Value)) {
			$rsnew['picture'] = NULL;
		} else {
			$rsnew['picture'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $section_pics->picture->UploadPath), $section_pics->picture->Upload->FileName);
		}

		// section
		$section_pics->section->SetDbValueDef($rsnew, $section_pics->section->CurrentValue, 0, FALSE);

		// url
		$section_pics->url->SetDbValueDef($rsnew, $section_pics->url->CurrentValue, NULL, FALSE);

		// target
		$section_pics->target->SetDbValueDef($rsnew, $section_pics->target->CurrentValue, NULL, FALSE);

		// order
		$section_pics->order->SetDbValueDef($rsnew, $section_pics->order->CurrentValue, NULL, FALSE);

		// pic_alt
		$section_pics->pic_alt->SetDbValueDef($rsnew, $section_pics->pic_alt->CurrentValue, NULL, FALSE);

		// hd_bg
		$section_pics->hd_bg->Upload->SaveToSession(); // Save file value to Session
		if (is_null($section_pics->hd_bg->Upload->Value)) {
			$rsnew['hd_bg'] = NULL;
		} else {
			$rsnew['hd_bg'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $section_pics->hd_bg->UploadPath), $section_pics->hd_bg->Upload->FileName);
		}

		// Call Row Inserting event
		$bInsertRow = $section_pics->Row_Inserting($rsnew);
		if ($bInsertRow) {
			if (!ew_Empty($section_pics->picture->Upload->Value)) {
				if ($section_pics->picture->Upload->FileName == $section_pics->picture->Upload->DbValue) { // Overwrite if same file name
					$section_pics->picture->Upload->SaveToFile($section_pics->picture->UploadPath, $rsnew['picture'], TRUE);
					$section_pics->picture->Upload->DbValue = ""; // No need to delete any more
				} else {
					$section_pics->picture->Upload->SaveToFile($section_pics->picture->UploadPath, $rsnew['picture'], FALSE);
				}
			}
			if ($section_pics->picture->Upload->Action == "2" || $section_pics->picture->Upload->Action == "3") { // Update/Remove
				if ($section_pics->picture->Upload->DbValue <> "")
					@unlink(ew_UploadPathEx(TRUE, $section_pics->picture->UploadPath) . $section_pics->picture->Upload->DbValue);
			}
			if (!ew_Empty($section_pics->hd_bg->Upload->Value)) {
				if ($section_pics->hd_bg->Upload->FileName == $section_pics->hd_bg->Upload->DbValue) { // Overwrite if same file name
					$section_pics->hd_bg->Upload->SaveToFile($section_pics->hd_bg->UploadPath, $rsnew['hd_bg'], TRUE);
					$section_pics->hd_bg->Upload->DbValue = ""; // No need to delete any more
				} else {
					$section_pics->hd_bg->Upload->SaveToFile($section_pics->hd_bg->UploadPath, $rsnew['hd_bg'], FALSE);
				}
			}
			if ($section_pics->hd_bg->Upload->Action == "2" || $section_pics->hd_bg->Upload->Action == "3") { // Update/Remove
				if ($section_pics->hd_bg->Upload->DbValue <> "")
					@unlink(ew_UploadPathEx(TRUE, $section_pics->hd_bg->UploadPath) . $section_pics->hd_bg->Upload->DbValue);
			}
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($section_pics->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($section_pics->CancelMessage <> "") {
				$this->setMessage($section_pics->CancelMessage);
				$section_pics->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$section_pics->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $section_pics->id->DbValue;

			// Call Row Inserted event
			$section_pics->Row_Inserted($rsnew);
		}

		// picture
		$section_pics->picture->Upload->RemoveFromSession(); // Remove file value from Session

		// hd_bg
		$section_pics->hd_bg->Upload->RemoveFromSession(); // Remove file value from Session
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $section_pics;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "section") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $section_pics->SqlMasterFilter_section();
				$this->sDbDetailFilter = $section_pics->SqlDetailFilter_section();
				if (@$_GET["id"] <> "") {
					$GLOBALS["section"]->id->setQueryStringValue($_GET["id"]);
					$section_pics->section->setQueryStringValue($GLOBALS["section"]->id->QueryStringValue);
					$section_pics->section->setSessionValue($section_pics->section->QueryStringValue);
					if (!is_numeric($GLOBALS["section"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["section"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@section@", ew_AdjustSql($GLOBALS["section"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$section_pics->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$section_pics->setStartRecordNumber($this->lStartRec);
			$section_pics->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$section_pics->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "section") {
				if ($section_pics->section->QueryStringValue == "") $section_pics->section->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $section_pics->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $section_pics->getDetailFilter(); // Restore detail filter
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	function Message_Showing(&$msg) {

		// Example:
		//$msg = "your new message";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
