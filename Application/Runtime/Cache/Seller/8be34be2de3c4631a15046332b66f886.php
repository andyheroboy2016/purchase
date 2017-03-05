<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" href="/purchase/Public/libs/bootstrap/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="/purchase/Public/libs/bootstrap/css/bootstrap-theme.min.css"> -->
    <link rel="stylesheet" href="/purchase/Public/css/reply_order.css">
    <title>查看询价单</title>
</head>
<body>
    <h2>已完成报价单</h2>
    <div class="order-div">
        
    </div>
    

<input type="hidden" id="appPath" value="/purchase/index.php">
<input type="hidden" id="pubPath" value="/purchase/Public">
<script type="text/html" id="order-form">
    {{each reply_order_list as reply_order}}
    <form action="" class="order-form">
        <h3>
            <p>报价单名称：{{reply_order.order_name}}</p>
            <p>报价单号：{{reply_order.order_number}}</p>
        </h3>
        <table class="order-table">
            <thead>
              <tr>
                <th>商品名称</th>
                <th>数量</th>
                <th>单位</th>
                <th>价格/元</th>
              </tr>
            </thead>
            <tbody>
                {{each reply_order.product_reply as item}}
                <tr class="product-tr">
                    <td class="product-name">{{item.product_name}}</td>
                    <td class="product-num">{{item.product_num}}</td>
                    <td class="product-unit">{{item.product_unit}}</td>
                    <td class="product-price">{{item.product_price}}</td> 
                </tr>
                {{/each}}
                <tr>
                    <td colspan="3">总价</td>
                    <td>{{reply_order.total_price}}</td>
                </tr>
            </tbody>
        </table>
    </form>
    {{/each}}
</script>

<script src="/purchase/Public/libs/jquery/jquery.min.js"></script>
<script src="/purchase/Public/libs/layer/layer.js"></script>
<script src="/purchase/Public/libs/art-template/dist/template.js"></script>


<script>
$(function(){
    var appPath = $('#appPath').val();
    $.ajax({
        url: appPath+'/Seller/Manage/replied_order_list',
        type: 'POST',
        dataType: 'json',
        data: {},
        success: function(data){
            console.log(data);
            $html = template('order-form',data);
            $('.order-div').html($html);

        },
        error: function(xhr){
            console.log(xhr);
        }
    });
});    
</script>
</body>
</html>