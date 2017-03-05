<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" href="/purchase/Public/libs/bootstrap/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="/purchase/Public/libs/bootstrap/css/bootstrap-theme.min.css"> -->
    <link rel="stylesheet" href="/purchase/Public/css/reply_order.css">
    <title>商家报价单</title>
</head>
<body>
    <h2>商家报价单</h2>
    <div class="order-div">
        
    </div>
    

<input type="hidden" id="appPath" value="/purchase/index.php">
<input type="hidden" id="pubPath" value="/purchase/Public">
<script type="text/html" id="order-form">
    {{each ask_order_list as ask_order}}
    
    <form action="" class="order-form">
        <h3>
            <p>报价单名称：{{ask_order.order_name}}</p>
            <p>报价单号：{{ask_order.order_number}}</p>
        </h3>
        <p style="display: none;">{{count = 0}}</p>
        {{each reply_order_list as reply_order}}
            {{if (ask_order.order_number == reply_order.order_number)}}
                {{if (reply_order.replied == 1)}}
                <table class="order-table">
                    <caption>
                        <span style="color: #FA851B;font-size: 16px;">{{reply_order.seller.seller_name}}</span>给的报价
                    </caption>
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
                {{else}}
                    <p style="display: none;">{{count = count + 1}}</p>
                {{/if}}
            {{/if}}    
        {{/each}}
        <p>还有&nbsp;<span style="color: #FA851B;font-size: 16px;">{{count}}</span>&nbsp;个商家没有给出报价</p>
        
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
        url: appPath+'/Buyer/Manage/reply_order_list',
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