<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Tooltip Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used for various help texts.
    |
    */

    'product_stock_alert' => "库存较低的产品。<br/><small class='text-muted'>基于在添加产品屏幕中设置的产品警戒数量。<br>在库存耗尽之前购买这些产品。</small>",

    'payment_dues' => "未支付的购买款项。<br/><small class='text-muted'>基于供应商的付款期限。<br/>显示在7天或更短时间内要支付的款项。</small>",

    'input_tax' => '在所选时间段内销售收取的总税款。',

    'output_tax' => '在所选时间段内购买支付的总税款。',

    'tax_overall' => '在所选时间段内收取的总税款与支付的总税款之间的差异。',

    'purchase_due' => '购买的总未支付金额。',

    'sell_due' => '销售待收总额',

    'over_all_sell_purchase' => '-ve 值 = 需支付的金额 <br>+ve 值 = 需收到的金额',

    'no_of_products_for_trending_products' => '要在下面的图表中比较的热门产品数量。',

    'top_trending_products' => "您店铺的畅销产品。<br/><small class='text-muted'>应用筛选器以了解特定类别、品牌、业务地点等的热门产品。</small>",

    'sku' => "唯一的产品 ID 或库存保管单位（SKU）<br><br>留空以自动生成 SKU。<br><small class='text-muted'>您可以在业务设置中修改 SKU 前缀。</small>",

    'enable_stock' => "启用或禁用产品的库存管理。<br><br><small class='text-muted'>库存管理应该在大多数服务上禁用。例如：理发，维修等。</small>",

    'alert_quantity' => "当产品库存达到或低于指定数量时收到警报。<br><br><small class='text-muted'>低库存的产品将显示在仪表板 - 产品库存警报部分。</small>",

    'product_type' => '<b>单一产品</b>：没有变体的产品。
    <br><b>可变产品</b>：具有大小、颜色等变体的产品。
    <br><b>组合产品</b>：多个产品的组合，也称为捆绑产品',

    'profit_percent' => "产品的默认利润率。<br><small class='text-muted'>(<i>您可以在业务设置中管理默认利润率。</i>)</small>",

    'pay_term' => "在给定的时间段内购买/销售支付的款项。<br/><small class='text-muted'>所有即将到期或到期的款项将显示在仪表板 - 到期款项部分。</small>",

    'order_status' => '仅当<b>订单状态</b>为<b>已收到物品</b>时，此购买中的产品才可供销售。',

    'purchase_location' => '购买产品将可在其中出售的业务位置。',

    'sale_location' => '您希望销售的业务位置',

    'sale_discount' => "在业务设置中为所有销售设置“默认销售折扣”。单击下面的编辑图标以添加/更新折扣。",
    
    'sale_tax' => "在业务设置中为所有销售设置“默认销售税”。单击下面的编辑图标以添加/更新订单税。",

    'default_profit_percent' => "产品的默认利润率。<br><small class='text-muted'>用于根据输入的购买价格计算销售价格。<br/>您可以在添加时为单个产品修改此值。</small>",

    'fy_start_month' => '财政年度开始的月份',

    'business_tax' => '您企业的注册税号。',

    'invoice_scheme' => "发票方案表示发票编号格式。选择要在此业务位置使用的方案<br><small class='text-muted'><i>您可以在发票设置中添加新的发票方案</i></small>",

    'invoice_layout' => "要在此业务位置使用的发票布局<br><small class='text-muted'>(<i>您可以在<i>发票设置<i></b>中添加新的<b>发票布局<b></i>)</small>",

    'invoice_scheme_name' => '为发票方案提供一个简短而有意义的名称。',

    'invoice_scheme_prefix' => '发票方案的前缀。<br>前缀可以是自定义文本或当前年份。例如：#XXXX0001，#2018-0002',

    'invoice_scheme_start_number' => "发票编号的起始编号。<br><small class='text-muted'>您可以将其设置为1或从其开始的任何其他编号。</small>",

    'invoice_scheme_count' => '为发票方案生成的发票总数',

    'invoice_scheme_total_digits' => '发票编号的长度，不包括发票前缀',

    'tax_groups' => '用于在购买/销售部分中组合使用的组税率，以上定义。',

    'unit_allow_decimal' => '小数位允许您以分数的形式销售相关产品。',

    'print_label' => '添加产品 -> 选择标签中要显示的信息 -> 选择条形码设置 -> 预览标签 -> 打印',

    'expense_for' => '选择与费用相关的用户。<i>（可选）</i><br/><small>示例：雇员的工资。</small>',

    'all_location_permission' => '如果选择了<b>所有位置</b>，则此角色将有权限访问所有业务位置',

    'dashboard_permission' => '如果未选中，仅在主页中显示欢迎消息。',

    'access_locations_permission' => '选择此角色可以访问的所有位置。所有选择的位置的所有数据将仅显示给用户。<br/><br/><small>例如：您可以使用此定义特定位置的<i>店长 / 收银员 / 库存经理 / 分店经理</i>。</small>',

    'print_receipt_on_invoice' => '启用或禁用在最终确定时自动打印发票',

    'receipt_printer_type' => '<i>基于浏览器的打印</i>：显示具有发票预览的浏览器打印对话框<br/><br/> <i>使用配置的收据打印机</i>：选择已配置的收据/热敏打印机进行打印',

    'adjustment_type' => '<i>正常</i>：出于正常原因（如泄漏、损坏等）的调整。 <br/><br/> <i>异常</i>：由于火灾、事故等原因的调整。',

    'total_amount_recovered' => '从保险或废品销售等收回的金额',

    'express_checkout' => '标记为已支付并结帐',
    'total_card_slips' => '在此注册中使用的卡支付的总数',
    'total_cheques' => '在此注册中使用的支票总数',

    'capability_profile' => "打印机供应商和型号之间对命令和代码页的支持因供应商和型号而异。如果不确定，最好使用“简单”能力配置文件",

    'purchase_different_currency' => '如果您在与业务货币不同的货币中购买，请选择此选项',

    'currency_exchange_factor' => "1 购买货币 =？基本货币 <br> <small class='text-muted'>您可以从业务设置中启用/禁用'以其他货币购买'</small>",

    'accounting_method' => '会计方法',

    'transaction_edit_days' => '从交易日期起的天数，可在此期间内编辑交易。',
    'stock_expiry_alert' => ":days 天内到期的库存列表 <br> <small class='text-muted'>您可以在业务设置中设置天数 </small>",
    'sub_sku' => 'Sku 是可选的。<br><br><small>留空以自动生成 sku。<small>',
    'shipping' => '设置运输详细信息和运输费用。单击下面的编辑图标以添加/更新运输详细信息和费用。',
];
