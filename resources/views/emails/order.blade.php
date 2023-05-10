<!DOCTYPE html>
<html>
<head>
  <title>Đơn hàng số #</title>
  <style type="text/css" media="screen">
* {
  margin: 0;
  padding: 0;
  font-family: "Arial", sans-serif;
  box-sizing: border-box;
  font-size: 13px;
}

img {
  max-width: 100%;
}

body {
  -webkit-font-smoothing: antialiased;
  -webkit-text-size-adjust: none;
  width: 100% !important;
  height: 100%;
  line-height: 1.6;
}
table td {
  vertical-align: top;
}
body {
  background-color: #f6f6f6;
}

.body-wrap {
  background-color: #f6f6f6;
  width: 100%;
}

.container {
  display: block !important;
  margin: 0 auto !important;
  clear: both !important;
}

.content {
  margin: 0 auto;
  display: block;
  padding: 20px;
}


.main {
  background: #fff;
  border: 1px solid #e9e9e9;
  border-radius: 3px;
}

.content-wrap {
  padding: 20px;
}

.content-block {
  padding: 0 0 20px;
}

h1, h2, h3 {
  font-family: "Arial", sans-serif;
  color: #000;
  margin: 20px 0 0;
  line-height: 1.2;
  font-weight: 400;
}

h1 {
  font-size: 32px;
  font-weight: 500;
}

h2 {
  font-size: 24px;
}

h3 {
  font-size: 18px;
}

h4 {
  font-size: 14px;
  font-weight: 600;
}

p, ul, ol {
  margin-bottom: 10px;
  font-weight: normal;
}
p li, ul li, ol li {
  margin-left: 5px;
  list-style-position: inside;
}

a {
  color: #348eda;
  text-decoration: underline;
}

.last {
  margin-bottom: 0;
}

.first {
  margin-top: 0;
}

.padding {
  padding: 10px 0;
}

.aligncenter {
  text-align: center;
}

.alignright {
  text-align: right;
}

.alignleft {
  text-align: left;
}

.clear {
  clear: both;
}


.invoice {
  margin: 10px auto;
  text-align: left;
  width: 80%;
}
.invoice td {
  padding: 5px 0;
}

.invoice .invoice-items td {
  border-top: #eee 1px solid;
}
.invoice .invoice-items .total td {
  font-weight: 700;
}
.w50{
  min-width: 70px;
}
.w150{
  min-width: 150px;
}
.w200{
  min-width: 300px;
}
.w100{
  min-width: 100px;
}
.text-center {
  text-align: center;
}
.text-right{
  text-align: right;
}

  </style>
</head>
<body>
  <table class="body-wrap">
    <tr>
      <td></td>
      <td class="container" width="800">
        <div class="content">
          <table class="main" width="100%" cellpadding="0" cellspacing="0">
            <tr>
              <td class="content-wrap aligncenter">
                <table width="100%" cellpadding="0" cellspacing="0">
                  <tr>
                    <td><img src="https://aogiasi.com/uploads/banners/8/5/7/x85778716e71bb90ceaf58769934a1ed0.png.pagespeed.ic._5xR_ccIg0.webp" alt=""></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td class="content-block">
                      <h1>Đơn hàng số:</h1>
                    </td>
                  </tr>
                  <tr>
                    <td class="content-block">
                      <table class="invoice">
                        <tr>
                          <td><b>Khách hàng:</b> {{ $customer->name }}</td>
                        </tr>
                        <tr>
                          <td><b>Số điện thoại:</b> {{ $customer->phone }}</td>
                        </tr>
                        <tr>
                          <td><b>Email:</b> {{ $customer->email }}</td>
                        </tr>
                        <tr>
                          <td><b>Địa chỉ:</b> {{ $customer->address }}</td>
                        </tr>
                        <tr>
                          <td align="center"><b>CHI TIẾT ĐƠN HÀNG</b></td>
                        </tr>                                                                        
                        <tr>
                          <td>
                            <table class="invoice-items" cellpadding="0" cellspacing="0" width="800">
                              <thead style="background: #e3e3e3;padding: 5px 0px;">
                              <tr>
                                <th class="w50 text-center" style="background: #e3e3e3;padding: 5px 0px;">STT</th>
                                <th class="w200" style="background: #e3e3e3;padding: 5px 0px;">Tên hàng</th>
                                <th class="w50 text-center" style="background: #e3e3e3;padding: 5px 0px;">Hình ảnh</th>
                                <th class="w100 text-right" style="background: #e3e3e3;padding: 5px 0px;">Đơn giá (đ)</th>
                                <th class="w50 text-center" style="background: #e3e3e3;padding: 5px 0px;">SL</th>
                                <th class="w150 text-right" style="background: #e3e3e3;padding: 5px 0px;">Thành tiền (đ)</th>
                              </tr>                                 
                              </thead> 
                              @if (isset($orderItems) && count($orderItems) > 0)
                              <?php $i = 0; ?>
                              @foreach ($orderItems as $item)                          
                              <?php $i++;?>
                              <tr>
                                <td class="w50 text-center">{{$i}}</td>
                                <td class="w200">{{$item->name}} <br> Màu: {{ $item->options->color }}</td>
                                <td class="50 text-center">
									@if ($item->options->image != '')
                                        <img src="{{ \App\Helpers\MyHtml::showThumb($item->options->image, 'product', 'small') }}">
                                    @endif                                	
                                </td>
                                <td class="w100 text-right">{!! Currency::display($item->price, 'vn') !!}</td>
                                <td class="w50 text-center">{{$item->qty}}</td>
                                <td class="w150 text-right">{!! Currency::display($item->qty * $item->price, 'vn') !!}</td>
                              </tr>
                              @endforeach
                              @endif
                              <tr class="total">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="alignright" width="80%">Khuyến mại</td>
                                <td class="alignright">{{number_format($data['discount'])}} đ</td>
                              </tr>                              
                              <tr class="total">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="alignright" width="80%">Tổng tiền</td>
                                <td class="alignright">{{number_format($data['total_amount'] - $data['discount'])}} đ</td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td class="content-block">
                      Aogiasi.com. 75 Công Chúa Ngọc Hân Phường 12 Quận 11 TP.HCM
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
          <div class="footer">
            <table width="100%">
              <tr>
                <td class="aligncenter content-block">Được gửi từ  <a href="https://aogiasi.com">Aogiasi.com</a></td>
              </tr>
            </table>
          </div></div>
      </td>
      <td></td>
    </tr>
  </table>
</body>
</html>