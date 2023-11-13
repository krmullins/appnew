<?php
	// check this file's MD5 to make sure it wasn't called before
	$tenantId = Authentication::tenantIdPadded();
	$setupHash = __DIR__ . "/setup{$tenantId}.md5";

	$prevMD5 = @file_get_contents($setupHash);
	$thisMD5 = md5_file(__FILE__);

	// check if this setup file already run
	if($thisMD5 != $prevMD5) {
		// set up tables
		setupTable(
			'customers', " 
			CREATE TABLE IF NOT EXISTS `customers` ( 
				`CompanyName` VARCHAR(40) NOT NULL,
				`CustomerID` VARCHAR(5) NOT NULL,
				PRIMARY KEY (`CustomerID`),
				`ContactName` VARCHAR(30) NULL,
				`ContactTitle` VARCHAR(30) NULL,
				`Address` TEXT NULL,
				`City` VARCHAR(15) NULL,
				`Region` VARCHAR(15) NULL,
				`PostalCode` VARCHAR(10) NULL,
				`Country` VARCHAR(15) NULL,
				`Phone` VARCHAR(24) NULL,
				`Fax` VARCHAR(24) NULL,
				`TotalSales` DECIMAL(10,2) NULL
			) CHARSET utf8mb4"
		);

		setupTable(
			'employees', " 
			CREATE TABLE IF NOT EXISTS `employees` ( 
				`EmployeeID` INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`EmployeeID`),
				`TitleOfCourtesy` VARCHAR(50) NULL,
				`Photo` VARCHAR(40) NULL,
				`LastName` VARCHAR(50) NULL,
				`FirstName` VARCHAR(10) NULL,
				`Title` VARCHAR(30) NULL,
				`BirthDate` DATE NULL,
				`HireDate` DATE NULL,
				`Address` VARCHAR(50) NULL,
				`City` VARCHAR(15) NULL,
				`Region` VARCHAR(15) NULL,
				`PostalCode` VARCHAR(10) NULL,
				`Country` VARCHAR(15) NULL,
				`HomePhone` VARCHAR(24) NULL,
				`Extension` VARCHAR(4) NULL,
				`Notes` TEXT NULL,
				`ReportsTo` INT NULL,
				`Age` INT NULL,
				`TotalSales` DECIMAL(10,2) NULL
			) CHARSET utf8mb4"
		);
		setupIndexes('employees', ['ReportsTo',]);

		setupTable(
			'orders', " 
			CREATE TABLE IF NOT EXISTS `orders` ( 
				`OrderID` INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`OrderID`),
				`Status` VARCHAR(200) NULL,
				`CustomerID` VARCHAR(5) NULL,
				`EmployeeID` INT NULL,
				`OrderDate` DATE NULL,
				`OrderTime` TIME NULL,
				`RequiredDate` DATE NULL,
				`ShippedDate` DATE NULL,
				`ShipVia` INT(11) NULL,
				`Freight` FLOAT(10,2) NULL DEFAULT '0',
				`ShipName` VARCHAR(5) NULL,
				`ShipAddress` VARCHAR(5) NULL,
				`ShipCity` VARCHAR(5) NULL,
				`ShipRegion` VARCHAR(5) NULL,
				`ShipPostalCode` VARCHAR(5) NULL,
				`ShipCountry` VARCHAR(5) NULL,
				`added_by` VARCHAR(40) NULL,
				`added_date` DATE NULL,
				`Total` DECIMAL(10,2) NULL
			) CHARSET utf8mb4"
		);
		setupIndexes('orders', ['CustomerID','EmployeeID','ShipVia',]);

		setupTable(
			'order_details', " 
			CREATE TABLE IF NOT EXISTS `order_details` ( 
				`odID` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`odID`),
				`OrderID` INT NULL DEFAULT '0',
				`Category` INT NULL,
				`ProductID` INT NULL DEFAULT '0',
				`UnitPrice` FLOAT(10,2) NULL DEFAULT '0',
				`Quantity` SMALLINT NULL DEFAULT '1',
				`Discount` FLOAT(10,2) NULL DEFAULT '0',
				`Subtotal` DECIMAL(10,2) NULL
			) CHARSET utf8mb4"
		);
		setupIndexes('order_details', ['OrderID','ProductID',]);

		setupTable(
			'products', " 
			CREATE TABLE IF NOT EXISTS `products` ( 
				`ProductID` INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`ProductID`),
				`ProductName` VARCHAR(50) NULL,
				`SupplierID` INT(11) NULL,
				`CategoryID` INT NULL,
				`QuantityPerUnit` VARCHAR(50) NULL,
				`UnitPrice` FLOAT(10,2) NULL DEFAULT '0',
				`UnitsInStock` SMALLINT NULL DEFAULT '0',
				`UnitsOnOrder` SMALLINT(6) NULL DEFAULT '0',
				`ReorderLevel` SMALLINT NULL DEFAULT '0',
				`Discontinued` TINYINT NULL DEFAULT '0',
				`TotalSales` DECIMAL(10,2) NULL,
				`TechSheet` VARCHAR(40) NULL
			) CHARSET utf8mb4"
		);
		setupIndexes('products', ['SupplierID','CategoryID',]);

		setupTable(
			'categories', " 
			CREATE TABLE IF NOT EXISTS `categories` ( 
				`CategoryID` INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`CategoryID`),
				`Picture` VARCHAR(40) NULL,
				`CategoryName` VARCHAR(50) NULL,
				UNIQUE `CategoryName_unique` (`CategoryName`),
				`Description` TEXT NULL
			) CHARSET utf8mb4"
		);

		setupTable(
			'suppliers', " 
			CREATE TABLE IF NOT EXISTS `suppliers` ( 
				`SupplierID` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`SupplierID`),
				`CompanyName` VARCHAR(50) NULL,
				`ContactName` VARCHAR(30) NULL,
				`ContactTitle` VARCHAR(30) NULL,
				`Address` VARCHAR(50) NULL,
				`City` VARCHAR(15) NULL,
				`Region` VARCHAR(15) NULL,
				`PostalCode` VARCHAR(10) NULL,
				`Country` VARCHAR(50) NULL,
				`Phone` VARCHAR(24) NULL,
				`Fax` VARCHAR(24) NULL,
				`HomePage` TEXT NULL
			) CHARSET utf8mb4"
		);

		setupTable(
			'shippers', " 
			CREATE TABLE IF NOT EXISTS `shippers` ( 
				`ShipperID` INT(11) NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`ShipperID`),
				`CompanyName` VARCHAR(40) NOT NULL,
				UNIQUE `CompanyName_unique` (`CompanyName`),
				`Phone` VARCHAR(24) NULL
			) CHARSET utf8mb4"
		);

		setupTable(
			'logs', " 
			CREATE TABLE IF NOT EXISTS `logs` ( 
				`ID` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`ID`),
				`ip` VARCHAR(16) NULL,
				`ts` BIGINT NULL,
				`details` TEXT NULL
			) CHARSET utf8mb4", [
				"ALTER TABLE `table9` RENAME `logs`",
				"UPDATE `membership_userrecords` SET `tableName`='logs' WHERE `tableName`='table9'",
				"UPDATE `membership_userpermissions` SET `tableName`='logs' WHERE `tableName`='table9'",
				"UPDATE `membership_grouppermissions` SET `tableName`='logs' WHERE `tableName`='table9'",
				"ALTER TABLE logs ADD `field1` VARCHAR(40)",
				"ALTER TABLE `logs` CHANGE `field1` `field1` VARCHAR(40) NOT NULL ",
				"ALTER TABLE `logs` ADD UNIQUE `field1_unique` (`field1`)",
				" ALTER TABLE `logs` CHANGE `field1` `field1` VARCHAR(40) NOT NULL ",
				"ALTER TABLE `logs` DROP INDEX `field1_unique`",
				"ALTER TABLE `logs` CHANGE `field1` `ID` VARCHAR(40) NOT NULL ",
				" ALTER TABLE `logs` CHANGE `ID` `ID` INT NOT NULL ",
				" ALTER TABLE `logs` CHANGE `ID` `ID` INT NOT NULL AUTO_INCREMENT ",
				" ALTER TABLE `logs` CHANGE `ID` `ID` INT UNSIGNED NOT NULL AUTO_INCREMENT ",
				"ALTER TABLE logs ADD `field2` VARCHAR(40)",
				"ALTER TABLE `logs` CHANGE `field2` `ip` VARCHAR(40) NULL ",
				" ALTER TABLE `logs` CHANGE `ip` `ip` VARCHAR(16) NULL ",
				"ALTER TABLE logs ADD `field3` VARCHAR(40)",
				"ALTER TABLE `logs` CHANGE `field3` `ts` VARCHAR(40) NULL ",
				" ALTER TABLE `logs` CHANGE `ts` `ts` BIGINT NULL ",
				"ALTER TABLE logs ADD `field4` VARCHAR(40)",
				"ALTER TABLE `logs` CHANGE `field4` `details` VARCHAR(40) NULL ",
				"ALTER TABLE `logs` CHANGE `comments` `comments` TEXT NULL ",
				"ALTER TABLE `logs` ADD PRIMARY KEY (`ID`)",
			]
		);



		// save MD5
		@file_put_contents($setupHash, $thisMD5);
	}


	function setupIndexes($tableName, $arrFields) {
		if(!is_array($arrFields) || !count($arrFields)) return false;

		foreach($arrFields as $fieldName) {
			if(!$res = @db_query("SHOW COLUMNS FROM `$tableName` like '$fieldName'")) continue;
			if(!$row = @db_fetch_assoc($res)) continue;
			if($row['Key']) continue;

			@db_query("ALTER TABLE `$tableName` ADD INDEX `$fieldName` (`$fieldName`)");
		}
	}


	function setupTable($tableName, $createSQL = '', $arrAlter = '') {
		global $Translation;
		$oldTableName = '';
		ob_start();

		echo '<div style="padding: 5px; border-bottom:solid 1px silver; font-family: verdana, arial; font-size: 10px;">';

		// is there a table rename query?
		if(is_array($arrAlter)) {
			$matches = [];
			if(preg_match("/ALTER TABLE `(.*)` RENAME `$tableName`/i", $arrAlter[0], $matches)) {
				$oldTableName = $matches[1];
			}
		}

		if($res = @db_query("SELECT COUNT(1) FROM `$tableName`")) { // table already exists
			if($row = @db_fetch_array($res)) {
				echo str_replace(['<TableName>', '<NumRecords>'], [$tableName, $row[0]], $Translation['table exists']);
				if(is_array($arrAlter)) {
					echo '<br>';
					foreach($arrAlter as $alter) {
						if($alter != '') {
							echo "$alter ... ";
							if(!@db_query($alter)) {
								echo '<span class="label label-danger">' . $Translation['failed'] . '</span>';
								echo '<div class="text-danger">' . $Translation['mysql said'] . ' ' . db_error(db_link()) . '</div>';
							} else {
								echo '<span class="label label-success">' . $Translation['ok'] . '</span>';
							}
						}
					}
				} else {
					echo $Translation['table uptodate'];
				}
			} else {
				echo str_replace('<TableName>', $tableName, $Translation['couldnt count']);
			}
		} else { // given tableName doesn't exist

			if($oldTableName != '') { // if we have a table rename query
				if($ro = @db_query("SELECT COUNT(1) FROM `$oldTableName`")) { // if old table exists, rename it.
					$renameQuery = array_shift($arrAlter); // get and remove rename query

					echo "$renameQuery ... ";
					if(!@db_query($renameQuery)) {
						echo '<span class="label label-danger">' . $Translation['failed'] . '</span>';
						echo '<div class="text-danger">' . $Translation['mysql said'] . ' ' . db_error(db_link()) . '</div>';
					} else {
						echo '<span class="label label-success">' . $Translation['ok'] . '</span>';
					}

					if(is_array($arrAlter)) setupTable($tableName, $createSQL, false, $arrAlter); // execute Alter queries on renamed table ...
				} else { // if old tableName doesn't exist (nor the new one since we're here), then just create the table.
					setupTable($tableName, $createSQL, false); // no Alter queries passed ...
				}
			} else { // tableName doesn't exist and no rename, so just create the table
				echo str_replace("<TableName>", $tableName, $Translation["creating table"]);
				if(!@db_query($createSQL)) {
					echo '<span class="label label-danger">' . $Translation['failed'] . '</span>';
					echo '<div class="text-danger">' . $Translation['mysql said'] . db_error(db_link()) . '</div>';

					// create table with a dummy field
					@db_query("CREATE TABLE IF NOT EXISTS `$tableName` (`_dummy_deletable_field` TINYINT)");
				} else {
					echo '<span class="label label-success">' . $Translation['ok'] . '</span>';
				}
			}

			// set Admin group permissions for newly created table if membership_grouppermissions exists
			if($ro = @db_query("SELECT COUNT(1) FROM `membership_grouppermissions`")) {
				// get Admins group id
				$ro = @db_query("SELECT `groupID` FROM `membership_groups` WHERE `name`='Admins'");
				if($ro) {
					$adminGroupID = intval(db_fetch_row($ro)[0]);
					if($adminGroupID) @db_query("INSERT IGNORE INTO `membership_grouppermissions` SET
						`groupID`='$adminGroupID',
						`tableName`='$tableName',
						`allowInsert`=1, `allowView`=1, `allowEdit`=1, `allowDelete`=1
					");
				}
			}
		}

		echo '</div>';

		$out = ob_get_clean();
		if(defined('APPGINI_SETUP') && APPGINI_SETUP) echo $out;
	}
