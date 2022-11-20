// общие кнопки для пагинации
function pageButtons($pCount, $cur, $name) {
	let $prevDis = ($cur == 1) ? "disabled" : "",
		$nextDis = ($cur == $pCount) ? "disabled" : "",
		$buttons = "<input type='button' value=&laquo; onclick='sort_" + $name + "(" + ($cur - 1) + ")' " + $prevDis + ">";
	for ($i = 1; $i <= $pCount; $i++)
		$buttons += "<input type='button' id='" + $name + "-page-btn" + $i + "'value='" + $i + "' onclick='sort_" + $name + "(" + $i + ")'>";
	$buttons += "<input type='button' value=&raquo; onclick='sort_" + $name + "(" + ($cur + 1) + ")' " + $nextDis + ">";
	return $buttons;
}


// для пагинации по необработанным заявкам

let $unhandleOrdersTable = document.getElementById("unhandleOrders"),
	$n = 7,
	$rowCountUnhandle = $unhandleOrdersTable.rows.length,
	$tr_unhandle = [],
	$i, $ii, $j = 1,
	$th_unhandle = ($unhandleOrdersTable.rows[(0)].outerHTML);
let $pageCountUnhandle = Math.ceil($rowCountUnhandle / $n);
if ($pageCountUnhandle > 1) {
	for ($i = $j, $ii = 0; $i < $rowCountUnhandle; $i++, $ii++)
		$tr_unhandle[$ii] = $unhandleOrdersTable.rows[$i].outerHTML;
	$unhandleOrdersTable.insertAdjacentHTML("afterend", "<div id='pagination-buttons-unhandle' style='margin-left:35px'></div");
	sort_unhandle(1);
}

// необработанные заявки
function sort_unhandle($p) {
	let $rows = $th_unhandle,
		$s = (($n * $p) - $n);
	for ($i = $s; $i < ($s + $n) && $i < $tr_unhandle.length; $i++)
		$rows += $tr_unhandle[$i];

	$unhandleOrdersTable.innerHTML = $rows;
	document.getElementById("pagination-buttons-unhandle").innerHTML = pageButtons($pageCountUnhandle, $p, "unhandle");
	document.getElementById("unhandle-page-btn" + $p).setAttribute("class", "active-page-btn");
}


// для пагинации по всем заявкам

let $allOrdersTable = document.getElementById("allOrders"),
	$rowCountAll = $allOrdersTable.rows.length,
	$tr_all = [],
	$th_all = ($allOrdersTable.rows[(0)].outerHTML);
let $pageCountAll = Math.ceil($rowCountAll / $n);
if ($pageCountAll > 1) {
	for ($i = $j, $ii = 0; $i < $rowCountAll; $i++, $ii++)
		$tr_all[$ii] = $allOrdersTable.rows[$i].outerHTML;
	$allOrdersTable.insertAdjacentHTML("afterend", "<div id='pagination-buttons-all' style='margin-left:35px'></div");
	sort_all(1);
}

// все заявки
function sort_all($p) {
	let $rows = $th_all,
		$s = (($n * $p) - $n);
	for ($i = $s; $i < ($s + $n) && $i < $tr_all.length; $i++)
		$rows += $tr_all[$i];

	$allOrdersTable.innerHTML = $rows;
	document.getElementById("pagination-buttons-all").innerHTML = pageButtons($pageCountAll, $p, "all");
	document.getElementById("all-page-btn" + $p).setAttribute("class", "active-page-btn");
}

// для пагинации по принятым заявкам

let $acceptedOrdersTable = document.getElementById("acceptedOrders"),
	$rowCountAccepted = $acceptedOrdersTable.rows.length,
	$tr_accepted = [],
	$th_accepted = ($acceptedOrdersTable.rows[(0)].outerHTML);
let $pageCountAccepted = Math.ceil($rowCountAccepted / $n);
if ($pageCountAccepted > 1) {
	for ($i = $j, $ii = 0; $i < $rowCountAccepted; $i++, $ii++)
		$tr_accepted[$ii] = $acceptedOrdersTable.rows[$i].outerHTML;
	$acceptedOrdersTable.insertAdjacentHTML("afterend", "<div id='pagination-buttons-accepted' style='margin-left:35px'></div");
	sort_accepted(1);
}

// принятые заявки
function sort_accepted($p) {
	let $rows = $th_accepted,
		$s = (($n * $p) - $n);
	for ($i = $s; $i < ($s + $n) && $i < $tr_accepted.length; $i++)
		$rows += $tr_accepted[$i];

	$acceptedOrdersTable.innerHTML = $rows;
	document.getElementById("pagination-buttons-accepted").innerHTML = pageButtons($pageCountAccepted, $p, "accepted");
	document.getElementById("accepted-page-btn" + $p).setAttribute("class", "active-page-btn");
}

// для пагинации по непринятым заявкам

let $unacceptedOrdersTable = document.getElementById("unacceptedOrders"),
	$pageCountUnaccepted = $unacceptedOrdersTable.rows.length,
	$tr_unaccepted = [],
	$th_unaccepted = ($unacceptedOrdersTable.rows[(0)].outerHTML);
let $pageCountunaccepted = Math.ceil($pageCountUnaccepted / $n);
if ($pageCountunaccepted > 1) {
	for ($i = $j, $ii = 0; $i < $pageCountUnaccepted; $i++, $ii++)
		$tr_unaccepted[$ii] = $unacceptedOrdersTable.rows[$i].outerHTML;
	$unacceptedOrdersTable.insertAdjacentHTML("afterend", "<div id='pagination-buttons-unaccepted' style='margin-left:35px'></div");
	sort_unaccepted(1);
}

// непринятые заявки
function sort_unaccepted($p) {
	let $rows = $th_unaccepted,
		$s = (($n * $p) - $n);
	for ($i = $s; $i < ($s + $n) && $i < $tr_unaccepted.length; $i++)
		$rows += $tr_unaccepted[$i];

	$unacceptedOrdersTable.innerHTML = $rows;
	document.getElementById("pagination-buttons-unaccepted").innerHTML = pageButtons($pageCountunaccepted, $p, "unaccepted");
	document.getElementById("unaccepted-page-btn" + $p).setAttribute("class", "active-page-btn");
}