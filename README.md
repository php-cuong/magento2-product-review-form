# magento2-product-review-form
How to show review form only for the customer who has purchased the item in Magento 2

## Why should you use this extension?
- By default, Magento 2 is showing review form on the product detail page for both Customer logged in and Guest, you can disable Guest by going to Magento Admin Panel and navigate to the Stores → Settings → Configuration → Catalog → Catalog. Then open Product Reviews tab, select the "Allow Guests to Write Reviews" as "No".

- You are working for a project, you are required to customize the review form, that allows it only to show with the customers who have purchased the product. You don't know how to complete this task, you are searching for a solution. Today I show you the best codes to complete your task.

- We have the scenario: When a customer views the product, we will check all orders of that customer if the current product exists in any orders, then show the review form and if not show a message.

- So what will we do in this practice?

1. We will create a new module called PHPCuong_ProductReviewForm
2. We will use the preference to override the method named **_construct() in the class named \Magento\Review\Block\Form**

## How to install this extension?

Under your root folder, run the following command lines:

- composer require php-cuong/magento2-product-review-form
- php bin/magento setup:upgrade --keep-generated
- php bin/magento setup:di:compile
- php bin/magento cache:flush

## See the video How I can create this extension steps by step:
1. Youtube: https://www.youtube.com/watch?v=Z-qpnl7cI4Q&index=54&list=PL98CDCbI3TNvPczWSOnpaMoyxVISLVzYQ
2. Facebook: https://www.facebook.com/giaphugroupcom/videos/707473429649797/
