<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Bootstrap Css -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="page-content">
        <div class="container-fluid">
            <style>
                /* Adjust styles as needed */
                .invoice {
                    padding: 30px;
                }
                .invoice h2 {
                    margin-top: 0px;
                }
                .invoice .table {
                    margin-bottom: 0;
                }
                .invoice .payment-info {
                    font-weight: 500;
                }
                .invoice .table th {
                    padding: 10px 15px;
                    background: #f5f5f5;
                    border-bottom: 2px solid #eee;
                }
                .invoice .table td {
                    padding: 10px 15px;
                    border-bottom: 1px solid #eee;
                }
                .invoice .table td h3{
                    margin-bottom: 0px;
                    font-weight: 400;
                }
                .invoice .btn {
                    margin-top: 10px;
                    background: #60b347;
                    color: #fff;
                }
                .invoice .btn:hover {
                    background: #45a048;
                    color: #fff;
                }
                .invoice .notices {
                    padding-left: 6px;
                    border-left: 6px solid #0087C3;
                }
                .invoice .notices .notice {
                    font-size: 13px;
                }
                .invoice footer {
                    margin-top: 10px;
                    padding-top: 10px;
                    border-top: 1px solid #eee;
                    font-size: 12px;
                    text-align: center;
                }
            </style>
            <div class="container">
                <main>
                  <div class="row contacts">
                    <div class="card">
                      <div class="card-body">
                        <div id="invoice" class="container">
                          <div class="toolbar hidden-print">
                            {{-- <div class="text-end">
                              <button type="button" class="btn btn-dark">
                                <i class="fa fa-print"></i> Print </button>
                              <button type="button" class="btn btn-danger export-pdf" onclick="exportAsPDF()"> 
                                <i class="fa fa-file-pdf-o"></i> Export as PDF </button>
                            </div> --}}
                            {{-- <hr> --}}
                          </div>
                          <div id="element-id">
                              <div class="invoice overflow-auto">
                                <div class="row">
                                  <div class="col-md-6">
                                    <a href="javascript:;">
                                      <img src="{{ public_path('upload/banteng.jpg') }}" width="80" alt="">
                                      
                                    </a>
                                    <h2 class="name mt-2">
                                      <a target="_blank" href="javascript:;"> Arboshiki </a>
                                    </h2>
                                    <div class="address">455 Foggy Heights, AZ 85004, US</div>
                                    <div class="phone">(123) 456-789</div>
                                    <div class="email">company@example.com</div>
                                  </div>
                                  <div class="col-md-6 text-end">
                                    <h1 class="invoice-id mb-0">INVOICE 3-2-1</h1>
                                    <div class="date">Date of Invoice: 01/10/2018</div>
                                    <div class="date">Due Date: 30/10/2018</div>
                                  </div>
                                </div>
                                <div class="row mt-3">
                                  <div class="col-md-6 invoice-to">
                                    <div class="text-gray-light">INVOICE TO:</div>
                                    <h2 class="to">John Doe</h2>
                                    <div class="address">796 Silver Harbour, TX 79273, US</div>
                                    <div class="email">
                                      <a href="mailto:john@example.com">john@example.com</a>
                                    </div>
                                  </div>
                                  <div class="col-md-6 invoice-details text-end">
                                    <table class="float-end">
                                      <tbody>
                                        <tr>
                                          <td class="font-weight-bold">Invoice No:</td>
                                          <td>INVOICE 3-2-1</td>
                                        </tr>
                                        <tr>
                                          <td class="font-weight-bold">Invoice Date:</td>
                                          <td>01/10/2018</td>
                                        </tr>
                                        <tr>
                                          <td class="font-weight-bold">Due Date:</td>
                                          <td>30/10/2018</td>
                                        </tr>
                                      </tbody>
                                    </table>                        
                                  </div>
                                  
                                </div>
                                <div class="row mt-3">
                                  <div class="col-md-12">
                                    <table class="table table-bordered">
                                      <thead>
                                        <tr>
                                          <th>#</th>
                                          <th class="text-left">Nama Barang</th>
                                          <th class="text-right">Qty Isi</th>
                                          <th class="text-right">Qty Kosong</th>
                                          <th class="text-right">Harga</th>
                                          <th class="text-right">TOTAL</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td class="no">01</td>
                                          <td class="text-left">Gas 5KG</td>
                                          <td class="qty">30</td>
                                          <td class="qty">30</td>
                                          <td class="unit">$40.00</td>
                                          <td class="qty">$500.00</td>
                                        </tr>
                                        <tr>
                                          <td class="no">02</td>
                                          <td class="text-left">Gas 3KG</td>
                                          <td class="qty">30</td>
                                          <td class="qty">30</td>
                                          <td class="unit">$40.00</td>
                                          <td class="qty">$500.00</td>
                                        </tr>
                                        <tr>
                                            <td class="no">03</td>
                                            <td class="text-left">Gas 12KG</td>
                                            <td class="qty">30</td>
                                            <td class="qty">30</td>
                                            <td class="unit">$40.00</td>
                                            <td class="qty">$500.00</td>
                                        </tr>
                                        <tr>
                                          <td colspan="3" style="border-left: 3px solid white;border-bottom: 3px solid white;"></td>
                                          <td colspan="2" class="total-line">Subtotal</td>
                                          <td class="total-value">$2000.00</td>
                                        </tr>
                                        <tr>
                                          <td colspan="3" style="border-left: 3px solid white;border-bottom: 3px solid white;"></td>
                                          <td colspan="2" class="total-line">Pembayaran</td>
                                          <td class="total-value">$100.00</td>
                                        </tr>
                                        <tr>
                                          <td colspan="3" style="border-left: 3px solid white;border-bottom: 3px solid white;"></td>
                                          <td colspan="2" class="total-line">Status</td>
                                          <td class="total-value bg-success text-white font-weight-light" >Lunas</td>
                                        </tr>
                                      </tbody>
                                    </table>                            
                                  </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                      <b>Note:</b> Catatan atau keterangan lainnya bisa dituliskan di sini.
                                    </div>
                                    <div class="col-md-6 text-end">
                                      <i>Tertanda <b>John Dae</b></i>
                                    </div>
                                  </div>
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>            
                </main>
            </div>
        </div>
    </div>
</body>
</html>