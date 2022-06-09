<?php
namespace PHPMaker2019\project4;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$tb_vendor_add = new tb_vendor_add();

// Run the page
$tb_vendor_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tb_vendor_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var ftb_vendoradd = currentForm = new ew.Form("ftb_vendoradd", "add");

// Validate form
ftb_vendoradd.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
	if ($fobj.find("#confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		<?php if ($tb_vendor_add->nama_vendor->Required) { ?>
			elm = this.getElements("x" + infix + "_nama_vendor");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tb_vendor->nama_vendor->caption(), $tb_vendor->nama_vendor->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tb_vendor_add->alamat->Required) { ?>
			elm = this.getElements("x" + infix + "_alamat");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tb_vendor->alamat->caption(), $tb_vendor->alamat->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tb_vendor_add->telp->Required) { ?>
			elm = this.getElements("x" + infix + "_telp");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tb_vendor->telp->caption(), $tb_vendor->telp->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ew.forms[val])
			if (!ew.forms[val].validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
ftb_vendoradd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftb_vendoradd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tb_vendor_add->showPageHeader(); ?>
<?php
$tb_vendor_add->showMessage();
?>
<form name="ftb_vendoradd" id="ftb_vendoradd" class="<?php echo $tb_vendor_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tb_vendor_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tb_vendor_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tb_vendor">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$tb_vendor_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($tb_vendor->nama_vendor->Visible) { // nama_vendor ?>
	<div id="r_nama_vendor" class="form-group row">
		<label id="elh_tb_vendor_nama_vendor" for="x_nama_vendor" class="<?php echo $tb_vendor_add->LeftColumnClass ?>"><?php echo $tb_vendor->nama_vendor->caption() ?><?php echo ($tb_vendor->nama_vendor->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tb_vendor_add->RightColumnClass ?>"><div<?php echo $tb_vendor->nama_vendor->cellAttributes() ?>>
<span id="el_tb_vendor_nama_vendor">
<input type="text" data-table="tb_vendor" data-field="x_nama_vendor" name="x_nama_vendor" id="x_nama_vendor" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tb_vendor->nama_vendor->getPlaceHolder()) ?>" value="<?php echo $tb_vendor->nama_vendor->EditValue ?>"<?php echo $tb_vendor->nama_vendor->editAttributes() ?>>
</span>
<?php echo $tb_vendor->nama_vendor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tb_vendor->alamat->Visible) { // alamat ?>
	<div id="r_alamat" class="form-group row">
		<label id="elh_tb_vendor_alamat" for="x_alamat" class="<?php echo $tb_vendor_add->LeftColumnClass ?>"><?php echo $tb_vendor->alamat->caption() ?><?php echo ($tb_vendor->alamat->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tb_vendor_add->RightColumnClass ?>"><div<?php echo $tb_vendor->alamat->cellAttributes() ?>>
<span id="el_tb_vendor_alamat">
<input type="text" data-table="tb_vendor" data-field="x_alamat" name="x_alamat" id="x_alamat" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tb_vendor->alamat->getPlaceHolder()) ?>" value="<?php echo $tb_vendor->alamat->EditValue ?>"<?php echo $tb_vendor->alamat->editAttributes() ?>>
</span>
<?php echo $tb_vendor->alamat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tb_vendor->telp->Visible) { // telp ?>
	<div id="r_telp" class="form-group row">
		<label id="elh_tb_vendor_telp" for="x_telp" class="<?php echo $tb_vendor_add->LeftColumnClass ?>"><?php echo $tb_vendor->telp->caption() ?><?php echo ($tb_vendor->telp->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tb_vendor_add->RightColumnClass ?>"><div<?php echo $tb_vendor->telp->cellAttributes() ?>>
<span id="el_tb_vendor_telp">
<input type="text" data-table="tb_vendor" data-field="x_telp" name="x_telp" id="x_telp" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($tb_vendor->telp->getPlaceHolder()) ?>" value="<?php echo $tb_vendor->telp->EditValue ?>"<?php echo $tb_vendor->telp->editAttributes() ?>>
</span>
<?php echo $tb_vendor->telp->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tb_vendor_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tb_vendor_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tb_vendor_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tb_vendor_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tb_vendor_add->terminate();
?>