<?php
require_once(__DIR__ . "/vendor/autoload.php");

if ($_SERVER['REQUEST_URI'] === '/phpmyadmin') {
  header('Location: /phpmyadmin');
  exit();
}

$ROUTER = new AltoRouter();

##################### SERVICE #####################
##################### ISSUE-AUTHORIZE #####################
$ROUTER->map("GET", "/issue/authorize", function () {
  require(__DIR__ . "/src/Views/issue-authorize/index.php");
});
$ROUTER->map("GET", "/issue/authorize/create", function () {
  require(__DIR__ . "/src/Views/issue-authorize/create.php");
});
$ROUTER->map("POST", "/issue/authorize/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/issue-authorize/action.php");
});
##################### ISSUE #####################
$ROUTER->map("GET", "/issue", function () {
  require(__DIR__ . "/src/Views/issue/index.php");
});
$ROUTER->map("GET", "/issue/income", function () {
  require(__DIR__ . "/src/Views/issue/income.php");
});
$ROUTER->map("GET", "/issue/outcome", function () {
  require(__DIR__ . "/src/Views/issue/outcome.php");
});
$ROUTER->map("GET", "/issue/manage", function () {
  require(__DIR__ . "/src/Views/issue/manage.php");
});
$ROUTER->map("GET", "/issue/view/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/issue/view.php");
});
$ROUTER->map("GET", "/issue/approve/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/issue/approve.php");
});
$ROUTER->map("GET", "/issue/complete/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/issue/complete.php");
});
$ROUTER->map("GET", "/issue/edit/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/issue/edit.php");
});
$ROUTER->map("GET", "/issue/print/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/issue/print.php");
});
$ROUTER->map("POST", "/issue/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/issue/action.php");
});

##################### BORROW-AUTHORIZE #####################
$ROUTER->map("GET", "/borrow/authorize", function () {
  require(__DIR__ . "/src/Views/borrow-authorize/index.php");
});
$ROUTER->map("GET", "/borrow/authorize/create", function () {
  require(__DIR__ . "/src/Views/borrow-authorize/create.php");
});
$ROUTER->map("POST", "/borrow/authorize/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/borrow-authorize/action.php");
});
##################### BORROW #####################
$ROUTER->map("GET", "/borrow", function () {
  require(__DIR__ . "/src/Views/borrow/index.php");
});
$ROUTER->map("GET", "/borrow/create", function () {
  require(__DIR__ . "/src/Views/borrow/create.php");
});
$ROUTER->map("GET", "/borrow/manage", function () {
  require(__DIR__ . "/src/Views/borrow/manage.php");
});
$ROUTER->map("GET", "/borrow/view/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/borrow/view.php");
});
$ROUTER->map("GET", "/borrow/send/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/borrow/send.php");
});
$ROUTER->map("GET", "/borrow/receive/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/borrow/receive.php");
});
$ROUTER->map("GET", "/borrow/complete/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/borrow/complete.php");
});
$ROUTER->map("GET", "/borrow/edit/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/borrow/edit.php");
});
$ROUTER->map("GET", "/borrow/print/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/borrow/print.php");
});
$ROUTER->map("POST", "/borrow/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/borrow/action.php");
});

##################### ESTIMATE-TYPE #####################
$ROUTER->map("GET", "/estimate/type", function () {
  require(__DIR__ . "/src/Views/estimate-type/index.php");
});
$ROUTER->map("GET", "/estimate/type/create", function () {
  require(__DIR__ . "/src/Views/estimate-type/create.php");
});
$ROUTER->map("POST", "/estimate/type/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/estimate-type/action.php");
});
##################### ESTIMATE-AUTHORIZE #####################
$ROUTER->map("GET", "/estimate/authorize", function () {
  require(__DIR__ . "/src/Views/estimate-authorize/index.php");
});
$ROUTER->map("GET", "/estimate/authorize/create", function () {
  require(__DIR__ . "/src/Views/estimate-authorize/create.php");
});
$ROUTER->map("POST", "/estimate/authorize/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/estimate-authorize/action.php");
});
##################### ESTIMATE #####################
$ROUTER->map("GET", "/estimate", function () {
  require(__DIR__ . "/src/Views/estimate/index.php");
});
$ROUTER->map("GET", "/estimate/create", function () {
  require(__DIR__ . "/src/Views/estimate/create.php");
});
$ROUTER->map("GET", "/estimate/manage", function () {
  require(__DIR__ . "/src/Views/estimate/manage.php");
});
$ROUTER->map("GET", "/estimate/view/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/estimate/view.php");
});
$ROUTER->map("GET", "/estimate/approve-sale/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/estimate/approve-sale.php");
});
$ROUTER->map("GET", "/estimate/approve-budget/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/estimate/approve-budget.php");
});
$ROUTER->map("GET", "/estimate/approve-finance/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/estimate/approve-finance.php");
});
$ROUTER->map("GET", "/estimate/complete/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/estimate/complete.php");
});
$ROUTER->map("GET", "/estimate/print/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/estimate/print.php");
});
$ROUTER->map("POST", "/estimate/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/estimate/action.php");
});

##################### PURCHASE #####################
$ROUTER->map("GET", "/purchase", function () {
  require(__DIR__ . "/src/Views/purchase/index.php");
});
$ROUTER->map("GET", "/purchase/create", function () {
  require(__DIR__ . "/src/Views/purchase/create.php");
});
$ROUTER->map("GET", "/purchase/manage", function () {
  require(__DIR__ . "/src/Views/purchase/manage.php");
});
$ROUTER->map("GET", "/purchase/view/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/purchase/view.php");
});
$ROUTER->map("GET", "/purchase/approve/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/purchase/approve.php");
});
$ROUTER->map("GET", "/purchase/complete/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/purchase/complete.php");
});
$ROUTER->map("GET", "/purchase/print/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/purchase/print.php");
});
$ROUTER->map("POST", "/purchase/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/purchase/action.php");
});

##################### ADVANCE #####################
$ROUTER->map("GET", "/advance", function () {
  require(__DIR__ . "/src/Views/advance/index.php");
});
$ROUTER->map("GET", "/advance/create", function () {
  require(__DIR__ . "/src/Views/advance/create.php");
});
$ROUTER->map("GET", "/advance/manage", function () {
  require(__DIR__ . "/src/Views/advance/manage.php");
});
$ROUTER->map("GET", "/advance/view/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/advance/view.php");
});
$ROUTER->map("GET", "/advance/approve/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/advance/approve.php");
});
$ROUTER->map("GET", "/advance/complete/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/advance/complete.php");
});
$ROUTER->map("GET", "/advance/print/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/advance/print.php");
});
$ROUTER->map("POST", "/advance/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/advance/action.php");
});

##################### PAYMENT #####################
$ROUTER->map("GET", "/payment", function () {
  require(__DIR__ . "/src/Views/payment/index.php");
});
$ROUTER->map("GET", "/payment/create", function () {
  require(__DIR__ . "/src/Views/payment/create.php");
});
$ROUTER->map("GET", "/payment/manage", function () {
  require(__DIR__ . "/src/Views/payment/manage.php");
});
$ROUTER->map("GET", "/payment/view/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/payment/view.php");
});
$ROUTER->map("GET", "/payment/account/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/payment/account.php");
});
$ROUTER->map("GET", "/payment/approve/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/payment/approve.php");
});
$ROUTER->map("GET", "/payment/complete/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/payment/complete.php");
});
$ROUTER->map("GET", "/payment/print/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/payment/print.php");
});
$ROUTER->map("POST", "/payment/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/payment/action.php");
});

##################### SYETEM #####################
$ROUTER->map("GET", "/system", function () {
  require(__DIR__ . "/src/Views/system/index.php");
});
$ROUTER->map("POST", "/system/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/system/action.php");
});

##################### CUSTOMER #####################
$ROUTER->map("GET", "/customer", function () {
  require(__DIR__ . "/src/Views/customer/index.php");
});
$ROUTER->map("GET", "/customer/create", function () {
  require(__DIR__ . "/src/Views/customer/create.php");
});
$ROUTER->map("GET", "/customer/view/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/customer/view.php");
});
$ROUTER->map("POST", "/customer/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/customer/action.php");
});

##################### PRODUCT BRAND #####################
$ROUTER->map("GET", "/product-brand", function () {
  require(__DIR__ . "/src/Views/product-brand/index.php");
});
$ROUTER->map("GET", "/product-brand/create", function () {
  require(__DIR__ . "/src/Views/product-brand/create.php");
});
$ROUTER->map("GET", "/product-brand/view/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/product-brand/view.php");
});
$ROUTER->map("POST", "/product-brand/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/product-brand/action.php");
});

##################### PRODUCT UNIT #####################
$ROUTER->map("GET", "/product-unit", function () {
  require(__DIR__ . "/src/Views/product-unit/index.php");
});
$ROUTER->map("GET", "/product-unit/create", function () {
  require(__DIR__ . "/src/Views/product-unit/create.php");
});
$ROUTER->map("GET", "/product-unit/view/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/product-unit/view.php");
});
$ROUTER->map("POST", "/product-unit/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/product-unit/action.php");
});

##################### PRODUCT TYPE #####################
$ROUTER->map("GET", "/product-type", function () {
  require(__DIR__ . "/src/Views/product-type/index.php");
});
$ROUTER->map("GET", "/product-type/create", function () {
  require(__DIR__ . "/src/Views/product-type/create.php");
});
$ROUTER->map("GET", "/product-type/view/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/product-type/view.php");
});
$ROUTER->map("POST", "/product-type/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/product-type/action.php");
});

##################### PRODUCT LOCATION #####################
$ROUTER->map("GET", "/product-location", function () {
  require(__DIR__ . "/src/Views/product-location/index.php");
});
$ROUTER->map("GET", "/product-location/create", function () {
  require(__DIR__ . "/src/Views/product-location/create.php");
});
$ROUTER->map("GET", "/product-location/view/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/product-location/view.php");
});
$ROUTER->map("POST", "/product-location/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/product-location/action.php");
});

##################### PRODUCT WAREHOUSE #####################
$ROUTER->map("GET", "/product-warehouse", function () {
  require(__DIR__ . "/src/Views/product-warehouse/index.php");
});
$ROUTER->map("GET", "/product-warehouse/create", function () {
  require(__DIR__ . "/src/Views/product-warehouse/create.php");
});
$ROUTER->map("GET", "/product-warehouse/view/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/product-warehouse/view.php");
});
$ROUTER->map("POST", "/product-warehouse/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/product-warehouse/action.php");
});

##################### PRODUCT #####################
$ROUTER->map("GET", "/product", function () {
  require(__DIR__ . "/src/Views/product/index.php");
});
$ROUTER->map("GET", "/product/create", function () {
  require(__DIR__ . "/src/Views/product/create.php");
});
$ROUTER->map("GET", "/product/view/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/product/view.php");
});
$ROUTER->map("GET", "/product/download/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/product/download.php");
});
$ROUTER->map("POST", "/product/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/product/action.php");
});

##################### ASSET BRAND #####################
$ROUTER->map("GET", "/asset-brand", function () {
  require(__DIR__ . "/src/Views/asset-brand/index.php");
});
$ROUTER->map("GET", "/asset-brand/create", function () {
  require(__DIR__ . "/src/Views/asset-brand/create.php");
});
$ROUTER->map("GET", "/asset-brand/view/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/asset-brand/view.php");
});
$ROUTER->map("POST", "/asset-brand/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/asset-brand/action.php");
});

##################### ASSET UNIT #####################
$ROUTER->map("GET", "/asset-unit", function () {
  require(__DIR__ . "/src/Views/asset-unit/index.php");
});
$ROUTER->map("GET", "/asset-unit/create", function () {
  require(__DIR__ . "/src/Views/asset-unit/create.php");
});
$ROUTER->map("GET", "/asset-unit/view/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/asset-unit/view.php");
});
$ROUTER->map("POST", "/asset-unit/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/asset-unit/action.php");
});

##################### ASSET TYPE #####################
$ROUTER->map("GET", "/asset-type", function () {
  require(__DIR__ . "/src/Views/asset-type/index.php");
});
$ROUTER->map("GET", "/asset-type/create", function () {
  require(__DIR__ . "/src/Views/asset-type/create.php");
});
$ROUTER->map("GET", "/asset-type/view/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/asset-type/view.php");
});
$ROUTER->map("POST", "/asset-type/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/asset-type/action.php");
});

##################### ASSET LOCATION #####################
$ROUTER->map("GET", "/asset-location", function () {
  require(__DIR__ . "/src/Views/asset-location/index.php");
});
$ROUTER->map("GET", "/asset-location/create", function () {
  require(__DIR__ . "/src/Views/asset-location/create.php");
});
$ROUTER->map("GET", "/asset-location/view/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/asset-location/view.php");
});
$ROUTER->map("POST", "/asset-location/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/asset-location/action.php");
});

##################### ASSET WAREHOUSE #####################
$ROUTER->map("GET", "/asset-warehouse", function () {
  require(__DIR__ . "/src/Views/asset-warehouse/index.php");
});
$ROUTER->map("GET", "/asset-warehouse/create", function () {
  require(__DIR__ . "/src/Views/asset-warehouse/create.php");
});
$ROUTER->map("GET", "/asset-warehouse/view/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/asset-warehouse/view.php");
});
$ROUTER->map("POST", "/asset-warehouse/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/asset-warehouse/action.php");
});

##################### ASSET #####################
$ROUTER->map("GET", "/asset", function () {
  require(__DIR__ . "/src/Views/asset/index.php");
});
$ROUTER->map("GET", "/asset/create", function () {
  require(__DIR__ . "/src/Views/asset/create.php");
});
$ROUTER->map("GET", "/asset/view/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/asset/view.php");
});
$ROUTER->map("GET", "/asset/download/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/asset/download.php");
});
$ROUTER->map("POST", "/asset/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/asset/action.php");
});

##################### EXPENSE #####################
$ROUTER->map("GET", "/expense", function () {
  require(__DIR__ . "/src/Views/expense/index.php");
});
$ROUTER->map("GET", "/expense/create", function () {
  require(__DIR__ . "/src/Views/expense/create.php");
});
$ROUTER->map("GET", "/expense/view/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/expense/view.php");
});
$ROUTER->map("POST", "/expense/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/expense/action.php");
});

##################### USER #####################
$ROUTER->map("GET", "/user", function () {
  require(__DIR__ . "/src/Views/user/index.php");
});
$ROUTER->map("GET", "/user/create", function () {
  require(__DIR__ . "/src/Views/user/create.php");
});
$ROUTER->map("GET", "/user/profile", function () {
  require(__DIR__ . "/src/Views/user/profile.php");
});
$ROUTER->map("GET", "/user/change", function () {
  require(__DIR__ . "/src/Views/user/change.php");
});
$ROUTER->map("GET", "/user/view/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/user/view.php");
});
$ROUTER->map("POST", "/user/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/user/action.php");
});

##################### AUTHORIZE #####################
$ROUTER->map("GET", "/authorize", function () {
  require(__DIR__ . "/src/Views/authorize/index.php");
});
$ROUTER->map("POST", "/authorize/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/authorize/action.php");
});

##################### SERVICE #####################
$ROUTER->map("GET", "/service", function () {
  require(__DIR__ . "/src/Views/service/index.php");
});
$ROUTER->map("POST", "/service/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/service/action.php");
});

##################### AUTH #####################
$ROUTER->map("GET", "/", function () {
  require(__DIR__ . "/src/Views/home/login.php");
});
$ROUTER->map("GET", "/logout", function () {
  require(__DIR__ . "/src/Views/home/logout.php");
});
$ROUTER->map("GET", "/home", function () {
  require(__DIR__ . "/src/Views/home/index.php");
});
$ROUTER->map("GET", "/info", function () {
  require(__DIR__ . "/src/Views/home/info.php");
});
$ROUTER->map("GET", "/error", function () {
  require(__DIR__ . "/src/Views/home/error.php");
});
$ROUTER->map("POST", "/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/home/action.php");
});
// $ROUTER->map("GET", "/[**:params]", function ($params) {
//   require(__DIR__ . "/src/Views/home/action.php");
// });


$MATCH = $ROUTER->match();

if (is_array($MATCH) && is_callable($MATCH["target"])) {
  call_user_func_array($MATCH["target"], $MATCH["params"]);
} else {
  header("HTTP/1.1 404 Not Found");
  require_once(__DIR__ . "/src/Views/home/error.php");
}
