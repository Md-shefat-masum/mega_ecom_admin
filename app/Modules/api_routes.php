<?php
/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
include_once  base_path("app/Modules/Auth/Route.php");
/*
|--------------------------------------------------------------------------
| File management Routes
|--------------------------------------------------------------------------
*/
include_once  base_path("app/Modules/FileUploader/Route.php");
/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
include_once  base_path("app/Modules/UserManagement/User/Route.php");
include_once  base_path("app/Modules/UserManagement/UserCustomerType/Route.php");
include_once  base_path("app/Modules/UserManagement/UserPermission/Route.php");
include_once  base_path("app/Modules/UserManagement/UserRetailerType/Route.php");
include_once  base_path("app/Modules/UserManagement/UserRole/Route.php");
include_once  base_path("app/Modules/UserManagement/UserSupplierType/Route.php");

/*


|--------------------------------------------------------------------------
| Product management Routes
|--------------------------------------------------------------------------
*/
include_once  base_path("app/Modules/ProductManagement/ProductCategoryGroup/Route.php");
include_once  base_path("app/Modules/ProductManagement/ProductCategory/Route.php");
include_once  base_path("app/Modules/ProductManagement/ProductCategoryWiseAdvertise/Route.php");

include_once  base_path("app/Modules/ProductManagement/ProductBarCode/Route.php");
include_once  base_path("app/Modules/ProductManagement/ProductBrand/Route.php");
include_once  base_path("app/Modules/ProductManagement/ProductMenufacturer/Route.php");

include_once  base_path("app/Modules/ProductManagement/ProductUnit/Route.php");
include_once  base_path("app/Modules/ProductManagement/ProductUnitGroup/Route.php");

include_once  base_path("app/Modules/ProductManagement/ProductVarient/Route.php");
include_once  base_path("app/Modules/ProductManagement/ProductVarientGroup/Route.php");
include_once  base_path("app/Modules/ProductManagement/ProductVarientValue/Route.php");

include_once  base_path("app/Modules/ProductManagement/Product/Route.php");
include_once  base_path("app/Modules/ProductManagement/ProductFaq/Route.php");
include_once  base_path("app/Modules/ProductManagement/ProductOffer/Route.php");

include_once  base_path("app/Modules/ProductManagement/ProductMedicineForm/Route.php");
include_once  base_path("app/Modules/ProductManagement/ProductMedicineGeneric/Route.php");
include_once  base_path("app/Modules/ProductManagement/ProductCompany/Route.php");

/*
|--------------------------------------------------------------------------
| Location management Routes
|--------------------------------------------------------------------------
*/
include_once  base_path("app/Modules/LocationManagement/Country/Route.php");
include_once  base_path("app/Modules/LocationManagement/StateDivision/Route.php");
include_once  base_path("app/Modules/LocationManagement/District/Route.php");
include_once  base_path("app/Modules/LocationManagement/Station/Route.php");


/*
|--------------------------------------------------------------------------
| Ecommerce management Routes
|--------------------------------------------------------------------------
*/
include_once  base_path("app/Modules/Ecommerce/CustomerWishlist/Route.php");
include_once  base_path("app/Modules/Ecommerce/Faq/Route.php");
include_once  base_path("app/Modules/Ecommerce/PromoCode/Route.php");
include_once  base_path("app/Modules/Ecommerce/GeneralSeo/Route.php");
/*
|--------------------------------------------------------------------------
| Configuration management Routes
|--------------------------------------------------------------------------
*/
include_once  base_path("app/Modules/ConfigurationManagement/WebsiteConfiguration/Route.php");



/*
|--------------------------------------------------------------------------
| Purchage management Routes
|--------------------------------------------------------------------------
*/
include_once  base_path("app/Modules/PurchageManagement/PurchaseOrder/Route.php");
include_once  base_path("app/Modules/PurchageManagement/PurchaseReturnOrder/Route.php");
/*
|--------------------------------------------------------------------------
| Sales management Routes
|--------------------------------------------------------------------------
*/
include_once  base_path("app/Modules/SalesManagement/SalesEcommerceOrder/Route.php");
include_once  base_path("app/Modules/SalesManagement/SalesInvoice/Route.php");
include_once  base_path("app/Modules/SalesManagement/SalesOrder/Route.php");
include_once  base_path("app/Modules/SalesManagement/SalesQuotationOrder/Route.php");
include_once  base_path("app/Modules/SalesManagement/SalesReturn/Route.php");
/*
|--------------------------------------------------------------------------
| Stock management Routes
|--------------------------------------------------------------------------
*/
include_once  base_path("app/Modules/StockManagement/ProductStock/Route.php");
include_once  base_path("app/Modules/StockManagement/ProductWearHouse/Route.php");
include_once  base_path("app/Modules/StockManagement/ProductWearHouseBranch/Route.php");
/*
|--------------------------------------------------------------------------
| Vat management Routes
|--------------------------------------------------------------------------
*/
include_once  base_path("app/Modules/VatManagement/Vat/Route.php");
include_once  base_path("app/Modules/VatManagement/VatGroup/Route.php");
/*
|--------------------------------------------------------------------------
| Banner management and Mobile api  Routes
|--------------------------------------------------------------------------
*/
include_once  base_path("app/Modules/BannerManagement/HomeBanner/Route.php");
include_once  base_path("app/Modules/BannerManagement/HomeSideBanner/Route.php");

/*
|--------------------------------------------------------------------------
| Website and Mobile api  Routes
|--------------------------------------------------------------------------
app/Modules/WebsiteApi/SliderAndBanner/Route.php
*/

include_once  base_path("app/Modules/WebsiteApi/SliderAndBanner/Route.php");

include_once  base_path("app/Modules/WebsiteApi/Category/Route.php");
include_once  base_path("app/Modules/WebsiteApi/Brand/Route.php");
include_once  base_path("app/Modules/WebsiteApi/Product/Route.php");

include_once  base_path("app/Modules/WebsiteApi/Cart/Route.php");
include_once  base_path("app/Modules/WebsiteApi/WishList/Route.php");
include_once  base_path("app/Modules/WebsiteApi/CompareList/Route.php");
include_once  base_path("app/Modules/WebsiteApi/Order/Route.php");

include_once  base_path("app/Modules/WebsiteApi/SearchHandling/Route.php");

include_once  base_path("app/Modules/WebsiteApi/ProductReview/Route.php");
include_once  base_path("app/Modules/WebsiteApi/ProductQuestion/Route.php");

include_once  base_path("app/Modules/TagManagement/ProductTag/Route.php");
include_once  base_path("app/Modules/TagManagement/ProductCategoryTag/Route.php");


/*
|--------------------------------------------------------------------------
| Blog management and Mobile api  Routes
|--------------------------------------------------------------------------
*/
include_once  base_path("app/Modules/BlogManagement/BlogCategory/Route.php");
include_once  base_path("app/Modules/BlogManagement/Blog/Route.php");
/*
|--------------------------------------------------------------------------
|Subscriber api  Routes
|--------------------------------------------------------------------------
*/
include_once  base_path("app/Modules/Subscriber/Route.php");

/*
|--------------------------------------------------------------------------
| account and payments
|--------------------------------------------------------------------------
*/
include_once  base_path("app/Modules/AccountAndPayments/AccountExpenditureGroups/Route.php");
include_once  base_path("app/Modules/AccountAndPayments/AccountExpenditures/Route.php");
include_once  base_path("app/Modules/AccountAndPayments/AccountHeads/Route.php");
include_once  base_path("app/Modules/AccountAndPayments/AccountNumbers/Route.php");
include_once  base_path("app/Modules/AccountAndPayments/Accounts/Route.php");