<?php
require_once(__DIR__ . "/vendor/autoload.php");

$ROUTER = new AltoRouter();

##################### SERVICE #####################
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

##################### advance #####################
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
$ROUTER->map("GET", "/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/home/action.php");
});


$MATCH = $ROUTER->match();

if (is_array($MATCH) && is_callable($MATCH["target"])) {
  call_user_func_array($MATCH["target"], $MATCH["params"]);
} else {
  header("HTTP/1.1 404 Not Found");
  require_once(__DIR__ . "/src/Views/home/error.php");
}
