<?php
// This script and data application were generated by AppGini 23.16
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');
	@include_once(__DIR__ . '/hooks/categories.php');
	include_once(__DIR__ . '/categories_dml.php');

	// mm: can the current member access this page?
	$perm = getTablePermissions('categories');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'categories';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`categories`.`CategoryID`" => "CategoryID",
		"`categories`.`Picture`" => "Picture",
		"`categories`.`CategoryName`" => "CategoryName",
		"`categories`.`Description`" => "Description",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`categories`.`CategoryID`',
		2 => 2,
		3 => 3,
		4 => 4,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`categories`.`CategoryID`" => "CategoryID",
		"`categories`.`Picture`" => "Picture",
		"`categories`.`CategoryName`" => "CategoryName",
		"`categories`.`Description`" => "Description",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`categories`.`CategoryID`" => "Category ID",
		"`categories`.`CategoryName`" => "Category Name",
		"`categories`.`Description`" => "Description",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`categories`.`CategoryID`" => "CategoryID",
		"`categories`.`CategoryName`" => "CategoryName",
		"`categories`.`Description`" => "Description",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = [];

	$x->QueryFrom = "`categories` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm['view'] == 0 ? 1 : 0);
	$x->AllowDelete = $perm['delete'];
	$x->AllowMassDelete = (getLoggedAdmin() !== false);
	$x->AllowInsert = $perm['insert'];
	$x->AllowUpdate = $perm['edit'];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 0;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = 1;
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowPrintingDV = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 5;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation['quick search'];
	$x->ScriptFileName = 'categories_view.php';
	$x->TableTitle = 'Product Categories';
	$x->TableIcon = 'resources/table_icons/award_star_bronze_1.png';
	$x->PrimaryKey = '`categories`.`CategoryID`';
	$x->DefaultSortField = '1';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth = [75, 150, 500, ];
	$x->ColCaption = ['Picture', 'Category Name', 'Description', ];
	$x->ColFieldName = ['Picture', 'CategoryName', 'Description', ];
	$x->ColNumber  = [2, 3, 4, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/categories_templateTV.html';
	$x->SelectedTemplate = 'templates/categories_templateTVS.html';
	$x->TemplateDV = 'templates/categories_templateDV.html';
	$x->TemplateDVP = 'templates/categories_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: categories_init
	$render = true;
	if(function_exists('categories_init')) {
		$args = [];
		$render = categories_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: categories_header
	$headerCode = '';
	if(function_exists('categories_header')) {
		$args = [];
		$headerCode = categories_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once(__DIR__ . '/header.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/header.php');
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: categories_footer
	$footerCode = '';
	if(function_exists('categories_footer')) {
		$args = [];
		$footerCode = categories_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once(__DIR__ . '/footer.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/footer.php');
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
